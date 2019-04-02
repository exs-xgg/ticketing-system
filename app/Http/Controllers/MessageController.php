<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Convo;
use App\Course;
use App\Section;
use Auth;
use App\User;
use DB;
use carbon\Carbon;
use App\Notifications\MessageSent;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role,$course_id,$section_id,$tab)
    {
        $data['course'] = Course::findOrFail($course_id);
        $data['section'] = Section::findOrFail($section_id);
        $user = Auth::user();
        $data['convos'] = Convo::where('user_id', $user->id)->orWhere('to_user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(10);
        // return $convos;
        return view('message.index', $data);
    }

    public function index2()
    {
        $user = Auth::user();
        $data['convos'] = Convo::where('user_id', $user->id)->orWhere('to_user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(10);
        // return $convos;
        return view('message.index', $data);
    }

    public function index3($role,$course_id,$tab)
    {
        $data['course'] = Course::findOrFail($course_id);
        $user = Auth::user();
        $data['convos'] = Convo::where('user_id', $user->id)->orWhere('to_user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(10);
        // return $convos;
        return view('message.index', $data);
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
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        $convo = Convo::where('user_id', $user->id)->where('to_user_id', $request->to_user_id)->first();
        $to_user = User::findOrFail($request->to_user_id);    
        if(!$convo){
            $convo = new Convo;
            $convo->user_id = $user->id;
            $convo->to_user_id = $request->to_user_id;
            $convo->save();
        }

        $message = new Message;
        $message->convo_id = $convo->id;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        $to_user->notify(new MessageSent($message->toArray()));

        session()->flash('status', 'Successfully sent');
        session()->flash('type', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($role,$course_id,$section_id,$tab,$convo_id)
    {
        $data['course'] = Course::findOrFail($course_id);
        $data['section'] = Section::findOrFail($section_id);
        $data['me'] = Auth::user();
        $data['conversation'] = Convo::findOrFail($convo_id);
        $conversation = $data['conversation'];
        $data['messages'] = Message::where('convo_id', $convo_id)->get();

        DB::table('notifications')->where('notifiable_id', auth()->id())->whereNull('read_at')->whereJsonContains('data', ['convo_id' => $conversation->id])->update(['read_at' => date('Y-m-d H:i:s')]);

        return view('message.show', $data);
    }

    public function show2($convo_id)
    {
        $data['me'] = Auth::user();
        $data['conversation'] = Convo::findOrFail($convo_id);
        $conversation = $data['conversation'];
        $data['messages'] = Message::where('convo_id', $convo_id)->get();

        DB::table('notifications')->where('notifiable_id', auth()->id())->whereNull('read_at')->whereJsonContains('data', ['convo_id' => $conversation->id])->update(['read_at' => date('Y-m-d H:i:s')]);

        return view('message.show', $data);
    }

    public function show3($role,$course_id,$tab,$convo_id)
    {
        $data['course'] = Course::findOrFail($course_id);
        $data['me'] = Auth::user();
        $data['conversation'] = Convo::findOrFail($convo_id);
        $conversation = $data['conversation'];
        $data['messages'] = Message::where('convo_id', $convo_id)->get();

        DB::table('notifications')->where('notifiable_id', auth()->id())->whereNull('read_at')->whereJsonContains('data', ['convo_id' => $conversation->id])->update(['read_at' => date('Y-m-d H:i:s')]);

        return view('message.show', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function reply(Request $request, $convo_id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        $convo = Convo::findOrFail($convo_id); 

        $message = new Message;
        $message->convo_id = $convo->id;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        $convo->updated_at = date("Y-m-d H:i:s");
        $convo->save();

        if($convo->user_id == $user->id){
            $to_user = User::findOrFail($convo->to_user_id);   
        } else {
            $to_user = User::findOrFail($convo->user_id);   
        }

        $to_user->notify(new MessageSent($message->toArray()));

        // session()->flash('status', 'Successfully sent');
        // session()->flash('type', 'success');

        return redirect()->back();
    }

    public function markAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->where('id',  $request->id)->markAsRead();
        $test = auth()->user()->unreadNotifications->where('id', $request->id)->first();

        $convo_id = $test->data['convo_id'];
        $teat1 = DB::table('notifications')->where('notifiable_id', auth()->id())->whereJsonContains('data', ['convo_id' => $convo_id])->update(['read_at' => date('Y-m-d H:i:s')]);

        return response('success', 200);
    }

    public function markAsAllRead(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
