@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Deactivated Instructor{{count($instructors) > 1 ? 's' : ''}}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-times fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($instructors)) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Instructor{{ count($instructors) > 1 ? 's' : '' }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Username</td>
                                <td>Mobile Number</td>
                                <td>Date deactivated</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructors as $instructor)
                            <tr>
                                <td>{{$instructor->name()}}</td>
                                <td>{{$instructor->email}}</td>
                                <td>{{$instructor->username}}</td>
                                <td>{{$instructor->mobileNumber}}</td>
                                 <td>{{$instructor->deleted_at}}</td>
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ route('admin.instructor.restore', $instructor->id) }}" class="restore text-success mr-3" data-method="put" data-from="instructor" data-toggle="tooltip" title="Restore" data-placement="left"><i class="fa fa-undo"></i></a>
                                    <a href="javascript:void(0);" data-href="{{ route('admin.instructor.forceDestroy', $instructor->id) }}" class="perma_delete text-danger" data-method="delete" data-from="instructor" data-toggle="tooltip" title="Delete" data-placement="right"><i class="fa fa-trash"></i></a>                              
                                </td>
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
            },
            order: []
        });
    });

</script>
@endsection
