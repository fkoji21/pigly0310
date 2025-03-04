@extends('layouts.app')

@section('content')
<div class="register__content">
    <div class="register-form__heading">
        <h2>初期体重登録</h2>
    </div>
    <form class="form" action="{{ route('register.step2.store') }}" method="post">
        @csrf

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">目標体重 (kg)</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="target_weight" value="{{ old('target_weight') }}" />
                </div>
                @error('target_weight')
                <div class="form__error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection