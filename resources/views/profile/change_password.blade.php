@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>Change Password</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mt-3">
                    <div class="card-header text-white bg-primary">
                        <h5 class="text-oswald mb-0 text-left">Change your password</h5>
                    </div>
                    <div class="card-body">
                        {{-- <span>Choose a strong password, use at least 8 characters, required to contain mix of letters and number and special characters.</span> --}}
                        <form class="" action="{{route('change.password.update')}}" method="post">
                            @csrf {{method_field('PUT')}}
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="md-form">
                                        <input type="password" name="currentPassword" id="currentPassword" value="{{old('currentPassword')}}" class="form-control {{$errors->has('currentPassword') ? 'is-invalid' : ''}}">
                                        <label for="currentPassword">Current Password <span class="red-asterisk">*</span></label>
                                        @if ($errors->has('currentPassword'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('currentPassword') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="md-form">
                                        <input type="password" name="password" id="password" class="form-control for_password {{$errors->has('password') ? 'is-invalid' : ''}}">
                                        <label for="password" class="label_password">New Password <span class="red-asterisk">*</span></label>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="md-form">
                                        <input id="password-confirm" type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" name="password_confirmation">
                                        <label for="password-confirm" class="form-label label_confirm">Confirm Password <span class="red-asterisk">*</span></label>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-pencil"></i> Update</button>
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

            // $( "#password-confirm" ).focus(function() {
            //     $('.label_confirm').addClass('active');
            // });

            // $( "#password-confirm" ).focusout(function() {
            //     if($( "#password-confirm" ).val() == ''){
            //         $('.label_confirm').removeClass('active');
            //     }
            // });

            
            // $("#password-confirm").passwordValidator({
            //     // list of qualities to require
            //     require: ['length', 'lower', 'upper', 'digit'],
            //     // minimum length requirement
            //     length: 8
            // });
        });
    </script>
@endsection
