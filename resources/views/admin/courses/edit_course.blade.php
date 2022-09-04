@extends('layouts.admin_layout')
@section('title', 'Editar Reto')
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
              <li class="breadcrumb-item active">Editar Reto</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Editar Reto</h3>
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
            <form method="post" action="{{ url('dashboard/courses/edit/' . $courseDetail->id) }}" name="editRecipe"
              id="editRecipe" enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseTitle"
                      value="{{ $courseDetail->title }}" placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Subtítulo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"
                      value="{{ $courseDetail->subtitle }}" name="courseSubTitle" placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo de Reto</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="courseType"
                      value="{{ $courseDetail->type }}" placeholder="Tipo de Reto">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cantidad de Días</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="courseDays"
                      value="{{ $courseDetail->days }}" placeholder="Nro. Dias">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Precio de Reto</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="coursePrice"
                      value="{{ $courseDetail->prices }}" placeholder="Precio">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripción de Reto</label>
                    <textarea class="form-control" name="courseDescription" id="courseDescription" placeholder="Descripion del reto">{{ $courseDetail->description }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nivel</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $courseDetail->level }}"
                      name="courseLevel" placeholder="Nivel">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Frecuencia</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"
                      value="{{ $courseDetail->frequency }}" name="courseFrequence" placeholder="Frecuencia">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Duracion</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"
                      value="{{ $courseDetail->duration }}" name="courseDuration" placeholder="Duracion">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Video de Reto</label>
                    <input type="url" class="form-control" id="courseUrlVideo"
                      value="{{ $courseDetail->url_video }}" name="courseUrlVideo" placeholder="Ingrese URL">
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen Principal</label>
                    <input type="file" class="form-control" onchange="preview_image(event)" name="courseBanner"
                      id="courseBanner">
                    <img style="margin-top: 10px;" class="img-fluid" width=600 id="output_image"
                      src="{{ asset($courseDetail->banner) }}" />
                    <input type="hidden" name="currentCourseBanner" value="{{ $courseDetail->banner }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen del Contenido</label>
                    <input type="file" class="form-control" onchange="preview_image2(event)" name="courseContent"
                      id="courseContent">
                    <img style="margin-top: 10px;" class="img-fluid" width=600 id="output_image2"
                      src="{{ asset($courseDetail->url_image) }}" />
                    <input type="hidden" name="currentCourseContent" value="{{ $courseDetail->url_image }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen Principal para Movil</label>
                    <input type="file" class="form-control" onchange="preview_image3(event)"
                      name="courseBannerMobile" id="courseBannerMobile">
                    <img style="margin-top: 10px;" class="img-fluid" width=600 id="output_image3"
                      src="{{ asset($courseDetail->mobile_image) }}" />
                    <input type="hidden" name="currentCourseBannerMobile" value="{{ $courseDetail->mobile_image }}">
                  </div>
                </div>

              </div>
          </div>


          <div class="card-footer">
            <div>
              <input type="submit" value="Actualizar Reto" class="btn btn-info">
            </div>
          </div>
          </form>


        </div>


      </div>

    </section>




  </div>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
