@extends('layouts.admin_layout')
@section('title', 'Crear Focalizado')
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
              <li class="breadcrumb-item active">Agregar Focalizado</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Agregar Focalizado</h3>
          </div>
          <form method="post" action="{{ url('dashboard/focused/create') }}" name="createRecipe" id="createRecipe"
            enctype="multipart/form-data">@csrf
            <div class="card-body">
              @include('admin.focused.partial_form')
            </div>
            <div class="card-footer">
              <a class="btn btn-secondary" href="{{ route('focused.index') }}">
                <i class="fas fa-reply"></i> Regresar
              </a>
              <button type="submit" class="btn btn-success">
                <i class="fas fa-paper-plane"></i> Agregar
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('scripts')
  <script>
    function preview_image(event, elementId) {
      const reader = new FileReader();
      reader.onload = function() {
        const output = document.getElementById(elementId);
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
@endsection
