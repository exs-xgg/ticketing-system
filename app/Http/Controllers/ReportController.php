<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
  
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::latest()->paginate(5);
  
        return view('report.index',compact('reports'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('report.create');
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
  
        Report::create($request->all());

        if (auth()->user())
            return redirect()->route('report.index')
                        ->with('success','Report created successfully.');
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
    public function show(Report $report)
    {
        return view('report.show',compact('report'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return view('report.edit',compact('report'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {

       

        $request->validate([
         'prob_category' => 'required',
            'sub_category' => 'required',
            'problem' => 'required',
            'solution' => 'required',
         
       
            
        ]);
        $report->prob_category = $request->prob_category;
         $report->sub_category = $request->sub_category;
          $report->problem = $request->problem;
           $report->solution = $request->solution;
            $report->save();
  
        return redirect()->route('report.index')
                        ->with('success','Report updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
  
        return redirect()->route('report.index')
                        ->with('success','Report deleted successfully');
    }
}