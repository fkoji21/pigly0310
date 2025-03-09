@extends('layouts.app')

@section('header') {{-- ヘッダーを非表示にする --}} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card register__container p-4">
        <h1 class="login__title">PiGLy</h1>
        <h2 class="register__subtitle">STEP1 アカウント情報の登録</h2>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label class="form-label text-start d-block">お名前</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="名前を入力">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-start d-block">メールアドレス</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="メールアドレスを入力">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-start d-block">パスワード</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="パスワードを入力">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn register__submit">次に進む</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="/login" class="register__login-link">ログインはこちら</a>
        </div>
    </div>
</div>
@endsection
