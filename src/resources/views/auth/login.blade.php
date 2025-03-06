@extends('layouts.app')

@section('header') {{-- ヘッダーを非表示にする --}} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 15px;">
        <h1 class="text-center login__title">PiGLy</h1>
        <h2 class="text-center login__subtitle">ログイン</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label text-start d-block">メールアドレス</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="メールアドレス">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-start d-block">パスワード</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="パスワード">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="login__submit">ログイン</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="/register" class="login__register-link">アカウント作成はこちら</a>
        </div>
    </div>
</div>
@endsection