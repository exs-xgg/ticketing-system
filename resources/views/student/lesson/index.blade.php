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
    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-bookmark fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->lessons)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Lesson{{count($section->lessons) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lesson</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section->lessons as $key => $lesson)
                    <tr>
                        <th scope="row">{{$key+1}}.</th>
                        <td>{{$lesson->title}}</td>
                        <td><a class="btn-link" href="{{route('student.lesson.download', [$course->id, $section->id, $lesson->id])}}" data-toggle="tooltip" data-placement="right" title="Download">{{substr($lesson->upload_file, 11)}}</a></td>
                        <td><a class="blue-text" href="{{route('student.lesson.show',[$course->id, $section->id, $lesson->id])}}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
