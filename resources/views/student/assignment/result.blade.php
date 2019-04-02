@extends('layouts.app')

@section('styles')
    <style>
        .nav-tabs{
            background-color: white !important;
            color: black !important;
        }
        .nav-tabs .nav-link.active {
            color: black !important
        }
        .nav-tabs .nav-link {
            color: black !important
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
            <div class="post-prev-info mb-0">
                {{ $section->name }}
            </div>
            <hr class="mt-0">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h4 class="text-oswald">{{ $assignment->title }}</h4>
                            {!! $assignment->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-12 mt-3">
            @if(!$assignment->isCode)
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-5">
                                <h4 class="text-oswald text-center py-3">My Assignment</h4>
                                {!! $assignment->checkpasses($section->id)->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <h4 class="text-oswald text-center py-3">My Assignment</h4>
                            <p class="select2Label">Code</p>
                            <textarea type="text" id="code" name="code" rows="15" class="form-control rounded-0" rows="3" readonly>{!! $assignment->checkpasses($section->id)->content !!}</textarea>
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
        </div>
    </div>
</div>    
@endsection

@section('script')
    @include('partials.notification')
    <script>
        $(document).ready(function() {
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