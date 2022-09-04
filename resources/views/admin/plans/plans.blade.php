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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Planes</h3>
                <a href="{{ route('plans.create') }}" class="btn btn-success float-right">
                  <i class="fas fa-plus"></i> Agregar Plan
                </a>
              </div>
              <div class="card-body">
                <table class="table table-sm table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Título</th>
                      <th>Descripción</th>
                      <th>Meses</th>
                      <th>Precio</th>
                      <th>Retos</th>
                      <th>Focalizados</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($plans as $plan)
                      <tr>
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->title }}</td>
                        <td>{{ $plan->description }}</td>
                        <td>{{ $plan->months }}</td>
                        <td>{{ $plan->price }}</td>
                        <td>
                          @foreach ($plan->courses as $courseItem)
                            <span class="badge badge-primary">{{ $courseItem->title }}</span>
                          @endforeach
                        </td>
                        <td>
                          @foreach ($plan->focused_exercises as $focusedExerciseItem)
                            <span class="badge badge-primary">{{ $focusedExerciseItem->title }}</span>
                          @endforeach
                        </td>
                        <td>
                          <a data-toggle="tooltip" href="{{ route('plans.edit', $plan->id) }}" title="Editar">
                            <i class="far fa-edit"></i>
                          </a>
                          <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;" record="plan"
                            recordId="{{ $plan->id }}" data-toggle="tooltip" title="Eliminar">
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
