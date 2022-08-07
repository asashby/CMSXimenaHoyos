@extends('layouts.admin_layout')
@section('title', 'Editar Area')
@section('content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Areas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/areas') }}">Áreas</a></li>
              <li class="breadcrumb-item active">Editar Área</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Área</h3>
              </div>


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
              <form role="form" method="post" action="{{ url('dashboard/area/edit/' . $areaDetail['id']) }}"
                name="addArea" id="addArea">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre Área</label>
                    <input type="text" class="form-control" placeholder="Ingrese Nombre" id="areaName" name="areaName"
                      value="{{ $areaDetail['name'] }}">
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
              </form>
            </div>

          </div>

        </div>
    </section>


  </div>
@endsection
