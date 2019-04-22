@extends('layouts.guest_app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-5">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">HCI Registration</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="sections" value="">
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="md-form">
                                    <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="firstName" id="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}" value="{{old('firstName')}}">
                                    <label for="firstName">First Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('firstName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <div class="md-form">
                                    <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="lastName" id="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{old('lastName')}}">
                                    <label for="lastName">Last Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('lastName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                         
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6">
                                 <div class="md-form">
                                    <input type="email" id="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}">
                                    <label for="email">Email Address <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="md-form">
                            <input type="text" id="username" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{old('username')}}">
                            <label for="username">Username <span class="red-asterisk">*</span></label>
                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form">
                            <input type="password" id="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                            <label for="password" class="label_password">Password <span class="red-asterisk">*</span></label>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                            </div>
                            <div class="col-md-6">
                               <div class="md-form">
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}">
                            <label for="password-confirm" class="label_confirm">Confirm Password <span class="red-asterisk">*</span></label>
                            @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form">
                            <input type="text" id="mobileNumber" name="mobileNumber" class="form-control {{$errors->has('mobileNumber') ? 'is-invalid' : ''}}">
                            <label for="mobileNumber" class="mobileNumber">Mobile Number <span class="red-asterisk">*</span></label>
                            @if ($errors->has('mobileNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobileNumber') }}</strong>
                            </span>
                            @endif
                        </div>
                            </div>
               

                        
        
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-check"></i> NEXT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


<script>
  $(function() {
          $('.mdb-select').material_select();
            $('#mobileNumber').mask('00000000000');
          
           });

            $( "#password" ).focus(function() {
                $('.label_password').addClass('active');
            });

            $( "#password" ).focusout(function() {
                if($( "#password" ).val() == ''){
                    $('.label_password').removeClass('active');
                }
            });

            
            $("#password").passwordValidator({
                // list of qualities to require
                require: ['length', 'lower', 'upper', 'digit'],
                // minimum length requirement
                length: 8
    
 
     });

  </script>
@endsection