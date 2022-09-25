@extends('layouts.admin_layout')
@section('title', 'Editar Slider')
@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/slider') }}">Slider</a></li>
              <li class="breadcrumb-item active">Editar Slider</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Slider</h3>
              </div>
              @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px;">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form role="form" method="post" action="{{ url('/dashboard/slider/edit/' . $slider['id']) }}"
                enctype="multipart/form-data">@csrf
                <div class="card-body">
                  @include('admin.slider.partial_form')
                </div>
                <div class="card-footer">
                  <a href="{{ route('slider.index') }}" class="btn btn-secondary">
                    <i class="fas fa-reply"></i> Regresar
                  </a>
                  <button type="submit" class="btn btn-success">
                    <i class="fas fa-edit"></i> Editar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
