@extends('layouts.admin_layout')
@section('title', 'Editar Menu Navegacion')
@section('content')
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Secciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/sections') }}">Secciones</a></li>
              <li class="breadcrumb-item active">Editar Seccion</li>
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
                <h3 class="card-title">Editar Seccion</h3>
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
              <form role="form" method="post" action="{{ url('/dashboard/section/edit/' . $sectionDetail['id']) }}"
                name="updateSection" id="updateSection" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre Sección</label>
                    <input type="text" class="form-control" placeholder="Ingrese Nombre" id="sectionName"
                      name="sectionName" value="{{ $sectionDetail['name'] }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <textarea class="form-control textAreaEditorSection" rows="3" name="sectionDescription" id="sectionDescription"
                      placeholder="Ingrese Descripcion" style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{!! $sectionDetail['description'] !!}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Banner Principal</label>
                    <input type="file" class="form-control" onchange="preview_image(event)" name="sectionImage"
                      id="sectionImage">
                    <img style="margin-top: 10px;" id="output_image" />
                  </div>
                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Editar</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
        </div>

      </div>
    </section>


  </div>
@endsection
