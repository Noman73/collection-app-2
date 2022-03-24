<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RittikiPay;
use DataTables;
use Validator;
class RittikiPayController extends Controller
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
            $get=RittikiPay::with('rittiki')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('rittiki-pay.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('rittiki-pay.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('rittiki',function($get){
            return $get->rittiki->name;
        })
          ->rawColumns(['action','collector'])->make(true);
        }
        return view('backend.rittiki-pay.rittiki-pay');
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
            'rittiki'=>"required|max:200|min:1",
            'ammount'=>"required|max:20|min:1",
        ]);
        if($validator->passes()){
            $donor=new RittikiPay;
            $donor->rittiki_id=$request->rittiki;
            $donor->ammount=$request->ammount;
            $donor->status=1;
            $donor->author_id=auth()->user()->id;
            $donor->save();
            if ($donor) {
                return response()->json(['message'=>'ঋত্বিকী পরিশোধ সম্পন্ন হয়েছে']);
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
        return response()->json(RittikiPay::with('rittiki')->find($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=RittikiPay::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'ডিলেট করা হয়েছে']);
        }else{
            return response()->json(['warning'=>'কিছু একটা ভুল করেছেন']);
        }
    }
}
