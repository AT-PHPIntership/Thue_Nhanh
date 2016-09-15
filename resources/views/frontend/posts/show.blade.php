@extends('frontend.layouts.master')

@section('page-title')
{{$post->title}} |
@endsection

@section('main-content')
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="col-md-12 well" >
                <h4>@lang('frontend.post.show.contact')</h4>
                <table id="contact-tb">
                    <tr>
                        <td>@lang('frontend.post.show.name')</td>
                        <td><strong>{{$post->user->name}}</strong></td>
                    </tr>
                    <tr>
                        <td>@lang('frontend.post.show.phone')</td>
                        <td><strong>{{$post->phone_number}}</strong></td>
                    </tr>
                    <tr>
                        <td>@lang('frontend.post.show.city')</td>
                        <td><strong>{{$post->city->name}}</strong></td>
                    </tr>
                </table>
                <hr>
                <h4>@lang('frontend.post.show.address')</h4>
                <p id="contact-tb">
                    {{$post->address}}
                </p>
            </div>
            <div id="small-map"></div>
            <p class="navigator-text">
                <a href="https://maps.google.com?saddr=Current+Location&daddr={{$post->lat}},{{$post->lng}}"
                   target="blank">@lang('frontend.post.show.direction')</a>
            </p>
        </div>
        <!-- Post content -->
        <div class="col-md-9">
            <div class="thumbnail post-wrapper">
                <!-- Slide show -->
                <div id="postCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#postCarousel" data-slide-to="0" class="active"></li>
                      @for($i=1; $i < count($photos); $i++)
                        <li data-target="#postCarousel" data-slide-to="{{$i}}"></li>
                      @endfor
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <div class="item active">
                        <img src="{{url(\Config::get('common.POST_PHOTOS_PATH') . $photos->first()->file_name)}}" alt="{{$photos->first()->file_name}}">
                      </div>
                      @for($i=1; $i < count($photos); $i++)
                      <div class="item">
                        <img src="{{url(\Config::get('common.POST_PHOTOS_PATH').$photos[$i]->file_name)}}" alt="{{$photos[$i]->file_name}}">
                      </div>
                      @endfor
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#postCarousel" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">@lang('frontend.post.show.previous')</span>
                    </a>
                    <a class="right carousel-control" href="#postCarousel" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">@lang('frontend.post.show.next')</span>
                    </a>
                  </div>
                <!-- /Slide show -->
                <div class="caption-full">
                    <h4 class="pull-right">{!! number_format($post->cost).trans('frontend.post.show.currency') !!}</h4>
                    <h4><a href="#">{{$post->title}}</a>
                    </h4>
                    <div class="detail">
                        <span class="detail-item">
                            <form id="vote-form" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                @if($isVote)
                                    <i class="fa fa-heart text-primary" id="btn-vote"></i>
                                @else
                                    <i class="fa fa-heart" id="btn-vote"></i>
                                @endif
                                {!!count($votes)!!}
                            </form>
                        </span>
                        <span class="detail-item">
                            <a href="#comments" class="no-underline"><i class="fa fa-comments"></i> <span id="count-cmts">{!!$countComments!!}</span> @lang('frontend.post.show.comments')</a>
                        </span>
                        <span class="detail-item">
                            <a href="#" class="no-underline" data-toggle="modal" data-target="#model-report"><i class="fa fa-warning"></i> @lang('frontend.post.show.report')</a>
                        </span>
                        <span class="pull-right">
                            {!! App\Services\PostServices::parseHumansTime($post->created_at) !!}
                        </span>

                    </div>
                    <hr class="header-rule">
                    <div class="post-content">{!! $post->content !!}</div>
                    <hr>
                    <div class="post-options text-right">
                        <p>
                            @if($post->reviewed_by)
                            <span class="text-success">
                              <i class="fa fa-check-circle"></i> @lang('frontend.post.show.reviewer')
                              <a href="#">{{$post->reviewer->name}}</a>
                            @else
                            <span class="text-danger">
                              <i class="fa fa-times-circle"></i> @lang('frontend.post.show.reviewer')
                              <a href="{{route('post.edit', ['id' => $post->id])}}">@lang('frontend.post.show.no_reviewer')</a>
                            @endif
                            </span>
                              @if($isMod || $isAdmin || $isWebmaster)
                                <a href="{{route('post.edit', ['id' => $post->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> @lang('frontend.post.show.btn_edit')</a>
                              @endif
                              @if($isAuthor || $isMod || $isAdmin || $isWebmaster)
                                <a href="{{route('post.destroy', ['id' => $post->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('frontend.post.show.btn_del')</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div id="comments">
                @if(Auth::user())
                    <!-- Comment textarea -->
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="thumbnail">
                                <img class="img-responsive user-photo" src="{!! url(\Config::get('common.AVATAR_PATH') . Auth::user()->avatar) !!}">
                            </div>
                            <!-- /thumbnail -->
                        </div>
                        <!-- /col-sm-1 -->

                        <div class="col-md-11">
                            <div class="widget-area no-padding blank">
                                <div class="status-upload">
                                    <form method="post" id="comment-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{Auth::user() ? Auth::user()->id : ''}}">
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <textarea name="content" placeholder="@lang('frontend.post.show.comment_placeholder')" id="comment-text"></textarea>
                                        <button type="submit" class="btn btn-default btn-comment"><i class="fa fa-comment"></i> @lang('frontend.post.show.comments')</button>
                                    </form>
                                </div><!-- Status Upload  -->
                            </div><!-- Widget Area -->
                        </div>
                    </div>
                    <!-- /Comment textarea -->
                    <hr>
                @else
                    <h4 class="login-text">
                        <a href="{{url('/login')}}">@lang('frontend.post.show.login')</a>
                        @lang('frontend.post.show.to_comment')
                    </h4>
                @endif
                @if(count($comments))
                    @foreach($comments as $comment)
                        <div class="row row_{{$comment->id}}">
                            <div class="col-sm-1">
                                <div class="thumbnail">
                                    <img class="img-responsive user-photo" src="{!! url(\Config::get('common.AVATAR_PATH') . $comment->user->avatar) !!}">
                                </div>
                                <!-- /thumbnail -->
                            </div>
                            <!-- /col-sm-1 -->
                            <div class="col-sm-11">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>{!!$comment->user->name!!}</strong>
                                        <small class="pull-right">
                                            <span>{!! App\Services\PostServices::parseHumansTime($comment->created_at) !!}</span>&nbsp;
                                            @if((Auth::user() && $comment->user->id == Auth::user()->id) || $isMod || $isAdmin || $isWebmaster)
                                              <form class="del-cmt-form" method="post">
                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                              </form>
                                            @endif
                                            {{-- <span class="btn btn-danger btn-xs"><a href="#" class="no-underline"><i class="fa fa-trash"></i></a></span> --}}
                                        </small>

                                    </div>
                                    <div class="panel-body">{{$comment->content}}</div>
                                    <!-- /panel-body -->
                                </div>
                                <!-- /panel panel-default -->
                            </div>
                            <!-- /col-sm-11 -->
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-sm-12 text-right">
                        {!! $comments->setPath(Request::url())->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div> <!-- /Post content -->
    </div>
</div> <!-- /Page content -->

<!--Report modal-->
<div class="modal fade" id="model-report" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">@lang('frontend.post.show.report_this_post')</h4>
        </div>
        @if(Auth::user())
        <form method="post" id="report-form">
            <div class="modal-body">
                {{ csrf_field() }}
                <textarea name="description" placeholder="@lang('frontend.post.show.report_placeholder')" id="report-description" required maxlength="255"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-submit-report btn btn-primary">@lang('frontend.post.show.btn_submit_report')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('frontend.post.show.btn_close')</button>
            </div>
        </form>
        @else
            <div class="modal-body">
                <p>@lang('frontend.post.show.remind_login')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('frontend.post.show.btn_close')</button>
            </div>
        @endif
      </div>

    </div>
</div>
<!--/Report modal-->

@endsection

@push('style-sheets')
<link rel="stylesheet" href="{{asset('/css/frontend/main.css')}}">
@endpush

@push('scripts')
<!-- LocationPicker -->
<script src="{{asset('/bower_resources/jquery-locationpicker-plugin/dist/locationpicker.jquery.min.js')}}"></script>

<!-- GoogleMap API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5WpyjImkemkAiHkeZQYqHEc5ybF0uIIg&libraries=places"></script>

<!-- Autosize -->
<script src="{{asset('/bower_resources/autosize/dist/autosize.min.js')}}"></script>

<script>
    var lang = {!! json_encode(trans('frontend')) !!};

    autosize($('textarea'));

    $(document).ready(function() {
        var radius = 500;
        var zoom = 14;
        $('#small-map').locationpicker({
            location: {
                latitude: {{$post->lat}},
                longitude: {{$post->lng}}
            },
            radius: radius,
            zoom: zoom
        });
    });
</script>
<script src="{{asset('/js/frontend/comment/main.js')}}"></script>
<script src="{{asset('/js/frontend/votes/main.js')}}"></script>
<script src="{{asset('/js/frontend/reports/main.js')}}"></script>
<script>
    var url = "{{route('comment.store')}}";
    var voteURL = "{{route('vote.create')}}";
    var delCmtURL = "{{route('comment.destroy')}}";
    var reportURL = "{{route('report.store')}}";
    submitComment(url);
    submitReport(reportURL);
    clickVote(voteURL);
    submitDelCmt(delCmtURL);
</script>
@endpush
