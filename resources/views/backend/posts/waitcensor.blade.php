@extends('backend.layouts.master')

@section('page-title')
  @lang('backend.posts.waitcensor.title') |
@endsection

@section('content-header')
  @lang('backend.posts.waitcensor.title')
@endsection

@section('content')
@include('messages')
<!-- /.box-header -->
<div class="box-body">
  <table id="tb-waitcensor" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">@lang('backend.posts.waitcensor.field_title')</th>
      <th class="text-center">@lang('backend.posts.waitcensor.field_user')</th>
      <th class="text-center">@lang('backend.posts.waitcensor.field_category')</th>
      <th class="text-center">@lang('backend.posts.waitcensor.field_city')</th>
      <th class="text-center">@lang('backend.posts.waitcensor.field_time')</th>
      <th class="text-center">@lang('backend.posts.waitcensor.field_options')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $index => $post)
      <tr>
        <td>{{++$index}}</td>
        <td>
          <a href="{{route('post.read', ['category' => $post->category->slug, 'post' => $post->slug])}}" class="no-link-color">
            <strong>{{title_case($post->title)}}</strong>
          </a>
        </td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->category->name}}</td>
        <td>{{$post->city->name}}</td>
        <td class="text-right">
          {{Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $post->created_at)->format("H:i:s d/m/Y")}}
        </td>
        <td class="text-center">
          <a href="{{route('post.edit', ['id' => $post->id])}}"><i class="fa fa-pencil-square"></i></a>
          <a href="#" class="btn-del" data-toggle="modal" data-target="#del-modal"><i class="fa fa-trash"></i></a>
          <input type="hidden" name="post_id" value="{{$post->id}}">
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
<!-- /.box-body -->

<!-- Deleting confirmation modal -->
<div class="modal fade" id="del-modal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('backend.posts.waitcensor.del_confirm')</h4>
      </div>
      <div class="modal-body">
        <p>
          @lang('backend.posts.waitcensor.del_msg')
        </p>
      </div>
      <div class="modal-footer">
        <form id="delete-form" action="" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" id="del-post-id" name="id" value="">
          <button type="submit" class="btn btn-warning">@lang('backend.posts.waitcensor.btn_yes')</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang('backend.posts.waitcensor.btn_cancel')</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.Deleting confirmation modal -->
@endsection

@push('style-sheets')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/bower_resources/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">
@endpush

@push('scripts')
  <!-- DataTables -->
  <script src="{{asset('/bower_resources/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('/bower_resources/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- page script -->
  <script src="{{asset('/js/frontend/post/main.js')}}"></script>
  <script>
    $(function () {
      $("#tb-waitcensor").DataTable({
        "order": [[ 5, "desc" ]]
      });
    });

    var delPostURL = "{{route('post.destroy')}}";
    setFormAction(delPostURL);
    // $(document).ready(function() {
    //   $(document).on('click', ".btn-del", function() {
    //     var postID = $(this).next().val();
    //     var formAction = "{{route('post.destroy')}}";
    //     $('#del-post-id').val(postID);
    //     $('#delete-form').attr('action', formAction + '/' + postID);
    //   });
    // });
  </script>
@endpush
