@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="goal-setting">
    <div class="goal-setting__box">
        <h2>目標体重設定</h2>
        <form action="{{ route('weight_logs.goal_update') }}" method="POST">
            @csrf
            <div class="goal-setting__input">
                <input type="text" name="target_weight" value="{{ old('target_weight', $weightTarget->target_weight ?? '') }}" /> kg
            </div>
            @error('target_weight')
            <div class="form__error">
                {{ $message }}
            </div>
            @enderror
            <div class="goal-setting__buttons">
                <a href="{{ route('weight_logs.index') }}" class="goal-setting__button goal-setting__cancel">戻る</a>
                <button type="submit" class="goal-setting__button goal-setting__submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection