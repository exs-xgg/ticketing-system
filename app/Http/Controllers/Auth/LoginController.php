<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
       if ($user->role == "admin") {// do your margic here
           return redirect()->route('admin.dashboard');
       } elseif ($user->role == "instructor") {
           return redirect()->route('instructor.dashboard');
       } elseif ($user->role == "client") {
            if($user->studentNumber == ''){
                return redirect()->route('student.concern.index');
            }
            return redirect()->route('student.dashboard');
       }

        return redirect('/');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
{
    $field = $this->field($request);

    return [
        $field => $request->get($this->username()),
        'password' => $request->get('password')
    ];
}

public function field(Request $request)
{
    $email = $this->username();

            return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
}

protected function validateLogin(Request $request)
{
    $field = $this->field($request);

    $messages = ["{$this->username()}.exists" => 'These credentials do not match our records or the account needs to be activated.'];

    $this->validate($request, [
        $this->username() => "required|exists:users,{$field},status,1'",
        'password' => 'required',
    ], $messages);
}


}
