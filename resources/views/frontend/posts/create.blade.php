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
        <div class="col-md-12">
            <h3 class="form-header">@lang('frontend.post.create.form_header')</h3>
        </div>
        <div class="form-group col-md-12">
            <hr>
        </div>
        <form id="create-post" action="{{route('post.create')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group  col-md-12">
              <label for="type" class="col-md-3 control-label">@lang('frontend.post.create.post_type')</label>
              <div class="col-md-9">
                <select class="form-control" id="type">
                  <option value="{{\Config::get('common.FOR_RENT_VAL')}}">@lang('frontend.post.create.for_rent')</option>
                  <option value="{{\Config::get('common.NEED_RENT_VAL')}}">@lang('frontend.post.create.need_rent')</option>
                </select>
              </div>
            </div>

            <div class="form-group col-md-12">
                <label for="category" class="col-md-3 control-label">@lang('frontend.post.create.category')</label>
                <div class="col-md-9">
                  <select class="form-control" id="category">
                    <option value="1">Nhà đất</option>
                    <option value="0">Xe cộ</option>
                  </select>
                </div>
            </div>

            <div class="form-group col-md-12"><hr></div>

            <div class="form-group  col-md-12">
              <label for="city" class="col-md-3 control-label">@lang('frontend.post.create.city')</label>
              <div class="col-md-9">
                <select class="selectpicker form-control" id="city" data-live-search="true">
                  <option value="1">Hanoi</option>
                  <option value="0">HCM</option>
                  <option value="0">Danang</option>
                </select>
              </div>
            </div>

            <div class="form-group col-md-12">
                <label for="category" class="col-md-3 control-label">@lang('frontend.post.create.category')</label>
                <div class="col-md-9">
                  <input type="text" name="category" id="category" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="phone" class="col-md-3 control-label">@lang('frontend.post.create.phone')</label>
                <div class="col-md-9">
                    <input type="text" name="phone" id="phone" class="form-control" maxlength="15">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="us3-address" class="col-md-3 control-label">@lang('frontend.post.create.address')</label>
                <div class="col-md-9">
                    <input type="text" name="address" class="form-control" id="us3-address" placeholder="@lang('frontend.post.create.add_eg')">
                    <div class="hidden">
                        Radius: <input type="text" name="radius" id="us3-radius"/>
                        <br>
                        Lat.: <input type="text" name="lat" id="us3-lat"/>
                        Long.: <input type="text" name="lng" id="us3-lon"/>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="us3" class="col-md-12 control-label">@lang('frontend.post.create.pick_location')</label>
                <div class="col-md-12">
                    <div class="form-control" id="us3" style="width: 100%; height: 400px;"></div>
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
                <label for="photo" class="col-md-3 control-label">@lang('frontend.post.create.photo')</label>
                <div class="col-md-9">
                  <label class="btn btn-primary btn-file" for="photo">
                    @lang('frontend.post.create.browse') <input type="file" id="photo" multiple style="display: none;">
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
                    <input type="text" name="start_time" class="form-control">
                </div>
                <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
                <div class="col-md-4">
                    <input type="text" name="end_time" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="col-md-3 control-label">@lang('frontend.post.create.days')</label>
                <div class="col-md-9">
                  <table width="100%">
                     <tr>
                         <td>
                             <input type="checkbox" name="mon"> @lang('frontend.post.create.mon')
                         </td>
                         <td>
                             <input type="checkbox" name="mon"> @lang('frontend.post.create.tue')
                         </td>
                         <td>
                             <input type="checkbox" name="mon"> @lang('frontend.post.create.wed')
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <input type="checkbox" name="mon"> @lang('frontend.post.create.thur')
                         </td>
                         <td>
                             <input type="checkbox" name="mon"> @lang('frontend.post.create.fri')
                         </td>
                         <td>
                             <input type="checkbox" name="mon"> @lang('frontend.post.create.sat')
                         </td>
                         <td>
                             <input type="checkbox" name="mon"> @lang('frontend.post.create.sun')
                         </td>
                     </tr>
                  </table>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="col-md-3 control-label">@lang('frontend.post.create.start_date')</label>
                <div class="col-md-4">
                    <input type="text" name="time_begin" id="time-begin" class="form-control">
                </div>
                <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
                <div class="col-md-4">
                    <input type="text" name="time_end"  class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="content" class="col-md-12 control-label">@lang('frontend.post.create.content')</label>
                <div class="col-md-12">
                  <textarea name="content" id="content" rows="10" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group col-md-12 text-center">
                <button type="button" class="btn btn-primary">@lang('frontend.post.create.submit')</button>
            </div>
        </form>
    </div> <!--/Form create post-->

    <!--Tips-->
    <div class="col-sm-3 text-center">

    </div> <!--/Tips-->
@endsection

@push('scripts')
    <script>
        var lang = {!! json_encode(trans('frontend')) !!};
    </script>
    <script src="/js/libs/locationpicker.jquery.js"></script>
    <script src="/bower_resources/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="/bower_resources/tinymce/tinymce.min.js"></script>


    <script>
        $(document).ready(function(){
            /*
            $('#us3').locationpicker({
                location: {latitude: 16.068454, longitude: 108.15572199999997},
                radius: 100,
                inputBinding: {
                	latitudeInput: $('#us3-lat'),
                	longitudeInput: $('#us3-lon'),
                	radiusInput: $('#us3-radius'),
                	locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function(currentLocation, radius, isMarkerDropped) {
                	// alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            }); */
            // Innital component

            $('#us3').locationpicker({
                radius: 100,
                inputBinding: {
                	latitudeInput: $('#us3-lat'),
                	longitudeInput: $('#us3-lon'),
                	radiusInput: $('#us3-radius'),
                	locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function(currentLocation, radius, isMarkerDropped) {
                	// alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });

            var defaultPos = {
                latitude: 21.0227731,
                longitude: 105.8018581,
            }

            // Get current location. Try HTML5 geolocation.
            if (navigator.geolocation){
                navigator.geolocation.getCurrentPosition(function(position){
                    defaultPos = {
                      latitude: position.coords.latitude,
                      longitude: position.coords.longitude
                    };
                });
            } else {
                alert(lang.post.create.unsupport_geolocation);
            }
            $('#us3').locationpicker('location', defaultPos);

        });
    </script>

    <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA5WpyjImkemkAiHkeZQYqHEc5ybF0uIIg&libraries=places"></script>

    {{-- Tinymce --}}
    <script>
        tinymce.init({
            selector:'#content'
        });
    </script>
    {{-- /Tinymce --}}

    // Process before uploading images
    <script>
    $(document).ready(function() {
        var toggle_img = $('.toggle-img');
        var image_holder = $("#image-holder");
        var toggle_btn = $('#toggle-btn');
        $("#photo").on('change', function() {
            //Get count of selected files
            var countFiles = $(this)[0].files.length;

            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            image_holder.empty();

            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                if (typeof(FileReader) != "undefined") {

                    //loop for each file selected for uploaded.
                    for (var i = 0; i < countFiles; i++) {

                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("<img />", {
                                "src": e.target.result,
                                "class": "thumb-image",
                                "style": "width:136px; padding: 10px 10px 0px 0px;",
                            }).appendTo(image_holder);
                        }

                        image_holder.show();
                        reader.readAsDataURL($(this)[0].files[i]);
                        // show the toggle button.
                        toggle_img.show();
                    }
                } else {
                    alert("This browser does not support FileReader.");
                    toggle_img.hide();
                }
            } else {
                alert("Pls select only images");
                toggle_img.hide();
            }
        });
        // toggle button
        toggle_img.click(function(){
            image_holder.toggle();
            $("i",this).toggleClass("fa-angle-double-down fa-angle-double-up");
        });
    });
    </script>

    {{-- <script>
        $(document).ready(function(){
            var optionValue = 1;
            $('#select-type').change(function(){
                optionValue = $(this).val();
                if (optionValue) {
                    $('.elements').load('');
                }
            });
        });
    </script> --}}


@endpush

@push('style-sheets')
    <link rel="stylesheet" href="/bower_resources/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/css/frontend/main.css">
@endpush
