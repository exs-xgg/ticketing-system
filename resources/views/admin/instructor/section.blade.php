@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Instructor Profile</h3>
            </div>
            <a href="{{ route('admin.instructor.course', [$instructor->id, $course->id]) }}" class="btn btn-light mr-0 my-0"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row">
        <div class="col-md-2 col-sm-4 text-center">
            <img src="{{ $instructor->avatar ? asset('storage/avatars/'.$instructor->avatar) : asset('images/profile_pic.png')}}" class="img-fluid rounded-circle z-depth-1" style="height:100px;width:100px;object-fit:cover;" alt="">
        </div>
        <div class="col-md-5 col-sm-8 instructor-des">
            <p><b>Name:</b> {{ $instructor->name() }} <br>
            <b>Email-Address:</b> {{ $instructor->email }} <br>  
            <b>Username:</b> {{ $instructor->username }}  
            @if ($instructor->mobileNumber)
                <br><b>Mobile Number:</b> {{ $instructor->mobileNumber }}  
            @endif
            </p>
        </div>    
    </div>
    <hr class="mb-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <div class="post-prev-info mb-0">
                {{ $section->name }}
            </div>
            <hr class="mt-0">
        </div>
    </div>
    {{-- <div class="row mt-3">
        <div class="col-lg-12">
            <hr>
            <h4 class="text-oswald mb-3">Course: {{$course->name}}</h4>
            <h4 class="text-oswald mb-3">Section: {{$section->name}}</h4>
            <h4>Student{{count($section->users) > 1 ? 's' : ''}}: {{ number_format(count($section->users)) }}</h4>
        </div>
    </div> --}}

    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-bookmark fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($section->lessons)) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Lesson{{count($section->lessons) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-book fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($section->quizzes)) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Quiz{{count($section->quizzes) > 1 ? 'zes' : ''}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-address-book fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($section->assignments)) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Assignment{{count($section->assignments) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Registered Since</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($section->users as $student)
                            <tr>
                                <td>{{$student->name()}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->mobileNumber}}</td>
                                <td>{{date('F j, Y',strtotime($student->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{ asset('js/addons/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            }
        });
    });

</script>
@endsection
