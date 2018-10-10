<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\visitor;
use App\Model\user\visit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
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
        $visitors = visitor::withCount(["visits"=>function($query){
                        $query->where("checked_out",0);
                    }])->get();
        $visits = visit::all();
        return view('admin.visitor.show',compact('visitors','visits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visits = visit::all();
        if (Auth::user()->can('visitors.create')) {
            return view('admin.visitor.visitor');
        }
        return redirect(route('admin.home'),compact('visits'));
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
          'idnr'=>'required|unique:visitors'
        ]);

        $visitor = new visitor;
        $visitor->name = $request->name;
        $visitor->surname = $request->surname;
        $visitor->idnr = $request->idnr;
        $visitor->date = $request->date;
        $visitor->state = $request->state;
        $visitor->gender = $request->gender;
        $visitor->email = $request->email;
        $visitor->phone = $request->phone;
        $visitor->comments = $request->comments;
        $visitor->status = $request->status;
        $visitor->save();
        return redirect(route('visitor.index'))->with('message','Visitor Created Successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxStore(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'surname'=>'required',
            'idnr'=>'required|unique:visitors'
        ]);

        $visitor = new visitor;
        $visitor->name = $request->name;
        $visitor->surname = $request->surname;
        $visitor->idnr = $request->idnr;
        $visitor->date = $request->date;
        $visitor->state = $request->state;
        $visitor->gender = $request->gender;
        $visitor->email = $request->email;
        $visitor->phone = $request->phone;
        $visitor->comments = $request->comments;


        $visitor->save();

        $response = Response::create($visitor, 200);

        $response->header('Content-Type', 'application/json');

        return $response;
    }

    public function ChangeStatus(Request $request)
    {
        $visitor = Visitor::findOrFail($request->id);
        $visitor->update(['status' => $visitor->status == 1? 0:1]);

        return response()->json(array('success' => true));
    }

    public function ajaxList(Request $request)
    {
        $totalData = Visitor::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');


        $search = $request->input('search.value');

        $visitors =  Visitor::withCount(["visits"=>function($query){
            $query->where("checked_out",0);
        }])
            ->where('name','like',"%{$search}%")
            ->orWhere('surname','like',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy("name")
            ->orderBy("surname")
            ->get();

        $totalFiltered = Visitor::where('name','like',"%{$search}%")
            ->orWhere('surname','like',"%{$search}%")
            ->count();


        $data = array();
        if(!empty($visitors))
        {
            foreach ($visitors as $visitor)
            {
                $nestedData['id'] = $visitor->id;
                $nestedData['name'] = $visitor->name;
                $nestedData['surname'] = $visitor->surname;
                $nestedData['gender'] = $visitor->gender;
                $nestedData['idnr'] = $visitor->idnr;
                $nestedData['date'] = $visitor->date;
                $nestedData['state'] = $visitor->state;
                $nestedData['email'] = $visitor->email;
                $nestedData['phone'] = $visitor->phone;
                $nestedData['comments'] = $visitor->comments;
                $nestedData['status'] = $visitor->status?'Aktiv':'Inaktiv';
                $nestedData['actual_visit'] = $visitor->visits_count==0?'Jo':'Po';

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
        $visits = visit::all();
        if (Auth::user()->can('visitors.update')) {
            $visitor = visitor::where('id', $id)->first();

            return view('admin.visitor.edit',compact('visitor','visits'));
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

        ]);

        $visitor = visitor::find($id);
        $visitor->surname = $request->surname;
        $visitor->email = $request->email;
        $visitor->phone = $request->phone;
        $visitor->comments = $visitor->comments."\n".$request->comments;
        $visitor->status = $request->status;
        $visitor->save();


        return redirect(route('visitor.index'))->with('message','Visitor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $visitor = Visitor::findOrFail($request->visit_id);
        $visitor->delete();
        return back()->with('message','Visitor Deleted Successfully');

    }
}
