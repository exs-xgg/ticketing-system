@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Course & Section</h3>
            </div>
            <a data-toggle="modal" data-target="#basicExampleModal" class="btn btn-primary my-0 mr-0"><i class="fa fa-plus"></i> Enroll Course</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3 pr-3">
        @foreach ($user->sections as $section)
        <div class="col-lg-4 col-md-6 col-sm-6 mb-3 pr-0">
            <div class="card">
                <div class="card-body">
                    <div class="post-prev-title">
                        <h3><a href="{{ route('student.announcement', [$section->course->id, $section->id]) }}">{{$section->course->name}}</a></h3>
                    </div>
                    
                    <div class="post-prev-info">
                        {{$section->name}}
                    </div>
                    
                    <div class="post-prev-text">
                        {{ substr($section->course->description, 0, 195) }}{{ strlen($section->course->description) > 195 ? "..." : "" }}
                    </div>

                    <hr>
                    <div class="">
                        <a href="{{ route('student.announcement', [$section->course->id, $section->id]) }}" class="blog-more">LEARN MORE</a>
                        <div class="float-right">
                            <a href="{{ route('student.lesson.index', [$section->course->id, $section->id]) }}" class="post-prev-count" data-toggle="tooltip" data-placement="top" title="Lessons">
                                <span class="icon_comment_alt">
                                    <i class="fa fa-bookmark"></i>
                                </span>
                                <span class="icon-count">{{ number_format(count($section->lessons)) }}</span>
                            </a>

                            <a href="{{ route('student.quiz.index', [$section->course->id, $section->id]) }}" class="post-prev-count" data-toggle="tooltip" data-placement="top" title="Quizzes">
                                <span class="icon_comment_alt">
                                    <i class="fa fa-book"></i>
                                </span>
                                <span class="icon-count">{{ number_format(count($section->quizzes)) }}</span>
                            </a>

                            <a href="{{ route('student.assignment.index', [$section->course->id, $section->id]) }}" class="post-prev-count" data-toggle="tooltip" data-placement="top" title="Assignments">
                                <span class="icon_comment_alt">
                                    <i class="fa fa-address-book"></i>
                                </span>
                                <span class="icon-count">{{ number_format(count($section->assignments)) }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enroll Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('student.check_token')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="md-form">
                        <input type="text" name="token" id="token" class="form-control" required>
                        <label for="token">Token <span class="red-asterisk">*</span></label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right mr-0 mb-3"><i class="fa fa-check"></i> Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
