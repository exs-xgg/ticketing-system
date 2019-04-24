<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faq;
use App\Client;
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
            'prob_category' => 'required',
            'sub_category' => 'required',
            'problem' => 'required',
            'solution' => 'required',
         
            
          
            
        ]);
  
        Faq::create($request->all());

        if (auth()->user())
            return redirect()->route('admin.faq.index')
                        ->with('success','Faq created successfully.');
        else
            return redirect()->route('view.index')
                       ->with('email',$request->input('email'));
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return view('admin.faq.show',compact('faq'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit',compact('faq'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {

       

        $request->validate([
       
            'problem' => 'required',
            'solution' => 'required',
         
       
            
        ]);
        
          $faq->problem = $request->problem;
           $faq->solution = $request->solution;
            $faq->save();
  
        return redirect()->route('admin.faq.index')
                        ->with('success','Faq updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
  
        return redirect()->route('admin.faq.index')
                        ->with('success','Faq deleted successfully');
    }
}