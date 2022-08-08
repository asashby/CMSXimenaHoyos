<input type="hidden" name="focused_exercise_id"
  value="{{ old('focused_exercise_id', $focusedExerciseItem->focused_exercise_id) }}">
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="title">Título</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        placeholder="Ingrese Titulo" value="{{ old('title', $focusedExerciseItem->title) }}" autofocus>
      @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="video_url">URL de Video</label>
      <input type="text" class="form-control @error('video_url') is-invalid @enderror" id="video_url"
        name="video_url" placeholder="Ingrese Titulo" value="{{ old('video_url', $focusedExerciseItem->video_url) }}">
      @error('video_url')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
</div>
