@extends('layouts.app')

@section('content')
<div class="container">
    <h2>体重管理画面</h2>
    <p>ここに体重の記録を表示する</p>

    <table border="1">
        <tr>
            <th>日付</th>
            <th>体重 (kg)</th>
            <th>カロリー</th>
            <th>運動時間</th>
            <th>運動内容</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        @foreach ($weightLogs as $log)
        <tr>
            <td>{{ $log->date }}</td>
            <td>{{ $log->weight }}</td>
            <td>{{ $log->calories ?? '未入力' }}</td>
            <td>{{ $log->exercise_time ?? '未入力' }}</td>
            <td>{{ $log->exercise_content ?? '未入力' }}</td>
            <td><a href="{{ route('weight_logs.edit', $log->id) }}">編集</a></td>
            <td>
                <form action="{{ route('weight_logs.destroy', $log->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <a href="{{ route('weight_logs.create') }}">新しい記録を追加</a>
</div>
@endsection