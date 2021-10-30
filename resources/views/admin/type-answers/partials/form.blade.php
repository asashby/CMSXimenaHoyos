<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('series', 'Numero de Series') !!}
            {!! Form::number('series',null, ['id'=>'series','class'=>'form-control']) !!}
            @error('series')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('reps', 'Repeticiones') !!}
            {!! Form::number('reps',null, ['id'=>'reps','class'=>'form-control']) !!}
            @error('reps')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
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
   {{--  <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('confirm_answer', 'Mensaje de confirmación') !!}
            {!! Form::text('confirm_answer',null, ['id'=>'confirm_answer','class'=>'form-control']) !!}
            @error('confirm_answer')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div> --}}
    {{-- <div class="col-lg-12">
        <div class="form-group">

            <label class="mb-2" for="url_image">Imagen <small>(jpeg, png, jpg, gif)</small></label>
            <div class="text-center">
                <img id="show_img" src="@if(isset($type_answer->url_image)){{asset($type_answer->url_image)}}@endif"
                     height="300">
            </div>
            <div class="input-group">
                <div class="custom-file">
                    {!! Form::file('url_image', ['id'=>'url_image','class'=>'custom-file-input']) !!}
                    <label class="custom-file-label" for="url_image">
                        @if(isset($type_answer->url_image))
                            {{$type_answer->url_image}}
                        @else
                            Subir una imagen
                        @endif
                    </label>
                </div>
            </div>

            @error('url_image')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div> --}}

</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
</div>


