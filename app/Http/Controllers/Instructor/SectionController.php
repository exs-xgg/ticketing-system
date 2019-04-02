<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($id);
        $sections = Section::where('course_id', $id)->where('instructor_id', $user->id)->orderBy('name', 'asc')->where('isActive', true)->get();
        $sections2 = Section::where('course_id', $id)->where('instructor_id', $user->id)->where('isActive', false)->get();
        return view('instructor.section.index', compact('course', 'sections', 'sections2'));
    }

    public function deactivated($course_id)
    {
        $user = Auth::user();
        $data['course'] = $user->courses()->findOrFail($course_id);
        $data['sections'] = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->where('isActive', true)->get();
        $data['sections2'] = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->orderBy('name', 'asc')->where('isActive', false)->get();
        return view('instructor.section.deactivated', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($id);
        return view('instructor.section.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $section = new Section;
        $section->instructor_id = $user->id;
        $section->course_id = $course->id;
        $section->name = $request->name;
        $section->save();

        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');
        return redirect()->route('instructor.section.index', $course->id);
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
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($id);
        return view('instructor.section.edit', compact('course', 'section'));
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
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($id);

        if ($request->name != $section->name) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
        }

        $section->name = $request->name;
        $section->save();

        session()->flash('status', 'Successfully updated');
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
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($id);
        $section->lessons()->detach();
        $section->quizzes()->detach();
        $section->assignments()->detach();
        $section->announcements()->detach();
        $section->users()->detach();
        $section->tokens()->delete();
        $section->takes()->delete();
        $section->passes()->delete();
        $section->forceDelete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return redirect()->back();
    }

    public function status(Request $request, $course_id, $section_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($section_id);
        $section->isActive = $request->status == 1 ? true : false;
        $section->save();

        session()->flash('status', 'Successfully updated');
        session()->flash('type', 'success');
        return response('success', 200); 
    }

    public function export($course_id, $section_id)
    {
        $course = Course::findOrFail($course_id);
        $section = Section::findOrFail($section_id);
        $students = $section->users()->get();
        $quizzes = $section->quizzes()->get();
        $assignments = $section->assignments()->get();
        $fileName = $course->name.' '.$section->name;

        $new_data = array();                
        $data = $students;
        foreach ($data as $key => $value) {
            $new_data[$value->id]['Name'] = $value->lastFirstName();
            foreach($quizzes as $key => $quiz){
                $num = $key+1;
                $new_data[$value->id]['Q'.$num] = $value->takesQuiz($quiz->id)->result ?? '';
            }
            foreach($assignments as $key => $assignment){
                $num = $key+1;
                $new_data[$value->id]['A'.$num ] = $value->passesExport($assignment->id)->grade ?? '';
            }
        }

        return Excel::create($fileName, function($excel) use ($new_data, $fileName, $section) {
            $excel->sheet($section->name, function($sheet) use ($new_data) {
                $sheet->setWidth('A', 35);
                $sheet->getStyle('1')->getFont()->setBold(true);
                $sheet->fromArray($new_data, null, 'A1' );
            });
        })->download('xlsx');
    }
}
