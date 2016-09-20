@extends('backend.layouts.master')

@section('page-title')
  @lang('backend.users.members.title') |
@endsection

@section('content-header')
  @lang('backend.posts.waitcensor.title')
@endsection

@section('content')
@include('messages')
<!-- /.box-header -->
<div class="box-body">
  <table id="tb-mems" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th class="text-center">@lang('backend.users.members.id')</th>
      <th class="text-center">@lang('backend.users.members.name')</th>
      <th class="text-center">@lang('backend.users.members.email')</th>
      <th class="text-center">@lang('backend.users.members.city')</th>
      <th class="text-center">@lang('backend.users.members.date')</th>
      <th class="text-center">@lang('backend.users.members.options')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
      <tr>
        <td>{{$member->id}}</td>
        <td>
          <strong>{{title_case($member->name)}}</strong>
        </td>
        <td>{{$member->email}}</td>
        <td>{{$member->city}}</td>
        <td class="text-right">
          {{Carbon\Carbon::createFromFormat(\Config::get('common.DATETIME_FORMAT_DB'), $member->created_at)->format(\Config::get('common.DATETIME_FORMAT_HUMAN'))}}
        </td>
        <td class="text-center">
          <a href="#" class="btn-cogs" data-toggle="modal" data-target=".setting-modal"><i class="fa fa-cogs"></i></a>
          <input type="hidden" name="user_id" value="{{$member->id}}">
          @if($member->roles->where('name', 'Mod')->first())
            <input type="hidden" name="mod" value="mod">
          @endif
          @if($member->roles->where('name', 'Admin')->first())
            <input type="hidden" name="admin" value="admin">
          @endif
          <a href="#" class="btn-ban" data-toggle="modal" data-target="#ban-modal"><i class="fa fa-minus-circle"></i></a>
          <input type="hidden" name="user_id" value="{{$member->id}}">
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
<!-- /.box-body -->

<!-- Ban account confirmation modal -->
<div class="modal fade" id="ban-modal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('backend.users.members.ban_confirmation')</h4>
      </div>
      <div class="modal-body">
        <p>
          @lang('backend.users.members.ban_confirm_msg')
        </p>
      </div>
      <div class="modal-footer">
        <form id="ban-form" action="" method="post">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-warning">@lang('backend.users.members.btn_ban')</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang('backend.users.members.btn_close')</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.Ban account confirmation modal -->

<!-- Set permission confirmation modal -->
<div class="modal fade setting-modal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('backend.users.members.config_title')</h4>
      </div>
      <form id="config-form" action="" method="post">
        {{ csrf_field() }}
        <div class="modal-body">
          <dl>
            <dt>
              <label>
                <input type="checkbox" name="mod" class="mod-checkbox"> @lang('backend.users.members.mod')
              </label>
            </dt>
            <dd>- @lang('backend.users.members.d_mod_l1')</dd>
            <dd>- @lang('backend.users.members.d_mod_l2')</dd>
            <dd>- @lang('backend.users.members.d_mod_l3')</dd>
            <dt>
              <label>
                <input type="checkbox" name="admin" class="admin-checkbox"> @lang('backend.users.members.admin')
              </label>
            </dt>
            <dd>- @lang('backend.users.members.d_admin_l1')</dd>
            <dd>- @lang('backend.users.members.d_admin_l2')</dd>
            <dd>- @lang('backend.users.members.d_admin_l3')</dd>
          </dl>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning">@lang('backend.users.members.btn_set')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('backend.users.members.btn_close')</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.Set permission confirmation modal -->

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
  <script src="{{asset('/js/backend/users/main.js')}}"></script>
  <script>
    $(function () {
      $("#tb-mems").DataTable();
    });

    var banAccURL = "{{route('admin.user.ban')}}";
    var setPermitsionURL = "{{route('admin.user.config')}}";
    banAccount(banAccURL);
    setPermission(setPermitsionURL);
  </script>
@endpush
