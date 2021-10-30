@extends('layouts.admin_layout')
@section('title', 'Ejercicios')
@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Ejercicios" position="Ejercicios" url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de Ejercicios</h3>
                                <a href="{{ route('questions.create') }}"
                                   style="max-width: 150px; float: right; display:inline-block;"
                                   class="btn btn-md btn-primary">Agregar Ejercicio</a>
                            </div>
                            <select  style="width: 100%;" class="form-control" name="course_id_2" id="course_id_2">
                                <option value="0" disabled selected>Seleccione un Reto</option>
                                @foreach ($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                            <select  style="width: 100%;" class="form-control" name="day_id" id="day_id">
                            </select>
                            <div id="table-questions" class="card-body table-questions">
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.questions.modals')
            </div>
        </section>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
