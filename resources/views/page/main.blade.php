@extends('layouts.start')

@section('on-body-tag')
    <style>
        a {
            text-decoration: none;
            color: black;
        }
    </style>
@endsection

@section('in-body-tag')
    <div class="mt-3 mb-3 mx-4" style="text-align: end">
        <a class="btn btn-outline-secondary" href="{{url('/')}}/logout"><div>logout</div></a>
    </div>

    <!-- data를 받아 foreach 보여줌 -->
    @foreach ($books as $book)
    <a href="{{url('/')}}/viewer/{{$book->id}}">
        <div class="card mx-auto mb-3" style="width: 20rem;">
            <img src="images/100123.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$book->title}}</h5>
            </div>
        </div>
    </a>
    @endforeach

@endsection
