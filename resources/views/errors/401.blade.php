@extends('backend.layouts.master')

@section('page-title')
  401 @lang('backend.errors.401') | 
@endsection

@section('content-header')
  401 @lang('backend.errors.unauthorized')
@endsection

@section('content')
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-yellow"> 401</h2>
      <div class="error-content push-to-bottom">
        <h3><i class="fa fa-warning text-yellow"></i> @lang('backend.errors.access_denied')</h3>
        <p>
          @lang('backend.errors.401_message')
        </p>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
@endsection
