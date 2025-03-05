@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="container d-flex justify-content-center" style="margin-top: 20px;">
    <div class="card shadow-sm p-5 w-50">
        <h2 class="text-center mb-4">Weight Log</h2>

        @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('weight_logs.update', $log->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">日付</label>
                <input type="date" name="date" class="form-control"
                    value="{{ \Carbon\Carbon::parse($log->date)->format('Y-m-d') }}" required>
                @error('date') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">体重（kg）</label>
                <input type="number" name="weight" class="form-control" value="{{ $log->weight }}" step="0.1" required>
                @error('weight') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">摂取カロリー</label>
                <input type="number" name="calories" class="form-control" value="{{ $log->calories }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">運動時間（hh:mm）</label>
                <input type="time" name="exercise_time" class="form-control" value="{{ $log->exercise_time }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">運動内容</label>
                <textarea name="exercise_content" class="form-control" placeholder="運動内容を追加">{{ $log->exercise_content }}</textarea>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-gradient">更新</button>
            </div>
        </form>

        <form action="{{ route('weight_logs.destroy', $log->id) }}" method="POST" class="text-center mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                <i class="fas fa-trash"></i> 削除
            </button>
        </form>
    </div>
</div>
@endsection