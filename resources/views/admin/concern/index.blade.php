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
            
          
                                
                   /* .level1{
                        color:  !important;
                    }
                    .level2{
                        color: !important;
                    }
                    .level3{
                        color: !important;
                    }
*/


      </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Concerns</h3>
            </div>
            <a href="{{route('admin.concern.create')}}" class="btn btn-primary mr-0 my-0"><i class="fa fa-plus"></i> Add concern</a>
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
                                <th class="th-sm">Reported By</th>
                                <th class="th-sm">Assigned To</th>
                                <th class="th-sm">Endorsed To </th>
                                <th class="th-sm">Problem Category</th>
                                <th class="th-sm">Sub Category</th>
                                <th class="th-sm">Priority</th>
                                <th class="th-sm">Status</th>
                                <th class="th-sm">Problem</th>
                                <th class="th-sm">Before Problem</th>
                                <th class="th-sm">Notes</th>
                                <th class="th-sm">Remarks</th>
                                <th class="th-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>

<!-- 
                            <?php
                            echo($concerns)
                            ?> -->

                              @foreach ($concerns as $data)
                                 <tr>
                                <td>{{$data->ticket}}</td>
                                <td>{{$data->created_at}}</td>
                                
                                <td>
                                {{ \App\User::where('email', $data->reporter)->value('firstName') }}
                                {{ \App\User::where('email', $data->reporter)->value('lastName') }}
                        </td>
                                 <td>

                                   <!--  @foreach ($data->users as $key => $user)

                                      <a>{{ $user->name() }}</a>
                                          {{ $key < count($data->users) - 1 ? ', ' : ''  }}
                                        @endforeach   -->
                                    {{$data->firstName}}  {{$data->lastName}}
                                  </td>   
                                   <td>
                                  <!--   @foreach ($data->users as $key => $user)
                                      <a>{{ $user->name() }}</a>
                                          {{ $key < count($data->users) - 2 ? ', ' : ''  }}

                                        @endforeach   -->
                                        {{ \App\User::where('id', $data->receiver2)->value('firstName') }}
                                        {{ \App\User::where('id', $data->receiver2)->value('lastName') }}
                                  </td>   


                                <td>{{$data->prob_category}}</td>
                                <td>{{$data->sub_category}}</td>

                                 <td
                                 class="
                                @if($data->priority == 'level 1(within 24 hours)') blue
                                @elseif($data->priority == 'level 2(2-3 days)') yellow 
                                @elseif($data->priority == 'level 3(4 and above)') amber
                                @endif">
                                {{ $data->priority }}</td>

                                <td>{{$data->status}}</td>
                                
                                 <td><pre>{{$data->problem}}<pre></td>
                                <td><pre>{{$data->before}}<pre></td>
                                       <td><pre>{{$data->comment}}<pre></td>
                                <td><pre>{{$data->remark}}</pre></td>

                                <td>
                                    <a href="{{route('admin.concern.edit', $data->id)}}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a>

                                    <a href="javascript:void(0);" data-href="{{ route('admin.concern.destroy', $data->id) }}" class="anchor_delete text-danger" data-method="delete" data-action="concern" data-from="concern" data-toggle="tooltip" title="Delete" data-placement="right"><i class="fa fa-trash"></i></a> 
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
 $('.mdb-select').material_select();
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
                search: "",
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
