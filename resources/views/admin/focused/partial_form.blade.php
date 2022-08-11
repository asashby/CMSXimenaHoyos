<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="title">Título</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        placeholder="Ingrese Titulo" value="{{ old('title', $focusedExercise->title) }}" autofocus>
      @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="subtitle">Descripcion de Ejercicio</label>
      <textarea class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" id="subtitle"
        placeholder="Ingrese Resumen" rows="3">{{ old('subtitle', $focusedExercise->subtitle) }}</textarea>
      @error('subtitle')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="video_url">Video De Portada</label>
      <input type="text" class="form-control @error('description') is-invalid @enderror" id="video_url"
        name="video_url" placeholder="Ingrese URL" value="{{ old('video_url', $focusedExercise->video_url) }}">
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
        @if ($focusedExercise->desktop_image) src="{{ $focusedExercise->getDesktopImageUrlAttribute() }}" @endif />
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
        @if ($focusedExercise->mobile_image) src="{{ $focusedExercise->getMobileImageUrlAttribute() }}" @endif />
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <label for="description">Contenido de Ejercicio</label>
      <textarea class="form-control textAreaEditor @error('description') is-invalid @enderror" name="description"
        id="description" placeholder="Ingrese Resumen">{{ old('description', $focusedExercise->description) }}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
</div>
