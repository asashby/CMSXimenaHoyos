@extends('layouts.admin_layout')
@section('title', 'Crear Tip')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tips</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/articles') }}">Tips</a></li>
              <li class="breadcrumb-item active">Agregar Tip</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Agregar Tip</h3>
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
            <form method="post" action="{{ url('dashboard/tips/create') }}" name="createArticle" id="createArticle"
              enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="tipTitle"
                      placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pretitulo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="tipSubTitle"
                      placeholder="Ingrese Pretitulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Resumen del tip</label>
                    <textarea class="form-control" name="tipResume" id="tipResume" placeholder="Ingrese Resumen"></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Banner Principal</label>
                    <input type="file" class="form-control" onchange="preview_image(event)" name="tipImage"
                      id="tipImage">
                    <img style="margin-top: 10px;" id="output_image" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen para Movil</label>
                    <input type="file" class="form-control" onchange="preview_image2(event)" name="tipMobileImage"
                      id="tipMobileImage">
                    <img style="margin-top: 10px;" id="output_image2" width=300 />
                  </div>
                  {{-- <div class="form-group">
                                <label for="exampleInputEmail1">URL de Video</label>
                                <input type="url" class="form-control" id="articleUrlVideo" name="articleUrlVideo" placeholder="Ingrese URL">
                            </div> --}}
                </div>

              </div>

              <h5>Contenido del Tip</h5>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <textarea class="form-control textAreaEditor" name="tipContent" id="tipContent" placeholder="Ingrese Descripción"></textarea>
                  </div>
                </div>
                <!-- /.form-group -->
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
  </script>
@endsection
