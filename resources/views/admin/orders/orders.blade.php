@extends('layouts.admin_layout')
@section('title', 'Ordenes')
@section('content')
  <div class="content-wrapper">
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
              <div class="card-body">
                <table id="ordersTable" class="table table-sm table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Fecha</th>
                      <th>Documento</th>
                      <th>Cliente</th>
                      <th>Teléfono</th>
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
                        <td>{{ optional($order->shipping)->dni }}</td>
                        <td>
                          {{ optional($order->shipping)->first_name }} {{ optional($order->shipping)->last_name }}
                          <br>
                          <small>{{ $order->user->email }}</small>
                        </td>
                        <td>{{ optional($order->shipping)->phone }}</td>
                        <td>
                          {{ $order->getShippingAddressFormatted() }}
                        </td>
                        <td>{{ $order->total }}</td>
                        <td>
                          @php
                            $stateClass = $order->state_id == 1 ? 'badge-info' : ($order->state_id == 2 ? 'badge-success' : 'badge-danger');
                          @endphp
                          <small class="badge {{ $stateClass }}" style="cursor: pointer;" data-toggle="modal"
                            data-state="{{ $order->state_id }}" data-target="#changeStateModal"
                            data-id="{{ $order->id }}">
                            {{ $order->getStateNameAttribute() }}
                          </small>
                        </td>
                        <td>
                          <a class="btn-sm" data-toggle="modal" id="detailOrder" data-id="{{ $order->id }}"
                            data-target="#productsList" title="Ver Productos">
                            <i style="color: blue; cursor:pointer" class="far fa-eye"></i>
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
  {{-- Modal Change State --}}
  <div class="modal fade" id="changeStateModal" tabindex="-1" aria-labelledby="changeStateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Cambiar Estado</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('orders.changeState') }}" method="POST">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="id" id="order-id">
            <div class="form-group">
              <label for="state_id">Estado</label>
              <select name="state_id" id="state_id" class="form-control" required>
                @foreach (App\Order::STATES as $state_key => $state_name)
                  <option value="{{ $state_key }}">{{ $state_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success ">Cambiar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
      $('#changeStateModal').on('shown.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const orderId = button.data("id")
        const stateId = button.data("state");
        $('#state').trigger('focus')
        $("#order-id").val(orderId);
        $("#state_id").val(stateId);
      })
    });
  </script>
@endsection
