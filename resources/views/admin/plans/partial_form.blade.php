<div class="form-row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="title">Título</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
        placeholder="Ingrese Titulo" value="{{ old('title', $plan->title) }}" autofocus>
      @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="description">Descripción de Plan</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
        placeholder="Ingrese Resumen">{{ old('description', $plan->description) }}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="months">Cantidad de Meses</label>
      <input type="number" class="form-control @error('months') is-invalid @enderror" id="months" name="months"
        placeholder="Numero de Meses" value="{{ old('months', $plan->months) }}">
      @error('months')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="price">Precio</label>
      <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
        placeholder="Ingrese Precio" value="{{ old('price', $plan->price) }}" step="0.01">
      @error('price')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="courses">Asignar Retos</label><br>
      @php
        $coursesIds = old('courses', $plan->course_id);
      @endphp
      @foreach ($courses as $id => $course)
        <input type="checkbox" name="courses[]" id="courses" value="{{ $id }}"
          @if (is_array($coursesIds) && in_array($id, $coursesIds)) checked @endif>{{ $course }}<br />
      @endforeach
      @error('courses')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
  </div>
</div>
