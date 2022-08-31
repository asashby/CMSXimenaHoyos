@extends('layouts.admin_layout')
@section('title', 'Editar Ejercicio')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ejercicios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/questions') }}">Ejercicios</a></li>
              <li class="breadcrumb-item active">Editar Ejercicio</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Editar Ejercicio</h3>
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
            <form method="POST" action="{{ url('dashboard/questions/edit/' . $question->id) }}" name="updateQuestion"
              id="updateQuestion" enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="course_id">Reto</label>
                    <select name="course_id" id="course_id" class="form-control" style="width: 100%;">
                      <?php echo $courses_drop_down; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="unit_id">Día</label>
                    <select name="unit_id" id="unit_id" class="form-control" style="width: 100%;">
                      <?php echo $unit_drop_down; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" name="title"
                      value="{{ $question->title }}" placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="subtitle">Pretitulo</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle"
                      value="{{ $question->subtitle }}" placeholder="Ingrese Pretitulo">
                  </div>

                  <h5>Caracteristicas del Ejercicio</h5>
                  <div class="form-group">
                    <label for="title">Tiempo Maximo del Ejercicio</label>
                    <input type="number" class="form-control" id="max_time" pattern="[0-100]" name="max_time"
                      value="{{ $question->max_time }}" placeholder="Ingrese Tiempo Maximo">
                  </div>
                  <div class="form-group">
                    <label for="title">Descanso entre Repeticiones</label>
                    <input type="number" class="form-control" id="time_rest" pattern="[0-100]" name="time_rest"
                      value="{{ $question->time_rest }}" placeholder="Ingrese Tiempo Descanso">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="url_image">Insertar Imagen Principal</label>
                    <input type="file" class="form-control" onchange="preview_image(event)" name="url_image"
                      id="url_image">
                    <img style="margin-top: 10px;" class="img-fluid" width=400 id="output_image"
                      src="{{ asset($question->url_image) }}" />
                    <input type="hidden" name="currentRecipeBanner" value="{{ $question->url_image }}">
                  </div>
                  <div class="form-group">
                    <label for="mobile_image">Insertar Imagen para movil</label>
                    <input type="file" class="form-control" onchange="preview_image2(event)" name="mobile_image"
                      id="mobile_image">
                    <img style="margin-top: 10px;" class="img-fluid" width=400 id="output_image"
                      src="{{ asset($question->mobile_image) }}" />
                    <input type="hidden" name="currentRecipeBanner" value="{{ $question->mobile_image }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">URL de Video</label>
                    <input type="url" class="form-control" id="articleUrlVideo" name="articleUrlVideo"
                      value="{{ $question->url_video }} placeholder="Ingrese URL">
                  </div>
                  <div class="form-group">
                    <label for="title">Orden</label>
                    <input type="number" class="form-control" id="order" pattern="[0-1000]" name="order"
                      value="{{ $question->order }}" placeholder="Ingrese Orden">
                  </div>
                </div>

              </div>

              <h5>Contenido del Ejercicio</h5>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contenido</label>
                    <textarea class="form-control" name="content" id="content" placeholder="Ingrese Contenido">{{ $question->content }}</textarea>
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
