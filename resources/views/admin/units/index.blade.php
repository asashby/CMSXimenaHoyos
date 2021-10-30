@extends('layouts.admin_layout')
@section('title', 'Días por Reto')

@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Días por Reto" position="Días por Reto" url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de Dias por Reto</h3>

                                <a href="{{ route('units.create') }}"
                                   style="max-width: 150px; float: right; display:inline-block;"
                                   class="btn btn-sm btn-primary">Agregar Dia</a>
                            </div>
                            <select style="width: 100%;"
                                    class="form-control selected-filter-course" name="course_id"
                                    id="course_id">
                                <option value="0">Seleccione un reto</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                            <div id="table-units-course" class="card-body table-units-course">

                                @include('admin.units.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.units.modals')
            @include('admin.questions.modals')
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
