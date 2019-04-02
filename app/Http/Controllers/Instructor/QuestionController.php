<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quiz;
use Auth;
use App\Course;
use App\Question;
use Carbon\carbon;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($course_id, $quiz_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isCode', false)->findOrFail($quiz_id);
         $questions = Question::where('quiz_id', $quiz->id)->get();
         return view('instructor.question.index', compact('course', 'quiz', 'questions'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id, $quiz_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isCode', false)->findOrFail($quiz_id);
        return view('instructor.question.create', compact('course', 'quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, $course_id, $quiz_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isCode', false)->findOrFail($quiz_id);
        
         if(!$quiz->isCode){
             $request->validate([
                'question' => 'required|string',
                'correct' => 'required|string',
            ]);
         } else {
            $request->validate([
                'item' => 'required|string',
                'correct' => 'nullable|string',
            ]);
         }
         
         $question = new Question;
         if ($request->hasFile('image')) {
             $request->validate([
                 'question_image' => 'bail|image|mimes:jpg,png,jpeg,gif,svg|max:10000',
             ]);
            
             $image = $request->image;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$image->getClientOriginalName();
            // $image->image = $name;
            $image->storeAs('public/images', $name);
            $question->question_image = $name;
         }

         
         $question->quiz_id = $quiz->id;
         $question->question = $quiz->isCode == 1 ? $request->item : $request->question;
         $question->correct = $quiz->isCode == 1 ? '' : $request->correct;
         $question->option_one = $quiz->isCode == 1 ? '' : $request->option_one;
         $question->option_two = $quiz->isCode == 1 ? '' : $request->option_two;
         $question->option_three = $quiz->isCode == 1 ? '' : $request->option_three;
         $question->save();

         session()->flash('status', 'Successfully saved');
         session()->flash('type', 'success');
         return redirect()->route('instructor.question.create', [$course->id, $quiz->id]);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($course_id, $quiz_id, $question_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isCode', false)->findOrFail($quiz_id);
         $question = Question::where('quiz_id', $quiz->id)->findOrFail($question_id);
         return view('instructor.question.edit', compact('course', 'quiz', 'question'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $course_id, $quiz_id, $question_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isCode', false)->findOrFail($quiz_id);
         $question = Question::where('quiz_id', $quiz->id)->findOrFail($question_id);

         $request->validate([
             'question' => 'required|string',
             'correct' => 'required|string',
         ]);

         if ($request->hasFile('image')) {
             $request->validate([
                 'question_image' => 'bail|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
             ]);
            
            $image = $request->image;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$image->getClientOriginalName();
            // $image->image = $name;
            $image->storeAs('public/images', $name);

            $question->question_image = $name;
         }

         $question->question = $request->question;
         $question->correct = $request->correct;
         $question->option_one = $request->option_one;
         $question->option_two = $request->option_two;
         $question->option_three = $request->option_three;
         $question->save();

         session()->flash('status', 'Successfully saved');
         session()->flash('type', 'success');

         return redirect()->route('instructor.question.index', [$course->id, $quiz->id]);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($course_id, $quiz_id, $question_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isCode', false)->findOrFail($quiz_id);
         $question = Question::where('quiz_id', $quiz->id)->findOrFail($question_id);

         $question->delete();

         session()->flash('status', 'Successfully deleted');
         session()->flash('type', 'success');
         return response('success', 200);    
     }
}
