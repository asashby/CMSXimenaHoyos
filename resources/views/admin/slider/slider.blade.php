@extends('layouts.admin_layout')
@section('title', 'Slider')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
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
      <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            Lista de Imagenes
          </h3>
        </div>

        <div class="card-body">
          <ul class="todo-list ui-sortable" data-widget="todo-list">
            @foreach ($sliders as $slider)
              <li class="item-slide" id="{{ $slider->id }}" data-target="slide">
                <!-- drag handle -->
                <span class="handle ui-sortable-handle">
                  <i class="fas fa-ellipsis-v"></i>
                  <i class="fas fa-ellipsis-v"></i>
                </span>
                <!-- checkbox -->
                <!-- todo text -->
                <span class="text">{{ $slider->title }}</span>
                <!-- Emphasis label -->
                <!-- General tools such as edit or delete-->
                <div class="tools">
                  <a href="{{ url('/dashboard/slider/edit/' . $slider->id) }}" data-toggle="tooltip" title="Editar"><i
                      class="fas fa-edit"></i></a>
                  <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;" record="slider"
                    recordId="{{ $slider->id }}" data-toggle="tooltip" title="Eliminar">
                    <i style="color: red;" class="fas fa-trash-alt"></i>
                  </a>
                </div>
              </li>
            @endforeach

          </ul>
        </div>

        <div class="card-footer clearfix">
          <a href="{{ url('/dashboard/slider/create') }}" style="max-width: 150px; float: right; display:inline-block;"
            class="btn btn-info btn-success">Agregar Slider</a>
        </div>
      </div>
    </section>

  </div>

@endsection
