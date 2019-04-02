@extends('layouts.app')

@section('styles')
    <link href="{{ asset('SmartWizard/dist/css/smart_wizard_theme_dots.css') }}" rel="stylesheet">
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
        <div class="col-lg-10 col-md-12 mb-3">
            @if ($quiz->timeLimit > 0)
            <h4 class="text-oswald text-center"><span id="divCounter"></span> minutes</h4>
            @endif

            @if (!$quiz->isCode)
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">{{ $quiz->title }}</h5>
                </div>
                <div class="card-body">
                    <form id="take-quiz-form-{{$quiz->id}}" action="{{route('student.take.store', [$course->id, $section->id, $quiz->id])}}" method="POST">
                        @csrf
                        <div id="smartwizard">
                            <ul>
                                <?php $i = 1; ?>
                                @foreach($quiz->questions as $question)
                                <li><a href="#step-{{$i}}">Q {{$i}}</a></li>
                                <?php $i++; ?>
                                @endforeach
                            </ul>
                            {{-- <hr class="my-0"> --}}
                            <div class="pt-3 pl-3">
                                <?php $i = 1; ?>
                                @foreach($quiz->questions as $question)
                                <div id="step-{{$i}}" class="">
                                    <p>{{ $i }}. {{$question->question}} ?</p>
                                    <input type="hidden" name="questions[{{ $i }}]" value="{{ $question->id }}">
                                    <img src="{{asset('storage/images/'.$question->question_image)}}" alt="" class="img-fluid mb-3 z-depth-1">
    
                                    @php
                                    if($question->option_one == '' && $question->option_two == '' && $question->option_three == ''){
                                        $choices = [$question->correct];
                                    } else {
                                        $choices = [
                                        $question->correct,
                                        $question->option_one,
                                        $question->option_two,
                                        $question->option_three
                                        ];
                                    }
                                    shuffle($choices);
                                    @endphp
    
                                    @if (count($choices) == 1)
                                        <div class="md-form">
                                            <input type="text" name="answers[{{ $question->id }}]" value="" class="form-control" id="choices{{ $question->id }}">
                                            <label for="choices{{ $question->id }}">Answer</label>
                                        </div>
                                    @else
                                        @foreach($choices as $key => $option)
                                            @if (!empty($option))
                                                <div class="form-check pl-0">
                                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" class="form-check-input" id="choices{{ $key.''.$question->id }}">
                                                    <label class="form-check-label" for="choices{{ $key.''.$question->id }}">{{ $option }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <?php $i++; ?>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else 
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <strong>{{ $quiz->title }}</strong>
                                <p>{{ $quiz->content }}</p>
                                {{-- <img src="{{ $question->question_image ? asset('storage/images/'.$question->question_image) : ''}}" class="z-depth-1" style="object-fit:cover;height:100px;width:100px;" alt=""> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form id="take-quiz-form-{{$quiz->id}}" action="{{ route('student.take.storeCodeQuiz', [$course->id, $section->id, $quiz->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <p class="select2Label">Code <span class="red-asterisk">*</span></p>
                                        <textarea type="text" id="code" name="code" rows="15" class="form-control rounded-0 {{$errors->has('code') ? 'is-invalid' : ''}}" rows="3">{{old('code')}}</textarea>
                                        @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <p class="mb-1">Stdin Inputs</p>
                                        <textarea name="stdin" id="stdin" class="form-control rounded-0 pt-0" rows="3">{{old('stdin')}}</textarea>
                                    </div>
                                    <a id="execute" class="btn btn-info"><i class="fa fa-save"></i> Execute</a>
                                </form>
                            </div>
                        </div>
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
                <button type="submit" name="button" class="btn btn-primary mt-4 float-right finish"><i class="fa fa-check"></i> Finish</button>
            @endif
        </div>
    </div>
</div>    
@endsection

@section('script')
<script src="{{asset('SmartWizard/dist/js/jquery.smartWizard.js')}}"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.finish', function(e) {
            e.preventDefault();
            var $this = $(this);
            swal({
                title: 'Are you sure you want to finish this quiz?',
                // text: 'You can only take this quiz once!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    window.onbeforeunload = null;
                    document.getElementById('take-quiz-form-{{$quiz->id}}').submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    toast({
                        type: 'error',
                        title: 'Cancelled.'
                    })
                }
            })   
        });
        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,  // Initial selected step, 0 = first step
            keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            autoAdjustHeight:true, // Automatically adjust content height
            cycleSteps: false, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            useURLhash: true, // Enable selection of the step based on url hash
            lang: {  // Language variables
                  next: 'Next',
                  previous: 'Previous'
            },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                toolbarExtraButtons: [
                    $('<button></button>').text('Finish').addClass('btn btn-info finish')
                ]
            },
            anchorSettings: {
                anchorClickable: true, // Enable/Disable anchor navigation
                enableAllAnchors: false, // Activates all anchors clickable all times
                markDoneStep: true, // add done css
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            },
            contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
            disabledSteps: [],    // Array Steps disabled
            errorSteps: [],    // Highlight step with errors
            theme: 'dots',
            transitionEffect: 'fade', // Effect on navigation, none/slide/fade
            transitionSpeed: '400'
        });

        $('.step-anchor').removeClass('nav-tabs');
        $('.sw-btn-group-extra').addClass('mt-3');
        $('.sw-btn-group').addClass('mt-3');

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

    //var hoursleft = 0;
    var minutesleft = {{ $quiz->timeLimit }}; //give minutes you wish
    var secondsleft = 00; // give seconds you wish
    var finishedtext = "Countdown finished!";
    var end1_{{$csqu}};
    if(localStorage.getItem("end1_{{$csqu}}")) {
        end1_{{$csqu}} = new Date(localStorage.getItem("end1_{{$csqu}}"));
    } else {
        end1_{{$csqu}} = new Date();
        end1_{{$csqu}}.setMinutes(end1_{{$csqu}}.getMinutes()+minutesleft);
        end1_{{$csqu}}.setSeconds(end1_{{$csqu}}.getSeconds()+secondsleft);
    }
    var counter = function () {
    var now = new Date();
    var diff = end1_{{$csqu}} - now;

    diff = new Date(diff);

    var milliseconds = parseInt((diff%1000)/100)
        var sec = parseInt((diff/1000)%60)
        var mins = parseInt((diff/(1000*60))%60)
        //var hours = parseInt((diff/(1000*60*60))%24);

    if (mins < 10) {
        mins = "0" + mins;
    }
    if (sec < 10) {
        sec = "0" + sec;
    }
    if(now >= end1_{{$csqu}}) {
        clearTimeout(interval);
        // localStorage.setItem("end", null);
            localStorage.removeItem("end1_{{$csqu}}");
            localStorage.clear();
        document.getElementById('divCounter').innerHTML = finishedtext;
        //  if(confirm("TIME UP!")){
            window.onbeforeunload = null;

                document.getElementById('take-quiz-form-{{$quiz->id}}').submit();
        //  }
    } else {
        var value = mins + ":" + sec;
        localStorage.setItem("end1_{{$csqu}}", end1_{{$csqu}});
        document.getElementById('divCounter').innerHTML = value;
    }
    }
    var interval = setInterval(counter, 1000);


    window.onbeforeunload = function() {
            return true;
    };

    $('#take-quiz-form-{{$quiz->id}}').on('submit', function(){
        window.onbeforeunload = null;
    });

    </script>
@endsection
