@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Course & Section</h3>
            </div>
            <a href="{{route('student.dashboard')}}" class="btn btn-light my-0 mr-0"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-body text-center">
                    <form action="{{route('student.register.store', $section->section->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="sections" value="{{$section->section->id}}">
                        <h4 class="text-oswald">{{$section->course->name}} / {{$section->section->name}}</h4>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
