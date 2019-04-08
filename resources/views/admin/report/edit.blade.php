@extends('layouts.app')
   
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
    <form action="{{ route('amin.faq.update',$faq->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <div class="md-form">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Problem Category:</strong>
                    <input type="text" name="prob_category" value="{{ $faq->prob_category }}" class="form-control" >
                </div>
            </div>
           
           <div class="md-form">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sub Category:</strong>
                    <input type="text" name="sub_category" value="{{ $faq->sub_category }}" class="form-control" >
                </div>
            </div>
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
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection