<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('id_sub_category', 'Reto') !!}
            {!! Form::select('course_id', $courses,null, [ 'id'=>'course_id','class'=>'form-control']) !!}
            @error('course_id')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('day', 'Numero de Día') !!}
            {!! Form::number('day',null, ['id'=>'day','class'=>'form-control']) !!}
            @error('day')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('title', 'Zona del Cuerpo') !!}
            {!! Form::text('title',null, ['id'=>'title','class'=>'form-control']) !!}
            @error('title')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('subtitle', 'Pretitulo') !!}
            {!! Form::text('subtitle',null, ['id'=>'subtitle','class'=>'form-control']) !!}
            @error('title')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
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
                        {{ Form::radio('is_activated',0) }} Inactivo
                    </label>
                </div>
            </div>
            @error('is_activated')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
      {{--   <div class="form-group">
            <label for="exampleInputEmail1">Contenido</label>
            {!! Form::textarea('content',null, ['id'=>'content','class'=>'form-control textAreaEditor form-content']) !!}
        </div> --}}

    </div>
    <div class="col-md-6">
        <div id="input_image" class="form-group">
            @include('admin.units.icon')
        </div>
        <div id="input_image" class="form-group">
            @include('admin.units.image')
        </div>
        <div id="input_image" class="form-group">
            @include('admin.units.bannerMobile')
        </div>
        <div class="form-group">
            {!! Form::label('url_video', 'Video del Día') !!}
            {!! Form::text('url_video',null, ['id'=>'title','class'=>'form-control']) !!}
            @error('url_video')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">

    </div>
</div>
<h5>Caracteristicas del Día</h5>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('level', 'Nivel') !!}
            {!! Form::text('level',null, ['id'=>'level','class'=>'form-control']) !!}
            @error('level')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('duration', 'Duracion') !!}
            {!! Form::text('duration',null, ['id'=>'duration','class'=>'form-control']) !!}
            @error('duration')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
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
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('frequency', 'Frecuencia') !!}
            {!! Form::text('frequency',null, ['id'=>'frequency','class'=>'form-control']) !!}
            @error('frequency')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('max_time', 'Tiempo Maximo') !!}
            {!! Form::number('max_time',null, ['id'=>'max_time','class'=>'form-control']) !!}
            @error('max_time')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
       {{--  <div class="form-group">
            {!! Form::label('reps', 'Numero de Repeticiones') !!}
            {!! Form::number('reps',null, ['id'=>'reps','class'=>'form-control']) !!}
            @error('reps')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}
        <div class="form-group">
            {!! Form::label('time_rest', 'Descanso entre Repeticiones') !!}
            {!! Form::text('time_rest',null, ['id'=>'time_rest','class'=>'form-control']) !!}
            @error('time_rest')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
</div>

{{-- <h5>Contenido del Reto</h5>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Contenido</label>
            {!! Form::textarea('content',null, ['id'=>'content','class'=>'form-control textAreaEditor form-content']) !!}
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
</div>


