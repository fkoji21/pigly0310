@extends('layouts.app')

@section('header') {{-- ヘッダーを非表示にする --}} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__container">
    <h1 class="register__title">PiGLy</h1>
    <h2 class="register__subtitle">STEP2 体重データの入力</h2>

    <form method="POST" action="{{ route('register.step2.store') }}">
        @csrf

        <div class="form-group">
            <label>現在の体重</label>
            <input type="text" name="current_weight" class="form-control @error('current_weight') is-invalid @enderror" value="{{ old('current_weight') }}">
            @error('current_weight')
            <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>目標の体重</label>
            <input type="text" name="target_weight" class="form-control @error('target_weight') is-invalid @enderror" value="{{ old('target_weight') }}">
            @error('target_weight')
            <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__button">
            <button type="submit" class="btn register__submit">アカウント作成</button>
        </div>
    </form>
</div>
@endsection