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
        $data['instructor_total'] = User::where('role', 'admin')->count();
        $data['student_total'] = User::where('role', 'client')->count();
        $data['new_users'] = User::latest()->limit(10)->get();

        return view('admin.dashboard', $data);
    }


     public function faq()
    {
       $data['faqs'] = Faq::latest()->get();
       
        return view('auth.faq', $data);
    }
    public function verify()
    {
         $user = Auth::user();
        return view('auth.verify',compact(user));
    }

    public function register(UserRequest $request)
    {

        //this is not a part, notworking
       
        

        return redirect()->route('student.dashboard');

    }

    public function student_dashboard()
    {
        $user = Auth::user();
        return view('student.dashboard', compact('user'));
    }
}
