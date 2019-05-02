@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Concern</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Update Concern</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('student.concern.update', $concern->id)}}" method="post">
                        {{ csrf_field() }} {{method_field('PUT')}}

        
                    <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                
                <div class="md-form">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Problem:</strong>
                   <textarea type="text" name="problem" rows="5" id="problem" class="form-control rounded-0 {{$errors->has('problem') ? 'is-invalid' : ''}}">{{ $concern->problem }}</textarea>
                </div>
            </div>
                <div class="md-form">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Before Problem:</strong>
                     <textarea type="text" name="before" rows="5" id="before" class="form-control rounded-0 {{$errors->has('before') ? 'is-invalid' : ''}}">{{ $concern->before }}</textarea>
                </div>
            </div>

            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


      
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
    $('.mdb-select').material_select();
    $('.multiple-select').select2();
  
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });

</script>
@endsection
