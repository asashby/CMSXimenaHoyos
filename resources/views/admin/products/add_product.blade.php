@extends('layouts.admin_layout')
@section('title', 'Crear Producto')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('dashboard/products') }}">Productos</a></li>
              <li class="breadcrumb-item active">Agregar Producto</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Agregar Producto</h3>
          </div>
          <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              @include('admin.products.partial_form')
            </div>
            <div class=" card-footer">
              <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-reply"></i> Regresar
              </a>
              <button type="submit" class="btn btn-success">
                <i class="fas fa-plus"></i> Agregar
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('script')
  <script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
      url: '{{ route('products.storeMedia') }}',
      maxFilesize: 5, // MB
      addRemoveLinks: true,
      acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(file, response) {
        $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name
      },
      removedfile: function(file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
          name = file.file_name
        } else {
          name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
      }
    }

    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        output.width = 400;
        output.height = 300

      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
@endpush
