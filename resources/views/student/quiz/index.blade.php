@extends('layouts.app')

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
    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-book fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ count($section->quizzes) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Quiz{{ count($section->quizzes) > 1 ? 'zes' : '' }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">
            <span class="text-italize"><i class="fa fa-info"></i> When you take a quiz, time limit will start, when time limit expire unanswered questions will be automaticaly submitted even if you leave the quiz area.</span>
            <div class="table-responsive">
                <table class="table text-nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quiz</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th>Result</th>
                            <th>Time limit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section->quizzes as $key => $quiz)
                        <tr>
                            <th>{{ $key+1 }}.</th>
                            <td>
                                {{-- <a href=""> --}}
                                    {{-- <strong>{{ $quiz->isCode ? 'Code Quiz:' : '' }}</strong>  --}}
                                    {{ substr($quiz->title, 0, 100) }}{{ strlen($quiz->title) > 100 ? "..." : "" }}
                                {{-- </a> --}}
                            </td>
                            <td>
                                {{$quiz->startDate ? $quiz->startDate->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                {{ $quiz->expireDate ? $quiz->expireDate->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                @if($quiz->takes($section->id, Auth::id()))
                                    @if ($quiz->isCode)
                                        @if ($quiz->takes($section->id, Auth::id())->result)
                                            <h4 class="text-oswald {{ $quiz->takes($section->id, Auth::id())->result == 0 ? 'red-text' : 'green-text' }}">
                                                {{ $quiz->takes($section->id, Auth::id())->result }}
                                            </h4>
                                        @else
                                            No result yet
                                        @endif
                                    @else
                                        <h4 class="text-oswald {{ $quiz->takes($section->id, Auth::id())->result <= 0 ? 'red-text' : 'green-text' }}">
                                            {{$quiz->takes($section->id, Auth::id())->result}}/{{count($quiz->questions)}}
                                        </h4>
                                    @endif
                                @else 
                                    <p class="red-text">No Quiz</p>
                                @endif                             
                            </td>
                            <td>{{$quiz->timeLimit ?? 0}} minutes</td>
                            {{-- <td>{{$quiz->takes()->result ?? ''}}/{{count($quiz->questions)}}</td> --}}
                            <td>
                                @if ($quiz->checktakes($section->id))
                                    <p class="green-text"><i class="fa fa-check"></i></p>
                                @elseif(Carbon\Carbon::parse($quiz->startDate)->isFuture())
                                    <p class="red-text">Not Yet Available</p>
                                @elseif(Carbon\Carbon::parse($quiz->expireDate)->isPast())
                                    <p class="red-text">Expired</p>
                                @elseif($quiz->isCode)
                                    <a class="blue-text take" href="javascript:void(0);" data-href="{{route('student.quiz.show', [$course->id, $section->id, $quiz->id])}}">Take</a>
                                @elseif(count($quiz->questions) == 0)
                                    <p class="red-text">Unavailable</p>
                                @else
                                    <a class="blue-text take" href="javascript:void(0);" data-href="{{route('student.quiz.show', [$course->id, $section->id, $quiz->id])}}">Take</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.take', function(e) {
                e.preventDefault();
                var $this = $(this);
                swal({
                    title: 'Good luck.',
                    text: 'You can only take this quiz once!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Continue'
                }).then((result) => {
                    if (result.value) {
                        window.location = $this.data('href');
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
        });
    </script>
@endsection
