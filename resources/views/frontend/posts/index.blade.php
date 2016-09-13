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
<script src="{{asset('/js/frontend/post/main.js')}}"></script>
<script>
    $(document).ready(function(){
        var currentTab = {{ session()->get('currentTab') }};
        setActiveTab(currentTab);
    });
</script>
@endpush
