@extends('layouts.admin_layout')
@section('title', 'Dashboard')
@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $numArticles }}</h3>
                <p>Articulos</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paper"></i>
              </div>
              <a href="{{ url('dashboard/articles') }}" class="small-box-footer">Listado <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $numCourses }}</h3>
                <p>Retos</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ url('dashboard/courses') }}" class="small-box-footer">Listado <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $numUnits }}</h3>
                <p>Ejercicios</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('dashboard/units') }}" class="small-box-footer">Listado <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $numUsers }}</h3>
                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('dashboard/users') }}" class="small-box-footer">Listado <i
                  class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <input id="exchange_rate" type="number" min="0" step="0.001"
                  value="{{ $companyData->exchange_rate }}">
                <label for="exchange_rate">Tipo de Cambio</label>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="updateExchangeRate()">
                Actualizar <i class="fas fa-paper-plane"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('scripts')
  <script>
    function updateExchangeRate() {
      const exchangeRateInput = $("#exchange_rate");
      $.ajax({
        url: `/dashboard/companies/exchange-rate`,
        method: 'PUT',
        data: {
          exchange_rate: exchangeRateInput.val(),
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          console.log(response)
        }
      });
    }
  </script>
@endsection
