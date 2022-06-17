@extends('layouts.start')

@section('on-body-tag')
<style>
    form {
        margin: 210px 10px 10px 0px;
    }
</style>
@endsection

@section('in-body-tag')
<form method="post" action="{{url('/')}}/signup1" onsubmit="return SubmitCheck()">
    @method('post')
    @csrf

    <input type="hidden" name="randomKey" value="138974895"/>

    <span class="input-group-text mx-3 mb-3">현재 네이버만 됩니다.</span>
    <div class="mx-3 form-floating mb-3">
        <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
        <label for="floatingInput">이메일 주소</label>
    </div>

    <div class="row mx-3 mb-3">
        <button type="button" class="btn btn-primary col-12" onclick="EmailCheck()">이메일 인증</button>
    </div>

    <div class="mx-3 form-floating mb-3">
        <input name="key" type="text" class="form-control" id="key" placeholder="name@example.com">
        <label for="floatingInput">인증 번호</label>
    </div>
    <div class="mb-3 text-end mx-3">
        <a href="{{url('/')}}/">로그인</a>
    </div>

    <div class="row mx-3">
        <button type="submit" class="btn btn-primary col-12">다음</button>
    </div>
</form>
@endsection

@section('under-body-tag')
<script>
    function EmailCheck() {

        console.log(1);

        let email = document.querySelector('#email').value;
        let url = "http://localhost:8000/send/" + email;

        fetch(url)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data);
                document.querySelector('[name="randomKey"]').value = data.randomInt;
            });
    }

    function SubmitCheck() {
        if (document.querySelector('#email').value.length === 0) {
            alert('이메일을 확인해주세요')
            return false;
        }

        if (document.querySelector('[name="randomKey"]').value !== document.querySelector('#key').value) {
            alert('인증 번호가 맞지 않습니다.');
            return false;
        }

        return true;
    }
</script>
@endsection
