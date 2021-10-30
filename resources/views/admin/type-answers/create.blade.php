@extends('layouts.admin_layout')
@section('title', 'Crear Tipo de Respuesta')
@section('content')
    <div class="content-wrapper">
        <x-position root="Tipo de respuestas" title="Tipo de respuesta" position="Nuevo"
                    url="{{route('type-answers.index')}}"/>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Nuevo tipo de respuesta" url="{{route('type-answers.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-courses" class="card-body">
                                {!! Form::open(['url' => route('type-answers.store'),'files' => true]) !!}
                                @include('admin.type-answers.partials.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
