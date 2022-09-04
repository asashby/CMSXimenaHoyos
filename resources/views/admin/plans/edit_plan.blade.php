@extends('layouts.admin_layout')
@section('title', 'Editar Plan')
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
              <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planes</a></li>
              <li class="breadcrumb-item active">Editar Plan</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Editar Plan</h3>
          </div>
          <form method="post" action="{{ route('plans.update', $plan->id) }}">@csrf
            <div class="card-body">
              @include('admin.plans.partial_form')
            </div>
            <div class="card-footer">
              <a class="btn btn-secondary" href="{{ route('plans.index') }}">
                <i class="fas fa-reply"></i> Regresar
              </a>
              <button type="submit" class="btn btn-success">
                <i class="fas fa-edit"></i> Editar
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
@endsection
