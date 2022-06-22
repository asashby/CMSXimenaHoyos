@extends('layouts.admin_layout')
@section('title', 'Crear Focalizado')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Agregar Focalizado</h3>
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
                    <form method="post" action="{{ url('dashboard/focused/create')}}" name="createRecipe"
                        id="createRecipe" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="focusedTitle"
                                        placeholder="Ingrese Titulo">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripcion de Ejercicio</label>
                                    <textarea class="form-control" name="focusedSubTitle" id="focusedSubTitle"
                                        placeholder="Ingrese Resumen"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contenido de Ejercicio</label>
                            <textarea class="form-control textAreaEditor" name="focusedContent" id="focusedContent"
                                placeholder="Ingrese Resumen"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">Registrar Ingredientes</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" id="focusedIngredient"
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
                                        <textarea class="form-control" id="focusedStep"
                                            placeholder="Descripcion del Paso"
                                            style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
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

        function preview_image3(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image3');
            output.src = reader.result;
            output.width = 400;
            output.height = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }
</script>
@endsection
