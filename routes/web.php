<?php

use App\Mail\Email;
use App\Models\Book;
use App\Models\Last_page;
use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', function() {
    session()->forget('user');
    return redirect('/');
});

Route::get('/', function () {
    if (session('user') !== null) return redirect('/Main');
    return view('page/index');
});
Route::post('/', function (Request $request) {
    if (session('user') !== null) return redirect('/Main');

    $count = User::where('email', $request->email)
        ->where('password', base64_encode(hash('sha256', $request->password, 'true')))
        ->where('checked', 1)
        ->count();

    if ($count === 0) {
        return redirect('/');
    } else {
        session()->put('user', User::where('email', $request->email)->where('password', base64_encode(hash('sha256', $request->password, 'true')))->first()->id);
        return redirect('/Main');
    }
});

Route::get('/signup1', function () {
    if (session('user') !== null) return redirect('/Main');
    return view('page.signup');
});
Route::post('/signup1', function (Request $request) {
    if (session('user') !== null) return redirect('/Main');

    $count = User::where('email', $request->email)
        ->count();
        if ($count === 0) {
            return redirect('/signup2')->with('email', User::where('email', $request->email)->get()->id);
        }
        echo "
        <script>
            alert('이미 있는 이메일입니다.');
        </script>
        ";
        return redirect('/');
});

Route::get('/signup2', function () {
    if (session('user') !== null) return redirect('/Main');
    if (session('email') === null) return redirect('/signup1');
    return view('page.mkpw');
});
Route::post('/signup2', function (Request $request) {
    if (session('user') !== null) return redirect('/Main');
    if ($request->secretEmail !== $request->email) {
        echo "
        <script>
            alert('이메일이 잘못되었습니다.');
        </script>
        ";
        return redirect('/');
    }
    $user = new User();
    $user->email = $request->email;
    $user->checked = 1;
    $user->password = base64_encode(hash('sha256', $request->password, 'true'));
    $user->save();

    return redirect('/');
});

Route::get('/Main', function () {
    if (session('user') === null) return redirect('/');
    return view('page.main')->with('books', Book::all());
});

Route::get('/viewer/{id}', function ($id) {
    if (session('user') === null) return redirect('/');
    return view('page.viewer')
        ->with('book', Book::find($id))->with('pages', Page::where('books_id', $id)->get())
        ->with('lastPage', Last_page::where('books_id', $id)->where('users_id', session('user'))->first());
});

Route::get('/reader/{id}/{page}', function ($id, $page) {
    if (session('user') === null) return redirect('/');
    $lastPage = null;
    if (Last_page::where('users_id', session('user'))->where('books_id', $id)->count() === 0) {
        $lastPage = new Last_page();
        $lastPage->users_id = session('user');
        $lastPage->books_id = $id;
        $lastPage->pages_id = $page;
    } else {
        $lastPage = Last_page::where('users_id', session('user'))->where('books_id', $id)->first();
        $lastPage->pages_id = $page;
    }
    $lastPage->save();

    return view('page.reader')
        ->with('content', Page::where('books_id', $id)->where('page', $page)->first()->content)
        ->with('lastPage', Page::where('books_id', $id)->where('page', ($page + 1))->count())
        ->with('book', $id)
        ->with('nextPage', ($page + 1));
});

Route::get('/send/{email}', function($email) {
    $randomInt = random_int(10000,99999);
    Mail::to($email)->send(new Email($randomInt));

    return response()
        ->json([
            'randomInt' => $randomInt,
        ], 200)->header("Access-Control-Allow-Origin", "*");
});
