@extends('backend.layouts.master')

@section('page-title')
  @lang('backend.posts.waitcensor.title') |
@endsection

@section('content-header')
  @lang('backend.posts.waitcensor.title')
@endsection

@section('content')
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
          <a href="#"><i class="fa fa-pencil-square"></i></a>
          <a href="#"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
<!-- /.box-body -->
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
  <script>
    $(function () {
      $("#tb-waitcensor").DataTable({
        "order": [[ 5, "desc" ]]
      });
    });
  </script>
@endpush
