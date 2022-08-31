@extends('layouts.admin_layout')
@section('title', 'Crear Plan')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Planes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/plans') }}">Planes</a></li>
              <li class="breadcrumb-item active">Agregar Planes</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Agregar Plan</h3>
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
            <form method="post" action="{{ url('dashboard/plans/create') }}" enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  {{-- <div class="form-group">
                                    <label>Seleccione Reto</label>
                                    <select id="challenges" name="challenges[]" class="form-control"
                                        multiple="multiple">
                                        <?php echo $courses_drop_down; ?>
                                    </select>
                                </div> --}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="planTitle"
                      placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripcion de Plan</label>
                    <textarea class="form-control" name="planResume" id="planResume" placeholder="Ingrese Resumen"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cantidad de Meses</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="planMonths"
                      placeholder="Numero de Meses">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Precio</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="planPrice"
                      placeholder="Ingrese Dificultad">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Asignar Retos</label><br>
                    @foreach ($courses as $id => $course)
                      <input type="checkbox" name="courses[]" value="{{ $id }}">{{ $course }}<br />
                    @endforeach
                  </div>
                </div>
              </div>


              {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">Registrar Ingredientes</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" id="planIngredient"
                                            placeholder="Ingrediente">
                                    </div>
                                    <input type="button" class="btn btn-primary addIngredient" value="Agregar">
                                    <div class="card-body">
                                        <ul class="todo-list ui-sortable" id="ingredients-list" data-widget="todo-list">
                                        </ul>
                                    </div>
                                    <input type="hidden" name="ingredientsRecipe">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">Registrar Pasos</label>
                                    <input type="number" class="form-control mb-2 mr-sm-2" id="stepOrder" min=0
                                        placeholder="Paso Nro.">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <textarea class="form-control" id="planStep" placeholder="Descripcion del Paso"
                                            ></textarea>
                                    </div>
                                    <input type="button" class="btn btn-primary addStep" value="Agregar">
                                    <div class="card-body">
                                        <ul class="todo-list ui-sortable" id="step-list" data-widget="todo-list">
                                        </ul>
                                    </div>
                                    <input type="hidden" name="stepsRecipe">
                                </div>
                            </div>
                        </div> --}}
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
