<label class="mb-2" for="url_image">Imagen <small>(jpeg, png, jpg, gif)</small></label>
@if(isset($question))
    @if(!is_null($question->url_image))
        <div id="box-image" class="text-center">
            <div class="box8">
                <img id="show_img" class="img-fluid" src="@if(isset($question->url_image)){{asset($question->url_image)}}@endif"
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
        <img id="show_img" class="img-fluid" src="@if(isset($question->url_image)){{asset($question->url_image)}}@endif" width="600">
    @endif

@else
    <img id="show_img" class="img-fluid" src="@if(isset($question->url_image)){{asset($question->url_image)}}@endif" width="600">
@endif
<div class="input-group">
    <div class="custom-file">
        {!! Form::file('url_image', ['id'=>'url_image','class'=>'custom-file-input']) !!}
        <label class="custom-file-label" for="url_image">Subir imagen</label>
    </div>
</div>
@error('url_image')
<x-form message="{{$message }}"/>
@enderror
