@extends('frontend.layouts.master')

@section('page-title')
{!! title_case($post->title) !!} |
@endsection

@section('main-content')
<!--Ads section-->
<div class="col-sm-2 text-center">

</div> <!--/Ads section-->
<!--Form create post-->
<div class="col-sm-7">
  @include('frontend.common.errors')
  <div class="col-md-12">
    <h3 class="form-header">@lang('frontend.post.edit.title')</h3>
  </div>
  <div class="form-group col-md-12">
    <hr>
  </div>
  <form id="update-post" action="{{route('post.update', ['post' => $post->id])}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group col-md-12">
      <label for="type" class="col-md-3 control-label">@lang('frontend.post.create.post_type')</label>
      <div class="col-md-9">
        <select class="form-control" name="type" id="type">
          <option value="{{$post->type}}">{!! $post->type  == \Config::get('common.FOR_RENT_VAL') ? trans('frontend.post.create.for_rent') : trans('frontend.post.create.need_rent') !!}</option>
        </select>
      </div>
    </div>

    <div class="form-group col-md-12">
      <label for="category" class="col-md-3 control-label">@lang('frontend.post.create.category')</label>
      <div class="col-md-9">
        <select class="form-control" id="category" name="category_id">
        @foreach($categories as $category)
          @if($post->category->id == $category->id)
            <option value="{{$category->id}}" selected>{{$category->name}}</option>
          @else
            <option value="{{$category->id}}">{{$category->name}}</option>
          @endif
        @endforeach
        </select>
      </div>
    </div>
    <div class="form-group col-md-12"><hr></div>
    <div class="form-group col-md-12">
      <label for="name" class="col-md-3 control-label">@lang('frontend.post.create.name')</label>
      <div class="col-md-9">
        <input type="text" name="name" id="name" class="form-control" readonly required value="{{$post->user->name}}">
      </div>
    </div>
    <div class="form-group col-md-12">
      <label for="phone" class="col-md-3 control-label">@lang('frontend.post.create.phone')</label>
      <div class="col-md-9">
        <input type="text" name="phone_number" id="phone" class="form-control" required maxlength="15" value="{{$post->phone_number}}">
      </div>
    </div>
    <div class="form-group  col-md-12">
      <label for="city" class="col-md-3 control-label">@lang('frontend.post.create.city')</label>
      <div class="col-md-9">
        <select class="selectpicker form-control" id="city" name="city_id" required data-live-search="true">
          @foreach($cities as $city)
            @if($post->city->id == $city->id)
              <option value="{{$city->id}}" selected>{{$city->name}}</option>
            @else
              <option value="{{$city->id}}">{{$city->name}}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label for="location-address" class="col-md-3 control-label">@lang('frontend.post.create.address')</label>
      <div class="col-md-9">
        <input type="text" name="address" class="form-control" id="location-address" required
               placeholder="@lang('frontend.post.create.add_eg')"
               value="{{$post->address}}"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_add')">
        <div class="hidden">
          <input type="text" name="radius" id="location-radius"/>
          <br>
          <input type="text" name="lat" id="location-lat" value="{{$post->lat}}"/>
          <input type="text" name="lng" id="location-lon" value="{{$post->lng}}"/>
        </div>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label for="location" class="col-md-12 control-label toggle-map">@lang('frontend.post.create.pick_location') <strong>&nbsp;<i class="fa fa-caret-up"></i></strong></label>
      <div class="col-md-12 map_holder">
        <div class="form-control" id="map"></div>
      </div>
    </div>
    <div class="form-group col-md-12"><hr></div>
    <div class="form-group col-md-12">
      <label for="title" class="col-md-3 control-label">@lang('frontend.post.create.topic')</label>
      <div class="col-md-9">
        <input type="text" name="title" id="title" required class="form-control" value="{{$post->title}}">
      </div>
    </div>
    <div class="form-group col-md-12">
      <label for="cost" class="col-md-3 control-label">@lang('frontend.post.create.cost')</label>
      <div class="col-md-9">
        <input type="text" name="cost" id="cost" required class="form-control"
               value="{{$post->cost}}"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_cost')">
      </div>
    </div>

{{--
    <div class="form-group col-md-12">
      <label for="photos" class="col-md-3 control-label">@lang('frontend.post.create.photo')</label>
      <div class="col-md-9">
        <label class="btn btn-primary btn-file" for="photos"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_cost')">
          @lang('frontend.post.create.browse')
          <input type="file" name="photos[]" id="photos" multiple>
        </label>
        <div class="toggle-img">
            <i id="toggle-btn" class="fa fa-angle-double-up pull-right btn btn-xs btn-primary"></i>
        </div>
        <div id="image-holder">
        </div>
      </div>
    </div>
--}}
    <div class="form-group col-md-12">
      <label class="col-md-3 control-label">@lang('frontend.post.create.time')</label>
      <div class="col-md-4">
        <input type="time" name="time_begin" class="form-control" required
               value="{{$post->time_begin}}"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_time_begin')">
      </div>
      <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
      <div class="col-md-4">
        <input type="time" name="time_end" class="form-control" required
               value="{{$post->time_end}}"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_time_end')">
      </div>
    </div>
    <div class="form-group col-md-12">
      <label class="col-md-3 control-label">@lang('frontend.post.create.days')</label>
      <div class="col-md-9">
        <table class="btn-file" id="table-checkbox"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_week_days')">
          <tr>
          @foreach($post['chosenDays'] as $index => $date)
            <td><input type="checkbox" name="{{$date->date}}" {{$date->chosen ? 'checked' : null}}>{!! trans('frontend.post.create.' . $date->date) !!}</td>
            @if($index == 2)
          </tr>
          <tr>
            @endif
          @endforeach
          </tr>
        </table>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label class="col-md-3 control-label">@lang('frontend.post.create.start_date')</label>
      <div class="col-md-4">
        <input type="date" name="start_date" class="form-control" required
               value="{{$post->start_date}}"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_start_date')">
      </div>
      <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
      <div class="col-md-4">
        <input type="date" name="end_date" class="form-control"
               value="{{$post->end_date}}"
               data-toggle="tooltip" data-placement="bottom"
               title="@lang('frontend.post.create.title_end_date')">
      </div>
    </div>
    <div class="form-group col-md-12">
      <label for="content" class="col-md-12 control-label">@lang('frontend.post.create.content')</label>
      <div class="col-md-12">
        <textarea name="content" id="content" rows="10" class="form-control">{{$post->content}}</textarea>
      </div>
    </div>
    <div class="form-group col-md-12"><hr></div>
    <div class="form-group col-md-12">
      <label for="content" class="col-md-3 control-label">@lang('frontend.post.edit.review_status')</label>
      <label class="col-md-3">
        <input type="radio" name="accept" value="{{\Config::get('common.POST_ACCEPT')}}" checked>
        @lang('frontend.post.edit.accept')
      </label>
      <label class="col-md-6">
        <input type="radio" name="deny" value="{{\Config::get('common.POST_DENY')}}">
        @lang('frontend.post.edit.deny')
      </label>
    </div>
    <div class="form-group col-md-12"><hr></div>
    <div class="form-group col-md-12 text-center">
      <button type="submit" class="btn btn-primary">@lang('frontend.post.edit.submit')</button>
    </div>
  </form>
</div> <!--/Form create post-->

<!--Tips-->
<div class="col-sm-3 text-center">

</div> <!--/Tips-->
@endsection

@push('scripts')
<!-- language translated messages -->
<script>
    var lang = {!! json_encode(trans('frontend')) !!};
</script>
<!-- LocationPicker -->
<script src="{{asset('/bower_resources/jquery-locationpicker-plugin/dist/locationpicker.jquery.min.js')}}"></script>
<!-- Bootstrap-Select -->
<script src="{{asset('/bower_resources/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<!-- TinyMce -->
<script src="{{asset('/bower_resources/tinymce/tinymce.min.js')}}"></script>

<!--Custom scripts-->
<script src="{{asset('/js/frontend/post/create.js')}}"></script>
<script src="{{asset('/js/frontend/post/main.js')}}"></script>

<!-- GoogleMap API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5WpyjImkemkAiHkeZQYqHEc5ybF0uIIg&libraries=places"></script>
<script>
$(document).ready(function(){
  var location = {
    latitude: {{$post->lat}},
    longitude: {{$post->lng}}
  };
  var radius = 300;
  initMap(location, radius);
});
</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        // Redirect if change post type
        $('#type').change(function() {
            const POST_TYPE_NEED = 0;
            var typeSelected = $(this).val();
            var urlType0 = "{{route('post.need_rent.create')}}";
            if(typeSelected == POST_TYPE_NEED) {
                $(location).attr('href', urlType0);
            }
        });
    });
</script>
@endpush

@push('style-sheets')
<link rel="stylesheet" href="{{asset('/bower_resources/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/frontend/main.css')}}">
@endpush
