@extends('layouts.guest_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-5">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Verification of the Account</h5>
                </div>
                <div class="card-body">
                  
                   <center>{{ __('Your Account needs to be verified by the Wireless Access for Health.') }}</center> 
                    {{ __('') }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
