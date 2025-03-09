@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal.css') }}">
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 text-center border-0" style="max-width: 400px; width: 100%;">
        <h2 class="mb-3">目標体重設定</h2>
        <form action="{{ route('weight_logs.goal_update') }}" method="POST" novalidate>
            @csrf
            <div class="d-flex align-items-center justify-content-center mb-3">
                <input type="number" name="target_weight" class="form-control text-center w-50"
                    value="{{ old('target_weight', $weightTarget->target_weight ?? '') }}">
                <span class="ms-2">kg</span>
            </div>
            @error('target_weight')
            <div class="text-danger small">
                {{ $message }}
            </div>
            @enderror
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary w-45 text-decoration-none">戻る</a>
                <button type="submit" class="btn btn-gradient w-45">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
