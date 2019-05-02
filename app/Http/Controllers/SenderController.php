<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sender;


class SenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $admins = User::where('role', 'admin')->get();
        // $clients = User::where('role', 'client')->get();
        // // $priority['priority'] = ['level 1: 24 hours','level 2: 2-3 days','level 3: 4&above']; 
        // // $status['status'] = ['Open','Ongoing','Resolved','Closed'];

        // return view('admin.concern.edit', compact('concern'), compact('clients'), $priority, $status);
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
        $sender =  Sender::firstOrNew(['concerns_id' => $request->input('concerns_id')]);
        // $request = $request->all();
        $sender->remark = $request->remark;
        $sender->concerns_id = $request->concerns_id;
        $sender->priority = $request->priority;
        $sender->status = $request->status;
        $sender->note_receiver1 = $request->note_receiver1;
        // $request = $request->all();
        // $concern = extract_field_to_save($concern,$request);

        $sender->save();

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
