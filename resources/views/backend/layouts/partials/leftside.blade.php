<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{!! url(\Config::get('common.AVATAR_PATH') . Auth::user()->avatar) !!}" class="img-circle" alt="{{Auth::user()->name}}">
      </div>
      <div class="pull-left info">
        <!-- Current user's name -->
        <p>{{Auth::user()->name}}</p>
        <!-- Current user's role -->
        <i class="fa fa-circle text-success"></i> {{Auth::user()->roles->first()->name}}
      </div>
    </div>
    <!-- sidebar menu -->
    <ul class="sidebar-menu">
      <li class="header">@lang('backend.common.management')</li>
      <li>
        <a href="#">
          <i class="fa fa-th"></i> <span>@lang('backend.common.posts')</span>
        </a>
        <ul class="treeview-menu">
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.posts_activated')</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.posts_waitting')</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.posts_closed')</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.posts_deleted')</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-warning"></i>
          <span>@lang('backend.common.reports')</span>
        </a>
        <ul class="treeview-menu">
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.reports_waitting')</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.reports_processed')</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>@lang('backend.common.accounts')</span>
        </a>
        <ul class="treeview-menu">
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.acc_admins')</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.acc_mems')</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.acc_deactivated')</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> @lang('backend.common.acc_banned')</a></li>
        </ul>
      </li>
      <li><a href=""><i class="fa fa-book"></i> <span> @lang('backend.common.categories')</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
