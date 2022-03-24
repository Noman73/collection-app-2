<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\User;
use Validator;
use DataTables;
use URL;
class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }
    public function index()
    {
        if (request()->ajax()){
            $get=Submission::with('collector')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('submission.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('submission.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>
              <a data-url="'.URL::to('submission-view/'.$get->id).'" href="javascript:void(0)" class="btn btn-secondary shadow btn-xs sharp ml-1 dataView"><i class="fa fa-eye"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('collector',function($get){
            return $get->collector->name;
        })
          ->rawColumns(['action','collector'])->make(true);
        }
        return view('backend.submission.submission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'collector'=>"required|max:200|min:1",
            'ammount'=>"required|max:20|min:1",
            'comment'=>"nullable|max:500",
        ]);
        if($validator->passes()){
            $donor=new Submission;
            $donor->collector_id=$request->collector;
            $donor->ammount=$request->ammount;
            $donor->comment=$request->comment;
            $donor->status=1;
            $donor->author_id=auth()->user()->id;
            $donor->save();
            if ($donor) {
                return response()->json(['message'=>'Submission Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
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
        return response()->json(Submission::with('collector')->find($id));
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
        $validator=Validator::make($request->all(),[
            'collector'=>"required|max:200|min:1",
            'ammount'=>"required|max:20|min:1",
        ]);
        if($validator->passes()){
            $donor=Submission::find($id);
            $donor->collector_id=$request->collector;
            $donor->ammount=$request->ammount;
            $donor->status=1;
            $donor->author_id=auth()->user()->id;
            $donor->save();
            if ($donor) {
                return response()->json(['message'=>'Submission Updated Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Submission::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'ডিলেট করা হয়েছে']);
        }else{
            return response()->json(['warning'=>'কিছু একটা ভুল করেছেন']);
        }
    }

    public function getCollector(Request $request){
        $donors= User::where('name','like','%'.$request->searchTerm.'%')->orWhere('email','like','%'.$request->searchTerm.'%')->take(15)->get();
        foreach ($donors as $value){
             $set_data[]=['id'=>$value->id,'text'=>$value->name.'('.$value->email.')'];
         }
         return $set_data;
     }

     public function getData($id)
     {
       return response()->json(Submission::with('author')->find($id));
     }
}
