<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name',null, ['id'=>'name','class'=>'form-control']) !!}
            @error('title')
            <x-form message="{{$message }}" />
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('sur_name', 'Apellidos') !!}
            {!! Form::text('sur_name',null, ['id'=>'sur_name','class'=>'form-control']) !!}
            @error('sur_name')
            <x-form message="{{$message }}" />
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('email', 'Correo') !!}
            {!! Form::email('email',null, ['id'=>'email','class'=>'form-control']) !!}
            @error('email')
            <x-form message="{{$message }}" />
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name_city', 'Ciudad') !!}
            {!! Form::text('name_city',null, ['id'=>'name_city','class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('gender', 'Género') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('gender', 'male') }} Masculino
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('gender','female') }} Femenino
                    </label>
                </div>
            </div>
        </div>
    </div>
    @if(isset($user))
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
                        {{ Form::radio('is_activated',0) }} Inactivo
                    </label>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('free_courses', 'Retos Libres') !!}
            <div class="form-check">
                @foreach ($courses as $key => $course)
                {!! Form::checkbox('courses[]', $key, in_array($key, $user->courses_free) ? true : false, ['class' =>
                'form-check-input']) !!}
                <div class="form-check form-check">
                    {!! Form::label('voice', $course, ['class' => 'form-check-label']) !!}
                </div>
                @endforeach
            </div>
            @error('course_id')
            <x-form message="{{$message }}" />
            @enderror
        </div>
    </div> --}}

    <div class="col-lg-6">
        <div class="form-group">
            <label for="MultiselectDropDown">Asignar </label>
            <select id="challenges" name="plans[]" class="assignChallenges form-control" multiple="multiple">
                @foreach ($plans as $plan)
                <option value="{{ $plan->planId }}">{{ $plan->courseName }} - {{
                    $plan->planName }}</option>
                @endforeach
            </select>
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
