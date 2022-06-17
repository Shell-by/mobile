@extends('layouts.start')

@section('on-body-tag')
    <style>
        a {
            text-decoration-line: none;
        }
    </style>
@endsection

@section('in-body-tag')

    <div class="mt-3 mb-3 mx-4" style="text-align: end">
        <a class="btn btn-secondary" href="{{url('/')}}/Main"><div>홈</div></a>
    </div>

    <!-- 받은 id의 책의 정보를 가져옴 -->
    <div class="card mb-3">
        <img src="../images/100123.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <p class="card-text">{{$book->title}}</p>
        </div>
    </div>

    <!-- 사용자 정보에 최근에 읽었던 화를 저장하여 그것을 보여줌 -->

    @if ($lastPage == null)
    <div class="row">
        <a href="{{url('/')}}/reader/{{$book->id}}/1" class="col-12 btn btn-primary mb-3"><div>1화 바로가기</div></a>
    </div>
    @else
        <div class="row">
            <a href="{{url('/')}}/reader/{{$book->id}}/{{$lastPage->pages_id}}" class="col-12 btn btn-primary mb-3"><div>(최근에 읽었던 화 바로가기)</div></a>
        </div>
    @endif

    <!-- 책의 편수를 data로 가져와 foreach로 보여줌 -->
    <ul class="list-group">
        @php
            $cnt = 0;
        @endphp
        @foreach ($pages as $page)
            <a href="{{url('/')}}/reader/{{$book->id}}/{{$page->page}}"><li class="list-group-item btn">{{++$cnt}}화</li></a>
        @endforeach
    </ul>
@endsection
