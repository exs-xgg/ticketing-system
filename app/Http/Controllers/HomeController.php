<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use carbon\Carbon;
use App\User;
use App\Concern;
use App\Faq;
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
        $this->middleware('auth')->except(['faq','register' ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {
        $data['concern_total'] = Concern::count();
        $data['instructor_total'] = User::where('role', 'instructor')->count();
        $data['student_total'] = User::where('role', 'student')->count();
        $data['new_users'] = User::latest()->limit(10)->get();

        return view('admin.dashboard', $data);
    }


     public function faq()
    {
       $data['faqs'] = Faq::latest()->get();
       
        return view('auth.faq', $data);
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
