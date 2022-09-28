<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('course_id', 'Seleccione Reto') !!}
      {!! Form::select('course_id', $courses, null, ['id' => 'course_id', 'class' => 'form-control']) !!}
      @error('course_id')
        <x-form message="{{ $message }}" />
      @enderror
    </div>
    <div class="form-group">
      <select style="width: 100%;" class="form-control" name="unit_id" id="unit_id">
        <option value="0">Seleccione Día</option>
      </select>
    </div>
    {{--   <div class="form-group">
            {!! Form::label('unit_id', 'Seleccione Dia') !!}
            {!! Form::select('unit_id', $units, null, [ 'id'=>'unit_id','class'=>'form-control']) !!}
            @error('unit_id')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}
    <div class="form-group">
      {!! Form::label('title', 'Título') !!}
      {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control']) !!}
      @error('title')
        <x-form message="{{ $message }}" />
      @enderror
    </div>
    <div class="form-group">
      {!! Form::label('subtitle', 'Pretitulo') !!}
      {!! Form::text('subtitle', null, ['id' => 'subtitle', 'class' => 'form-control']) !!}
      @error('title')
        <x-form message="{{ $message }}" />
      @enderror
    </div>

    <h5>Caracteristicas del Ejercicio</h5>
    <div class="form-group">
      {!! Form::label('max_time', 'Tiempo Maximo del Ejercicio') !!}
      {!! Form::number('max_time', null, ['id' => 'max_time', 'class' => 'form-control']) !!}
      @error('max_time')
        <x-form message="{{ $message }}" />
      @enderror
    </div>
    <div class="form-group">
      {!! Form::label('time_rest', 'Descanso entre Repeticiones') !!}
      {!! Form::text('time_rest', null, ['id' => 'time_rest', 'class' => 'form-control']) !!}
      @error('time_rest')
        <x-form message="{{ $message }}" />
      @enderror
    </div>
  </div>
  <div class="col-md-6">
    <div id="input_image" class="form-group">
      @include('admin.questions.image')
    </div>
    <div id="input_image" class="form-group">
      @include('admin.questions.bannerMobile')
    </div>
    <div class="form-group">
      {!! Form::label('url_video', 'Video del Día') !!}
      {!! Form::text('url_video', null, ['id' => 'url_video', 'class' => 'form-control']) !!}
      @error('url_video')
        <x-form message="{{ $message }}" />
      @enderror
    </div>
  </div>
</div>
<h5>Caracteristicas del Ejercicio</h5>
<div class="row">
  <div class="col-md-6">
    {{--    <div class="form-group">
            {!! Form::label('level', 'Nivel') !!}
            {!! Form::text('level',null, ['id'=>'level','class'=>'form-control']) !!}
            @error('level')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}
    {{--      <div class="form-group">
            {!! Form::label('duration', 'Duracion') !!}
            {!! Form::text('duration',null, ['id'=>'duration','class'=>'form-control']) !!}
            @error('duration')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}
    {{-- <div class="form-group">
            {!! Form::label('series', 'Numero de Series') !!}
            {!! Form::number('series',null, ['id'=>'series','class'=>'form-control']) !!}
            @error('series')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('calories', 'Calorias') !!}
            {!! Form::number('calories',null, ['id'=>'calories','class'=>'form-control']) !!}
            @error('calories')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}
  </div>
  {{-- <div class="col-md-6"> --}}
  {{--   <div class="form-group">
            {!! Form::label('frequency', 'Frecuencia') !!}
            {!! Form::text('frequency',null, ['id'=>'frequency','class'=>'form-control']) !!}
            @error('frequency')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}
  {{--  <div class="form-group">
            {!! Form::label('reps', 'Numero de Repeticiones') !!}
            {!! Form::number('reps',null, ['id'=>'reps','class'=>'form-control']) !!}
            @error('reps')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}
  {{-- </div> --}}
</div>

<div class="col-12">
  <div class="form-group">
    <label for="exampleInputEmail1">Contenido</label>
    {!! Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control form-content']) !!}
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    {!! Form::label('is_activated', 'Estado') !!}
    <div class="form-control">
      <div class="form-check form-check-inline">
        <label>
          {{ Form::radio('is_activated', 1) }} Activo
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label>
          {{ Form::radio('is_activated', 0) }} Inactivo
        </label>
      </div>
    </div>
    @error('is_activated')
      <x-form message="{{ $message }}" />
    @enderror
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="form-group">
      {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(function() {
    var url = $(location).attr('href').split('/');
    if (url[url.length - 1] !== 'edit') {
      let value = $('#course_id').val();
      $.ajax({
        url: `/course/${value}/units`,
        type: 'get',
        success: function(data) {
          $("#unit_id").empty();
          $.each(data, function(key, value) {
            //Use the Option() constructor to create a new HTMLOptionElement.
            var option = new Option(key, value);
            //Convert the HTMLOptionElement into a JQuery object that can be used with the append method.
            $(option).html(key);
            //Append the option to our Select element.
            $("#unit_id").append(option);
          });

        }
      });
    }
  })

  function readFileMobileImage() {
    if (this.files && this.files[0]) {
      var FR = new FileReader();
      FR.addEventListener("load", function(e) {
        document.getElementById("show_img_mobile").src = e.target.result;
      });
      FR.readAsDataURL(this.files[0]);
    }
  }

  function readFile() {
    if (this.files && this.files[0]) {
      var FR = new FileReader();
      FR.addEventListener("load", function(e) {
        document.getElementById("show_img").src = e.target.result;
      });
      FR.readAsDataURL(this.files[0]);
    }
  }
  document.getElementById("url_image").addEventListener("change", readFile);
  document.getElementById("mobile_image").addEventListener("change", readFileMobileImage);
</script>
