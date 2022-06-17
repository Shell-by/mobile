@extends('layouts.start')

@section('on-body-tag')
<style>
    form {
        margin: 250px 10px 10px 0px;
    }
</style>
@endsection

@section('in-body-tag')
    <form method="POST" action="{{url('/')}}/">
        @method('post')
        @csrf

        <div class="mx-3 form-floating mb-3">
            <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
            <label for="email">이메일 주소</label>
        </div>
        <div class="mx-3 form-floating mb-1">
            <input name="passwrod" type="password" class="form-control" id="passwrod" placeholder="Password">
            <label for="passwrod">비밀번호</label>
        </div>
        <div class="mb-3 text-end mx-3">
            <a href="{{url('/')}}/signup1">회원가입</a>
        </div>

        <div class="row mx-3">
            <button type="submit" class="btn btn-primary col-12">로그인</button>
        </div>

    </form>
@endsection
