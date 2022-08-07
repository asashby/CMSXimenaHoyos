@extends('layouts.admin_layout')
@section('title', 'Ejercicios Focalizados')
@section('content')
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ejercicios Focalizados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Ejercicios Focalizados</li>
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
            <!--Elegido-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla de Ejercicios Focalizados</h3>
                <a href="{{ url('dashboard/focused/create') }}" style="float: right; display:inline-block;"
                  class="btn btn-success">
                  Agregar Focalizado
                </a>
              </div>
              <div class="card-body">
                <table id="coursesTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Título</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($exercises as $exercise)
                      <tr>
                        <td>{{ $exercise->id }}</td>
                        <td>{{ $exercise->title }}</td>
                        <td>
                          {{-- <span data-toggle="modal" id="excercises" data-target="#unitsListModal"
                                                data-id="{{$exercise->id}}" data-title="{{$exercise->title}}">
                                                <a data-toggle="tooltip" style="cursor: pointer" title="Ver Ejercicios">
                                                    <i class="fas fa-file text-info"></i>
                                                </a>
                                            </span> --}}
                          <a data-toggle="tooltip" href="{{ url('dashboard/focused/edit/' . $exercise->id) }}"
                            title="Editar">
                            <i class="far fa-edit"></i>
                          </a>
                          <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;" record="focused"
                            recordId="{{ $exercise->id }}" data-toggle="tooltip" title="Eliminar">
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
  {{-- -- LISTAR PREGUNTAS POR UNIDAD --- --}}
  <div class="modal fade" id="unitsListModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Lista de Ejercicios para <b id="courseModalLabel"></b> </h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
          <div class="data-units-course col-md-12">
            <ul class="todo-list ui-sortable" data-widget="todo-list">
            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
