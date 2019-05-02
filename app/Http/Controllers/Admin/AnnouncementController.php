<?php

namespace App\Http\Controllers\Instructor;

use Auth;
use App\Concern;
use App\User;
// use App\Section;
use App\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use App\Mail\newAnnouncement;
// use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($concern_id)
    {
        $user = Auth::user();
        $concern =  $user->concerns()->findOrFail($concern_id);
        $announcements = Announcement::where('admin_id', $user->id)->where('concern_id', $concern_id)->orderBy('updated_at', 'desc')->paginate(20);
        return view('admin.announcement.index', compact('concern', 'announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id)
    {
        $user = Auth::user();
        $course = $user->concerns()->findOrFail($concerns_id);

        $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();

        return view('instructor.announcement.create', compact('course', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);

        $request->validate([
            'message' => 'required|string',
        ]);

        $announcement = new Announcement;

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'bail|image|mimes:jpg,png,jpeg,gif,svg|max:10000',
            ]);
            
            $image = $request->image;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$image->getClientOriginalName();
            // $image->image = $name;
            $image->storeAs('public/images', $name);
            $announcement->image = $name;
        }
        
        $announcement->instructor_id = $user->id;
        $announcement->course_id = $course->id;
        $announcement->message = $request->message;
        $announcement->save();

        $announcement->sections()->sync($request->sections, false);

        $msg = 'There\'s a new announcement posted in your course '.$announcement->course->name;

        foreach($announcement->sections as $section){
           foreach($section->users as $user){
               if($user->mobileNumber){
                   $mobile = $user->mobileNumber;
                //    $message = \App\Helpers\SMS::send($mobile, $msg);
               }
               Mail::to($user->email)->send(new newAnnouncement($user, $announcement));
           }
       }


        session()->flash('status', 'Successfully posted');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', $course->id);
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
    public function edit($course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        // $section = Section::where('course_id', $course->id)->findOrFail($section_id);

        $announcement = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

        $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();
        $section22 = array();
        foreach ($sections as $section2) {
            $section22[$section2->id] = $section2->title;
        }

        return view('instructor.announcement.edit', compact('course', 'section22', 'sections', 'announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        // $section = Section::where('course_id', $course->id)->findOrFail($section_id);

        $announcement = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

        $request->validate([
            'message' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'question_image' => 'bail|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            
            $image = $request->image;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$image->getClientOriginalName();
            // $image->image = $name;
            $image->storeAs('public/images', $name);
            $announcement->image = $name;
        }

        $announcement->message = $request->message;
        $announcement->save();

        session()->flash('status', 'Successfully updated');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', $course->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $announcement = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);
        $announcement->sections()->detach();
        $announcement->delete();
        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }
}
