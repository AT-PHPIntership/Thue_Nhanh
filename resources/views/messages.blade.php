@if (session()->has('message'))
    <div class="alert alert-success">
        <a href="#" class="close no-underline" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
          <li>{{ session('message') }}</li>
        </ul>
    </div>
@endif

@if (count($errors))
    <div class="alert alert-danger">
        <a href="#" class="close no-underline" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
