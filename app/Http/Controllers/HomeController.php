<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use carbon\Carbon;
use App\User;
use App\Course;
use App\Section;
use App\Lesson;
use App\Quiz;
use App\Assignment;
use App\Token;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['register_token', 'register_student', 'check_token', 'register', 'privacy_policy']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {
        $data['course_total'] = Course::count();
        $data['instructor_total'] = User::where('role', 'instructor')->count();
        $data['student_total'] = User::where('role', 'student')->count();
        $data['lesson_total'] = Lesson::count();
        $data['quiz_total'] = Quiz::count();
        $data['assignment_total'] = Assignment::count();
        $data['pie_data'] = [$data['lesson_total'], $data['quiz_total'], $data['assignment_total']];
        $data['new_users'] = User::latest()->limit(10)->get();

        return view('admin.dashboard', $data);
    }

    public function instructor_dashboard()
    {
        return view('instructor.dashboard');
    }

    public function register_token()
    {
        return view('auth.register_token');
    }

    public function check_token(Request $request)
    {
        $token = Token::where('token', $request->classToken)->where('status', true)->whereHas('course', function($e){
            $e->where('status', true);
        })->first();

        if(isset($token)){
            if(Carbon::parse($token->expireDate)->isPast()){
                session()->flash('status', 'Token already expired!');
                session()->flash('type', 'error');
                return redirect()->back();
            } elseif($token->token == $request->classToken){
                return redirect()->route('privacy_policy', $token->token);
            }
        }
        session()->flash('status', 'Invalid token');
                session()->flash('type', 'error');
                return redirect()->back();
    }

    public function register_student($token)
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
                return view('auth.register', compact('section'));
            }
            session()->flash('status', 'Invalid token');
            session()->flash('type', 'error');
            return redirect()->back();
        }
    }

    public function privacy_policy()
    {
        return view('auth.privacy_policy');
    }

    public function register(UserRequest $request, $section)
    {
        $request->validate([
            'firstName' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'middleName'=> 'nullable|regex:/^[\pL\s\-]+$/u|max:255',
            'lastName'  => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'birthDate' => 'required|max:255',
            'username'  => 'required|alpha_dash|unique:users|max:255',
            'email'     => 'required|string|email|unique:users|max:255',
            'password'  => 'required|string|min:6|confirmed',
            'mobileNumber'=> 'nullable|alpha_num|digits:11|unique:users',
        ]);

        $user = User::create([
            'role'      => 'student',
            'firstName' => $request->firstName,
            'middleName'=> $request->middleName,
            'lastName'  => $request->lastName,
            'birthDate' => $request->formatted_birthDate_submit,
            'mobileNumber'     => $request->mobileNumber,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        $user->sections()->sync($request->sections, false);

        return redirect()->route('student.dashboard');

    }

    public function student_dashboard()
    {
        $user = Auth::user();
        return view('student.dashboard', compact('user'));
    }
}
