@extends('layouts.admin_layout')
@section('title', 'Editar Usuario')
@section('content')
    <div class="content-wrapper">
        <x-position root="Usuarios" title="Usuarios" position="Editar"
                    url="{{route('users.index')}}"/>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Editar usuario" url="{{route('users.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-courses" class="card-body">
                                {!! Form::model($user,['url' => route('users.update',$user->id),'method' => 'PUT','files' => true]) !!}
                                @include('admin.users.partials.form')
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
    <script src="{{asset('js/scripts/courses.js')}}"></script>
@endsection
