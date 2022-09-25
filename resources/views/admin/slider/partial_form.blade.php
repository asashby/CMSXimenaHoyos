<div class="form-group">
  <label for="product_id">Producto</label>
  <select id="product_id" name="product_id" class="form-control">
    <option value="">Seleccionar</option>
    @foreach ($products as $product)
      <option value="{{ $product->id }}" @if ($product->id == $slider->product_id) selected @endif>
        {{ $product->display_name }}
      </option>
    @endforeach
  </select>
  @error('product_id')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupSliderImage">Subir</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="sliderImage" name="sliderImage"
      aria-describedby="inputGroupSliderImage" accept="image/png, image/jpeg" onchange="preview_image(event)">
    <label class="custom-file-label" for="sliderImage">Insertar Imagen</label>
  </div>
</div>
<div class="media">
  <img class="img-fluid" style="width:300px;" id="output_image" src="{{ $slider->url_image }}" />
</div>
@section('scripts')
  <script>
    $(document).ready(function() {
      $('#product_id').select2({
        width: '100%',
      });
    });

    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        output.width = 300
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
@endsection
