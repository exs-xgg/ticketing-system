<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use carbon\Carbon;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use App\File;
use App\Rules\ValidUsername;

class UserController extends Controller
{
    public function index()
   {
        $data['user'] = Auth::user();
        $data['suffix'] = ['Jr','Sr','I','II','III','IV','V','VI','VII','VIII','IX', 'X'];
        return view('profile.index', $data);
    }


    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'email'        => 'required|string|email|unique:users,email,'.$user->id.',id|max:255',
            // 'username'     => 'required|string|unique:users,username,'.$user->id.',id|min:5|max:255',
            'username'     => ['required','unique:users,username,'.$user->id.',id','min:5','max:255', new ValidUsername],
            'mobileNumber' => 'nullable|digits:11|unique:users,mobileNumber,'.$user->id.',id',
            'firstName'    => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'lastName'     => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'middleName'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'suffix'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:1|max:255',
            'birthDate'    => 'nullable|max:255',
        ]);

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'bail|image|mimes:jpg,png,jpeg,gif,svg|max:10000',
            ]);
            
            $avatar = $request->avatar;
            $name = time().$user->id.'.'.$avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $name);
            $user->avatar = $name;
        }

            
      

        // if ($user->role == 'student') {
        //     if(Carbon::parse($request->formatted_birthDate_submit)->age >= 16 ){
        //         $user->birthDate = $request->formatted_birthDate_submit;
        //     } else {
        //         session()->flash('statusError', '16 years old above only');
        //         return redirect()->route('profile.index');
        //     }
        // }

        $user->firstName = $request->firstName;
        $user->middleName = $request->middleName;
        $user->lastName = $request->lastName;
        $user->suffixName = $request->suffix;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->mobileNumber = $request->mobileNumber;
        $user->save();

        session()->flash('status', 'Update successful');
        session()->flash('type', 'success');
        return redirect()->route('profile.index');
    }

    public function profile_remove(Request $request)
    {
        $user = Auth::user();
        $user->avatar = 'profile_pic.png';
        $user->save();

        session()->flash('status', 'Remove profile avatar successful');
        session()->flash('type', 'success');
        return response('success', 200);
        // return redirect()->route('profile.update');
    }

    public function change_password_index()
    {
        return view('profile.change_password');
    }

    public function change_password_update(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'currentPassword' => 'required',
            // 'password' => 'required|min:8|confirmed',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/',
            'password_confirmation' => 'required|min:8',
        ]);

        if (Hash::check(Input::get('currentPassword'), $user['password'])) {
            $this->validate($request, [
                'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/',
            ]);
            $user->password = bcrypt(Input::get('password'));
            $user->save();
            session()->flash('status', 'You have successfully changed your password');
            session()->flash('type', 'success');
            return redirect()->route('change.password.index');
        } else {
            session()->flash('status', 'Invalid Current Password');
            session()->flash('type', 'error');
            return redirect()->route('change.password.index');
        }
    }

    public function my_files()
    {
        $data['files'] = File::where('user_id', Auth::id())->oldest()->get();
        return view('profile.my_files', $data);
    }

    public function files_store(Request $request)
    {
        $request->validate([
            'file_upload' => 'mimes:pdf,doc,ppt,xls,docx,pptx,xlsx,rar,zip|max:10000',
        ]);

        if ($request->hasFile('file_upload')) {
           $fileUpload = $request->file_upload;
           $name = time().'-'.$fileUpload->getClientOriginalName();
           $type = $fileUpload->getClientOriginalExtension();
           $size = $fileUpload->getClientSize();
           $fileUpload->storeAs('public/userfiles', $name);
           
           $file = new File;
           $file->user_id = Auth::id();
           $file->name = $name;
           $file->type = $type;
           $file->size = $size;
           $file->save();
       }

        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');
        return redirect()->back();
    }


    public function files_download($file_id)
    {
        $entry = File::findOrFail($file_id);
        $pathToFile = storage_path()."/app/public/userfiles/".$entry->name;
        $name = substr($entry->name, 11);
        return response()->download($pathToFile, $name);
    }

    public function files_destroy($file_id)
    {
        $entry = File::findOrFail($file_id);
        $entry->delete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }
}
