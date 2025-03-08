@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
@endsection

@section('content')
<div class="container-fluid weight-log__container">

    {{-- 目標体重・最新体重セクション（白背景） --}}
    <div class="weight-log__summary">
        <div class="summary__box">
            <span class="summary__label">目標体重</span>
            <span class="summary__value">{{ $targetWeight ?? '-' }}<span class="unit">kg</span></span>
        </div>
        <div class="summary__box">
            <span class="summary__label">目標まで</span>
            <span class="summary__value">{{ isset($latestWeight, $targetWeight) ? number_format($latestWeight - $targetWeight, 1) : '-' }}<span class="unit">kg</span></span>
        </div>
        <div class="summary__box">
            <span class="summary__label">最新体重</span>
            <span class="summary__value">{{ $latestWeight ?? '-' }}<span class="unit">kg</span></span>
        </div>
    </div>

    {{-- 検索フォーム & テーブルブロック（白背景） --}}
    <div class="weight-log__table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <form action="{{ route('weight_logs.index') }}" method="GET">
                    <input type="date" name="start_date" class="form-control d-inline w-auto" value="{{ request('start_date') }}">
                    <span>〜</span>
                    <input type="date" name="end_date" class="form-control d-inline w-auto" value="{{ request('end_date') }}">
                    <button type="submit" class="btn btn-secondary weight-log__search">検索</button>
                    <a href="{{ route('weight_logs.index') }}" class="btn btn-outline-secondary">リセット</a>
                </form>
            </div>
            <button type="button" class="btn weight-log__add" data-bs-toggle="modal" data-bs-target="#createModal">
                データ追加
            </button>
        </div>
        @if(request('start_date') && request('end_date'))
        <p>{{ request('start_date') }} ～ {{ request('end_date') }} の検索結果 {{ $resultCount }} 件</p>
        @endif

        {{-- テーブル --}}
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                    <th></th>
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
                        <a href="{{ route('weight_logs.edit', $log->id) }}" class="btn btn-outline-primary btn-sm edit-icon">
                            <img src="{{ asset('images/edit-icon.png') }}" alt="編集" width="20">
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ページネーション --}}
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

</div>
<!-- モーダル -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Weight Logを追加</h5>
            </div>
            <div class="modal-body">
                <form id="weightLogForm" action="{{ route('weight_logs.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="date" class="form-label">日付 <span class="required">必須</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date">
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">体重 <span class="required">必須</span></label>
                        <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" step="0.1">
                        @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="calories" class="form-label">摂取カロリー <span class="required">必須</span></label>
                        <input type="number" class="form-control @error('calories') is-invalid @enderror" id="calories" name="calories">
                        @error('calories')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exercise_time" class="form-label">運動時間 <span class="required">必須</span></label>
                        <input type="time" class="form-control @error('exercise_time') is-invalid @enderror" id="exercise_time" name="exercise_time">
                        @error('exercise_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exercise_details" class="form-label">運動内容</label>
                        <textarea class="form-control @error('exercise_details') is-invalid @enderror" id="exercise_details" name="exercise_details" rows="2" maxlength="120"></textarea>
                        @error('exercise_details')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // フォームのバリデーション処理
        const form = document.getElementById("weightLogForm");
        if (form) {
            form.addEventListener("submit", function(event) {
                let hasErrors = false;

                // 各フィールドのバリデーション
                document.querySelectorAll(".form-control").forEach(function(input) {
                    if (input.classList.contains("is-invalid")) {
                        hasErrors = true;
                    }
                });

                if (hasErrors) {
                    event.preventDefault(); // フォーム送信を止める

                    // すでに開いているモーダルを再取得して閉じないようにする
                    var myModal = bootstrap.Modal.getInstance(document.getElementById("createModal"));
                    if (!myModal) {
                        myModal = new bootstrap.Modal(document.getElementById("createModal"));
                    }
                    myModal.show(); // モーダルを閉じない
                }
            });
        }

        // ページロード時にエラーがある場合、自動でモーダルを開く
        @if($errors -> any())
        var myModal = new bootstrap.Modal(document.getElementById("createModal"));
        myModal.show();
        @endif

        // 検索フォームの処理（検索ボタンを正しく動作させる）
        const searchForm = document.getElementById("searchForm");
        if (searchForm) {
            searchForm.addEventListener("submit", function(event) {
                // 検索フォームでは `event.preventDefault();` を適用しない
            });
        }
    });
</script>
@endsection
