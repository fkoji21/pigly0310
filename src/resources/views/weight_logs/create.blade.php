<form action="{{ route('weight_logs.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">日付 <span class="text-danger">※必須</span></label>
        <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
        @error('date') <p class="text-danger small">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">体重（kg） <span class="text-danger">※必須</span></label>
        <input type="number" name="weight" class="form-control" value="{{ old('weight') }}" step="0.1" required>
        @error('weight') <p class="text-danger small">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">摂取カロリー</label>
        <input type="number" name="calories" class="form-control" value="{{ old('calories') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">運動時間（hh:mm）</label>
        <input type="time" name="exercise_time" class="form-control" value="{{ old('exercise_time') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">運動内容</label>
        <textarea name="exercise_content" class="form-control">{{ old('exercise_content') }}</textarea>
    </div>

    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
        <button type="submit" class="btn btn-gradient">登録</button>
    </div>
</form>