@extends('layouts.admin_layout')
@section('title', 'Menú de Navegación')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Secciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Secciones</li>
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
                <h3 class="card-title">Tabla de Secciones</h3>
                <a href="{{ url('/dashboard/section/create') }}"
                  style="max-width: 150px; float: right; display:inline-block;" class="btn btn-block btn-success">Agregar
                  Seccion</a>
              </div>

              <div class="card-body">
                <ul class="todo-list ui-sortable" data-widget="todo-list">
                  @foreach ($sections as $section)
                    <li class="item-slide" id="{{ $section->id }}" data-target="section">
                      <!-- drag handle -->
                      <span class="handle ui-sortable-handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      <!-- todo text -->
                      <span class="text">{{ $section->name }}</span>
                      @if ($section->activated == 1)
                        <small class="badge badge-success update-status" style="cursor: pointer;"
                          id="section-{{ $section->id }}" section_id="{{ $section->id }}">
                          Activado
                        </small>
                      @else
                        <small class="badge badge-danger update-status" style="cursor: pointer;"
                          id="section-{{ $section->id }}" section_id="{{ $section->id }}">
                          Desactivado
                        </small>
                      @endif
                      <!-- Emphasis label -->
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        {{-- <a href="{{ url('/dashboard/section/edit/'.$section->id)}}" data-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></a> --}}
                        <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;" record="section"
                          recordId="{{ $section->id }}" data-toggle="tooltip" title="Eliminar">
                          <i style="color: red;" class="fas fa-trash-alt"></i>
                        </a>
                      </div>
                    </li>
                  @endforeach
                </ul>
                {{-- <table id="sectionsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Orden Navegación</th>
                            <th>Orden Home</th>
                            <th>status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{!! $section->description !!}</td>
                                <td>{{ $section->order }}</td>
                                <td>{{ $section->order_home}}</td>
                                <td>
                                    @if ($section->activated == 1)
                                        <small class="badge badge-success update-status"  style="cursor: pointer;" id="section-{{ $section->id }}" section_id="{{ $section->id }}">
                                            Activado
                                        </small>
                                    @else
                                        <small class="badge badge-danger update-status" style="cursor: pointer;" id="section-{{ $section->id }}" section_id="{{ $section->id }}">
                                            Desactivado
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <a data-toggle="tooltip" href="{{ url('dashboard/section/edit/'.$section->id) }}" data-toggle="tooltip" title="Editar" title="Editar">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;" record="section" recordId="{{ $section->id }}" data-toggle="tooltip" title="Eliminar">
                                        <i style="color: red;" class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

  </div>

@endsection
