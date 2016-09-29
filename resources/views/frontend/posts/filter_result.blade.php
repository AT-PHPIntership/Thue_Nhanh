@extends('frontend.layouts.master')

@section('page-title')
@lang('frontend.post.index.home') |
@endsection

@section('main-content')
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-sm-3 well text-center">
        </div>
        <div class="col-sm-7">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default text-left">
                <div class="panel-body filter-result">
                  <form action="{{route('post.filter')}}" method="get">
                    <div class="col-md-6 col-sm-12 col-xs-12 filter-item">
                      <input type="text" class="form-control" name="keyword" placeholder="@lang('frontend.post.index.search_holder')">
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 filter-item">
                      <select class="form-control" id="category" name="category">
                        <option value="{{\Config::get('common.DISTANCE_INF')}}">@lang('frontend.post.index.radius')</option>
                        <option value="{{\Config::get('common.DISTANCE_1')}}">1km</option>
                        <option value="{{\Config::get('common.DISTANCE_3')}}">3km</option>
                        <option value="{{\Config::get('common.DISTANCE_5')}}">5km</option>
                        <option value="{{\Config::get('common.DISTANCE_10')}}">10km</option>
                      </select>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 filter-item">
                      <button type="submit" class="btn btn-default btn-filter">
                        <i class="fa fa-search"></i> @lang('frontend.post.index.btn_search')
                      </button>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12 filter-item">
                      <select class="form-control" id="category" name="category">
                        <option value="{{\Config::get('common.CATEGORY_DEFAULT')}}">
                          @lang('frontend.post.index.category_default')
                        </option>
                        @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 filter-item">
                      <select class="form-control" id="city" name="city">
                        <option value="{{\Config::get('common.CITY_DEFAULT')}}">@lang('frontend.post.index.city_default')</option>
                        @foreach($cities as $city)
                          <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 filter-item">
                      <select class="form-control" id="type" name="type">
                        <option value="{{\Config::get('common.TYPE_DEFAULT')}}">@lang('frontend.post.index.type')</option>
                        <option value="{{\Config::get('common.FOR_RENT_VAL')}}">@lang('frontend.post.index.for_rent')</option>
                        <option value="{{\Config::get('common.NEED_RENT_VAL')}}">@lang('frontend.post.index.need_rent')</option>
                      </select>
                    </div>
                    <input type="hidden" id="currLat" name="lat" value="">
                    <input type="hidden" id="currLng" name="lng" value="">
                  </form>
                </div>
              </div>
            </div>
          </div>

            <ul class="nav nav-tabs nav-tab-padding">
              <li class="forRent-nav"><a href="#forRent" data-toggle="tab" aria-expanded="false">@lang('frontend.post.index.for_rent')</a></li>
              <li class="needRent-nav"><a href="#needRent" data-toggle="tab" aria-expanded="true">@lang('frontend.post.index.need_rent')</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in" id="forRent">
              @foreach($forRentPosts as $index => $post)
                  <div class="row">
                    <div class="col-sm-3 post-thumbnail-outer">
                      <div class="post-thumbnail well">
                        <a href="{{route('post.read', ['category' => $post->category->slug, 'post' => $post->slug])}}" class="no-link-color">
                          <img src="{{url(\Config::get('common.POST_PHOTOS_PATH').$post->photos->first()->file_name)}}" class="post-small-thumb">
                        </a>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <div class="well">
                        <div class="group-title">
                          <div class="label-title">
                            <a href="{{route('post.read', ['category' => $post->category->slug, 'post' => $post->slug])}}" class="no-link-color">
                              <h4>{{$post->title}}</h4>
                            </a>
                          </div>
                          <div class="label-time">
                            <p>{!! App\Services\PostServices::parseHumansTime($post->created_at) !!}</p>
                          </div>
                        </div>
                        <div class="label-price">
                          <p>{{$post->cost}}@lang('frontend.post.index.unit')</p>
                        </div>
                        <div class="group-footer">
                            <div class="label-location">
                              <p>@lang('frontend.post.index.category') {{$post->category->name}} - {{$post->city->name}}</p>
                            </div>
                            <div class="label-views">
                              <p>
                                <i class="fa fa-heart"></i>
                                {!!count($post->votes)!!}
                              </p>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach
                  <!-- Pagination -->
                  <div class="row text-right pagination-row">
                  @if (isset(request()->can_thue))
                    {{ $forRentPosts->appends(['can_thue' => request()->can_thue])->links() }}
                  @else
                    {{ $forRentPosts->links() }}
                  @endif
                  </div> <!-- /Pagination -->
              </div>

              <div class="tab-pane fade" id="needRent">
              @foreach($needRentPosts as $needRentPost)
                  <div class="row">
                    <div class="col-sm-3 post-thumbnail-outer">
                      <div class="post-thumbnail well">
                        <a href="{{route('post.read', ['category' => $post->category->slug, 'post' => $post->slug])}}" class="no-link-color">
                          <img src="{{url(\Config::get('common.POST_PHOTOS_PATH').$needRentPost->photos->first()->file_name)}}" class="post-small-thumb">
                        </a>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <div class="well">
                        <div class="group-title">
                          <div class="label-title">
                            <a href="{{route('post.read', ['category' => $post->category->slug, 'post' => $post->slug])}}" class="no-link-color">
                              <h4>{{$needRentPost->title}}</h4>
                            </a>
                          </div>
                          <div class="label-time">
                            <p>{!! App\Services\PostServices::parseHumansTime($needRentPost->created_at) !!}</p>
                          </div>
                        </div>
                        <div class="label-price">
                          <p>{{$needRentPost->cost}}@lang('frontend.post.index.unit')</p>
                        </div>
                        <div class="group-footer">
                          <div class="label-location">
                            <p>@lang('frontend.post.index.category') {{$needRentPost->category->name}} - {{$needRentPost->city->name}}</p>
                          </div>
                          <div class="label-views">
                            <p>
                              <i class="fa fa-heart"></i>
                              {!!count($needRentPost->votes)!!}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach
                  <!-- Pagination -->
                  <div class="row text-right pagination-row">
                  @if (isset(request()->cho_thue))
                    {{ $needRentPosts->appends(['cho_thue' => request()->cho_thue])->links() }}
                  @else
                    {{ $needRentPosts->links() }}
                  @endif
                  </div> <!-- /Pagination -->
              </div>
            </div>
        </div>
        <div class="col-sm-2 well text-center">
        </div>
    </div>
</div>

@if($needRentPosts->currentPage() != session()->get('needRent.currentPage'))
    {!! session()->flash('currentTab', \Config::get('common.NEED_RENT_VAL')); !!}
    {!! session()->put('needRent', ['currentPage' => $needRentPosts->currentPage()]) !!}
@elseif($forRentPosts->currentPage() != session()->get('forRent.currentPage'))
    {!! session()->flash('currentTab', \Config::get('common.FOR_RENT_VAL')); !!}
    {!! session()->put('forRent', ['currentPage' => $forRentPosts->currentPage()]) !!}
@endif

@if(!session()->has('currentTab'))
    {!! session()->put('currentTab', \Config::get('common.FOR_RENT_VAL')); !!}
@endif

@endsection

@push('style-sheets')
<link rel="stylesheet" href="/css/frontend/main.css">
@endpush

@push('scripts')
  <!--Custom scripts-->
  <script src="{{asset('/js/frontend/post/main.js')}}"></script>
  <!-- GoogleMap API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5WpyjImkemkAiHkeZQYqHEc5ybF0uIIg&libraries=places"></script>
<script>
    $(document).ready(function(){
        var currentTab = {{ session()->get('currentTab') }};
        setActiveTab(currentTab);
    });
    getCurrentPos();
</script>
@endpush
