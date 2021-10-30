<div class="row">
    <div class="col-lg-12 selected-type">
        <div class="form-group">
            {!! Form::label('type_answer_id', 'Respuesta') !!}
            {!! Form::select('type_answer_id', $type_answers,null, [ 'id'=>'type_answer_id','class'=>'form-control js-example-basic-single']) !!}
            @error('type_answer_id')
            <x-form message="{{$message }}"/>
            @enderror
        </div>

    </div>
    <div class="col-lg-12 selected-type">
        <div class="form-group">
            {!! Form::label('question_id', 'Pregunta') !!}
            {!! Form::select('question_id', $questions,null, [ 'id'=>'question_id','class'=>'form-control js-select-question']) !!}
            @error('question_id')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    {{----
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
    ---}}
    <div class="col-lg-6">
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
            {!! Form::label('is_activated', 'Estado') !!}
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
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
</div>

