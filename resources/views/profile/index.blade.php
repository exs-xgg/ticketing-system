@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>Profile</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>

        <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }} {{method_field('PUT')}}
           <div class="row mt-3 justify-content-center">
        <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header text-white bg-primary">
                            <h5 class="text-oswald mb-0">Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                    <div class="col-sm-12 col-lg-6 col-md-6">
                                        <div class="md-form">
                                            <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="firstName" id="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}" value="{{$user->firstName}}">
                                            <label for="firstName">First name <span class="red-asterisk">*</span></label>
                                            @if ($errors->has('firstName'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('firstName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 col-md-6">
                                        <div class="md-form">
                                            <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="middleName" id="middleName" class="form-control {{$errors->has('middleName') ? 'is-invalid' : ''}}" value="{{$user->middleName ? $user->middleName : old('middleName')}}">
                                            <label for="middleName">Middle name</label>
                                            @if ($errors->has('middleName'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('middleName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 col-md-6">
                                        <div class="md-form">
                                            <input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="lastName" id="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{$user->lastName}}">
                                            <label for="lastName">Last name <span class="red-asterisk">*</span></label>
                                            @if ($errors->has('lastName'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lastName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-lg-6 col-md-6">
                                        <div class="md-form">
                                            <select class="select-wrapper mdb-select" name="suffix" id="suffix">
                                              <option value="" selected>Select</option>
                                              @foreach($suffix as $data)
                                                <option value="{{ $data }}" {{ $user->suffixName == $data ? 'selected' : ''}}>{{ $data }}</option>
                                              @endforeach
                                            </select>
                                            
                                            <!--<input type="text" pattern="[A-Za-z]*" title="Only Alphabets" name="suffix" id="suffix" class="form-control {{$errors->has('suffix') ? 'is-invalid' : ''}}" value="{{$user->suffixName ? $user->suffixName : old('suffix')}}">-->
                                            <label for="suffix">Suffix</label>
                                            <!--@if ($errors->has('suffix'))-->
                                            <!--    <span class="invalid-feedback" role="alert">-->
                                            <!--        <strong>{{ $errors->first('suffix') }}</strong>-->
                                            <!--    </span>-->
                                            <!--@endif-->
                                        </div>
                                    </div>

                                </div>
                                @if ($user->role == 'student')
                                    @if ($user->studentNumber == '')
                                        <p class="red-text"> <i class="fa fa-exclamation-triangle"></i> Update your Student Number</p>
                                        <div class="md-form">
                                            <input type="text" name="studentNumber" id="studentNumber" class="form-control {{$errors->has('studentNumber') ? 'is-invalid' : ''}}" value="{{$user->studentNumber ? $user->studentNumber : old('studentNumber')}}">
                                            <label for="studentNumber">Student Number <span class="red-asterisk">*</span></label>
                                            @if ($errors->has('studentNumber'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('studentNumber') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    @else 
                                        <div class="md-form">
                                            <input type="text" readonly class="form-control" value="{{$user->studentNumber}}">
                                            <label>
                                                Student Number 
                                                {{-- <span class="red-asterisk">Can't be change</span> --}}
                                            </label>
                                        </div>
                                    @endif
                                @endif
            
                                <div class="form-row">
                                    @if ($user->role == 'student') 
                                        <div class="col-lg-12">
                                            <div class="md-form">
                                                <input placeholder="Select date" type="text" name="birthDate" id="birthDate" class="form-control datepicker {{$errors->has('birthDate') ? 'is-invalid' : ''}}" value="{{date('j F, Y',strtotime($user->birthDate))}}">
                                                <label for="birthDate">Date of Birth <span class="red-asterisk">*</span></label>
                                                @if ($errors->has('birthDate'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                                    </span>
                                                @endif
                                                @if (Session::has('statusError'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ Session::get('statusError') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="md-form">
                                            <input type="email" name="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{$user->email}}">
                                            <label for="email">Email Address <span class="red-asterisk">*</span></label>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="mobileNumber" id="mobileNumber" class="form-control {{$errors->has('mobileNumber') ? 'is-invalid' : ''}}" value="{{$user->mobileNumber ? $user->mobileNumber : old('mobileNumber')}}">
                                    <label for="mobileNumber">Mobile Number</label>
                                    @if ($errors->has('mobileNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobileNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="md-form">
                                            <input type="text" name="username" id="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{$user->username}}">
                                            <label for="username">Username <span class="red-asterisk">*</span></label>
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-pencil"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form id="remove-profile-pic-{{$user->id}}" action="{{ route('profile.picture.remove') }}" method="post">
          @csrf {{method_field('PUT')}}

        </form>
    </div>
@endsection

@section('script')
    <script>
        $('.mdb-select').material_select();
        $('#mobileNumber').mask('00000000000');
        $('#studentNumber').mask('0000000000');

        var student = '{!! $user->role !!}';
        if( student == 'student'){
            $('.datepicker').pickadate({
                max: new Date(),
                formatSubmit: 'yyyy-mm-dd',
                hiddenPrefix: 'formatted_',
                selectYears: 40, 
                max: new Date(2003,11,31)               
            });
        } else {
            $('.datepicker').pickadate({
                max: new Date(),
                formatSubmit: 'yyyy-mm-dd',
                hiddenPrefix: 'formatted_',
                selectYears: 40,              
            });
        }

        function previewFile(){
            var preview = document.querySelector('.img-preview'); //selects the query named img
            var file    = document.querySelector('input[type=file]').files[0]; //sames as here
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file); //reads the data as a URL
            } else {
                preview.src = "{{$user->avatar ? asset('storage/avatars/'.$user->avatar) : asset('images/profile_pic.png')}}";
            }

        }

    previewFile();  //calls the function named previewFile()


    </script>
@endsection
