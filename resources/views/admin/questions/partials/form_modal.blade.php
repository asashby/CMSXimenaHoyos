<div class="row">
    <div class="col-lg-12 selected-type">
        <select class="form-control selected-course" name="type_answer_id" id="type_answer_id">
            <option value="0">Seleccione una Serie y Repeticion</option>    
            @foreach(json_decode($type_answers) as $type_answer)
                <option value="{{$type_answer->id}}">{{$type_answer->series}} Series - {{$type_answer->reps}} Repeticiones</option>
            @endforeach
        </select>
      {{--   {!! Form::label('type_answer_id', 'Selecciona una respuesta') !!}
        <div class="form-group">
            {!! Form::select('type_answer_id', $type_answers,null, [ 'id'=>'type_answer_id','class'=>'form-control js-example-basic-single','style'=>'width: 100%;']) !!}
            @error('type_answer_id')
            <x-form message="{{$message }}"/>
            @enderror
        </div> --}}

    </div>
    {{--
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('title', 'Título') !!}
            {!! Form::text('title',null, ['id'=>'title','class'=>'form-control']) !!}
            @error('title')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Mensaje</label>
            {!! Form::textarea('message',null, ['id'=>'message','class'=>'form-control textAreaEditor form-content']) !!}
        </div>
        @error('message')
        <x-form message="{{$message }}"/>
        @enderror
    </div>
     --}}
    {{-- <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('type_answer_valid', 'Respuesta') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('type_answer_valid', 1 ,['id'=>'correct']) }} Correcta
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('type_answer_valid',0,['id'=>'incorrect']) }} Incorrecta
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('status', 'Estado') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('status', 1,['id'=>'active']) }} Activo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('status',0,['id'=>'inactive']) }} Inactivo
                    </label>
                </div>
            </div>
        </div>
    </div> --}}
</div>


