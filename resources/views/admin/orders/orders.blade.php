@extends('layouts.admin_layout')
@section('title', 'Ordenes')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ordenes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Ordenes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
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
            <!--Elegido-->
            <div class="card">
              {{-- <div class="card-header">
                            <h3 class="card-title">Tabla de Retos</h3>
                            <a href="{{ url('dashboard/orders/create') }}"
                                style="max-width: 150px; float: right; display:inline-block;"
                                class="btn btn-block btn-success">Agregar Plan</a>
                        </div> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="ordersTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Fecha</th>
                      <th>Usuario</th>
                      <th>Envio</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)
                      <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                          {{ $order->user->name }} {{ $order->user->sur_name }}
                          <br>
                          <small>{{ $order->user->email }}</small>
                        </td>
                        <td>
                          {{ $order->getShippingAddressFormatted() }}
                        </td>
                        <td>{{ $order->total }}</td>
                        <td>
                          @php
                            $stateClass = $order->state_id == 1 ? 'badge-info' : ($order->state_id == 2 ? 'badge-success' : 'badge-danger');
                          @endphp
                          <small class="badge {{ $stateClass }}" style="cursor: pointer;">
                            {{ $order->getStateNameAttribute() }}
                          </small>
                        </td>
                        <td>
                          <a data-toggle="modal" id="detailOrder" data-id="{{ $order->id }}"
                            data-target="#productsList" title="Ver Productos">
                            <i style="color: blue; cursor:pointer" class="fas fa-eye"></i>
                          </a>
                          <a href="javascript:void(0)" class="confirmCancel" style="cursor: pointer;" record="order"
                            recordId="{{ $order->id }}" data-toggle="tooltip" title="Anular">
                            <i style="color: red;" class="fas fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  {{-- -- LISTAR PREGUNTAS POR UNIDAD --- --}}
  <div class="modal fade" id="productsList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Productos de La Orden</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
          <div class="data-order col-md-12">
            <table class="table products-list">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- /.content-wrapper -->
@endsection
