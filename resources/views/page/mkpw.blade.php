@extends('layouts.start')

@section('on-body-tag')
<style>
    form {
        margin: 230px 10px 10px 0px;
    }
</style>
@endsection

@section('in-body-tag')
    <form method="post" action="{{url('/')}}/signup2" onsubmit="return SubmitCheck()">
        @method('post')
        @csrf

        <input type="hidden" name="secretEmail" value="{{session('email')}}" />

        <div class="mx-3 form-floating mb-3">
            <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com" value="{{ session('email') }}">
            <label for="floatingInput">이메일 주소</label>
        </div>

        <div class="mx-3 form-floating mb-3">
            <input name="passwrod" type="password" class="form-control" id="pw" placeholder="Password">
            <label for="floatingPassword">비밀번호</label>
        </div>

        <div class="mx-3 form-floating mb-1">
            <input type="password" class="form-control" id="pwCheck" placeholder="Password">
            <label for="floatingPassword">비밀번호 확인</label>
        </div>

        <div class="mb-3 text-end mx-3">
            <a href="{{url('/')}}/">로그인</a>
        </div>

        <div class="row mx-3">
            <button type="submit" class="btn btn-primary col-12">회원가입</button>
        </div>
    </form>
@endsection

@section('under-body-tag')
    <script>
        function SubmitCheck() {
            if (document.querySelector('#email').value.length === 0) {
                alert('이메일을 확인해주세요');
                return false;
            }

            if (document.querySelector('#pw').value.length === 0) {
                alert('비밀번호를 확인해주세요');
                return false;
            }

            if (document.querySelector('#pwCheck').value.length === 0) {
                alert('비밀번호 확인을 확인해주세요');
                return false;
            }

            if (document.querySelector('#pwCheck').value !== document.querySelector('#pw').value) {
                alert('비밀번호와 비밀번호 확인을 확인해주세요');
                return false;
            }

            return true;
        }
    </script>
@endsection
