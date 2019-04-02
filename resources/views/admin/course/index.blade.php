@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Concerns</h3>
            </div>
            <a href="{{route('admin.course.create')}}" class="btn btn-primary mr-0 my-0"><i class="fa fa-plus"></i> Add concern</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-list fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($courses) )}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Concerns{{ count($courses) > 1 ? 's' : '' }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="table" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Course</th>
                                <th class="th-sm">Instructors</th>
                                <th class="th-sm">Status</th>
                                <th class="th-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $data)
                                <tr>
                                    <td>{{ $data->name }}</td> 
                                    <td>
                                        @foreach ($data->users as $key => $user)
                                            <a class="btn-link" href="{{route('admin.instructor.show', $user->id)}}">{{ $user->name() }}</a>
                                                {{ $key < count($data->users) - 1 ? ', ' : ''  }}
                                        @endforeach  
                                    </td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                Inactive
                                                <input class="active-mode-switch" type="checkbox" {{$data->status ? 'checked' : ''}} courseId="{{$data->id}}">
                                                <span class="lever"></span> Active
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.course.edit', $data->id)}}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a>
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
        $('#table').DataTable({
            scrollX: true,
            // processing: true,
            // serverSide: true,
            // ajax: "{!! route('admin.courseList') !!}",
            // columns: [
            //     {data: 'name', name: 'name'},
            //     {data: 'instructors', name: 'instructors'},
            //     {data: 'status', name: 'status'},
            //     {data: 'action', name: 'action'},
            // ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            order: [],
        });
        // tooltip for datatables
        $('table').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#table').on('change', '.active-mode-switch', function() {
            var status = 0;
            var id = $(this).attr('courseId');
            if ($(this).is(':checked')) {
                status = 1;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/course/"+id+"/status",
                type : 'PUT',
                data: { id: id, status : status },
                success: function(result) {
                    var newResult = JSON.parse(result);
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    toast({
                        type: 'success',
                        title: newResult.status
                    })
                },
                error : function(error) {
                    console.log('error');
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection
