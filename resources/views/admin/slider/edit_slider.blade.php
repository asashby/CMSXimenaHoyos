@extends('layouts.admin_layout')
@section('title', 'Editar Slider')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Slider</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('dashboard/slider') }}">Slider</a></li>
                <li class="breadcrumb-item active">Editar Slider</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Editar Slider</h3>
              </div>
              <!-- /.card-header -->
              
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
              <form role="form" method="post" action="{{ url('/dashboard/slider/edit/'.$sliderDetails['id'])}}" name="updateSlide" id="updateSlide" enctype="multipart/form-data">@csrf
                <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputFile">Insertar Imagen</label>
                          <input type="file" class="form-control" name="sliderImage" id="sliderImage" onchange="preview_image(event)">
                          <br>
                          <img style="margin-top: 10px;" width="300"  id="output_image" src="{{$sliderDetails->url_image}}"/>
                          <input type="hidden" name="currentArticleImage"  value="{{$sliderDetails->url_image}}"> 
                          <input type="hidden" name="currentSlugImage" value="{{$sliderDetails->slug}}"> 
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Editar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
    </div>
     <script type='text/javascript'>
      function preview_image(event) 
      {
       var reader = new FileReader();
       reader.onload = function()
       {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        output.width = 400;
        output.width = 300

       }
       reader.readAsDataURL(event.target.files[0]);
      }
      </script>
@endsection