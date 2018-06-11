<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\visit;
use App\Http\Controllers\Controller;
use App\Model\user\company;
use App\Model\user\visitor;
use App\Model\user\visit_visitors;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $visits = visit::all();

        return view('admin.visit.show',compact('visits'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visitors = visitor::all();
        $companies =company::all();
        return view('admin.visit.visit',compact('companies','visitors'));
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

        ]);
        $visit = new visit;
        $visit->purpose = $request->purpose;
        $visit->purposetext = $request->purposetext;
        $visit->plan = $request->plan;
        $visit->status = $request->status;
        $visit->date = $request->date;
        $visit->time = $request->time;
        $visit->endtime = $request->endtime;
        $visit->comments = $request->comments;
        if (isset($request->newVisit) && $request->newVisit == "new-visit") {
            $visit->status = "Pending";
            $visit->date = now();
        }
        if (isset($request->startVisit) && $request->startVisit == "start-visit") {
            $visit->status = "Ongoing";
            $visit->time = now();
         }
        $visit->save();

        $visit->companies()->sync($request->companies);

        $data = array();
        foreach ($request->visitorIds as $visitorIndex => $visitorId) {
            $data[$visitorId] =  array("commingfrom" => $request->commingfrom[$visitorIndex]);
        }

        $visit->visitors()->sync($data);
        //dd($data);

        /*$visit->visitors()->sync(array(
            5 => array( "commingfrom" => "test" ),
            12 => array( "commingfrom"  => "test2" )
        ));*/





        // $visit->visitVisitors()->sync($request->visitVisitors);
        //$visit->companies()->sync($request->visitCompanies);

        return redirect(route('visit.index'))->with('message','Visit Created Successfully');
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
    public function edit($id)
    {
        $visit = visit::where('id',$id)->first();
        $companies =company::all();
        $visitors =visitor::all();
        return view('admin.visit.edit',compact('visit','companies','visitors'));
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


        ]);
        $visit = visit::find($id);
        $visit->purpose = $request->purpose;
        $visit->plan = $request->plan;
        $visit->status = $request->status;
        $visit->date = $request->date;
        $visit->time = $request->time;
        $visit->endtime = $request->endtime;
        $visit->comments = $request->comments;
        $visit->visitors()->sync($request->visitors);
        if (isset($request->startVisit) && $request->startVisit == "start-visit") {
            $visit->time = now();
        }
        $data = array();
        foreach ($request->visitorIds as $visitorIndex => $visitorId) {
            $data[$visitorId] =  array("commingfrom" => $request->commingfrom[$visitorIndex]);
        }

        $visit->visitors()->sync($data);
        $visit->save();
        return redirect(route('visit.index'))->with('message','Visit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $visit = Visit::findOrFail($request->visit_id);
        $visit->delete();
        return back();
    }
}
