@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
@endsection

@section('content')
<div class="container-fluid weight-log__container">

    <div class="weight-log__summary">
        <div class="summary__box">
            <span class="summary__label">目標体重</span>
            <span class="summary__value">{{ $targetWeight ?? '-' }} kg</span>
        </div>
        <div class="summary__box">
            <span class="summary__label">目標まで</span>
            <span class="summary__value">{{ isset($latestWeight, $targetWeight) ? number_format($latestWeight - $targetWeight, 1) : '-' }} kg</span>
        </div>
        <div class="summary__box">
            <span class="summary__label">最新体重</span>
            <span class="summary__value">{{ $latestWeight ?? '-' }} kg</span>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <input type="date" name="start_date" class="form-control d-inline w-auto">
            <span>〜</span>
            <input type="date" name="end_date" class="form-control d-inline w-auto">
            <button class="btn btn-secondary weight-log__search">検索</button>
            <button class="btn btn-outline-secondary weight-log__reset">リセット</button>
        </div>
        @if(session('success'))
        <div id="success-message" class="alert alert-success text-center">
            {{ session('success') }}
        </div>
        @endif
        <button type="button" class="btn weight-log__add" data-bs-toggle="modal" data-bs-target="#createModal">
            データ追加
        </button>
    </div>

    <table class="table table-bordered table-hover text-center">
        <thead class="table-pink">
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weightLogs as $log)
            <tr>
                <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                <td>{{ number_format($log->weight, 1) }}kg</td>
                <td>{{ $log->calories ?? '-' }}cal</td>
                <td>{{ $log->exercise_time ?? '00:00' }}</td>
                <td>
                    <a href="{{ route('weight_logs.edit', $log->id) }}" class="btn btn-outline-primary btn-sm">
                        ✏️
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination d-flex justify-content-center mt-3">
        @if ($weightLogs->hasPages())
        <nav>
            <ul class="pagination">
                {{-- 前へボタン --}}
                <li class="page-item {{ $weightLogs->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $weightLogs->previousPageUrl() }}" aria-label="前">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- ページ番号 --}}
                @foreach ($weightLogs->getUrlRange(1, $weightLogs->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $weightLogs->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach

                {{-- 次へボタン --}}
                <li class="page-item {{ $weightLogs->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $weightLogs->nextPageUrl() }}" aria-label="次">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        @endif
    </div>

</div>

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Weight Logを追加</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body">
                @include('weight_logs.create')
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // バリデーションエラーがある場合、モーダルを表示
        <?php if ($errors->any()): ?>
            var myModal = new bootstrap.Modal(document.getElementById('createModal'));
            myModal.show();
        <?php endif; ?>

        // 成功メッセージ（登録 or 削除）のフェードアウト処理
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.transition = "opacity 1s ease-in-out";
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 1000); // 完全に消す
            }, 3000); // 3秒後に消える
        }
    });
</script>

@endsection