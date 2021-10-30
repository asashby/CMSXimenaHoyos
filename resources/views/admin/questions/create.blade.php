@extends('layouts.admin_layout')
@section('title', 'Crear Ejercicio')
@section('content')
    <div class="content-wrapper">
        <x-position root="Ejercicios" title="Ejercicios" position="Nuevo ejercicio" url="{{route('questions.index')}}"></x-position>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Nuevo ejercicio" url="{{route('questions.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-questions" class="card-body">
                                {!! Form::open(['url' => route('questions.store'),'files' => true]) !!}
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
