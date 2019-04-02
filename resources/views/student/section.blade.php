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
                    <i class="fa fa-users fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ count($section->users) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Student{{ count($section->users) > 1 ? 's' : '' }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Roles</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>{{ $section->instructor->name() }}</td>
                            <td>{{ $section->instructor->email }}</td>
                            <td class="text-capitalize">{{ $section->instructor->role }}</td>
                            <td>
                                <a class="blue-text" data-toggle="modal" data-target="#basicExampleModal">Message</a>
                            </td>
                        </tr>
                        @foreach ($section->users as $key => $student)
                        <tr>
                            <td>{{ $key+2 }}.</td>
                            <td>{{ $student->name() }}</td>
                            <td>{{ $student->email }}</td>
                            <td class="text-capitalize">{{ $student->role }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Message to {{$section->instructor->name()}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('message.store')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="to_user_id" value="{{$section->instructor->id}}" class="form-control" id="recipient-name">
                    <div class="form-group">
                        <label for="token">Message <span class="red-asterisk">*</span></label>
                        <textarea type="text" name="message" id="message-text" class="form-control md-textarea" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-right mr-0 mb-3"><i class="fa fa-check"></i> Send message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
