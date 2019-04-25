<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Concern;
use App\Client;
use Auth;
use App\User;
use DataTables;
use Carbon\carbon;
class ConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['concerns'] = Concern::select('concerns.id', 'ticket', 'prob_category', 'receiver1', 'concern2.receiver2', 'reporter', 'sub_category', 'problem', 'before', 'concern2.priority', 'concern2.status', 'concern2.remark','comment', 'concerns.created_at', 'firstName', 'middleName', 'lastName')
                            ->join('users', 'users.id', '=', 'concerns.receiver1')
                            ->leftJoin('concern2', 'concerns.id', '=', 'concern2.concerns_id')
                            ->orderBy('concerns.created_at')
                            ->get();

        return view('admin.concern.index', $data);
    }

    public function concernsList()
    {
        $concerns = Concern::latest()->get();
        return DataTables::of($concerns)
                        ->addColumn('action', function ($concern) {
                            return '<a href="'.route('admin.concern.edit', $concerns->id).'" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a>';
                        })
                        
                        // ->addColumn('admins', function (Concern $concern) {
                        //     return $concern->users->map(function($user) {
                        //      return '<a class="btn-link" href="'.route('admin.instructor.show', $user->id).'">'.$user->name().'</a>';
                        //     })->implode(', ');
                        // })
                        ->rawColumns(['admins'])
                        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $admins = User::where('role', 'admin')->get();
         $clients = User::where('role', 'client')->get();
       
        return view('admin.concern.create', compact('admins'),compact('clients'));



      /*  return view('admin.concern.create');*/
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $concern->receiver1 = $request->receiver1;
        $concern->receiver2 = $request->receiver2;
        $concern->comment = $request->comment;
       

   

        $concern->save();
        $concern->users()->sync($request->admins, false);
        $concern->users()->sync($request->clients, false);


        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');


        

        return redirect()->route('admin.concern.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Concern $concern)
    {
        return view('admin.concern.show',compact('concern'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Concern $concern)
    {
        $admins = User::where('role', 'admin')->get();
         $clients = User::where('role', 'client')->get();

        return view('admin.concern.edit', compact('concern'), compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concern $concern)
    {
       

        // $request->validate([
        //  'priority' => 'required',
        //   'status' => 'required',
        
            
        // ]);

        // $concern2->priority = $request->priority;
        // $concern2->status = $request->status;
        // $concern2->receiver2 = $request->receiver2;
         $concern->comment = $request->comment;



  
    

        $concern->save();
        
        return redirect()->route('admin.concern.index')
                        ->with('success','Concern updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $concern = Concern::findOrFail($id);
        $concern->users()->detach();
        $concern->delete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }
}
