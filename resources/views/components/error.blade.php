@extends('layouts.auth')

@section('content')
    <div class="wrapper-page">
        <div class="card">
            <div class="card-block">
    
                <div class="ex-page-content text-center">
                    <h1 class="text-dark">{{$responseStatus}}!</h1>
                    <h4 class="">Sorry, {{ $responseMessage }}</h4><br>
    
                    <a class="btn btn-info mb-5 waves-effect waves-light" href="{{ route('home') }}"><i class="mdi mdi-home"></i> Back to Dashboard</a>
                </div>
    
            </div>
        </div>
    
    </div>
@endsection