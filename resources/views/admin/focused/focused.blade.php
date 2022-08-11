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
                      <th>Título</th>
                      <th>Descripción</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($exercises as $exercise)
                      <tr>
                        <td>{{ $exercise->title }}</td>
                        <td>{{ $exercise->subtitle }}</td>
                        <td>
                          <a href="{{ route('focused.show', $exercise->id) }}" data-toggle="tooltip" class="btn-sm"
                            title="Detalle">
                            <i class="fas fa-eye text-info"></i>
                          </a>
                          <a data-toggle="tooltip" href="{{ url('dashboard/focused/edit/' . $exercise->id) }}"
                            title="Editar" class="btn-sm">
                            <i class="far fa-edit"></i>
                          </a>
                          <a href="javascript:void(0)" class="confirmDelete btn-sm" style="cursor: pointer;"
                            record="focused" recordId="{{ $exercise->id }}" data-toggle="tooltip" title="Eliminar">
                            <i class="fas fa-trash-alt text-danger"></i>
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
