<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
// use App\Client;
use Auth;
use DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::where('role', 'client')->latest()->get();
        return view('admin.student.index', compact('clients'));
    }


    public function status(Request $request, $id)
    {
        // $user = Auth::user();
        // $course = $user->courses()->findOrFail($course_id);
        $data['student'] = User::where('role', 'student')->findOrFail($id);
        $data['student']->status = $request->status == 1 ? true : false;
        $data['student']->save();
        $status = $request->status == 1 ? 'Lesson Activated' : 'Lesson Deactivated';
        return json_encode(['text' => 'success', 'return' => '1', 'status' => $status]);
    }
}
