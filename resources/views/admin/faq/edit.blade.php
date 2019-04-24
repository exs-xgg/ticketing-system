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
   
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
           
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.faq.index') }}"> Back</a>
            </div>
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>UPDATE FREQUENTLY ASK QUESTION</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Update FAQ</h5>
                </div>
    <form action="{{ route('admin.faq.update',$faq->id) }}" method="POST">
        @csrf
        @method('PUT')



                         



           <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                
                <div class="md-form">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Problem:</strong>
                   <textarea type="text" name="problem" rows="5" id="problem" class="form-control rounded-0 {{$errors->has('problem') ? 'is-invalid' : ''}}">{{ $faq->problem }}</textarea>
                </div>
            </div>
                <div class="md-form">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Solution:</strong>
                     <textarea type="text" name="solution" rows="5" id="solution" class="form-control rounded-0 {{$errors->has('solution') ? 'is-invalid' : ''}}">{{ $faq->solution }}</textarea>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
   
    </form>
@endsection
@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
      $('.mdb-select').material_select();
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
