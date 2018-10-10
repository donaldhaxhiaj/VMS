<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\visitor;
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


    public function index() {
        $visitors = visitor::all();
        visitor::count();
        return view('admin.home',compact('visitors'));

    }

}

