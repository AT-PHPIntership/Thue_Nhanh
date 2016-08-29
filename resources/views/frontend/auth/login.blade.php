@extends('frontend.layouts.master')

@section('page-title')
    @lang('frontend.auth.login') |
@endsection

@section('main-content')

<div class="col-md-4 well">
    <form id="login_form" action="{{route('auth.login')}}" method="post">
        <h3 class="form-header">@lang('frontend.auth.login')</h3>

        <div class="form-group col-lg-12">
            @include('frontend.common.errors')
        </div>

        {{ csrf_field() }}

        <div class="form-group col-lg-12">
            <label>@lang('frontend.auth.email')<span class="red">&nbsp;&ast;</span></label>
            <input type="email" name="email" class="form-control"  data-validetta="required,email" value="">
        </div>

        <div class="form-group col-lg-12">
			<label>@lang('frontend.auth.password')<span class="red">&nbsp;&ast;</span></label>
			<input type="password" name="password" class="form-control" data-validetta="required,minLength[6],maxLength[32]" value="">
		</div>

        <div class="form-group col-sm-12">
			<input type="checkbox" name="remember" id="agree-checkbox" class="checkbox agree-checkbox"/> <label for="agree-checkbox" class="agreement"> @lang('frontend.auth.remember')</label>
		</div>

        <div class="hr center-block"></div>

        <div class="form-group col-lg-6">
            <a href="{{url('/register')}}" class="btn btn-success btn-block">@lang('frontend.auth.signup')</a>
        </div>

        <div class="form-group col-lg-6">
            <button type="submit" class="btn btn-primary btn-block">@lang('frontend.auth.login')</button>
        </div>

        <div class="form-group col-lg-12 text-center">
            @lang('frontend.auth.or')
        </div>

        <div class="form-group col-lg-12">
            <button type="button" class="btn btn-block btn-fb" name="signin"><i class="fa fa-facebook-square"></i> &nbsp;@lang('frontend.auth.sign_in_fb')</button>
        </div>

        <div class="hr center-block"></div>
        <div class="form-group col-lg-12">
            <a href="{{url('/password/reset')}}" class="pull-right">@lang('frontend.auth.forget_pass')</a>
        </div>
    </form>
</div>

@endsection

@push('style-sheets')
    <link rel="stylesheet" href="/bower_resources/validetta/dist/validetta.min.css">
    <link rel="stylesheet" href="/css/frontend/main.css">
@endpush

@push('scripts')
    <script src="/bower_resources/validetta/dist/validetta.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login_form").validetta({
                realTime : true,
            },
            // Override global error messages
            {!! json_encode(trans('validetta')) !!}
            );
        });
    </script>
@endpush
