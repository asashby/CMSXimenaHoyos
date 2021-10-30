@extends('layouts.admin_layout')
@section('title', 'Agregar Área')
@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Áreas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('dashboard/areas') }}">Áreas</a></li>
                <li class="breadcrumb-item active">Agregar Áreas</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Agregar Área</h3>
                </div>
                <!-- /.card-header -->
                
                @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>  
                    @endforeach
                </ul>
                </div>
                @endif

                <!-- form start -->
                <form role="form" method="post" action="{{ url('/dashboard/area/create')}}"  name="addArea" id="addArea" >@csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre Área</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre" id="areaName" name="areaName" >
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
    </div>
@endsection