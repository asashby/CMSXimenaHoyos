@extends('layouts.admin_layout')
@section('title', 'Politicas')
@section('content')

  <div class="content-wrapper">

    <div class="content-header">
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Políticas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Políticas</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->


    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{ $companyData->helpCenter->title }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>

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
            <form method="post" action="{{ url('dashboard/policies/helpCenter') }}" name="createArticle"
              id="createArticle" enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="helpCenterTitle" name="helpCenterTitle"
                      value="{{ $companyData->helpCenter->title }}" placeholder="Ingrese Titulo">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <textarea class="form-control" name="helpCenterDescription" id="helpCenterDescription" placeholder="Ingrese Descripcion"
                      style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{ $companyData->helpCenter->description }}</textarea>
                  </div>
                </div>

              </div>
          </div>

          <div class="card-footer">
            <div class="form-actions">
              <input type="submit" value="Guardar Configuracion" class="btn btn-info">
            </div>
          </div>
          </form>


        </div>
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">{{ $companyData->privacyPolicy->title }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>

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
            <form method="post" action="{{ url('dashboard/policies/privacyPolicy') }}" name="createArticle"
              id="createArticle" enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="privacyPolicyTitle" name="privacyPolicyTitle"
                      value="{{ $companyData->privacyPolicy->title }}" placeholder="Ingrese Titulo">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <textarea class="form-control" name="privacyPolicyDescription" id="privacyPolicyDescription"
                      placeholder="Ingrese Descripcion" style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{ $companyData->privacyPolicy->description }}</textarea>
                  </div>
                </div>

              </div>


          </div>

          <div class="card-footer">
            <div class="form-actions">
              <input type="submit" value="Guardar Configuración" class="btn btn-info">
            </div>
          </div>
          </form>


        </div>

      </div>

    </section>


    <script>
      function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('output_image');
          output.src = reader.result;
          output.width = 400;
          output.width = 300

        }
        reader.readAsDataURL(event.target.files[0]);
      }

      function preview_image2(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('output_image2');
          output.src = reader.result;
          output.width = 400;
          output.width = 300

        }
        reader.readAsDataURL(event.target.files[0]);
      }

      function preview_image3(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('output_image3');
          output.src = reader.result;
          output.width = 400;
          output.width = 300

        }
        reader.readAsDataURL(event.target.files[0]);
      }

      function preview_image4(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('output_image4');
          output.src = reader.result;
          output.width = 400;
          output.width = 300

        }
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>
  </div>
@endsection
