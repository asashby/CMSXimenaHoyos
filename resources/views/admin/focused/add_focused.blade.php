@extends('layouts.admin_layout')
@section('title', 'Crear Focalizado')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Focalizados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/focused') }}">Focalizados</a></li>
              <li class="breadcrumb-item active">Agregar Focalizado</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Agregar Focalizado</h3>
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
            <form method="post" action="{{ url('dashboard/focused/create') }}" name="createRecipe" id="createRecipe"
              enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="focusedTitle"
                      placeholder="Ingrese Titulo" autofocus>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripcion de Ejercicio</label>
                    <textarea class="form-control" name="focusedSubTitle" id="focusedSubTitle" placeholder="Ingrese Resumen"
                      style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                  </div>

                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Contenido de Ejercicio</label>
                <textarea class="form-control textAreaEditor" name="focusedContent" id="focusedContent" placeholder="Ingrese Resumen"
                  style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Video De Portada</label>
                    <input type="text" class="form-control" id="focusedUrlVideo" name="focusedUrlVideo"
                      placeholder="Ingrese Url">
                  </div>
                </div>
              </div>
          </div>
          <div class="card-footer">
            <div class="form-actions">
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
