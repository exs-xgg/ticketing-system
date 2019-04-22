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
                    <form action="{{route('admin.faq.store')}}" method="post">
                        {{ csrf_field() }}
        
                       <div class="md-form">
                             <select class="select-wrapper mdb-select" name="prob_category" id="prob_category">
                                  <option value="" selected>Select</option>
                                  <option value="Technical" {{ old('prob_category') == 'Technical' ? 'selected' : ''}}>Technical</option>
                                  <option value="PCB" {{ old('prob_category') == 'PCB' ? 'selected' : ''}}>PCB</option>
                                  <option value="Eclaims" {{ old('prob_category') == 'Eclaims' ? 'selected' : ''}}>Eclaims</option>
                                 <option value="HPP" {{ old('prob_category') == 'HPP' ? 'selected' : ''}}>HPP</option>        
                              </select>
                                <label for="prob_category">Problem Category</label>
                            </div>

                         <div class="md-form">
                             <select class="select-wrapper mdb-select" name="sub_category" id="sub_category">
                                  <option value="" selected>Select</option>
                                  <option value="Technical" {{ old('sub_category') == 'Technical' ? 'selected' : ''}}>Technical</option>
                                  <option value="PCB" {{ old('sub_category') == 'PCB' ? 'selected' : ''}}>PCB</option>
                                  <option value="Eclaims" {{ old('sub_category') == 'Eclaims' ? 'selected' : ''}}>Eclaims</option>
                                 <option value="HPP" {{ old('sub_category') == 'HPP' ? 'selected' : ''}}>HPP</option>        
                              </select>
                                <label for="sub_category">Sub-Category</label>
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
