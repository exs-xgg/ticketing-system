<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faq;
use Auth;
use App\User;
use DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faqs'] = Faq::latest()->get();
        return view('admin.faq.index', $data);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
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
        
        $faq = new Faq;
        $faq->prob_category = $request->prob_category;
        $faq->sub_category = $request->sub_category ;
        $faq->problem = $request->problem;
        $faq->solution= $request->solution;
        $faq->save();


        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');

        return redirect()->route('admin.faq.index');

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
       $faq = Faq::findOrFail($id);

        return view('admin.faq.edit', compact('faq'));
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
        $faq = Faq::findOrFail($id);

        if ($request->prob_category != $faq->prob_category) {
            $request->validate([
                'prob_category' => 'required|string|unique:courses|max:255',
            ]);
        }

    
        $faq->prob_category = $request->prob_category;
        $faq->sub_category = $request->sub_category;
        $faq->problem = $request->problem;
        $faq->solution = $request->solution;
        $faq->save();


         

        session()->flash('status', 'Successfully updated');
        session()->flash('type', 'success');

        return redirect()->route('admin.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $faq = Faq::findOrFail($id);
         $faq->faqs()->detach();
          $faq->delete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }


    public function forceDestroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->faqs()->detach();
        $faq->forceDelete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }


}
