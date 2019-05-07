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
                    <form action="{{route('admin.concern.store')}}" method="post">
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
                                  <option value="Network/Connection" {{ old('sub_category') == 'Network/Connection' ? 'selected' : ''}}>Technical- Network/Connection</option>
                                  <option value="Server/Backup" {{ old('sub_category') == 'Server/Backup' ? 'selected' : ''}}>Technical- Server/Backup</option>
                                  <option value="Performance Issue" {{ old('sub_category') == 'Performance Issue' ? 'selected' : ''}}>Technical- Performance Issue</option>
                                 <option value="Submission Statistics" {{ old('sub_category') == 'Submission Statistics' ? 'selected' : ''}}>PCB- Submission Statistics</option>        
                
                              <option value="Resubmission Request" {{ old('sub_category') == 'Resubmission Request' ? 'selected' : ''}}>PCB- Resubmission Request</option>        
                              
                               <option value="Cipher Keys" {{ old('sub_category') == 'Cipher Keys' ? 'selected' : ''}}>Eclaims- Cipher Keys</option>        
                              
                              <option value="Error Encountered" {{ old('sub_category') == 'Error Encountered' ? 'selected' : ''}}>Eclaims- Error Encountered</option>        
                              
                              <option value="Module 2 Training" {{ old('sub_category') == 'Module 2 Training' ? 'selected' : ''}}>HPP- Module 2 Training</option>        
                              
                              <option value="Module 1 Training" {{ old('sub_category') == 'Module 1 Training' ? 'selected' : ''}}>HPP- Module 1 Training</option>        
                              
                              <option value="Module 1&2 Training" {{ old('sub_category') == 'Module 1&2 Training' ? 'selected' : ''}}>HPP- Module 1&2 Training</option>        
                            
                               <option value="New Site" {{ old('sub_category') == 'New Site' ? 'selected' : ''}}>HPP- New Site</option>        
                              
                              <option value="Refresher Training" {{ old('sub_category') == 'Refresher Training' ? 'selected' : ''}}>HPP- Refresher Training</option>        
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
                            <label class="select2Label">What happened before encountering the problem?</label>
                            <textarea type="text" id="before" name="before" rows="5" class="form-control rounded-0 {{$errors->has('before') ? 'is-invalid' : ''}}">{{old('before')}}</textarea>
                            @if ($errors->has('before'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('before') }}</strong>
                            </span>
                            @endif
                        </div>

                        <p class="select2Label mb-0 mt-3">Assign to Receiver 1</p>
                        <div class="md-form mt-0">
                            <select class="select-wrapper mdb-select" id="receiver1" name="receiver1" style="width:100% !important;">
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ $admin->id === old('admin') ? 'selected' : ''  }}>{{ $admin->name() }}</option>
                                @endforeach
                            </select>
                        </div>

                          <p class="select2Label mb-0 mt-3">Reporter</p>
                        <div class="md-form mt-0">
                            <select class="select-wrapper mdb-select" id="reporter" name="reporter" style="width:100% !important;">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $client->id === old('clients') ? 'selected' : ''  }}>{{ $client->name() }}</option>
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
    $('.mdb-select').material_select();
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!! json_encode(old('admins')) !!}).trigger('change');
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });

</script>
@endsection
