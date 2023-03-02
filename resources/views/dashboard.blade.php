@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('company_detail')}}"><button type="submit" class="btn btn-primary">Company Details</button></a>
                    <a href="{{route('pdf_index')}}"><button type="submit" class="btn btn-primary" style="float: right;">File Details</button></a>
                </div>  
                @include('errors.index')    
            </div>
        </div>
    </div>
</div>
@endsection
