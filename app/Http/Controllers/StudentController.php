<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concern;
use Auth;
use DateTime;
use carbon\Carbon;
use App\User;
use DataTables;

class StudentController extends Controller
{
    public function concern()
    {
        $data['concerns'] = Concern::where('user_id', Auth::id())->oldest()->get();
        return view('student.dashboard', $data);
    }

    public function create()
    {

         $admins = User::where('role', 'admin')->get();

        return view('admin.concern.create', compact('admins'));



      /*  return view('admin.concern.create');*/
    }



public function store(Request $request)
    {
        $request->validate([
            'prob_category' => 'string|max:255',
        ]);

        $concern = new Concern;
        $concern->prob_category = $request->prob_category;
        $concern->sub_category = $request->sub_category;
        $concern->problem = $request->problem;
        $concern->before = $request->before;
        $concern->ticket = random_int(1, 10000);
   

        $concern->save();
        $concern->users()->sync($request->admins, false);


        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');

        return redirect()->route('admin.concern.index');

    }












}
   