<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rittiky;
use DataTables;
use Validator;
class RittikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','role:admin'])->except(['getRittiki']);
    }
    public function index()
    {
        if (request()->ajax()){
            $get=Rittiky::with('ammount')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
                            <a data-url="'.route('rittiki.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                            <a data-url="'.route('rittiki.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>
                        </div>';
            return $button;
          })
          ->addColumn('total',function($get){
              return number_format($get->ammount->sum('ammount'),2);
          })
          ->addColumn('pays',function($get){
            return number_format($get->pays->sum('ammount'),2);
        })
        ->addColumn('balance',function($get){
            return number_format(intval($get->ammount->sum('ammount')-$get->pays->sum('ammount')),2);
        })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.rittiki.rittiki');
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
            'name'=>"required|max:200|min:1",
            'adress'=>"required|max:200|min:1",
            'mobile'=>"required|max:200|min:1|unique:rittikies,mobile",
        ]);

        if($validator->passes()){
            $rittiky=new Rittiky;
            $rittiky->name=$request->name;
            $rittiky->adress=$request->adress;
            $rittiky->mobile=$request->mobile;
            $rittiky->author_id=auth()->user()->id;
            $rittiky->save();
            if ($rittiky) {
                return response()->json(['message'=>'ঋত্বিকী যুক্ত হয়েছে']);
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
        return response()->json(Rittiky::find($id));
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
            'name'=>"required|max:200|min:1",
            'adress'=>"required|max:200|min:1",
            'mobile'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $rittiky=Rittiky::find($id);
            $rittiky->name=$request->name;
            $rittiky->adress=$request->adress;
            $rittiky->mobile=$request->mobile;
            $rittiky->author_id=auth()->user()->id;
            $rittiky->save();
            if ($rittiky) {
                return response()->json(['message'=>'ঋত্বিকী হালনাগাদ সম্পন্ন হয়েছে']);
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
        return false;
        $delete=Rittiky::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'ঋত্বিকী ডিলেট করা হয়েছে']);
        }else{
            return response()->json(['warning'=>'কিছু একটা ভুল করেছেন']);
        }
    }
    public function getRittiki(Request $request){
        $donors= Rittiky::where('name','like','%'.$request->searchTerm.'%')->orWhere('mobile','like','%'.$request->searchTerm.'%')->take(15)->get();
        foreach ($donors as $value){
            $set_data[]=['id'=>$value->id,'text'=>$value->name.'('.$value->mobile.')'];
        }
        return $set_data;
     }
}
