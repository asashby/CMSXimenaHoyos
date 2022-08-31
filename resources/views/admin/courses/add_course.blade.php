@extends('layouts.admin_layout')
@section('title', 'Crear Reto')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Retos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/courses') }}">Retos</a></li>
              <li class="breadcrumb-item active">Agregar Reto</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Agregar Reto</h3>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger" style="margin-top: 10px;">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="post" action="{{ url('dashboard/courses/create') }}" name="createCourse" id="createCourse"
              enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseTitle"
                      placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pretitulo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseSubTitle"
                      placeholder="Ingrese Pretitulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo de Reto</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseType"
                      placeholder="Tipo de Reto">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cantidad de Días</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="courseDays"
                      placeholder="Nro. Dias">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Precio de Reto</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="coursePrice"
                      placeholder="Precio">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripcion de Reto</label>
                    <textarea class="form-control" name="courseDescription" id="courseDescription" placeholder="Descripion del reto"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nivel</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseLevel"
                      placeholder="Nivel">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Frecuencia</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseFrequence"
                      placeholder="Frecuencia">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Duracion</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseDuration"
                      placeholder="Duracion">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Video del Reto</label>
                    <input type="url" class="form-control" id="courseUrlVideo" name="courseUrlVideo"
                      placeholder="Ingrese URL">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen Principal</label>
                    <input type="file" class="form-control" onchange="preview_image(event)" name="courseBanner"
                      id="courseBanner">
                    <img style="margin-top: 10px;" class="img-fluid" id="output_image" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen Principal para Movil</label>
                    <input type="file" class="form-control" onchange="preview_image3(event)"
                      name="courseBannerMobile" id="courseBannerMobile">
                    <img style="margin-top: 10px;" class="img-fluid" id="output_image3" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen del Contenido</label>
                    <input type="file" class="form-control" onchange="preview_image2(event)" name="courseContent"
                      id="courseContent">
                    <img style="margin-top: 10px;" class="img-fluid" id="output_image2" />
                  </div>
                </div>
              </div>
          </div>
          <div class="card-footer">
            <div>
              <input type="submit" value="Publicar" class="btn btn-info">
            </div>
          </div>
          </form>
        </div>
      </div>
    </section>
  </div>

  <script>
    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        output.width = 400;
        output.height = 300

      }
      reader.readAsDataURL(event.target.files[0]);
    }

    function preview_image2(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image2');
        output.src = reader.result;
        output.width = 400;
        output.height = 300

      }
      reader.readAsDataURL(event.target.files[0]);
    }

    function preview_image3(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image3');
        output.src = reader.result;
        output.width = 400;
        output.height = 300

      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
@endsection
