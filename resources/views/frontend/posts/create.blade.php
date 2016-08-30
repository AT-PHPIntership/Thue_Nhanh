@extends('frontend.layouts.master')

@section('page-title')
    @lang('frontend.post.create.title') |
@endsection

@section('main-content')
    <!--Ads section-->
    <div class="col-sm-2 text-center">

    </div> <!--/Ads section-->

    <!--Form create post-->
    <div class="col-sm-7 well">
        <div class="col-md-12">
            <h3 class="form-header">@lang('frontend.post.create.form_header')</h3>
        </div>
        <div class="form-group col-md-12">
            <hr>
        </div>
        <form id="create-post" action="{{route('post.create')}}" method="post">
            {{ csrf_field() }}

            <div class="form-group  col-md-12">
              <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.post_type')</label>
              <div class="col-md-9">
                <select class="form-control" id="select-type">
                  <option value="1">@lang('frontend.post.create.for_rent')</option>
                  <option value="0">@lang('frontend.post.create.need_rent')</option>
                </select>
              </div>
            </div>

            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.category')</label>
                <div class="col-md-9">
                  <select class="form-control">
                    <option value="1">Nhà đất</option>
                    <option value="0">Xe cộ</option>
                  </select>
                </div>
            </div>

            <div class="form-group col-md-12"><hr></div>

            <div class="form-group  col-md-12">
              <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.city')</label>
              <div class="col-md-9">
                <select class="form-control" id="select-type">
                  <option value="1">@lang('frontend.post.create.for_rent')</option>
                  <option value="0">@lang('frontend.post.create.need_rent')</option>
                </select>
              </div>
            </div>

            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.category')</label>
                <div class="col-md-9">
                  <input type="text" name="address" id="address" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="select" class="col-md-12 control-label">@lang('frontend.post.create.pick_location')</label>
                <div class="col-md-12">
                    <div class="form-control" id="address" width="100%"></div>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.phone')</label>
                <div class="col-md-9">
                    <input type="text" name="phone" class="form-control" maxlength="15">
                </div>
            </div>

            <div class="form-group col-md-12"><hr></div>

            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.topic')</label>
                <div class="col-md-9">
                  <input type="text" name="address" id="address" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.cost')</label>
                <div class="col-md-9">
                  <input type="text" name="address" id="address" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.photo')</label>
                <div class="col-md-9">
                  {{-- <input type="file" name="address" id="address"> --}}
                  <label class="btn btn-primary btn-file">
                    @lang('frontend.post.create.browse') <input type="file" style="display: none;">
                  </label>
                  <div class="photos">

                  </div>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.time')</label>
                <div class="col-md-4">
                    <input type="text" name="start_time" class="form-control">
                </div>
                <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
                <div class="col-md-4">
                    <input type="text" name="end_time" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.days')</label>
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
                         <td>
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
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.start_date')</label>
                <div class="col-md-4">
                    <input type="text" name="start_time" class="form-control">
                </div>
                <label for="" class="col-md-1 control-label">@lang('frontend.post.create.to')</label>
                <div class="col-md-4">
                    <input type="text" name="end_time" class="form-control">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="select" class="col-md-3 control-label">@lang('frontend.post.create.content')</label>
                <div class="col-md-9">
                  <textarea name="address" id="address" class="form-control"></textarea>
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
    <script>
        $(document).ready(function(){
            var optionValue = 1;
            $('#select-type').change(function(){
                optionValue = $(this).val();
                if (optionValue) {
                    $('.elements').load('');
                }
            });
        });
    </script>
@endpush
