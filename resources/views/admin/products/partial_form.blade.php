<div class="form-row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="name">Título</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        placeholder="Ingrese Titulo" value="{{ old('name', $product->name) }}" required autofocus>
      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label>Seleccione Categoria</label>
      @php
        $categoriesIds = old('categories[]', $product->categories->pluck('id')->toArray());
      @endphp
      <select id="categories" name="categories[]" class="form-control">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" @if (in_array($category->id, $categoriesIds)) selected @endif>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      @error('categories[]')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="description">Descripción de Producto</label>
      <textarea class="form-control textAreaEditor @error('description') is-invalid @enderror" name="description"
        id="description" placeholder="Ingrese Resumen">{!! old('description', $product->description) !!}</textarea>
      @error('description')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="sku">SKU</label>
      <input type="text" class="form-control @error('sku') is-invalid @enderror" placeholder="Ingrese Sku"
        name="sku" id="sku" value="{{ old('sku', $product->sku) }}">
      @error('sku')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="price">Precio</label>
      <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
        placeholder="Ingrese Precio" value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
      @error('price')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="stock">Stock</label>
      <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
        placeholder="Ingrese Stock" value="{{ old('stock', $product->stock) }}" step="0.01" required>
      @error('stock')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="form-group">
      <div class="custom-control custom-switch @error('is_active') is-invalid @enderror">
        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
          @if (old('is_active', $product->is_active)) checked @endif>
        <label class="custom-control-label" for="is_active">Activo</label>
      </div>
      @error('is_active')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
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
    <div class="form-group">
      <label for="exampleInputFile">Imagen de Portada</label>
      <input type="file" class="form-control" name="productImage" id="productImage" onchange="preview_image(event)"
        value="{{ $product->url_image }}">
      <br>
      <img class="img-fluid" width="300" id="output_image" src="{{ $product->url_image }}" />
    </div>
  </div>
</div>
