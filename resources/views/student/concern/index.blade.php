@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">

<style>
         pre {
            overflow-x: auto;
            white-space: pre-wrap;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;
         }
      </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Concerns</h3>
            </div>
            <a href="{{route('student.concern.create')}}" class="btn btn-primary mr-0 my-0"><i class="fa fa-plus"></i> Add concern</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-list fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($concerns) )}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Concern{{ count($concerns) > 1 ? 's' : '' }}</h2>
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
                                <th class="th-sm">Ticket#</th>
                                <th class="th-sm">Date</th>
                                <th class="th-sm">Receiver 1</th>
                                 <th class="th-sm">Receiver 2</th>
                                <th class="th-sm">Problem Category</th>
                                <th class="th-sm">Sub Category</th>
                                <th class="th-sm">Priority</th>
                                <th class="th-sm">Status</th>
                                <th class="th-sm">Problem</th>
                                <th class="th-sm">Before Problem</th>
                                <th class="th-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                              @foreach ($concerns as $data)
                                 <tr>
                                <td>{{$data->ticket}}</td>
                                <td>{{$data->created_at}}</td>
                                 <td>
                                    @foreach ($data->users as $key => $user)
                                      <a>{{ $user->name() }}</a>
                                          {{ $key < count($data->users) - 1 ? ', ' : ''  }}
                                        @endforeach  
                                  </td>   
                                   <td>
                                    @foreach ($data->users as $key => $user)
                                      <a>{{ $user->name() }}</a>
                                          {{ $key < count($data->users) - 2 ? ', ' : ''  }}
                                        @endforeach  
                                  </td>   

                                <td>{{$data->prob_category}}</td>
                                <td>{{$data->sub_category}}</td>
                                <td>{{$data->priority}}</td>
                                <td>{{$data->status}}</td>
                                 <td><pre>{{$data->problem}}<pre></td>
                                <td><pre>{{$data->before}}<pre></td>






                                <td>
                                    <a href="{{route('admin.concern.edit', $data->id)}}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a>
                                   
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
