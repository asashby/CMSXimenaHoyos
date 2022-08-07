@extends('layouts.admin_layout')
@section('title', 'Agregar Slider')
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
              <li class="breadcrumb-item active">Agregar Slider</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Agregar Slider</h3>
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

              <!-- form start -->
              <form role="form" method="post"action="{{ url('/dashboard/slider/create') }}" name="addSlider"
                id="addSlider" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="control-group">
                    <label class="control-label">Banner Image</label>
                    <div class="controls">
                      <input type="file" name="sliderImage" onchange="preview_image(event)">
                      <br>
                      <img style="margin-top: 10px;" id="output_image" />
                    </div>
                  </div>
                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Agregar</button>
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
  </script>
@endsection
