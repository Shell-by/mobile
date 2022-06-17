@extends('layouts.start')

@section('on-body-tag')
    <style>
        div {
            font-size: 1.1rem
        }
    </style>
@endsection

@section('in-body-tag')
    <div class="text-end">
        <a href="{{ url('/') }}/Main" class="btn btn-secondary mb-3 mx-2 mt-2">
            <div>홈</div>
        </a>
        <a href="{{ url('/') }}/viewer/{{ $book }}" class="btn btn-secondary mb-3 mx-2 mt-2">
            <div>책</div>
        </a>
    </div>

    <div class="mx-5 mt-2 mb-5">
        {{ $content }}
    </div>

    <div class="row mx-3">
        @if ($lastPage != 0)
            <a href="{{ url('/') }}/reader/{{ $book }}/{{ $nextPage }}" class="col-12 btn btn-primary mb-3">
                <div>{{ $nextPage }}화</div>
            </a>
        @else
            <a href="{{ url('/') }}/viewer/{{ $book }}" class="col-12 btn btn-primary mb-3">
                <div>현재 마지막화입니다.</div>
            </a>
        @endif
    </div>
@endsection
