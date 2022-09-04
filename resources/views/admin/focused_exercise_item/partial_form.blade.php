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
    <div class="form-group">
      <label for="description">Descripción</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
        placeholder="Ingrese Resumen" rows="3">{{ old('description', $focusedExerciseItem->description) }}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="series">Series</label>
      <input type="text" class="form-control @error('series') is-invalid @enderror" id="series" name="series"
        placeholder="Series" value="{{ old('series', $focusedExerciseItem->series) }}">
      @error('series')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="repetitions">Repeticiones</label>
      <input type="text" class="form-control @error('repetitions') is-invalid @enderror" id="repetitions"
        name="repetitions" placeholder="Series" value="{{ old('repetitions', $focusedExerciseItem->repetitions) }}">
      @error('repetitions')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
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
  <div class="col-md-6">
    <div class="form-group">
      <label for="desktop_image">Imagen Escritorio</label>
      <input type="file" class="form-control @error('desktop_image') is-invalid @enderror"
        onchange="preview_image(event, 'desktop_image_preview')" name="desktop_image" id="desktop_image"
        accept="image/*">
      @error('desktop_image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
      <img class="img-fluid mt-2" id="desktop_image_preview" style="max-width: 200px"
        @if ($focusedExerciseItem->desktop_image) src="{{ $focusedExerciseItem->getDesktopImageUrlAttribute() }}" @endif />
    </div>
    <div class="form-group">
      <label for="mobile_image">Imagen Móvil</label>
      <input type="file" class="form-control @error('mobile_image') is-invalid @enderror"
        onchange="preview_image(event, 'mobile_image_preview')" name="mobile_image" id="mobile_image" accept="image/*">
      @error('mobile_image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
      <img class="img-fluid mt-2" id="mobile_image_preview" style="max-width: 200px"
        @if ($focusedExerciseItem->mobile_image) src="{{ $focusedExerciseItem->getMobileImageUrlAttribute() }}" @endif />
    </div>
  </div>
</div>
