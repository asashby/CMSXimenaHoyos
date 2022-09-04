@extends('layouts.admin_layout')
@section('title', 'Editar Categoria')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorias</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/categories') }}">Categorias</a></li>
              <li class="breadcrumb-item active">Editar Categoria</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Editar Categoria</h3>
          </div>
          <form method="post" action="{{ url('dashboard/categories/edit/' . $categoryDetail->id) }}"
            enctype="multipart/form-data">@csrf
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
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="categoryTitle">Título</label>
                    <input type="text" class="form-control" id="categoryTitle" name="categoryTitle"
                      placeholder="Ingrese Titulo" value="{{ $categoryDetail->name }}">
                  </div>
                  <div class="form-group">
                    <label for="categoryResume">Descripción de Categoria</label>
                    <textarea class="form-control" name="categoryResume" id="categoryResume" placeholder="Ingrese Resumen">{{ $categoryDetail->description }}</textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div>
                <input type="submit" value="Publicar" class="btn btn-info">
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
@endsection
