@extends('layouts.app')

@section('header') {{-- ヘッダーを非表示にする --}} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card register__container p-4">
        <h1 class="login__title">PiGLy</h1>
        <h2 class="register__subtitle">STEP2 体重データの入力</h2>

        <form method="POST" action="{{ route('register.step2.store') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label text-start d-block">現在の体重</label>
                <div class="input-group">
                    <input type="text" name="current_weight" class="form-control @error('current_weight') is-invalid @enderror" placeholder="現在の体重を入力" value="{{ old('current_weight') }}" autocomplete="off"  step="0.1">
                    <span class="input-group-text">kg</span>
                </div>
                @error('current_weight')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-start d-block">目標の体重</label>
                <div class="input-group">
                    <input type="text" name="target_weight" class="form-control @error('target_weight') is-invalid @enderror" placeholder="目標の体重を入力" value="{{ old('target_weight') }}" autocomplete="off" step="0.1">
                    <span class="input-group-text">kg</span>
                </div>
                @error('target_weight')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn register__submit">アカウント作成</button>
            </div>
        </form>
    </div>
</div>
@endsection
