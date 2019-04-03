@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Instructors</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Add Instructor</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.instructor.store')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-sm-12 col-lg-6 col-md-6">
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
                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="md-form">
                                    <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="middleName" id="middleName" class="form-control {{$errors->has('middleName') ? 'is-invalid' : ''}}" value="{{old('middleName')}}">
                                    <label for="middleName">Middle Name</label>
                                    @if ($errors->has('middleName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middleName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="md-form">
                                    <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" id="lastName" name="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{old('lastName')}}">
                                    <label for="lastName">Last Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('lastName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="md-form">
                                    <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" id="suffix" name="suffix" class="form-control {{$errors->has('suffix') ? 'is-invalid' : ''}}" value="{{old('suffix')}}">
                                    <label for="suffix">Suffix</label>
                                    @if ($errors->has('suffix'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('suffix') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
        
                        <div class="md-form">
                            <input type="email" name="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}">
                            <label for="email">Email Address <span class="red-asterisk">*</span></label>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="md-form">
                            <input type="text" name="mobileNumber" id="mobileNumber" class="form-control {{$errors->has('mobileNumber') ? 'is-invalid' : ''}}" value="{{old('mobileNumber')}}">
                            <label for="mobileNumber">Mobile Number</label>
                            @if ($errors->has('mobileNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobileNumber') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="md-form">
                            <input type="text" name="username" id="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{old('username')}}">
                            <label for="username">Username <span class="red-asterisk">*</span></label>
                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
        
                         <div class="md-form">
                            <input type="password" name="password" id="password" placeholder="Leave empty, default password is secret" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                            <label for="password">Password</label>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div> 
        
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#mobileNumber').mask('00000000000');
        $('#studentNumber').mask('0000000000');
    </script>
@endsection
