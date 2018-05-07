<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\visitor;
use App\Http\Controllers\Controller;
use App\Model\user\category;
use App\Model\user\tag;
use Illuminate\Support\Facades\Auth;


class VisitorController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = visitor::all();
        return view('admin.visitor.show',compact('visitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('visitors.create')) {
            return view('admin.visitor.visitor');
        }
        return redirect(route('admin.home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'name'=>'required',
          'surname'=>'required',
          'idnr'=>'required',
          'company'=>'required'
        ]);

        $visitor = new visitor;
        $visitor->name = $request->name;
        $visitor->surname = $request->surname;
        $visitor->idnr = $request->idnr;
        $visitor->birthdate = $request->birthdate;
        $visitor->state = $request->state;
        $visitor->gender = $request->gender;
        $visitor->email = $request->email;
        $visitor->phone = $request->phone;
        $visitor->comments = $request->comments;
        $visitor->save();
        return redirect(route('visitor.index'))->with('message','Visitor Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('visitors.update')) {
            $visitor = visitor::where('id', $id)->first();

            return view('admin.visitor.edit',compact('visitor'));
;
        }
        return redirect(route('admin.home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'surname' => 'required',
        ]);

        $visitor = visitor::find($id);
        $visitor->name = $request->name;
        $visitor->surname = $request->surname;
        $visitor->idnr = $request->idnr;
        $visitor->birthdate = $request->birthdate;
        $visitor->state = $request->state;
        $visitor->gender = $request->gender;
        $visitor->email = $request->email;
        $visitor->phone = $request->phone;
        $visitor->comments = $request->comments;
        $visitor->save();

        return redirect(route('visitor.index'))->with('message','Visitor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        visitor::where('id',$id)->delete();
        return redirect()->back()->with('message','Visitor Deleted Successfully');
    }
}
