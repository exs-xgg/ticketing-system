<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concerns2;

class Concerns2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $concern = New Concerns2;
        // $request = $request->all();
        $concern->remark = $request->remark;
        $concern->concerns_id = $request->concerns_id;
        $concern->priority = $request->priority;
        $concern->status = $request->status;
        $concern->receiver2 = $request->receiver2;
        $concern->save();

        // return $data->id;


        // $concern->save();
        // $concern->users()->sync($request->admins, false);
        // $concern->users()->sync($request->clients, false);


        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');

        return redirect()->route('admin.concern.index');

        // return json_encode($concern);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
