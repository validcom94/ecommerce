<?php
    if (!isset($blockTitle)) {
        $blockTitle = 'Изображения';
    }
?>

@if (!isset($ajax) || !$ajax)
<div class="media-files-widget"
     data-multiple="{{isset($multiple)?$multiple:0}}"
     @if(isset($urlField) && $urlField)
     data-url-field="true"
     @endif
     data-type="{{isset($type)?$type:'image'}}">
@endif

@if (!isset($ajax) || !$ajax)
    <div>
        <h4>{{$blockTitle}}</h4>
    </div>
    <div>
        <a style="margin-bottom:20px; {{($images && $images->count()>0 && (!isset($multiple) || $multiple ==0))?'display:none;':''}}" href="#" class="btn add_image btn-primary btn-block btn-addon add_button media-add-item" data-toggle="modal" data-type="images" data-target="#add_image" data-input="some_input">
            <i class="fa fa-plus"></i> &nbsp; {{trans('ecommerce::default.actions.image_add')}}
        </a>
    </div>
@endif

@if (!isset($ajax) || !$ajax)
    <div class="media-files-holder">
@endif

@if (isset($images) && $images)
    @foreach($images as $index => $image)
        <div class="media-files-item">
            <div class="m-b-sm text-md">{{ trans('content::default.posts.image') }}</div>
            <div class="text-center">
            @if (isset($cropped_coords) && isset($image) && $cropped_coords)
                <img id="img" class="img-thumbnail img-responsive" src="{{ '/'.config('media.policies.uploads.images.src_path').'/'.$image->id.'?'.$cropped_coords}}" style="max-height: 300px; max-width: 100%;" />
            @else
                <img id="img" class="img-thumbnail img-responsive" src="{{$image->path}}" style="max-height: 300px; max-width: 100%;" />
            @endif
            </div>

            @if ($image)
                <div>
                    <label class="control-label image_title">{{ trans('content::default.posts.image_title') }}</label>
                    {!! Form::text('Media['.time().'-'.$index.'-'.(isset($type)?$type:'image').'][image_title]', !Input::old() ? ($image->pivot?$image->pivot->title:'') : '', ['class' => 'form-control image_title']) !!}
                </div>
            @endif
            @if ($image)
                <div>
                    <label class="control-label image_alt">{{ trans('content::default.posts.image_alt') }}</label>
                    {!! Form::text('Media['.time().'-'.$index.'-'.(isset($type)?$type:'image').'][image_alt]', !Input::old() ? ($image->pivot?$image->pivot->alt:'') : ''  , ['class' => 'form-control image_alt']) !!}
                </div>
            @endif
            @if ($image && isset($type) && $type)
                {!! Form::hidden('Media['.time().'-'.$index.'-'.(isset($type)?$type:'image').'][subtype]', $type) !!}
            @endif
            @if ($image && isset($urlField) && $urlField)
                <div>
                    <label class="control-label image_url">URL</label>
                    {!! Form::text('Media['.time().'-'.$index.'-'.(isset($type)?$type:'image').'][url]', !Input::old() ? ($image->pivot?$image->pivot->url:'') : ''  , ['class' => 'form-control image_url']) !!}
                </div>
            @endif

            <br>
            <div>
                <a style="margin-bottom:20px;" href="#" class="btn add_image btn-primary btn-block btn-addon add_button media-change-item" data-toggle="modal" data-type="images" data-target="#add_image" data-input="some_input">
                    <i class="fa fa-cogs"></i>
                    {{trans('ecommerce::default.actions.image_change')}}
                </a>
                <a style="margin-bottom:20px;" href="#" class="btn  btn-block btn-danger btn-addon delete_button media-delete-item">
                    <i class="fa fa-trash"></i>
                    {{trans('ecommerce::default.actions.image_delete')}}
                </a>
            </div>
            <input type="hidden" name="Media[{{time().'-'.$index.'-'.(isset($type)?$type:'image')}}][image_id]" value="{{isset($image)?$image->id:''}}">
            <input type="hidden" name="Media[{{time().'-'.$index.'-'.(isset($type)?$type:'image')}}][cropped_coords]" value="{{isset($cropped_coords)?$cropped_coords:''}}">
        </div>
    @endforeach
@endif


@if (!isset($ajax) || !$ajax)
    </div>
</div>
@endif
