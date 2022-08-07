@extends('layouts.admin_layout')
@section('title', 'Planes')
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
              <li class="breadcrumb-item active">Planes</li>
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
                <h3 class="card-title">Tabla de Retos</h3>
                <a href="{{ url('dashboard/plans/create') }}"
                  style="max-width: 150px; float: right; display:inline-block;" class="btn btn-block btn-success">Agregar
                  Plan</a>
              </div>

              <div class="card-body">
                <table id="coursesTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Título</th>
                      <th>Meses</th>
                      <th></th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($plans as $plan)
                      <tr>
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->title }}</td>
                        <td>{{ $plan->months }}</td>
                        <td>{{ $plan->description }}</td>
                        <td>
                          {{-- <span data-toggle="modal" id="excercises" data-target="#unitsListModal"
                                                data-id="{{$plan->id}}" data-title="{{$plan->title}}">
                                                <a data-toggle="tooltip" style="cursor: pointer" title="Ver Ejercicios">
                                                    <i class="fas fa-file text-info"></i>
                                                </a>
                                            </span> --}}
                          <a data-toggle="tooltip" href="{{ url('dashboard/plans/edit/' . $plan->id) }}" title="Editar">
                            <i class="far fa-edit"></i>
                          </a>
                          <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;" record="plan"
                            recordId="{{ $plan->id }}" data-toggle="tooltip" title="Eliminar">
                            <i style="color: red;" class="fas fa-trash-alt"></i>
                          </a>
              </div>
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
