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
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-4 col-sm-4 text-center">
            <h2 class="text-oswald">{{$quiz->title}}</h2>
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-list-ol fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{$take->result}}/{{count($quiz->questions) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Result</h2>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection