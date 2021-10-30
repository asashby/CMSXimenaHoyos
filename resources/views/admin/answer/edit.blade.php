@extends('layouts.admin_layout')
@section('title', 'Editar Respuesta')
@section('content')
    <div class="content-wrapper">
        <x-position root="Respuestas" title="Respuestas" position="Editar Respuestas" url="{{ url('dashboard/courses') }}"></x-position>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Editar respuesta" url="{{route('questions.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-questions" class="card-body">
                                {!! Form::model($question_answer,['url' => url('dashboard/answers-questions',$question_answer->id),'method' => 'PUT','files' => true]) !!}
                                @include('admin.answer.partials.form')
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
