<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>@lang('frontend.auth.verify_header')</h2>

        <div>
            @lang('frontend.auth.verify_body_p1')
            <br>
            @lang('frontend.auth.verify_body_p2')
            <br>
            {{ url('register/verify/' . $id . '/' . $validationCode) }} . <br/>
        </div>
    </body>
</html>
