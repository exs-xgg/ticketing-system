<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Take;
use App\TakeAnswer;
use App\Question;
use App\Course;
use App\Section;
use App\Pass;
use Purifier;

class TakeController extends Controller
{
    public function store(Request $request, $course_id, $section_id, $quiz_id)
    {
        $checktakes = Take::where('user_id', Auth::id())->where('quiz_id', $quiz_id)->where('section_id', $section_id)->first();
        
        if($checktakes){
            session()->flash('status', 'Already taken the quiz');
            session()->flash('type', 'error');
            return redirect()->route('student.quiz.show', [$course_id, $section_id, $quiz_id]);
        }
        
        $result = 0;
        
        $take = Take::create([
            'user_id' => Auth::id(),
            'section_id' => $section_id,
            'quiz_id' => $quiz_id,
            'result'  => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;
            $questionMaster = Question::find($question);
            if ($request->input('answers.'.$question) != null && $request->input('answers.'.$question) == $questionMaster->correct) {
                $status = 1;
                $result++;
            }
        }
        $take->update(['result' => $result]);

        session()->flash('status', 'Quiz finished');
        session()->flash('type', 'success');  
        return redirect()->route('student.take.result', [$course_id, $section_id, $quiz_id, $take->id]);
    }

    public function storeCodeQuiz(Request $request, $course_id, $section_id, $quiz_id)
    {
        $checktakes = Take::where('user_id', Auth::id())->where('quiz_id', $quiz_id)->where('section_id', $section_id)->first();
        if($checktakes){
            session()->flash('status', 'Already taken the quiz');
            session()->flash('type', 'error');
            return redirect()->route('student.quiz.show', [$course_id, $section_id, $quiz_id]);
        }
        
        $take = Take::create([
            'user_id' => Auth::id(),
            'section_id' => $section_id,
            'quiz_id' => $quiz_id,
            'code'  => $request->code,
        ]);

        session()->flash('status', 'Quiz finished');
        session()->flash('type', 'success');    
        return redirect()->route('student.quiz.index', [$course_id, $section_id]);
    }

    public function result($course_id, $section_id, $quiz_id, $take_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);
        $quiz = $section->quizzes()->findOrFail($quiz_id);
        $take = Take::where('quiz_id', $quiz->id)->findOrFail($take_id);

        return view('student.quiz.result', compact('course', 'section', 'quiz', 'take'));
    }

    public function store_assignment(Request $request, $course_id, $section_id, $assignment_id)
    {
        $request->validate([
            $request->content ? 'content' : 'code' => 'required'
        ]);

        $pass = Pass::create([
            'user_id' => Auth::id(),
            'section_id' => $section_id,
            'assignment_id' => $assignment_id,
            'content'  => $request->content ? Purifier::clean($request->content) : $request->code,
        ]);

        session()->flash('status', 'Assignment submitted');
        session()->flash('type', 'success');
        return redirect()->route('student.pass.result_assignment', [$course_id, $section_id, $assignment_id, $pass->id]);
    }

    public function result_assignment($course_id, $section_id, $assignment_id, $pass_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        $assignment = $section->assignments()->findOrFail($assignment_id);

        $pass = Pass::where('assignment_id', $assignment->id)->findOrFail($pass_id);

        return view('student.assignment.result', compact('course', 'section', 'assignment', 'pass'));
    }

    public function runCode(Request $request){
        $executed = \App\Helpers\runCode::run($request->code, $request->stdin);
        $data = json_decode($executed, true);
        $data2 = $data['output'];
        
        return json_encode(['text' =>  $data2, 'return' => '1']);
    }
}
