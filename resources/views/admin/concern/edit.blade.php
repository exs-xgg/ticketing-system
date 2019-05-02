@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Courses</h3>
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
                    <form action="{{route('concern2.store', $concern->id)}}" method="post">
                        {{ csrf_field() }} 

                        <input type="hidden" id="custId" name="concerns_id" value="{{$concern->id}}">
        
                       <div class="md-form">
                             <select class="select-wrapper mdb-select" name="priority" id="priority">
                                  <option value="" selected>Select</option>
                                  <option value="level 1" {{ old('priority') == 'level 1' ? 'selected' : ''}}>Level 1(within 24 hours)</option>
                                  <option value="level 2" {{ old('priority') == 'level 2' ? 'selected' : ''}}>Level 2(2-3 days)</option>
                                  <option value="level 3" {{ old('priority') == 'level 3' ? 'selected' : ''}}>Level 3(4 and above)</option>      
                              </select>
                                <label for="priority">Priority level</label>
                            </div>

                         <div class="md-form">
                             <select class="select-wrapper mdb-select" name="status" id="status">
                                  <option value="" selected>Select</option>
                                  <option value="Ongoing" {{ old('sub_category') == 'Ongoing' ? 'selected' : ''}}>Ongoing</option>
                                  <option value="Resolved" {{ old('sub_category') == 'Resolved' ? 'selected' : ''}}>Resolved</option>
                                 <option value="Closed" {{ old('sub_category') == 'Closed' ? 'selected' : ''}}>Closed</option>        
                              </select>
                                <label for="status">Status</label>
                        </div>
                                 <div class="form-group">
                            <label class="select2Label">Remarks</label>
                            <textarea type="text" id="remark" name="remark" rows="5" class="form-control rounded-0 {{$errors->has('remark') ? 'is-invalid' : ''}}">{{old('remark')}}</textarea>
                            @if ($errors->has('remark'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('remark') }}</strong>
                            </span>
                            @endif
                        </div>

          
                     <p class="select2Label mb-0 mt-3">Assign to Receiver 2</p>
                        <div class="md-form mt-0">
                            <select class="select-wrapper mdb-select" id="receiver2" name="receiver2" style="width:100% !important;">
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ $admin->id === old('admin') ? 'selected' : ''  }}>{{ $admin->name() }}</option>
                                @endforeach
                            </select>
                        </div>


        
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-pencil"></i> Update</button>
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
