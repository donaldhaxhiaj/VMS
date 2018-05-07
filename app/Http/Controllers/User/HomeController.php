<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Model\user\visitor;
use App\Model\user\category;
use App\Model\user\tag;
use App\Model\user\visit;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function visitor()
    {
        $visitors = visitor::where('status',1)->orderBy('created_at','DESC')->paginate(2);
        return view('user.blog',compact('posts'));
    }
    public function tag(tag $tag)
    {
        $posts = $tag->posts();
        return view('user.blog',compact('posts'));
    }



    public function visit(visit $visit)
    {
        $visits = $visit->visits();
        return view('user.blog',compact('visits'));
    }
}
