@extends('frontend.layouts.master')

@section('page-title')
    @lang('frontend.auth.title_register') |
@endsection

@section('main-content')

@include('frontend.common.errors')

<!-- Display successful message -->
@if (session()->has('email'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
          <li><strong>@lang('frontend.auth.thanks')</strong></li>
          <li>{{trans('frontend.auth.success', ['email' => session('email')])}}</li>
          <li>@lang('frontend.auth.direction')</li>
          <li><a href="{{ url('/login') }}">@lang('frontend.auth.rediect')</a></li>
        </ul>
    </div>
@endif

<!-- Registration form -->
<div class="col-sm-6 col-xs-12">
    <form id="registration_form" action="#" method="post">
        <h3 class="form-header">@lang('frontend.auth.registration')</h3>

        {{ csrf_field() }}

		<div class="form-group col-lg-12">
			<label>@lang('frontend.auth.username')<span class="red">&nbsp;&ast;</span></label>
			<input type="text" name="username" class="form-control" data-validetta="required,minLength[2],maxLength[128]" value="">
		</div>

        <div class="form-group col-lg-12">
            <label>@lang('frontend.auth.email')<span class="red">&nbsp;&ast;</span></label>
            <input type="email" name="email" class="form-control"  data-validetta="required,email" value="">
        </div>

		<div class="form-group col-lg-6">
			<label>@lang('frontend.auth.password')<span class="red">&nbsp;&ast;</span></label>
			<input type="password" name="password" class="form-control" data-validetta="required,minLength[6],maxLength[32]" value="">
		</div>

		<div class="form-group col-lg-6">
			<label>@lang('frontend.auth.repeat_pass')<span class="red">&nbsp;&ast;</span></label>
			<input type="password" name="password_confirmation" class="form-control" data-validetta="required,minLength[6],maxLength[32],equalTo[password]" value="">
		</div>

		<div class="form-group col-sm-12">
			<input type="checkbox" class="checkbox agree-checkbox" data-validetta="required"/> <span class="agreement"> @lang('frontend.auth.agreement_text')</span>
		</div>

        <div class="hr center-block"></div>

        <div class="form-group col-lg-6">
            <button type="button" class="btn btn-block btn-fb" name="signin"><i class="fa fa-facebook-square"></i> &nbsp;@lang('frontend.auth.sign_in_fb')</button>
        </div>

        <div class="form-group col-lg-6">
            <button type="submit" class="btn btn-primary btn-block" name="signup">@lang('frontend.auth.signup')</button>
        </div>
    </form>

</div> <!--/ Registration form -->


<div class="col-sm-6 col-xs-12 terms">
    <h3>@lang('frontend.auth.terms_and_conditions')</h3>
    @include('frontend.common.web_terms_and_conditions')
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
            $("#registration_form").validetta({
                realTime : true,
            },
            // Override global error messages
            {!! json_encode(trans('validetta')) !!}
            );
        });
    </script>
@endpush
