<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use App\Section;
use App\Course;
use App\Mail\newAccount;
use Illuminate\Support\Facades\Mail;
use App\Rules\ValidUsername;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = User::where('role', 'instructor')->latest()->get();
        return view('admin.instructor.index', compact('instructors'));
    }

    public function trash()
    {
        $instructors = User::where('role', 'instructor')->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('admin.instructor.deleted', compact('instructors'));
    }

    public function restore(Request $request, $id)
    {
        $instructor = User::withTrashed()->findOrFail($id);
        $instructor->instructorSections()->restore();
        $instructor->restore();

        session()->flash('status', 'Successfully restored');
        session()->flash('type', 'success');
        return response('success', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = $this->generateStrongPassword();
        $user = User::create([
            'role'         => 'instructor',
            'firstName'    => $request->firstName,
            'middleName'   => $request->middleName,
            'lastName'     => $request->lastName,
            'suffixName'   => $request->suffix,
            'username'     => $request->username,
            'email'        => $request->email,
            'mobileNumber' => $request->mobileNumber,
            'password'     => bcrypt($password),
            'avatar'       => 'profile_pic.png'
        ]);

        Mail::to($user->email)->queue(new newAccount($user, $password));
        // if($request->mobileNumber) {
        //     $message = 'Hi '.$user->name().', Welcome to CCS Learning Management System! \n'.$lesson->course->name;
        //     \App\Helpers\SMS::send($request->mobileNumber, $message);
        // }  

        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');
        return redirect()->route('admin.instructor.index');
    }

    function generateStrongPassword($length = 8, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if(!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instructor = User::findOrFail($id);
        return view('admin.instructor.show', compact('instructor'));
    }

    public function course($instructor_id, $course_id)
    {
        $instructor = User::findOrFail($instructor_id);
        $course = $instructor->courses()->findOrFail($course_id);
        $sections = Section::where('course_id', $course->id)->where('instructor_id', $instructor->id)->orderBy('name', 'asc')->get();

        return view('admin.instructor.course', compact('instructor', 'course', 'sections'));
    }

    public function section($instructor_id, $course_id, $section_id)
    {
        $instructor = User::findOrFail($instructor_id);
        $course = $instructor->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->where('instructor_id', $instructor->id)->findOrFail($section_id);
        return view('admin.instructor.section', compact('instructor', 'course', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = User::where('role', 'instructor')->findOrFail($id);
        return view('admin.instructor.edit', compact('instructor'));
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
        $user = User::findOrFail($id);

        $request->validate([
            'firstName'    => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'lastName'     => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'middleName'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'suffix'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:1|max:255',
            // 'username'     => 'required|alpha_dash|unique:users,username,'.$user->id.',id|min:5|max:255',
            'username'     => ['required','unique:users,username,'.$user->id.',id','min:5','max:255', new ValidUsername],
            'email'        => 'required|string|email|unique:users,email,'.$user->id.',id|max:255',
            'mobileNumber' => 'nullable|alpha_num|digits:11|unique:users,mobileNumber,'.$user->id.',id',
            // 'password'     => 'nullable|string|min:8|max:255',
            'password'     => 'nullable|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/',
        ]);

        $user->update([
            'firstName'    => $request->firstName,
            'middleName'   => $request->middleName,
            'lastName'     => $request->lastName,
            'suffixName'   => $request->suffix,
            'username'     => $request->username,
            'email'        => $request->email,
            'mobileNumber' => $request->mobileNumber,
            'password'     => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        session()->flash('status', 'Successfully updated');
        session()->flash('type', 'success');
        return redirect()->route('admin.instructor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // $user->courses()->detach();
        $user->instructorSections()->delete();
        $user->delete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }

    public function forceDestroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->courses()->detach();
        $user->forceDelete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }
}
