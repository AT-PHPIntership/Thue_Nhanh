<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand" href="{{url('/')}}">@lang('common.header.logo')</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/')}}"><i class="fa fa-home"></i> @lang('common.header.home')</a></li>
        <li>
          <a href="{{route('post.create')}}"><i class="fa fa-cloud-upload"></i> @lang('common.header.create') <sup><span class="label label-success">@lang('common.header.label_free')</span></sup></a>
        </li>
      </ul>
      <div class="navbar-right">
          <form class="navbar-form navbar-left" role="search">
              <div class="form-group input-group">
                  <input name="q" type="text" class="form-control" placeholder="@lang('common.header.search')">
                  <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">
                          <span class="glyphicon glyphicon-search"></span>
                      </button>
                  </span>
              </div>
          </form>
          {{-- @yield('navbar-menu') --}}
          @if(isset(Auth::user()->email))
              @include('frontend.layouts.partials.usermenu')
          @else
              @include('frontend.layouts.partials.guestmenu')
          @endif
      </div>
    </div>
  </div>
</nav>
