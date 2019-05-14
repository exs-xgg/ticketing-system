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
     <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Frequently Asked Question</h3>
            </div>
            <a href="{{route('admin.faq.create')}}" class="btn btn-primary mr-0 my-0"><i class="fa fa-plus"></i> Add FAQ</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-list fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($faqs) )}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">FAQ{{ count($faqs) > 1 ? 's' : '' }}</h2>
                </div>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="table" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>

                                <th class="th-sm">Problem Category</th>
                                <th class="th-sm">Sub Category</th>
                                <th class="th-sm">Problem</th>
                                 <th class="th-sm">Solution</th>
                                <th class="th-sm">Action</th>
                            </tr>
                        </thead>
                           <tbody>
                            @foreach ($faqs as $faq)
                            <tr>
                                <td>{{$faq->prob_category }}</td>
                                <td>{{$faq->sub_category}}</td>
                                <td><pre>{{$faq->problem}}<pre></td>
                                <td><pre>{{$faq->solution}}<pre></td>
            <td>
                    <form action="{{ route('admin.faq.destroy',$faq->id) }}" method="POST">
   
    
                    <a class="btn btn-primary" href="{{ route('admin.faq.edit',$faq->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  

      
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
