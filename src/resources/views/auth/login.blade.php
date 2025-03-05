@extends('layouts.app')

@section('header') {{-- ヘッダーを非表示にする --}} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__container">
    <h1 class="login__title">PiGLy</h1>
    <h2 class="login__subtitle">ログイン</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf
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
            <button type="submit" class="btn login__submit">ログイン</button>
        </div>
    </form>

    <div class="login__footer">
        <a href="/register" class="login__register-link">会員登録はこちら</a>
    </div>
</div>
@endsection