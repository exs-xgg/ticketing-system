@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Instructor Profile</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
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
    <div class="row mt-0">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Course{{count($instructor->courses) > 1 ? 's' : ''}}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-0">
        @if ( count($instructor->courses) == 0 )
        <div class="col-xl-12 col-md-12 mb-3">
            <div class="card py-5">
                <div class="card-body text-center">
                    <h4 class="text-osald">No course available</h4>
                </div>
            </div>
        </div>
        @else    
            @foreach ($instructor->courses as $course)
                <div class="col-lg-4 col-md-6 col-sm-6 mb-3 pr-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="post-prev-title">
                                <h3><a href="{{ route('admin.instructor.course', [$instructor->id, $course->id]) }}">{{ $course->name }}</a></h3>
                            </div>
                            <div class="post-prev-info">
                                {{ $course->code }}
                            </div>
                            <div class="post-prev-text">
                                {{ substr($course->description, 0, 195) }}{{ strlen($course->description) > 195 ? "..." : "" }}
                            </div>
                            <hr>
                            <div class="">
                                <a href="{{route('admin.course.edit', $course->id)}}" class="blog-more">UPDATE</a>
                                <div class="float-right">
                                    <a href="javascript:void(0);" class="post-prev-count" data-toggle="tooltip" data-placement="top" title="Instructors">
                                        <span class="icon_comment_alt">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <span class="icon-count">{{ count($course->users) }}</span>
                                    </a>
        
                                    <a href="javascript:void(0);" class="post-prev-count" data-toggle="tooltip" data-placement="top" title="Sections">
                                        <span class="icon_comment_alt">
                                            <i class="fa fa-graduation-cap"></i>
                                        </span>
                                        <span class="icon-count">{{ count($course->sections) }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
