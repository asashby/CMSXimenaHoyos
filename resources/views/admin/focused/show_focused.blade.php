@extends('layouts.admin_layout')
@section('title', 'Detalle Ejercicio Focalizado')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detalle Ejercicio Focalizado: {{ $focused->title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('focused.index') }}">Ejercicios Focalizados</a></li>
              <li class="breadcrumb-item active">Detalle</li>
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
                <h3 class="card-title">Tabla de Ejercicios: {{ $focused->title }}</h3>
                <a href="{{ route('focused_exercise_item.create', ['focused_exercise_id' => $focused->id]) }}"
                  style="float: right;" class="btn btn-success">
                  Agregar Ejercicio
                </a>
              </div>
              <div class="card-body">
                <table id="coursesTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($focused->focused_exercise_items as $focusedExerciseItem)
                      <tr>
                        <td>{{ $focusedExerciseItem->title }}</td>
                        <td>
                          <form action="{{ route('focused_exercise_item.destroy', $focusedExerciseItem->id) }}"
                            method="post" onsubmit="return confirm('Eliminar?')">
                            @csrf
                            @method('DELETE')
                            <a data-toggle="tooltip"
                              href="{{ route('focused_exercise_item.edit', $focusedExerciseItem->id) }}" title="Editar"
                              class="btn btn-sm">
                              <i class="far fa-edit text-primary"></i>
                            </a>
                            <button type="submit" class="btn btn-sm btn-link" data-toggle="tooltip" title="Eliminar">
                              <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <a class="btn btn-secondary" href="{{ route('focused.index') }}">
                  <i class="fas fa-undo"></i> Regresar
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
