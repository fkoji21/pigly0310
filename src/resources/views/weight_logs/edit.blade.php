@extends('layouts.app')

@section('content')
<div class="container">
    <h2>体重編集</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('weight_logs.update', $log->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>日付</label>
            <input type="date" name="date" class="form-control" value="{{ $log->date }}" required>
            @error('date') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>体重（kg）</label>
            <input type="number" name="weight" class="form-control" value="{{ $log->weight }}" step="0.1" required>
            @error('weight') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>摂取カロリー</label>
            <input type="number" name="calories" class="form-control" value="{{ $log->calories }}">
        </div>

        <div class="form-group">
            <label>運動時間（hh:mm）</label>
            <input type="time" name="exercise_time" class="form-control" value="{{ $log->exercise_time }}">
        </div>

        <div class="form-group">
            <label>運動内容</label>
            <textarea name="exercise_content" class="form-control">{{ $log->exercise_content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">更新する</button>
    </form>

    <form action="{{ route('weight_logs.destroy', $log->id) }}" method="POST" style="margin-top: 10px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">削除</button>
    </form>
</div>
@endsection