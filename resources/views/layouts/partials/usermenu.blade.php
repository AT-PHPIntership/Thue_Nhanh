<div class="dropdown nav navbar-nav">
    <li class="dropdown-toggle" style="" data-toggle="dropdown">
      <a href="#">
        <i class="fa fa-user"></i> {{Auth::user()->name}}
        <sup><span class="label label-success"></span></sup>
        <i class="fa fa-caret-down"></i>
      </a>
    </li>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation">
        <a role="menuitem" href="#">
            @lang('common.header.notifications')
            <sup><span class="label label-success"></span></sup>
        </a>

      </li>
      <li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" href="#">@lang('common.header.profile')</a></li>
      <li role="presentation"><a role="menuitem" href="#">@lang('common.header.all_posts')</a></li>
      <li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" href="#">@lang('common.header.logout')</a></li>
    </ul>
</div>
