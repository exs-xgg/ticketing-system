<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Client;
use Auth;
use DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
       $data['faqs'] = Faq::latest()->get();
        return view('auth.faq.blade', $data);
    }

   
    
}
