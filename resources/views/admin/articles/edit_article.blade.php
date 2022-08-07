@extends('layouts.admin_layout')
@section('title', 'Editar Datos')
@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sobre Ximena</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Sobre Ximena</li>
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

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Editar Datos</h3>
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
            <form method="post" action="{{ url('dashboard/articles/edit/' . $articleDetail->slug) }}"
              name="createArticle" id="createArticle" enctype="multipart/form-data">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="hidden" name="sectionId" value="1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="articleTitle"
                      value="{{ $articleDetail->title }}" placeholder="Ingrese Titulo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pretitulo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="articleSubTitle"
                      value="{{ $articleDetail->subtitle }}" placeholder="Ingrese Pretitulo">
                  </div>

                  <h5>Redes Sociales</h5>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Link Facebook</label>
                    <input type="text" class="form-control" id="articleTextLink" name="linkFb"
                      value="{{ $articleDetail->addittional_info ? $articleDetail->addittional_info->facebook : '' }}"
                      placeholder="Ingrese Texto Link">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Link Instagram</label>
                    <input type="text" class="form-control" id="articleTextLink" name="linkIns"
                      value="{{ $articleDetail->addittional_info ? $articleDetail->addittional_info->instagram : '' }}"
                      placeholder="Ingrese Texto Link">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Link Tiktok</label>
                    <input type="text" class="form-control" id="articleTextLink" name="linkTk"
                      value="{{ $articleDetail->addittional_info ? $articleDetail->addittional_info->tiktok : '' }}"
                      placeholder="Ingrese Texto Link">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen Banner</label>
                    <input type="file" class="form-control" onchange="preview_image(event)" name="articleBanner"
                      id="articleBanner">
                    <img style="margin-top: 10px;" class="img-fluid" id="output_image"
                      src="{{ asset($articleDetail->banner) }}" />
                    <input type="hidden" name="currentArticleBanner" value="{{ $articleDetail->banner }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Imagen para Movil</label>
                    <input type="file" class="form-control" onchange="preview_image3(event)"
                      name="articleBannerMobile" id="articleBannerMobile">
                    <img style="margin-top: 10px;" class="img-fluid" id="output_image3"
                      src="{{ asset($articleDetail->mobile_image) }}" />
                    <input type="hidden" name="currentArticleBannerMobile"
                      value="{{ $articleDetail->mobile_image }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Insertar Foto</label>
                    <input type="file" class="form-control" onchange="preview_image2(event)" name="articleImage"
                      id="articleImage">
                    <img style="margin-top: 10px;" id="output_image2" class="img-fluid"
                      src="{{ asset($articleDetail->page_image) }}" />
                    <input type="hidden" name="currentArticleImage" value="{{ $articleDetail->page_image }}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">URL de Video</label>
                    <input type="url" class="form-control" id="articleUrlVideo" name="articleUrlVideo"
                      value="{{ $articleDetail->url_video }}" placeholder="Ingrese URL">
                    <input type="hidden" name="currentUrlVideo" value="{{ $articleDetail->url_video }}">
                  </div>
                </div>

              </div>

              <h5>Contenido del Articulo</h5>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <div class="form-group">
                      <textarea class="form-control" name="articleResume" id="articleResume" placeholder="Ingrese Resumen"
                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{ $articleDetail->description }}</textarea>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>

          </div>

          <div class="card-footer">
            <div class="form-actions">
              <input type="submit" value="Actualizar Datos" class="btn btn-info">
            </div>
          </div>
          </form>


        </div>


      </div>

  </div>
  </section>

  </div>

  <script type='text/javascript'>
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
  </script>
@endsection
