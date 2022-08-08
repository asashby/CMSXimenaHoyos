@extends('layouts.admin_layout')
@section('title', 'Editar Ejercicio Focalizado')
@section('content')
  <div class="content-wrapper">
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
              <li class="breadcrumb-item">
                <a href="{{ route('focused.show', $focusedExerciseItem->focused_exercise_id) }}">
                  Detalle
                </a>
              </li>
              <li class="breadcrumb-item active">Editar Ejercicio Focalizado</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Editar Ejercicio Focalizado</h3>
          </div>
          <form method="post" action="{{ route('focused_exercise_item.update', $focusedExerciseItem->id) }}">
            @method('PUT')
            @csrf
            <div class="card-body">
              @include('admin.focused_exercise_item.partial_form')
            </div>
            <div class="card-footer">
              <div class="form-actions">
                <a class="btn btn-secondary"
                  href="{{ route('focused.show', $focusedExerciseItem->focused_exercise_id) }}">
                  <i class="fas fa-reply"></i> Regresar
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-edit"></i> Editar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
@endsection
