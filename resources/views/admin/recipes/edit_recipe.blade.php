@extends('layouts.admin_layout')
@section('title', 'Editar Receta')
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
                        <li class="breadcrumb-item active">Editar Receta</li>
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
                    <h3 class="card-title">Editar Receta</h3>
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
                    <form method="post" action="{{ url('dashboard/recipes/edit/'.$recipeDetail->id) }}"
                        name="editRecipe" id="editRecipe" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seleccione Reto</label>
                                    <select id="challenges" name="challenges[]" class="form-control"
                                        multiple="multiple">
                                        @foreach ($courses as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="recipeTitle"
                                        value="{{$recipeDetail->title}}" placeholder="Ingrese Titulo">
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Sección</label>
                                    <select name="timefood" class="form-control select2" style="width: 100%;">
                                        <option <?php if($recipeDetail->time_food =="Desayuno") echo
                                            'selected="selected"'; ?> >Desayuno</option>
                                        <option <?php if($recipeDetail->time_food =="Media Mañana") echo
                                            'selected="selected"'; ?> >Media Mañana</option>
                                        <option <?php if($recipeDetail->time_food =="Almuerzo") echo
                                            'selected="selected"'; ?> >Almuerzo</option>
                                        <option <?php if($recipeDetail->time_food =="Media Tarde") echo
                                            'selected="selected"'; ?> >Media Tarde</option>
                                        <option <?php if($recipeDetail->time_food =="Cena") echo 'selected="selected"';
                                            ?> >Cena</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripcion de Receta</label>
                                    <textarea class="form-control" name="recipeResume" id="recipeResume"
                                        placeholder="Ingrese Resumen"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$recipeDetail->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dificultad</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        name="recipeDificult" value="{{$recipeDetail->dificult}}"
                                        placeholder="Ingrese Dificultad">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">Informacion Nutricional</label>

                                    <div class="form-inline">
                                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="key"
                                            placeholder="Clave">

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
                                            @foreach ($recipeDetail->nutritional_facts as $macro)
                                            <tr macro="{{$macro->macro}}">
                                                <td>{{$macro->macro}}</td>
                                                <td>{{$macro->quantity}}</td>
                                                <td>
                                                    <a href="javascript:void(0)" id="DeleteButton"
                                                        style="cursor: pointer;" title="Eliminar"><i style="color: red;"
                                                            class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="currentAttributesRecipe"
                                        value="{{json_encode($recipeDetail->nutritional_facts)}}">
                                    <input id="attributesFinal" name="attributes" type="hidden">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">Registrar Ingredientes</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" id="recipeIngredient"
                                            placeholder="Ingrediente">
                                    </div>
                                    <input type="button" class="btn btn-primary addIngredient" value="Agregar">
                                    <div class="card-body">
                                        <ul class="todo-list ui-sortable" id="ingredients-list" data-widget="todo-list">
                                            @foreach ($recipeDetail->ingredients as $ingredient )
                                            <li order="{{$ingredient}}" class="item" data-target="unit">
                                                <!-- drag handle -->
                                                <span class="handle ui-sortable-handle">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </span>
                                                <!-- checkbox -->
                                                <!-- todo text -->
                                                <p class="text">{{$ingredient}}</p>
                                                <!-- Emphasis label -->
                                                <!-- General tools such as edit or delete-->
                                                <div class="tools deleteIngredient">
                                                    <a href="javascript:void(0)" id="deleteBtn" style="cursor: pointer;"
                                                        title="Eliminar"><i style="color: red;"
                                                            class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="hidden" name="currentIngredientsRecipe"
                                        value="{{ json_encode($recipeDetail->ingredients) }}">
                                    <input type="hidden" name="ingredientsRecipe">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen Principal</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)"
                                        name="recipeBanner" id="recipeBanner">
                                    <img style="margin-top: 10px;" class="img-fluid" width=400 id="output_image"
                                        src="{{asset($recipeDetail->page_image)}}" />
                                    <input type="hidden" name="currentRecipeBanner"
                                        value="{{ $recipeDetail->page_image }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen para Movil</label>
                                    <input type="file" class="form-control" onchange="preview_image3(event)"
                                        name="recipeBannerMobile" id="recipeBanner">
                                    <img style="margin-top: 10px;" class="img-fluid" width=400 id="output_image3"
                                        src="{{asset($recipeDetail->mobile_image)}}" />
                                    <input type="hidden" name="currentRecipeBannerMobile"
                                        value="{{ $recipeDetail->mobile_image }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen del Contenido</label>
                                    <input type="file" class="form-control" onchange="preview_image2(event)"
                                        name="recipeContent" id="recipeContent">
                                    <img style="margin-top: 10px;" class="img-fluid" width=600 id="output_image2"
                                        src="{{asset($recipeDetail->image_content)}}" />
                                    <input type="hidden" name="currentRecipeContent"
                                        value="{{ $recipeDetail->image_content }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Video de Preparacion</label>
                                    <input type="url" class="form-control" id="recipeUrlVideo" name="recipeUrlVideo"
                                        value="{{ $recipeDetail->url_video}}" placeholder="Ingrese URL">
                                    <input type="hidden" name="currentRecipeUrlVideo"
                                        value="{{ $recipeDetail->url_video }}">
                                </div>
                                <div class="form-group">
                                    <label class="mb-2">Registrar Pasos</label>
                                    <input type="number" class="form-control mb-2 mr-sm-2" id="stepOrder" min=0
                                        placeholder="Paso Nro.">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <textarea class="form-control" id="recipeStep"
                                            placeholder="Descripcion del Paso"
                                            style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                    </div>
                                    <input type="button" class="btn btn-primary addStep" value="Agregar">
                                    <div class="card-body">
                                        <ul class="todo-list ui-sortable" id="step-list" data-widget="todo-list">
                                            @foreach ($recipeDetail->steps as $step)
                                            <li class="item-list" order="{{$step->step}}"
                                                description="{{$step->description}}">
                                                <div class="card card-primary collapsed-card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Paso {{$step->step}}</h3>
                                                        <div class="card-tools">
                                                            <a href="javascript:void(0)" id="deletestep"
                                                                style="cursor: pointer;" title="Eliminar"><i
                                                                    style="color: red;"
                                                                    class="fas fa-trash-alt"></i></a>
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <div class="card-body" style="display: block;">
                                                        <p>{{$step->description}}</p>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <input type="hidden" name="currentStepsRecipe"
                                        value="{{ json_encode($recipeDetail->steps) }}">
                                    <input type="hidden" name="stepsRecipe">
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        {{-- <h5>Contenido del Articulo</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control textAreaEditor" name="articleContent"
                                        id="articleContent" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo" id="articleSeoTitle"
                                name="articleSeoTitle">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="articleSeoDescription" id="articleSeoDescription"
                                placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image2(event)"
                                name="articleSeoImage" id="articleSeoImage">
                            <img style="margin-top: 10px;" id="output_image2" />
                        </div> --}}
                </div>

                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Actualizar Receta" class="btn btn-info">
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
<!-- jQuery -->
@php
$section_ids=[];
@endphp
@foreach ($recipeDetail->course as $course)
@php
array_push($section_ids, $course->id);
@endphp
@endforeach
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

</script>
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

        $(document).ready(function(){
            $("#challenges").select2({
                width: '100%',
            });
            var data = [];
            data = <?php echo json_encode($section_ids); ?>;
            $("#challenges").val(data).trigger('change');
        });
</script>
@endsection
