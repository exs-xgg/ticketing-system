<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Section;
use App\Quiz;
use App\Course;
use App\Assignment;
use carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('instructor_id', $user->id)->where('course_id', $course->id)->findOrFail($id);

        // $students = User::where('role', 'student')->where('course_id', $course_id)->where('section_id', $id)->latest()->get();

        return view('instructor.student.index', compact('course', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id, $section_id, $student_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('instructor_id', $user->id)->where('course_id', $course->id)->findOrFail($section_id);

        $student = $section->users()->findOrFail($student_id);

        $quizzes = Quiz::where('instructor_id', $section->instructor_id)->where('course_id', $course->id)->where('isActive', true)->get();

        $assignments = Assignment::where('instructor_id', $section->instructor_id)->where('course_id', $course->id)->where('isActive', true)->get();

        return view('instructor.student.show', compact('course', 'section', 'student', 'quizzes', 'assignments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
