<div class="form-row">
  <div class="form-group col-md-6">
    <label for="title">Título</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
      placeholder="Ingrese Titulo" value="{{ old('title', $plan->title) }}" autofocus>
    @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="form-group col-12">
    <label for="description">Descripción de Plan</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
      placeholder="Ingrese Resumen">{{ old('description', $plan->description) }}</textarea>
    @error('description')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="form-group col-md-6">
    <label for="months">Cantidad de Meses</label>
    <input type="number" class="form-control @error('months') is-invalid @enderror" id="months" name="months"
      placeholder="Numero de Meses" value="{{ old('months', $plan->months) }}">
    @error('months')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="form-group col-md-6">
    <label for="price">Precio</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
      placeholder="Ingrese Precio" value="{{ old('price', $plan->price) }}" step="0.01">
    @error('price')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="form-group col-md-6">
    <label>Asignar Retos</label><br>
    @php
      $coursesIds = old('coursesIds', $plan->course_id);
    @endphp
    @foreach ($courses as $id => $course)
      <input type="checkbox" name="coursesIds[]" value="{{ $id }}"
        @if (is_array($coursesIds) && in_array($id, $coursesIds)) checked @endif>{{ $course }}<br />
    @endforeach
    @error('coursesIds')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="form-group col-md-6">
    <label for="focusedExercisesIds">Focalizados</label>
    @php
      $focusedExercisesIds = old('focusedExercisesIds', $plan->focused_exercises->pluck('id')->toArray());
    @endphp
    <select name="focusedExercisesIds[]" id="focusedExercisesIds" class="form-control" multiple="multiple">
      @foreach ($focusedExercises as $focusedExerciseItem)
        <option value="{{ $focusedExerciseItem->id }}" @if (is_array($focusedExercisesIds) && in_array($focusedExerciseItem->id, $focusedExercisesIds)) selected @endif>
          {{ $focusedExerciseItem->display_name }}
        </option>
      @endforeach
    </select>
    @error('focusedExercisesIds')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
</div>
@section('scripts')
  <script>
    $(function() {
      $("#focusedExercisesIds").select2({
        closeOnSelect: false,
      });
    })
  </script>
@endsection
