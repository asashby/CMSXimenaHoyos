<label class="mb-2" for="url_image">Icono<small>(jpeg, png, jpg, gif)</small></label>
@if(isset($unit))
    @if(!is_null($unit->url_icon))
        <div id="box-image" class="text-center">
            <div class="box8">
                <img id="show_icon" src="@if(isset($unit->url_icon)){{asset($unit->url_icon)}}@endif"
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
        <img id="show_icon" class="img-fluid" src="@if(isset($unit->url_icon)){{asset($unit->url_icon)}}@endif">
    @endif

@else
    <img id="show_icon" class="img-fluid" src="@if(isset($unit->url_icon)){{asset($unit->url_icon)}}@endif">
@endif
<div class="input-group">
    <div class="custom-file">
        {!! Form::file('url_icon', ['id'=>'url_icon','class'=>'custom-file-input']) !!}
        <label class="custom-file-label" for="url_icon">Subir imagen</label>
    </div>
</div>
@error('url_icon')
<x-form message="{{$message }}"/>
@enderror
