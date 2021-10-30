<label class="mb-2" for="url_image">Imagen para movil<small>(jpeg, png, jpg, gif)</small></label>
@if(isset($unit))
    @if(!is_null($unit->mobile_image))
        <div id="box-image" class="text-center">
            <div class="box8">
                <img id="show_img_mobile" src="@if(isset($unit->mobile_image)){{asset($unit->mobile_image)}}@endif"
                     height="300">
                <div class="box-content text-center">
                    <ul class="icon">
                        <li><a data-id="{{$unit->id}}" class="delete_image_unit" href="javascript:void(0);"><i
                                    class="fa fa-trash-alt"></i>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    @else
        <img id="show_img_mobile" class="img-fluid" src="@if(isset($unit->mobile_image)){{asset($unit->mobile_image)}}@endif" height="300">
    @endif

@else
    <img id="show_img_mobile" class="img-fluid" src="@if(isset($unit->mobile_image)){{asset($unit->mobile_image)}}@endif" height="300">
@endif
<div class="input-group">
    <div class="custom-file">
        {!! Form::file('mobile_image', ['id'=>'mobile_image','class'=>'custom-file-input']) !!}
        <label class="custom-file-label" for="mobile_image">Subir imagen</label>
    </div>
</div>
@error('mobile_image')
<x-form message="{{$message }}"/>
@enderror
