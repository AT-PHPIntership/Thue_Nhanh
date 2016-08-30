<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>@lang('frontend.auth.change_pass.header')</h2>

        <div>
            @lang('frontend.auth.change_pass.body_p1')
            <ul>
                <li>@lang('frontend.auth.change_pass.email') <strong>{{$email}}</strong></li>
                <li>@lang('frontend.auth.change_pass.password') <strong>{{$password}}</strong></li>
            </ul>
            @lang('frontend.auth.change_pass.body_p2')
            <br>
            {{-- {{ route('user.update') }} . <br/> --}}
        </div>
    </body>
</html>
