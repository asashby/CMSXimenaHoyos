@extends('layouts.admin_layout')
@section('title', 'Actualizar Datos')
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
            <h1 class="m-0 text-dark">Configuración de la Compañia</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->


    <section class="content">
      <div class="container-fluid">

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Editar Datos de la Compañía</h3>
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
            <form method="post" action="{{ url('dashboard/company') }}" name="createArticle" id="createArticle"
              enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre de La Compañía</label>
                    <input type="text" class="form-control" id="companyName" name="companyName"
                      value="{{ $companyData->name }}" placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dirección de La Compañía</label>
                    <input type="text" class="form-control" id="addressCompany" name="companyAddress"
                      value="{{ $companyData->companyInfo->company_address }}" placeholder="Ingrese Direccion">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Teléfono de La Compañía</label>
                    <input type="text" class="form-control" id="companyPhone" name="companyPhone"
                      value="{{ $companyData->companyInfo->company_phone }}" placeholder="Ingrese Telefono">
                  </div>

                  <h5>Redes Sociales <small>(para inicio de Sesion)</small></h5>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Facebook</label>
                    <input type="text" class="form-control" id="clientIdFb"
                      value="{{ $companyData->facebook->client_id }}" name="FclientId" placeholder="Client ID">
                    <input type="text" class="form-control" id="clientSecretFb"
                      value="{{ $companyData->facebook->client_secret }}" name="FclientSecret"
                      placeholder="Client Secret">
                    <input type="text" class="form-control" id="urlRedirectFb"
                      value="{{ $companyData->facebook->redirect }}" name="Furl_redirect" placeholder="URL redirect">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Google</label>
                    <input type="text" class="form-control" id="clientIdG"
                      value="{{ $companyData->google->client_id }}" name="GclientId" placeholder="Client ID">
                    <input type="text" class="form-control" id="clientSecretG"
                      value="{{ $companyData->google->client_secret }}" name="GlientSecret" placeholder="Client Secret">
                    <input type="text" class="form-control" id="urlRedirectG"
                      value="{{ $companyData->google->redirect }}" name="Gurl_redirect" placeholder="URL redirect">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Registro en Ecommerce</label>
                    <div class="form-check">
                      <input type="checkbox" value="1" name="checkUserMaki" id="checkUserMaki"
                        <?php if ($companyData->create_user_maki == 1) {
                            echo 'checked';
                        } ?>>
                      <label class="form-check-label" for="checkUserMaki">
                        Registro de Usuarios Entrantes a Maki
                      </label>
                    </div>
                  </div>
                  <h5></h5>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Token de Comercio</label>
                    <input type="text" class="form-control" id="commerceToken"
                      value="{{ $companyData->commerce_token }}" name="commerceToken" placeholder="token de comercio">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Logo de La Compañía <small>(jpeg, png, jpg, gif, svg)</small></label>
                    <input type="file" class="form-control" onchange="preview_image(event)" name="companyImage"
                      id="companyImage">
                    <img style="margin-top: 10px;" class="img-fluid" id="output_image"
                      src="{{ $companyData->companyInfo->url_company }}" />
                    <input type="hidden" name="currentCompanyImage"
                      value="{{ $companyData->companyInfo->url_company }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Ícono Compañía <small>(solo PNG)</small></label>
                    <input type="file" class="form-control" onchange="preview_image3(event)" name="companyIcon"
                      id="companyIcon">
                    <img style="margin-top: 10px;" class="img-fluid" id="output_image3"
                      src="{{ $companyData->companyInfo->url_icon }}" />
                    <input type="hidden" name="currentCompanyIcon" value="{{ $companyData->companyInfo->url_icon }}">
                  </div>
                </div>


              </div>
          </div>

          <div class="card-footer">
            <div class="form-actions">
              <input type="submit" value="Actualizar Configuración" class="btn btn-info">
            </div>
          </div>
          </form>


        </div>


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
