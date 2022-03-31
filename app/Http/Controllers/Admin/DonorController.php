<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use DataTables;
use Validator;
use Auth;
class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        // $this->middleware(['role:admin'])->except(['index']);
    }
    public function index()
    {
        if(request()->ajax()){
            $get=Donor::query();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">';
              if(Auth::user()->hasRole('admin')){
                $button.='<a data-url="'.route('donor.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('donor.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>';
              }else{
                $button.='X';
              }
              $button.='</div>';
            return $button;
          })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.donor.donor');
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
            'mobile'=>"required|max:200|min:1|regex:/^([0-9]+)$/",
        ]);
        if($validator->passes()){
            $donor=new Donor;
            $donor->name=$request->name;
            $donor->adress=$request->adress;
            $donor->mobile=$request->mobile;
            $donor->author_id=auth()->user()->id;
            $donor->save();
            if ($donor) {
                return response()->json(['message'=>'Donor Added Success']);
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
        return response()->json(Donor::find($id));
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
            'name'=>["required","max:200","min:1"],
            'adress'=>["required","max:200","min:1"],
            'mobile'=>["required","max:200","min:1"],
        ]);

        if($validator->passes()){
            $donor=Donor::find($id);
            $donor->name=$request->name;
            $donor->adress=$request->adress;
            $donor->mobile=$request->mobile;
            $donor->author_id=auth()->user()->id;
            $donor->save();
            if ($donor) {
                return response()->json(['message'=>'Donor Updated Success']);
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
        $delete=Donor::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'দাতা ডিলেট করা হয়েছে']);
        }else{
            return response()->json(['warning'=>'কিছু একটা ভুল করেছেন']);
        }

    }
    public function getDonor(Request $request){
       $donors= Donor::where('name','like','%'.$request->searchTerm.'%')->orWhere('mobile','like','%'.$request->searchTerm.'%')->take(15)->get();
       foreach ($donors as $value){
            $set_data[]=['id'=>$value->id,'text'=>$value->name.'('.$value->mobile.')'];
        }
        return $set_data;
    }
}
