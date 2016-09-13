<header class="main-header">
  <!-- Logo -->
  <a href="{{route('home')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>@lang('backend.common.mini_logo')</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>@lang('backend.common.logo')</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">@lang('backend.common.toggle_nav')</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Reports -->
        <li class="dropdown tasks-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-flag-o"></i>
            <span class="label label-danger"></span>
          </a>
        </li>
        <!-- New posts -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning"></span>
          </a>
        </li>
        <!--Logout -->
        <li class="dropdown user user-menu">
          <a href="{{url('/logout')}}">
            <i class="fa fa-sign-out"></i> @lang('backend.common.logout')
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
