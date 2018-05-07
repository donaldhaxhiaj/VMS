<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Model\user\visitor;
use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    public function visitor(visitor $visitor)
    {
        return view('user.visitor',compact('visitor'));
    }
}
