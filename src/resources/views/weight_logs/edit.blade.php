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

        <!-- 更新フォーム -->
        <form action="{{ route('weight_logs.update', $log->id) }}" method="POST" class="mt-3 update-form" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">日付</label>
                <input type="text" name="date" class="form-control"
                    value="{{ \Carbon\Carbon::parse($log->date)->format('Y-m-d') }}">
                @error('date') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">体重</label>
                <div class="input-group">
                    <input type="text" name="weight" class="form-control" value="{{ $log->weight }}">
                    <span class="input-group-text">kg</span>
                </div>
                @error('weight') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">摂取カロリー</label>
                <div class="input-group">
                    <input type="text" name="calories" class="form-control" value="{{ $log->calories }}">
                    <span class="input-group-text">cal</span>
                </div>
                @error('calories')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">運動時間（hh:mm）</label>
                <input type="text" name="exercise_time" class="form-control" value="{{ $log->exercise_time }}">
                @error('exercise_time')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">運動内容</label>
                <textarea name="exercise_content" class="form-control" placeholder="運動内容を追加">{{ $log->exercise_content }}</textarea>
                @error('exercise_content')
                <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>

            <!-- ボタン配置: 戻る & 更新（中央寄せ） -->
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-gradient update-button">更新</button>
            </div>
        </form> <!-- 更新フォーム終了 -->

        <!-- 削除ボタンを右寄せ & コンパクト化 -->
        <div class="text-end mt-3">
            <form action="{{ route('weight_logs.destroy', $log->id) }}" method="POST" class="delete-form d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger px-3 delete-button">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ✅ 削除ボタンの確認ダイアログ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ✅ 削除ボタンの処理
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!confirm('本当に削除しますか？')) {
                event.preventDefault(); // 削除をキャンセル
            }
        });
    });

    // ✅ 更新ボタンのクリックイベントを確認
    document.querySelector('.update-button').addEventListener('click', function(event) {
        console.log("更新ボタンがクリックされました");
    });

    // ✅ 更新フォームの submit イベントを確認
    document.querySelector('.update-form').addEventListener('submit', function(event) {
        console.log("更新フォームが送信されました");
    });
});
</script>
@endsection
