@extends('layouts.guess_app')

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
                  <button  class="btn btn-primary btn-block mt-4"><a style="color: white" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Ok</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form></button></center>

                    {{ __('') }} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
