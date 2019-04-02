@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>My files</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row mt-3">
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="card">
                            <div class="text-white blue text-center py-4 px-4">
                                <i class="fa fa-file fa-3x tiles-left-icon"></i>
                                <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($files)) }}</strong></h2>
                                <h2 class="text-uppercase text-white text-oswald">File{{ count($files) > 1 ? 's' : '' }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                        <div class="card">
                            <div class="card-header text-white bg-primary">
                                <h5 class="text-oswald mb-0 text-left">Upload File</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('my_files.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                            <span>File type supported: pdf, doc, ppt, xls, docx, pptx, xlsx, rar, zip, max:10MB</span>
                                        <div class="md-form">
                                            <div class="file-field">
                                                <div class="btn btn-primary btn-sm float-left ml-0">
                                                    <span><i class="fa fa-file"></i> Choose File</span>
                                                    <input type="file" name="file_upload">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path" type="text" placeholder="File name" readonly>
                                                </div>
                                            </div>
                                            
                                            @if ($errors->has('file_upload'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file_upload') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-upload"></i> Upload</button>
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body pb-0">
                                <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($files as $key => $file)
                                            <tr>
                                                <td>{{ substr($file->name, 11) }}</td>
                                                <td>{{ $file->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <a href="{{route('my_files.download', $file->id)}}" class="blue-text mr-3" data-toggle="tooltip" title="Download" data-placement="left"><i class="fa fa-download"></i></a>
                                                    <a href="javascript:void(0);" data-href="{{ route('my_files.destroy', $file->id) }}" class="perma_delete text-danger" data-placement="left" data-method="delete" data-from="course" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> 
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
