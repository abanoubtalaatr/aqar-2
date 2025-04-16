@if (Session::has('error'))
    <div class="callout callout-danger">
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

@if (Session::has('success'))
    <div class="callout callout-success">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
@if (Session::has('inActive'))
    <div class="callout callout-warning">
        <p>{{ Session::get('inActive') }}</p>
    </div>
@endif

@if ($errors->any())
    <div class="callout callout-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
