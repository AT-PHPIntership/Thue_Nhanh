<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <title>@yield('page-title') @lang('common.layouts.title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://bootswatch.com/superhero/bootstrap.min.css">
        <link href="/bower_resources/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom Css -->
        <link rel="stylesheet" href="/css/master.css">
        @stack('style-sheets')
    </head>
    <body>
        @include('layouts.partials.topnav')

        <div class="container">
            <div class="row">
                <div class="col-sm-2 well text-center">
                    @yield('tips')
                </div>
                <div class="col-sm-7">
                    @yield('main')
                </div>
                <div class="col-sm-3 well text-center">
                    @yield('ads')
                </div>
            </div>
        </div>

        @include('layouts.partials.footer')
        <script src="/bower_resources/jquery/dist/jquery.min.js"></script>
        <script src="/bower_resources/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $('body').prepend('<a href="#" title="@lang('common.layouts.back_to_top')" class="back-to-top"><i class="fa fa-3x fa-caret-square-o-up"></i></a>');
        </script>
        @stack('scripts')
        <script src="/js/master.js"></script>
    </body>
</html>
