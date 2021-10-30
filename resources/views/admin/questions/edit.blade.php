@extends('layouts.admin_layout')
@section('title', 'Editar Ejercicio')
@section('content')
    <div class="content-wrapper">
        <x-position root="Ejercicios" title="Ejercicios" position="Editar Ejercicio" url="{{url('dashboard/courses')}}"></x-position>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Editar Ejercicio" url="{{route('questions.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-questions" class="card-body">
                                {!! Form::model($question,['url' => route('questions.update',$question->id),'method' => 'PUT','files' => true]) !!}
                                @include('admin.questions.partials.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
