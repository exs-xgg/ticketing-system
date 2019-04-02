@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
    <div class="row mt-lg-3 justify-content-center">
        <div class="col-xl-12 col-md-12 mb-3">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Show Lesson</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <h2 class="text-center py-3 text-oswald">{{$lesson->title}}</h2>
                            <p>{!! $lesson->description !!}</p>
                            <hr>
                            <div class="float-left">
                                @if ($lesson->upload_file)
                                    <p class="mb-0"><i class="fa fa-file"></i> <a href="{{ route('student.lesson.download', [$course->id, $section->id, $lesson->id]) }}" class="btn-link" data-toggle="tooltip" title="Download" data-placement="right">{{substr($lesson->upload_file, 11)}}</a><p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
