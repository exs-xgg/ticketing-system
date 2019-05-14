@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<style media="screen">
    .mdb-feed {
            margin: 0 !important
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-8 col-md-10 mb-5 pb-5">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Update Announcement</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{route('instructor.announcement.update', [$course->id, $announcement->id])}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }} {{method_field('PUT')}}
        
                        <div class="form-group mb-3">
                            <label class="select2Label">Message <span class="red-asterisk">*</span></label>
                            <textarea type="text" id="message" name="message" class="form-control rounded-0 {{$errors->has('message') ? 'is-invalid' : ''}}" rows="3">{{$announcement->message}}</textarea>
                            @if ($errors->has('message'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="md-form mt-0">
                                    <div class="file-field">
                                        <div class="btn btn-primary btn-md float-left ml-0">
                                            <span><i class="fa fa-file-image"></i> Upload image</span>
                                            <input type="file" name="image" onchange="previewFile()">
                                        </div>
                                    </div>
                                    
                                    @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        @if ($announcement->image)
                            <img id="img-announcement" class="img-preview z-depth-1 {{ $announcement->image ? 'mb-3' : '' }}" style="height:500px;width:100%;object-fit:cover";>
                        @else
                            <img id="img-announcement" class="img-preview z-depth-1 {{ $announcement->image ? 'mb-3' : '' }}">
                        @endif
                        <p class="mb-0 select2Label">Assign Section <span class="red-asterisk">*</span></p>
                        <div class="md-form mt-0">
                            <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" style="width:100% !important;">
                                @foreach ($sections as $section2)
                                <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="checkbox">Post to all</label>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary mt-3 float-right"><i class="fa fa-share-square"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!!json_encode($announcement->sections()->allRelatedIds()) !!}).trigger('change');
    $("#checkbox").on('click',function(){
        if($("#checkbox").is(':checked') ){
            $('.multiple-select').select2('destroy').find('option').prop('selected', 'selected').end().select2();
        }else{
            $('.multiple-select').select2('destroy').find('option').prop('selected', false).end().select2();
        }
    });
    function previewFile(){
        var preview = document.querySelector('.img-preview'); //selects the query named img
        var file    = document.querySelector('input[type=file]').files[0]; //sames as here
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            document.getElementById('img-announcement').style.height = "500px";
            document.getElementById('img-announcement').style.width = "100%";
            document.getElementById('img-announcement').style.objectFit = "cover";
            document.getElementById('img-announcement').style.marginBottom = "1rem";
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
            preview.src = "{{$announcement->image ? asset('storage/images/'.$announcement->image) : ''}}";
        }

    }

    previewFile();  //calls the function named previewFile()
</script>
@endsection
