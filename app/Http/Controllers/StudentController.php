<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concern;
use Auth;
use DateTime;
use carbon\Carbon;

class StudentController extends Controller
{
    public function announcement($course_id, $section_id)
    {

        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.announcement', compact('user','course', 'section'));
    }

    public function lesson_index($course_id, $section_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.lesson.index', compact('user','course', 'section'));
    }

    public function lesson_show($course_id, $section_id, $lesson_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->whereHas('lessons', function ($query) use ($lesson_id) {
            $query->where('lesson_id', $lesson_id);
        })->findOrFail($section_id);

        $lesson = $section->lessons()->findOrFail($lesson_id);

        return view('student.lesson.show', compact('user','course', 'section', 'lesson'));
    }

    public function quiz_index($course_id, $section_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);


        return view('student.quiz.index', compact('user','course', 'section'));
    }

    public function quiz_show($course_id, $section_id, $quiz_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        $quiz = $section->quizzes()->findOrFail($quiz_id);

        if(Carbon::parse($quiz->startDate)->isFuture() || Carbon::parse($quiz->expireDate)->isPast()){
            session()->flash('status', 'Not Available');
            session()->flash('type', 'error');
            return view('student.quiz.index', compact('user','course', 'section'));
        }

        $checkTake = Take::where('user_id', $user->id)->where('quiz_id', $quiz_id)->where('section_id', $section_id)->first();

        if($checkTake)
        {
            session()->flash('status', 'Invalid');
            session()->flash('type', 'error');
            return view('student.quiz.index', compact('user','course', 'section'));
        }


        $csqu = $course->id.''.$section->id.''.$quiz->id.''.$user->id;

        return view('student.quiz.show', compact('user','course', 'section', 'quiz', 'csqu'));
    }

    public function lesson_download($course_id, $section_id, $lesson_id){

        $entry = Lesson::findOrFail($lesson_id);
        $filename = substr($entry->upload_file, 11);
        $pathToFile = storage_path()."/app/public/files/".$entry->upload_file;
        return response()->download($pathToFile, $filename);
    }

    public function section_index($course_id, $section_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.section', compact('user','course', 'section'));
    }

    public function assignment_index($course_id, $section_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.assignment.index', compact('user','course', 'section'));
    }

    public function assignment_show($course_id, $section_id, $assignment_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('isActive', true)->where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        $checkPass = Pass::where('user_id', $user->id)->where('assignment_id', $assignment_id)->where('section_id', $section_id)->first();

        if($checkPass)
        {
            session()->flash('status', 'You already passed your assignment');
            session()->flash('type', 'error');
            return view('student.assignment.index', compact('user','course', 'section'));
        }

        // foreach($section->assignments as $assignment){
        //     // $date = new DateTime($assignment->expireDate);
        //     // $now = new DateTime();

        //     $date = new Carbon($assignment->expireDate);

        //     if($date->isPast()) {
        //         session()->flash('status', 'Expired deadline');
        //         session()->flash('type', 'error');
        //         return view('student.assignment.index', compact('user','course', 'section'));
        //     }
        // }

        $assignment = $section->assignments()->where('isActive', true)->findOrFail($assignment_id);

        $date = new Carbon($assignment->expireDate);

        if($date->isPast()) {
            session()->flash('status', 'Expired deadline');
            session()->flash('type', 'error');
            return view('student.assignment.index', compact('user','course', 'section'));
        }

        return view('student.assignment.show', compact('user','course', 'section', 'assignment'));
    }

    // check_token
    public function check_token(Request $request)
    {
        $token = Token::where('token', $request->token)->where('status', true)->whereHas('section', function($e){
            $e->where('isActive', true);
        })->whereHas('course', function($e){
            $e->where('status', true);
        })->first();
        

        if(isset($token)){
            if(Carbon::parse($token->expireDate)->isPast()){
                session()->flash('status', 'Token already expired!');
                session()->flash('type', 'error');
                return redirect()->back();
            } elseif ($token->token == $request->token){
                return redirect()->route('student.course.add', $token->token);
            }
        }
        session()->flash('status', 'Invalid token!');
        session()->flash('type', 'error');
        return redirect()->back();
    }

    public function course_add($token)
    {
        $section = Token::where('token', $token)->where('status', true)->whereHas('course', function($e){
            $e->where('status', true);
        })->firstOrFail();

        if(isset($section)){
            if(Carbon::parse($section->expireDate)->isPast()){
                session()->flash('status', 'Token already expired');
                session()->flash('type', 'error');
                return redirect()->back();
            } elseif($section->token == $token){
                return view('student.course.add', compact('section'));
            }
            session()->flash('status', 'Invalid token');
            session()->flash('type', 'error');
            return redirect()->back();
        }
    }

    public function register_store(Request $request, $section)
    {
        $user = Auth::user();

        $checkSection = $user->sections()->where('section_id', $section)->where('user_id', $user->id)->first();

        // return $checkSection;

        if($checkSection){
            session()->flash('status', 'Already registered');
            session()->flash('type', 'error');
            return redirect()->route('student.dashboard');
        }

        $user->sections()->sync($request->sections, false);



        session()->flash('status', 'Success');
        session()->flash('type', 'success');
        return redirect()->route('student.dashboard');
    }

}
