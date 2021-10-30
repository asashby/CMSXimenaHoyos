@extends('layouts.admin_layout')
@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Progreso de usuarios" position="Progreso de usuarios"
                    url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de Retos</h3>
                                <div class="card-tools">
                                    <select style="width: 400px;" class="form-control selected-course" name="course_id"
                                            id="course_id">
                                        <option value="0">Seleccione un Reto</option>
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="detail_course" class="card-body detail_course"></div>
                        </div>
                    </div>
                </div>
                <div id="users_list" class="users_list"></div>
            </div>
            @include('admin.progress.modals')
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
