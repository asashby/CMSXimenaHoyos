<label class="mb-2" for="url_image">Imagen para movil<small>(jpeg, png, jpg, gif)</small></label>
@if(isset($question))
    @if(!is_null($question->mobile_image))
        <div id="box-image" class="text-center">
            <div class="box8">
                <img id="show_img_mobile" class="img-fluid" src="@if(isset($question->mobile_image)){{asset($question->mobile_image)}}@endif"
                width="600">
                <div class="box-content text-center">
                    <ul class="icon">
                        <li><a data-id="{{$question->id}}" class="delete_image_unit" href="javascript:void(0);"><i
                                    class="fa fa-trash-alt"></i>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    @else
        <img id="show_img_mobile" class="img-fluid" src="@if(isset($question->mobile_image)){{asset($question->mobile_image)}}@endif" width="600">
    @endif

@else
    <img id="show_img_mobile" class="img-fluid" src="@if(isset($question->mobile_image)){{asset($question->mobile_image)}}@endif" width="600">
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
