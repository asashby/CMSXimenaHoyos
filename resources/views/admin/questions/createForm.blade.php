@extends('layouts.admin_layout')
@section('title', 'Crear Ejercicio')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                <li class="breadcrumb-item active">Agregar Ejercicio</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Agregar Artículo</h3>
                </div>
                <!-- /.card-header -->
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
                    <form  method="post" action="{{ route('questions.store') }}" name="createArticle" id="createArticle" enctype="multipart/form-data">@csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_id">Reto</label>
                                <select name="course_id" id="course_id" class="form-control" style="width: 100%;">
                                    <option value="0"  selected disabled>Seleccione Reto</option>
                                    @foreach ($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="unit_id">Día</label>
                                <select name="unit_id" id="unit_id" class="form-control" style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Ingrese Titulo">
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Pretitulo</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Ingrese Pretitulo">
                            </div>

                            <h5>Caracteristicas del Ejercicio</h5>
                            <div class="form-group">
                                <label for="title">Tiempo Maximo del Ejercicio</label>
                                <input type="number" class="form-control" id="max_time" name="max_time" placeholder="Ingrese Tiempo Maximo">
                            </div>
                            <div class="form-group">
                                <label for="title">Descanso entre Repeticiones</label>
                                <input type="number" class="form-control" id="time_rest" name="time_rest" placeholder="Ingrese Tiempo Descanso">
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url_image">Insertar Imagen Principal</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)" name="url_image" id="url_image">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image"/>
                            </div>
                            <div class="form-group">
                                <label for="mobile_image">Insertar Imagen para movil</label>
                                    <input type="file" class="form-control" onchange="preview_image2(event)" name="mobile_image" id="mobile_image">
                                    <img style="margin-top: 10px;" class="img-fluid" width=400 id="output_image2"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">URL de Video</label>
                                <input type="url" class="form-control" id="articleUrlVideo" name="articleUrlVideo" placeholder="Ingrese URL">
                            </div>
                            <div class="form-group">
                                <label for="title">Orden</label>
                                <input type="number" class="form-control" id="order" pattern="[0-1000]" name="order" placeholder="Ingrese Orden">
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                <h5>Contenido del Articulo</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contenido</label>
                                <textarea class="form-control" name="content" id="content" placeholder="Ingrese Contenido" style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                        </div>
                    </div>
                    <!-- /.form-group -->
                </div>
                    <!-- /.col -->
                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Publicar" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
                <!-- /.card-body -->

        </div>
            <!-- /.card -->
    </section>



    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image');
            output.src = reader.result;
            output.width = 400;
            output.height = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function preview_image2(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image2');
            output.src = reader.result;
            output.width = 400;
            output.height = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection


