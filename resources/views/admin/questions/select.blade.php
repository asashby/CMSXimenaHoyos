<div class="form-group">
    {!! Form::label('type_answer_id', 'Tipo de respuesta') !!}
    {!! Form::select('type_answer_id', $type_answers,null, [ 'id'=>'type_answer_id','class'=>'form-control']) !!}
    @error('type_answer_id')
    <x-form message="{{$message }}"/>
    @enderror
</div>
