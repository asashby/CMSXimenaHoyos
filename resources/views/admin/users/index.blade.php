@extends('layouts.admin_layout')
@section('title', 'Usuarios')
@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Usuarios" position="Usuarios" url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de usuarios</h3>
                                <a href="{{ route('users.create') }}"
                                   style="max-width: 150px; float: right; display:inline-block;"
                                   class="btn btn-md btn-primary">Agregar usuario</a>
                            </div>
                            <div id="table-courses" class="card-body table-courses">
                                @include('admin.users.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
