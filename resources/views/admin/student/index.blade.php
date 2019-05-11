@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>HCI Accounts</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-2 justify-content-between">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class=""></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($clients) )}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">HCI Account{{ count($clients) > 1 ? 's' : '' }}</h2>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Health Facility</th>
                                <th>Registered Since</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($clients as $client)
                            <tr>
                                
                                <td>{{$client->name()}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->facility}}</td>
                                <td>{{date('F j, Y',strtotime($client->created_at))}}</td>
                                <td>

                                    <div class="switch">
                                        <label>
                                            Deativate
                                            <input class="active-mode-switch" type="checkbox" {{ $client->status ? 'checked' : '' }} clientId="{{ $client->id }}">
                                            <span class="lever"></span> Activate
                                        </label>
                                    </div>
                            
                                     
                                </td>
                                
                                
                            </tr>@endforeach
                           
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
            order:[]
        });

$('.active-mode-switch').change(function() {
                var status = 0;
                var id = $(this).attr('clientId');
                if ($(this).is(':checked')) {
                    status = 1;
                }


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/student/"+id+"/status",
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
