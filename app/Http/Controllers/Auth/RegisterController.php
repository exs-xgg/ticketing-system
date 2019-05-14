<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use carbon\Carbon;
use App\Rules\ValidUsername;
use App\Mail\newAccount;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // for email verification(before)
     public function __construct()
     {
         $this->middleware('guest');
     }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName'    => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'lastName'     => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            // 'birthDate'             => 'required|max:255|16Above',
          
            'username'              => 'required|alpha_dash|unique:users|min:5|max:255',
            'username'     => ['required','unique:users','min:5','max:255', new ValidUsername],
            'email'                 => 'required|string|email|unique:users|max:255',
            'mobileNumber'          => 'nullable|alpha_num|digits:11|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/',
            'password_confirmation' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'role'          => 'client',
            'firstName'     => $data['firstName'],
            'lastName'      => $data['lastName'],
            'username'      => $data['username'],
            'email'         => $data['email'],
            'status'         => '0',
            'mobileNumber'  => $data['mobileNumber'],
            'password'      => Hash::make($data['password']),
            'avatar'        => 'profile_pic.png'
        ]);

        Mail::to($user->email)->send(new newAccount($user));

        return $user;
    }
}
