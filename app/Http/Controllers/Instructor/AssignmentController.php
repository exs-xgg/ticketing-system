<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Assignment;
use carbon\Carbon;
use Purifier;
use App\Pass;
use App\Mail\newAssignment;
use Illuminate\Support\Facades\Mail;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($course_id)
     {
         $user = Auth::user();
         $data['course'] = $user->courses()->findOrFail($course_id);
         $data['assignments'] = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->oldest()->get();
         return view('instructor.assignment.index', $data);
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($course_id)
     {
         $user = Auth::user();
         $data['course'] = $user->courses()->findOrFail($course_id);
         $data['sections'] = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();
         return view('instructor.assignment.create', $data);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, $course_id)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'content' => 'required|string',
             'startDate' => 'required|string|max:255',
             'expireDate' => 'required|string|max:255',
             'sections' => 'required'
         ]);
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);

         $assignment = new Assignment;
         $assignment->instructor_id = $user->id;
         $assignment->course_id = $course->id;
         $assignment->title = $request->title;
         $assignment->isCode = $request->has('codeAssignment');
         $assignment->content = Purifier::clean($request->content);
         $assignment->startDate = $request->formatted_startDate_submit;
         $assignment->expireDate = $request->formatted_expireDate_submit;
         $assignment->save();

         $assignment->sections()->sync($request->sections, false);
         $msg = 'There\'s a new assignment in your course '.$assignment->course->name;

        //  foreach($assignment->sections as $section){
        //     foreach($section->users as $user){
        //         if($user->mobileNumber){
        //             $mobile = $user->mobileNumber;
        //             $message = \App\Helpers\SMS::send($mobile, $msg);
        //         }
        //     }
        //     Mail::to($user->email)->send(new newAssignment($user, $assignment));
        // }

         session()->flash('status', 'Successfully saved');
         session()->flash('type', 'success');
         return redirect()->route('instructor.assignment.index', $course->id);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);
        $sections = Section::where('course_id', $course_id)->get();
        $section22 = array();
        foreach ($sections as $section2) {
            $section22[$section2->id] = $section2->title;
        }

        return view('instructor.assignment.show', compact('course', 'assignment', 'section22', 'sections'));
    }

    public function show_submit($course_id, $assignment_id, $section_id, $submit_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->findOrFail($section_id);
        $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);
        $submit = Pass::where('assignment_id', $assignment->id)->where('section_id', $section_id)->findOrFail($submit_id);

        return view('instructor.student.assignment_show', compact('course', 'section', 'assignment', 'submit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($course_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);
         $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.assignment.edit', compact('course', 'assignment', 'section22', 'sections'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $course_id, $id)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'content' => 'required|string',
             'startDate' => 'required|string|max:255',
             'expireDate' => 'required|string|max:255',
             'sections' => 'required'
         ]);
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $assignment->title = $request->title;
         $assignment->isCode = $request->has('codeAssignment');
         $assignment->content = Purifier::clean($request->content);
         $assignment->startDate = $request->formatted_startDate_submit;
         $assignment->expireDate = $request->formatted_expireDate_submit;
         $assignment->save();

         if (isset($request->sections)) {
             $assignment->sections()->sync($request->sections);
         } else {
             $assignment->sections()->sync(array());
         }

         session()->flash('status', 'Successfully updated');
         session()->flash('type', 'success');
         return redirect()->route('instructor.assignment.index', $course->id);
     }

     public function passUpdate(Request $request, $id)
     {
        $request->validate([
            'grade' => 'nullable|numeric|max:100',
        ]);
        
        $pass = Pass::findOrFail($id);
        $pass->grade = $request->grade;
        $pass->save();

        session()->flash('status', 'Successfully graded');
        session()->flash('type', 'success');
        return redirect()->back();
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($course_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);
         $assignment->pass()->delete();
         $assignment->sections()->detach();
         $assignment->delete();

         session()->flash('status', 'Successfully deleted');
         session()->flash('type', 'success');
         return response('success', 200);
     }

     public function status(Request $request, $course_id, $assignment_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($request->id);
         $assignment->isActive = $request->status == 1 ? true : false;
         $assignment->save();
         $status = $request->status == 1 ? 'Assignment Activated' : 'Assignment Deactivated';
         return json_encode(['text' => 'success', 'return' => '1', 'status' => $status]);
     }
}
