@if ($errors->any())
    <div class="alert alert-danger"  role="alert">
        <div class="alert-body">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    </div>
@endif
@if (\Session::has('success'))
    <div class="alert alert-success" role="alert">
        <div class="alert-body">
            <li>{!! \Session::get('success') !!}</li>
        </div>
    </div>
@endif
@if (\Session::has('error'))
    <div class="alert alert-danger" role="alert">   
        <div class="alert-body">
            <li>{!! \Session::get('error') !!}</li>
        </div>
    </div>
@endif
