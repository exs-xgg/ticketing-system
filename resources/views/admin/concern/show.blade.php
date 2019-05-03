@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="comment-form" method="post" action="{{ route('admin.concern.update' , $concern->id) }}" >
                        {{ csrf_field() }}  {{method_field('PUT')}}
                        <div class="row" style="padding: 10px;">
                            <div class="form-group">
                                <textarea class="form-control" name="comment" placeholder="Write something from your heart..!"></textarea>
                            </div>
                        </div>
                        <div class="row" style="padding: 0 10px 0 10px;">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" style="width: 100%" name="submit">
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>

                <div class="panel-body comment-container" >
                    
                   
                        <div class="well">
                            <i><b> {{ $concern->comment }} </b></i>&nbsp;&nbsp;
                            <span> {{ $concern->comment }} </span>
                            <span>{{ \Carbon\Carbon::parse($concern->created_at)}}</span>
                            <div style="margin-left:10px;">
                                <!-- <a style="cursor: pointer;" cid="{{ $concern->id }}" name_a="{{ Auth::user()->firstname }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp; -->
                                <a style="cursor: pointer;"  class="delete-concern" token="{{ csrf_token() }}" comment-did="{{ $concern->id }}" >Delete</a>
                                <div class="reply-form">
                                    
                                    <!-- Dynamic Reply form -->
                                    
                                </div>
                      
                                
                            </div>
                        </div>
                 

                </div>
            </div>
        </div>
    </div>

   

</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/main.js') }}">
  
</script>


