@extends('layouts.admin_layout')
@section('title', 'Editar Producto')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                        <li class="breadcrumb-item active">Editar Producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Editar Producto</h3>
                </div>
                <!-- /.card-header -->
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
                    <form method="post" action="{{ url('dashboard/products/edit/'. $productDetail->id)}}"
                        name="createRecipe" id="createRecipe" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label>Seleccione Categoria</label>
                                    <select id="category" name="productCategory" class="form-control">
                                        <?php echo $categories_drop_down; ?>
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="productTitle"
                                        placeholder="Ingrese Titulo" value="{{ $productDetail->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripcion de Producto</label>
                                    <textarea class="form-control" name="productResume" id="productResume"
                                        placeholder="Ingrese Resumen"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{ $productDetail->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Precio</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="productPrice"
                                        placeholder="Ingrese Precio" value="{{ $productDetail->price }}">
                                </div>
                                <div class="form-inline">
                                    <label class="sr-only" for="inlineFormInputName2">Codigo</label>
                                    <input type="text" class="form-control mb-2 mr-sm-2" id="key" placeholder="Clave">

                                    <label class="sr-only" for="inlineFormInputGroupUsername2">Valor</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control" id="value" placeholder="Valor">
                                    </div>
                                    <button type="button" class="btn btn-primary mb-2 addRow">+</button>
                                </div>
                                <table id="attributes" class="table table-bordered">
                                    <thead>
                                        <th>Codigo</th>
                                        <th>Valor</th>
                                        <th>Accion</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <input type="hidden" name="currentAttributesProduct">
                                <input id="attributesFinal" name="attributes" type="hidden">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagenes</label>
                                    <div class="needsclick dropzone" id="document-dropzone"></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <!-- /.row -->
            <div class="card-footer">
                <div class="form-actions">
                    <input type="submit" value="Publicar" class="btn btn-info">
                </div>
            </div>
            </form>
            <!-- /.row -->

        </div>
        <!-- /.card-body -->

</div>
<!-- /.card -->
</section>



<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@push('script')
<script>
    var uploadedDocumentMap = {}
Dropzone.options.documentDropzone = {
url: '{{ route('products.storeMedia') }}',
maxFilesize: 15, // MB
addRemoveLinks: true,
acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
headers: {
'X-CSRF-TOKEN': "{{ csrf_token() }}"
},
success: function(file, response) {
$('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
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
$('form').find('input[name="photos[]"][value="' + name + '"]').remove()
},
init: function() {
@if (isset($photos))
var files =
{!! json_encode($photos) !!}
for (var i in files) {
var file = files[i]
console.log(file.original_url);
file = {
...file,
width: 226,
height: 324
}
 this.options.addedfile.call(this, file)
               this.options.thumbnail.call(this, file, file.original_url)
               file.previewElement.classList.add('dz-complete')

$('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
}
@endif
}
}
</script>
@endpush
@endsection
