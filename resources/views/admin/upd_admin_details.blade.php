@extends('layouts.admin_layout')
@section('title', 'Actualizar Datos')
@section('content')

  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Configuracion</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div>
        </div>
      </div>
    </div>



    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Actualizar Datos</h3>
              </div>


              @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                  {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                  {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px;">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif


              <form role="form" method="post" action="{{ url('/dashboard/upd-admin-details') }}"
                name="updateAdminDetails" id="updateAdminDetails" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->name }}"
                      placeholder="Ingrese Nombre" id="adminName" name="adminName">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" value="{{ Auth::guard('admin')->user()->email }}" class="form-control"
                      id="adminEmail" name="adminEmail" readonly>
                  </div>
                  {{-- <div class="form-group">
                        <label for="exampleInputFile">Insertar Imagen</label>
                            <input type="file" class="form-control" name="adminImage" id="adminImage">
                            @if (!empty(Auth::guard('admin')->user()->image))
                              <a target="_blank" href="{{ Auth::guard('admin')->user()->image }}">Ver Imagen</a>
                              <input type="hidden" class="form-control" name="currentAdminImage" value="{{ Auth::guard('admin')->user()->image }}">
                            @endif
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div>
                      </div> --}}
                  {{-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> --}}
                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>

        </div>
    </section>


  </div>
@endsection
