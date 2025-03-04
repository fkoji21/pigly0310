@extends('layouts.app')

@section('content')
<div class="container">
    <h2>体重記録</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('weight_logs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>日付</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
            @error('date') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>体重（kg）</label>
            <input type="number" name="weight" class="form-control" value="{{ old('weight') }}" step="0.1" required>
            @error('weight') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>摂取カロリー</label>
            <input type="number" name="calories" class="form-control" value="{{ old('calories') }}">
        </div>

        <div class="form-group">
            <label>運動時間（hh:mm）</label>
            <input type="time" name="exercise_time" class="form-control" value="{{ old('exercise_time') }}">
        </div>

        <div class="form-group">
            <label>運動内容</label>
            <textarea name="exercise_content" class="form-control">{{ old('exercise_content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">記録する</button>
    </form>
</div>
@endsection