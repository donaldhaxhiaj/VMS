<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function company()
    {
        $companies = DB::table("companies")->lists("name","id");
        return view('myform',compact('companies'));
    }


    /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */


    public function index() {
        return view('admin/home');
    }
}
