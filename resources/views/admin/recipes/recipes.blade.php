@extends('layouts.admin_layout')
@section('title', 'Recetas')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Recetas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Recetas</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        @if (Session::has('error_message'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla de Recetas</h3>
                <a href="{{ url('dashboard/recipes/create') }}"
                  style="max-width: 150px; float: right; display:inline-block;" class="btn btn-block btn-success">Agregar
                  Receta</a>
              </div>

              <div class="card-body">
                <table id="sectionsTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Título</th>
                      <th>Imagen</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recipes as $recipe)
                      <tr>
                        <td>{{ $recipe->id }}</td>
                        <td>{{ $recipe->title }}</td>
                        <td>
                          <img src="{{ asset($recipe->page_image) }}" class="img-fluid" width=200 height=100
                            alt="">
                        </td>
                        <td>
                          <a data-toggle="tooltip" href="{{ url('dashboard/recipes/edit/' . $recipe->id) }}"
                            title="Editar">
                            <i class="far fa-edit"></i>
                          </a>
                          <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;" record="recipe"
                            recordId="{{ $recipe->id }}" data-toggle="tooltip" title="Eliminar">
                            <i style="color: red;" class="fas fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

  </div>

@endsection
