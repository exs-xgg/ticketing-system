@extends('layouts.app')

@section('styles')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fwl1zems9tvf6ysxti5p5zrr86dawn4f0zdyzwoel3rjh9ok"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<script>
    tinymce.init({ 
        selector:'.isContent' 
    });
    </script>
@endsection

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

    <div class="row mt-3 justify-content-center">
        <div class="col-lg-10 col-md-12 mb-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h4 class="text-oswald">{{ $assignment->title }}</h4>
                            {!! $assignment->content !!}
                        </div>
                    </div>
                </div>
            </div>

            <form id="pass-assignment-form-{{$assignment->id}}" action="{{route('student.pass.store_assignment', [$course->id, $section->id, $assignment->id])}}" method="POST">
            @csrf
                @if (!$assignment->isCode)
                    <div class="form-group mb-3">
                        <p class="mb-1">Content <span class="red-asterisk">*</span></p>
                        <textarea name="content" id="content" class="form-control rounded-0 pt-0 {{$errors->has('content') ? 'is-invalid' : ''}} isContent" rows="15">{{old('content')}}</textarea>
                        {{-- <label for="content">Description</label> --}}
                        @if ($errors->has('content'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                        @endif
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <p class="mb-1">Code <span class="red-asterisk">*</span></p>
                                <textarea name="code" id="code" class="form-control rounded-0 pt-0" rows="15">{{old('code')}}</textarea>
                                {{-- <label for="code">Description</label> --}}
                                @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <p class="mb-1">Stdin Inputs</p>
                                <textarea name="stdin" id="stdin" class="form-control rounded-0 pt-0" rows="3">{{old('stdin')}}</textarea>
                            </div>
                            <a id="execute" class="btn btn-info"><i class="fa fa-save"></i> Run</a>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <p class="select2Label">Result...</p>
                                    <p id="result" style="white-space: pre-line"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <button type="submit" id="passAssignment" class="btn btn-primary float-right mt-4"><i class="fa fa-check"></i> Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            window.onbeforeunload = function() {
                return true;
            };
            $('#pass-assignment-form-{{$assignment->id}}').on('submit', function(){
                window.onbeforeunload = null;
            });
            $(document).on('click', '#passAssignment', function(e) {
                e.preventDefault();
                var $this = $(this);
                swal({
                    title: 'Are you sure you want to submit this assignment?',
                    // text: 'Are you sure you want to submit this assignment?!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        window.onbeforeunload = null;
                        $('#pass-assignment-form-{{$assignment->id}}').submit();
                    } else if (
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        const toast = swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        toast({
                            type: 'error',
                            title: 'Cancelled.'
                        })
                    }
                })   
            });
            $("#execute").click(function () {
                var _this = $(this);
                _this.html('<i class="fa fa-spinner fa-spin loading"></i> Running');
                var code = $("#code").val();
                var stdin = $("#stdin").val();
                var url = '{{ route('runCode') }}';
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {code: code, stdin, stdin},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        _this.attr('disabled', 'disable');
                    },
                    success: function(result) {
                        setTimeout(function () {
                            _this.html('<i class="fa fa-save"></i> Run');
                            result = JSON.parse(result);
                            $("#result").html(result.text);
                            $('#execute').attr('disabled');
                        }, 800);
                    },
                    error: function(result){
                        console.log(result);
                    },
                    complete: function() {
                        _this.removeAttr('disabled');
                    }
                })
            });
        });
    </script>
@endsection
