<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Concern;
use Auth;
use App\User;
use DataTables;

class ConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['concerns'] = Concern::latest()->get();
        return view('admin.concern.index', $data);
    }

    public function concernsList()
    {
        $concerns = Concern::latest()->get();
        return DataTables::of($concerns)
                        ->addColumn('action', function ($concern) {
                            return '<a href="'.route('admin.concern.edit', $concern->id).'" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a>';
                        })
                        
                        ->addColumn('instructors', function (Course $course) {
                            return $course->users->map(function($user) {
                                return '<a class="btn-link" href="'.route('admin.instructor.show', $user->id).'">'.$user->name().'</a>';
                            })->implode(', ');
                        })
                        ->rawColumns(['instructors', 'action', 'status'])
                        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.concern.create');
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
        $concern->receiver1 = $request->receiver1;

        $concern->save();


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
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $concern = Concern::findOrFail($id);

        return view('admin.concern.edit', compact('concern'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $concern = Concern::findOrFail($id);

        if ($request->name != $course->name) {
            $request->validate([
                'name' => 'required|string|unique:courses|max:255',
            ]);
        }

        $course->name = $request->name;
        $course->code = $request->code;
        $course->description = $request->description;
        $course->save();

        if (isset($request->instructors)) {
            $course->users()->sync($request->instructors);
        } else {
            $course->users()->sync(array());
        }



        session()->flash('status', 'Successfully updated');
        session()->flash('type', 'success');

        return redirect()->route('admin.course.index');
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
