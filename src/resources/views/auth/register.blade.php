@extends('layouts.app')

@section('header') {{-- ヘッダーを非表示にする --}} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__container">
    <h1 class="register__title">PiGLy</h1>
    <h2 class="register__subtitle">新規会員登録</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>お名前</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
            <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
            <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
            <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__button">
            <button type="submit" class="btn register__submit">次に進む</button>
        </div>
    </form>

    <div class="register__footer">
        <a href="/login" class="register__login-link">ログインはこちら</a>
    </div>
</div>
@endsection