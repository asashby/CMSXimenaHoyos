@extends('layouts.admin_layout')
@section('title', 'Crear Receta')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Recetas</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('dashboard/recipes') }}">Recetas</a></li>
                <li class="breadcrumb-item active">Agregar Receta</li>
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
                    <h3 class="card-title">Agregar Receta</h3>
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
                    <form  method="post" action="{{ url('dashboard/recipes/create')}}" name="createRecipe" id="createRecipe" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seleccione Reto</label>
                                    <select id="challenges" name="challenges[]" class="form-control" multiple="multiple">
                                        <?php echo $courses_drop_down; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="recipeTitle" placeholder="Ingrese Titulo">
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Tipo de Comida</label>
                                    <select name="timefood" class="form-control select2" style="width: 100%;">
                                        <option>Desayuno</option>
                                        <option>Media Mañana</option>
                                        <option>Almuerzo</option>
                                        <option>Media Tarde</option>
                                        <option>Cena</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripcion de Receta</label>
                                        <textarea class="form-control" name="recipeResume" id="recipeResume" placeholder="Ingrese Resumen" style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dificultad</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="recipeDificult" placeholder="Ingrese Dificultad">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">Informacion Nutricional</label>

                                    <div class="form-inline">
                                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="key" placeholder="Clave">
                                      
                                        <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" id="value" placeholder="Valor">
                                        </div>
                                        <button type="button" class="btn btn-primary mb-2 addRow">+</button>
                                    </div>
                                    <table id="attributes" class="table table-bordered">
                                        <thead>
                                            <th>Clave</th>
                                            <th>Valor</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <input id="attributesFinal" name="attributes" type="hidden">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">Registrar Ingredientes</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" id="recipeIngredient" placeholder="Ingrediente">
                                        </div>
                                        <input type="button" class="btn btn-primary addIngredient" value="Agregar">
                                    <div class="card-body">
                                        <ul class="todo-list ui-sortable" id="ingredients-list" data-widget="todo-list">
                                        </ul>
                                    </div>
                                    <input type="hidden" name="ingredientsRecipe">
                                </div>
                            </div>
                            
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen Principal</label>
                                        <input type="file" class="form-control" onchange="preview_image(event)" name="recipeBanner" id="recipeBanner">
                                        <img style="margin-top: 10px;" class="img-fluid" id="output_image"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen para movil</label>
                                        <input type="file" class="form-control" onchange="preview_image3(event)" name="recipeBannerMobile" id="recipeBanner">
                                        <img style="margin-top: 10px;" class="img-fluid" width=400 id="output_image3"/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen del Contenido</label>
                                        <input type="file" class="form-control" onchange="preview_image2(event)" name="recipeContent" id="recipeContent">
                                        <img style="margin-top: 10px;" class="img-fluid" id="output_image2"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Video de Preparacion</label>
                                    <input type="url" class="form-control" id="recipeUrlVideo" name="recipeUrlVideo" placeholder="Ingrese URL">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">Registrar Pasos</label>
                                        <input type="number" class="form-control mb-2 mr-sm-2" id="stepOrder" min=0 placeholder="Paso Nro.">
                                        <div class="input-group mb-2 mr-sm-2">
                                            <textarea class="form-control" id="recipeStep" placeholder="Descripcion del Paso" style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                        </div>
                                        <input type="button" class="btn btn-primary addStep" value="Agregar">
                                    <div class="card-body">
                                        <ul class="todo-list ui-sortable" id="step-list" data-widget="todo-list">                    
                                        </ul>
                                    </div>
                                    <input type="hidden" name="stepsRecipe">
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                      
{{--                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">Registrar Ingredientes</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" id="recipeIngredient" placeholder="Ingrediente">
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
                                        <input type="number" class="form-control mb-2 mr-sm-2" id="stepOrder" min=0 placeholder="Paso Nro.">
                                        <div class="input-group mb-2 mr-sm-2">
                                            <textarea class="form-control" id="recipeStep" placeholder="Descripcion del Paso" style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
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