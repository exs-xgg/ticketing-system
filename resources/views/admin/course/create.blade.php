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
                    <h5 class="text-oswald mb-0">Add Concern</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.course.store')}}" method="post">
                        {{ csrf_field() }}
        
                        <div class="md-form">
                            <input type="text" name="name" id="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{old('name')}}">
                            <label for="name">Problem Category <span class="red-asterisk">*</span></label>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

        
                        <div class="md-form">
                            <input type="text" name="code" id="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}" value="{{old('code')}}">
                            <label for="code">Sub-category</label>
                            @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="form-group">
                            <label class="select2Label">Problem</label>
                            <textarea type="text" id="description" name="description" rows="5" class="form-control rounded-0 {{$errors->has('description') ? 'is-invalid' : ''}}">{{old('description')}}</textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <p class="select2Label mb-0 mt-3">Assign Resolver</p>
                        <div class="md-form mt-0">
                            <select class="multiple-select form-control" multiple="multiple" id="instructors" name="instructors[]" style="width:100% !important;">
                                @foreach ($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ $instructor->id === old('instructors') ? 'selected' : ''  }}>{{ $instructor->name() }}</option>
                                @endforeach
                            </select>
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
