@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<style>
    .select2-results{
        border: 1px solid #ced4da !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Concerns</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Add FAQ</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('report.store')}}" method="post">
                        {{ csrf_field() }}
        
                        <div class="md-form">
                            <input type="text" name="prob_category" id="prob_category" class="form-control ">
                            <label for="name">Problem Category <span class="red-asterisk">*</span></label>
                            @if ($errors->has('prob_category'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('prob_category') }}</strong>
                            </span>
                            @endif
                        </div>

        
                        <div class="md-form">
                            <input type="text" name="sub_category" id="sub_category" class="form-control {{$errors->has('sub_category') ? 'is-invalid' : ''}}" value="{{old('sub_category')}}">
                            <label for="code">Sub_Category</label>
                            @if ($errors->has('sub_category'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sub_category') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="form-group">
                            <label class="select2Label">Problem</label>
                            <textarea type="text" id="problem" name="problem" rows="5" class="form-control rounded-0 {{$errors->has('problem') ? 'is-invalid' : ''}}">{{old('problem')}}</textarea>
                            @if ($errors->has('problem'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('problem') }}</strong>
                            </span>
                            @endif
                        </div>

                            <div class="form-group">
                            <label class="select2Label">Solution</label>
                            <textarea type="text" id="solution" name="solution" rows="5" class="form-control rounded-0 {{$errors->has('solution') ? 'is-invalid' : ''}}">{{old('solution')}}</textarea>
                            @if ($errors->has('solution'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('solution') }}</strong>
                            </span>
                            @endif
                        </div>
        
                    
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-save"></i> Save</button>
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
    $('.multiple-select').select2().val({!! json_encode(old('instructors')) !!}).trigger('change');
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });

</script>
@endsection
