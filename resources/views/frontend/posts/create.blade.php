@extends('frontend.layouts.master')

@section('page-title')
@lang('frontend.post.create.title') |
@endsection

@section('main-content')
<!--Ads section-->
<div class="col-sm-2 text-center">

</div> <!--/Ads section-->

<!--Form create post-->
<div class="col-sm-7">
    @include('frontend.common.errors')
    <div class="col-md-12">
        <h3 class="form-header">@lang('frontend.post.create.form_header')</h3>
    </div>
    <div class="form-group col-md-12">
        <hr>
    </div>
    <form id="create-post" action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group  col-md-12">
          <label for="type" class="col-md-3 control-label">@lang('frontend.post.create.post_type')</label>
          <div class="col-md-9">
            <select class="form-control" name="type" id="type">
              @foreach($postTypes as $type => $value)
                <option value="{{$type}}">{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group col-md-12">
            <label for="category" class="col-md-3 control-label">@lang('frontend.post.create.category')</label>
            <div class="col-md-9">
              <select class="form-control" id="category" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="form-group col-md-12"><hr></div>
        <div class="form-group col-md-12">
            <label for="name" class="col-md-3 control-label">@lang('frontend.post.create.name')</label>
            <div class="col-md-9">
                <input type="text" name="name" id="name" class="form-control" disabled required value="{{Auth::user()->name}}">
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="phone" class="col-md-3 control-label">@lang('frontend.post.create.phone')</label>
            <div class="col-md-9">
                <input type="text" name="phone_number" id="phone" class="form-control" required maxlength="15" value="{{ null == $currentUser ? '' : $currentUser->phone_number}}">
            </div>
        </div>
        <div class="form-group  col-md-12">
          <label for="city" class="col-md-3 control-label">@lang('frontend.post.create.city')</label>
          <div class="col-md-9">
            <select class="selectpicker form-control" id="city" name="city_id" data-live-search="true">
              @foreach($cities as $city)
                @if(null != $currentUser && $city->id == $currentUser->city_id)
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
                <input type="text" name="address" class="form-control" id="location-address" placeholder="@lang('frontend.post.create.add_eg')" value="{{null == $currentUser ? '' : $currentUser->address}}">
                <div class="hidden">
                    <input type="text" name="radius" id="location-radius"/>
                    <br>
                    <input type="text" name="lat" id="location-lat"/>
                    <input type="text" name="lng" id="location-lon"/>
                </div>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="location" class="col-md-12 control-label">@lang('frontend.post.create.pick_location')</label>
            <div class="col-md-12">
                <div class="form-control" id="location" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
        <div class="form-group col-md-12"><hr></div>
        <div class="form-group col-md-12">
            <label for="title" class="col-md-3 control-label">@lang('frontend.post.create.topic')</label>
            <div class="col-md-9">
              <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="cost" class="col-md-3 control-label">@lang('frontend.post.create.cost')</label>
            <div class="col-md-9">
              <input type="text" name="cost" id="cost" class="form-control">
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="photos" class="col-md-3 control-label">@lang('frontend.post.create.photo')</label>
            <div class="col-md-9">
              <label class="btn btn-primary btn-file" for="photos">
                @lang('frontend.post.create.browse')
                <input type="file" name="photos[]" id="photos" multiple style="display: none;">
              </label>
              <div class="toggle-img">
                  <i id="toggle-btn" class="fa fa-angle-double-up pull-right btn btn-xs btn-primary"></i>
              </div>
              <div id="image-holder">
              </div>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-md-3 control-label">@lang('frontend.post.create.time')</label>
            <div class="col-md-4">
                <input type="time" name="time_begin" class="form-control">
            </div>
            <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
            <div class="col-md-4">
                <input type="time" name="time_end" class="form-control">
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-md-3 control-label">@lang('frontend.post.create.days')</label>
            <div class="col-md-9">
              <table width="100%">
                <tr>
                  <td><input type="checkbox" name="mon"> @lang('frontend.post.create.mon')</td>
                  <td><input type="checkbox" name="tue"> @lang('frontend.post.create.tue')</td>
                  <td><input type="checkbox" name="wed"> @lang('frontend.post.create.wed')</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="thur"> @lang('frontend.post.create.thur')</td>
                  <td><input type="checkbox" name="fri"> @lang('frontend.post.create.fri')</td>
                  <td><input type="checkbox" name="sat"> @lang('frontend.post.create.sat')</td>
                  <td><input type="checkbox" name="sun"> @lang('frontend.post.create.sun')</td>
                </tr>
              </table>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-md-3 control-label">@lang('frontend.post.create.start_date')</label>
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control">
            </div>
            <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="content" class="col-md-12 control-label">@lang('frontend.post.create.content')</label>
            <div class="col-md-12">
              <textarea name="content" id="content" rows="10" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group col-md-12 text-center">
            <button type="submit" class="btn btn-primary">@lang('frontend.post.create.submit')</button>
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
<script src="/js/libs/locationpicker.jquery.js"></script>
<!-- Bootstrap-Select -->
<script src="/bower_resources/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<!-- TinyMce -->
<script src="/bower_resources/tinymce/tinymce.min.js"></script>

<!--Custom scripts-->
<script src="/js/frontend/post/create.js"></script>

<!-- GoogleMap API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5WpyjImkemkAiHkeZQYqHEc5ybF0uIIg&libraries=places"></script>
@endpush

@push('style-sheets')
<link rel="stylesheet" href="/bower_resources/bootstrap-select/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="/css/frontend/main.css">
@endpush
