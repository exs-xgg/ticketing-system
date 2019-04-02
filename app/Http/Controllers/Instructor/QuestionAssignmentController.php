<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Assignment;
use Auth;
use App\Course;
use App\Question;
use Carbon\carbon;

class QuestionAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id, $assignment_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);

         $questions = Question::where('assignment_id', $assignment->id)->get();

         return view('instructor.question.assignment.index', compact('course', 'assignment', 'questions'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id, $assignment_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);

        return view('instructor.question.assignment.create', compact('course', 'assignment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id, $assignment_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);

         $request->validate([
             'question' => 'required|string|max:255',
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
         }

         $question = new Question;
         $question->assignment_id = $assignment->id;
         $question->question = $request->question;
         $question->question_image = $name ?? "";
         $question->correct = $request->correct;
         $question->option_one = $request->option_one;
         $question->option_two = $request->option_two;
         $question->option_three = $request->option_three;
         $question->save();

         session()->flash('status', 'Successfully saved!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.question.assignmentCreate', [$course->id, $assignment->id]);
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
    public function edit($course_id, $assignment_id, $question_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);

         $question = Question::where('assignment_id', $assignment->id)->findOrFail($question_id);

         return view('instructor.question.assignment.edit', compact('course', 'assignment', 'question'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $assignment_id, $question_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);
         $question = Question::where('assignment_id', $assignment->id)->findOrFail($question_id);

         $request->validate([
             'question' => 'required|string|max:255',
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
         }

         $question->question = $request->question;
         $question->question_image = $name ?? "";
         $question->correct = $request->correct;
         $question->option_one = $request->option_one;
         $question->option_two = $request->option_two;
         $question->option_three = $request->option_three;
         $question->save();

         session()->flash('status', 'Successfully added!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.question.assignmentIndex', [$course->id, $assignment->id]);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $assignment_id, $question_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);
         $question = Question::where('assignment_id', $assignment->id)->findOrFail($question_id);
        
         $question->delete();

         session()->flash('status', 'Successfully Deleted!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.question.assignmentIndex', [$course->id, $assignment->id]);
     }
}
