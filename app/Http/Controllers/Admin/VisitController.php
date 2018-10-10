<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\visit;
use App\Http\Controllers\Controller;
use App\Model\user\company;
use App\Model\user\visitor;
use App\Model\user\purpose;
use App\Http\Requests\visitRequest;
use Illuminate\Support\Facades\Validator;
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
        $purposes = purpose::all();

        return view('admin.visit.show',compact('visits','purposes'));
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
        $purposes =purpose::all();
        return view('admin.visit.visit',compact('companies','visitors','purposes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'purpose' => 'required',
            'companies'  => 'required',
        ]);
        $visit = new visit;
        $visit->purpose = $request->purpose;
        $visit->purposetext = $request->purposetext;
        $visit->status = "Ne pritje";
        $visit->time = $request->time;
        $visit->endtime = $request->endtime;
        $visit->comments = $request->comments;
        $visit->company_id = $request->companies;
        $visit->date = now();


        $visit->save();


        // $visit->companies()->sync($request->companies);
        return redirect()->route('visit.edit', $visit->id);
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

    public function ajaxList(Request $request)
    {
        $totalData = visit::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');


        $search = $request->input('search.value');
        $columnFilter = $request->input('columns');
        $status ='';
        if(is_array($columnFilter) && !empty($columnFilter[2]) && is_array($columnFilter[2]) && !empty($columnFilter[2]['search']['value'])){
            $status = $columnFilter[2]['search']['value'];
        }
        $visits =  Visit::Count()
            ->where('purpose','like',"%{$search}%")
            ->Where('status','like',"%{$status}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy("id",'desc')
            ->get();

        $totalFiltered = Visit::where('status','like',"%{$status}%")
            ->Where('purpose','like',"%{$search}%")
            ->count();


        $data = array();
        if(!empty($visits))
        {
            foreach ($visits as $visit)
            {
                $nestedData['id'] = $visit->id;
                $nestedData['purpose'] = $visit->purpose;
                $nestedData['purposetext'] = $visit->purposetext;
                $nestedData['status'] = $visit->status;
                $nestedData['time'] = $visit->time;
                $nestedData['date'] = $visit->date;
                $nestedData['endtime'] = $visit->endtime;
                $nestedData['comments'] = $visit->comments;

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);

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
        $purposes =purpose::all();
        return view('admin.visit.edit',compact('visit','companies','visitors','purposes'));
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
        $visit->status = $request->status;
        $visit->date = $request->date;
        $visit->time = $request->time;
        $visit->endtime = $request->endtime;
        $visit->comments = $request->comments;
        $visit->visitors()->sync($request->visitors);

        if (isset($request->visitorIds)){
            $data = array();
            foreach ($request->visitorIds as $visitorIndex => $visitorId) {
                $data[$visitorId] =  array("commingfrom" => $request->commingfrom[$visitorIndex]);
            }
            $visit->visitors()->sync($data);
        }

        $visit->save();

        return redirect(route('visit.index'))->with('message','Visit Updated Successfully');
    }

    public function  EndVisit(Request $request)
    {
        $visit = Visit::findOrFail($request->visit_id);
        $visit->status = "Perfunduar";
        $visit->endtime = now();
        $visit->save();
        return redirect(route('visit.index'))->with('message','Vizita u perfundua!');
    }

    public function  SaveVisit(Request $request)
    {
        $visit = new visit;
        $visit->purpose = $request->purpose;
        $visit->purposetext = $request->purposetext;
        $visit->endtime = $request->endtime;
        $visit->comments = $request->comments;
        $visit->company_id = $request->companies;
        $visit->status = "Ne pritje";
        $visit->date = now();
        $visit->save();
        return redirect(route('visit.edit',$visit->id));
    }

    public function  StartVisit(Request $request)
    {
        $visit = Visit::findOrFail($request->visit_id);

        $visit->status = "Aktive";
        $visit->date = now();
        $visit->time = now();
        $visit->save();
        //Visitors
        if (isset($request->visitorIds)){
            $data = array();
            foreach ($request->visitorIds as $visitorIndex => $visitorId) {
                $data[$visitorId] =  array("commingfrom" => $request->commingfrom[$visitorIndex]);
            }
            $visit->visitors()->sync($data);
        }

        return redirect(route('visit.index'))->with('message','Vizita filloi!');
    }

    public function  StartVisit2(Request $request)
    {
        $this->validate($request,[
            'purpose'=>'required',
            'companies'=>'required'
        ]);
        $visit = new visit;
        $visit->purpose = $request->purpose;
        $visit->purposetext = $request->purposetext;
        $visit->endtime = $request->endtime;
        $visit->comments = $request->comments;
        $visit->company_id = $request->companies;
        $visit->status = "Aktive";
        $visit->date = now();
        $visit->time = now();
        $visit->save();
        //Visitors
        if (isset($request->visitorIds)){
            $data = array();
            foreach ($request->visitorIds as $visitorIndex => $visitorId) {
                $data[$visitorId] =  array("commingfrom" => $request->commingfrom[$visitorIndex]);
            }
            $visit->visitors()->sync($data);
        }

        return redirect(route('visit.index'))->with('message','Vizita filloi!');
    }

    public function  CancelVisit(Request $request)
    {
        $visit = Visit::findOrFail($request->visit_id);
        $visit->status = "Refuzuar";
        $visit->save();
        return redirect(route('visit.index'))->with('message','Vizita u anullua!');
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
        return back()->with('message','Visit is deleted successfully');

    }
}
