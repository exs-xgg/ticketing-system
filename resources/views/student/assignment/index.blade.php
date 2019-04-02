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
                    <i class="fa fa-address-book fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->assignments)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Assignment{{count($section->assignments) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Assignment</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th>Date Submitted</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section->assignments as $key => $assignment)
                        <tr>
                            <th>{{$key+1}}.</th>
                            <td>{{$assignment->title}}</td>
                            <td>
                                {{$assignment->startDate ? $assignment->startDate->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                {{ $assignment->expireDate ? $assignment->expireDate->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                @if($assignment->passes($section->id, Auth::id()))
                                    {{$assignment->passes($section->id, Auth::id())->created_at->toFormattedDateString()}}
                                @endif    
                            </td>
                            <td>
                                @if ($assignment->passes($section->id, Auth::id()))
                                    @if ($assignment->passes($section->id, Auth::id())->grade)
                                        <h4 class="text-oswald {{ $assignment->passes($section->id, Auth::id())->grade == 0 ? 'red-text' : 'green-text' }}">
                                            {{ $assignment->passes($section->id, Auth::id())->grade }}
                                        </h4>
                                    @else 
                                        No result yet
                                    @endif
                                @else
                                    <p class="red-text">No Assignment</p>
                                @endif
                            </td>
                            <td>
                                @if ($assignment->passes($section->id, Auth::id()))
                                    <a href="{{route('student.pass.result_assignment', [$course->id, $section->id, $assignment->id, $assignment->passes($section->id, Auth::id())->id])}}" class="blue-text">View</a>
                                @elseif(Carbon\Carbon::parse($assignment->startDate)->isFuture())
                                    <p class="red-text">Not Yet Available</p>
                                @elseif(Carbon\Carbon::parse($assignment->expireDate)->isPast())
                                    <p class="red-text">Expired</p>
                                @else
                                    <a class="blue-text" href="{{route('student.assignment.show', [$course->id, $section->id, $assignment->id])}}">Submit</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
