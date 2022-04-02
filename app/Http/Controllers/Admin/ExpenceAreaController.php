<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\ExpenceArea;
use DataTables;
class ExpenceAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()){
            $get=ExpenceArea::all();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
                            <a data-url="'.route('expence_area.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                            <a data-url="'.route('expence_area.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>
                        </div>';
            return $button;
          })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.expence_area.expence_area');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());

        $validator=Validator::make($request->all(),[
            'expence_area'=>"required|max:200|min:1",
        ]);
        if($validator->passes()){
            $expence=new ExpenceArea;
            $expence->name=$request->expence_area;
            $expence->author_id=auth()->user()->id;
            $expence->save();
            if ($expence) {
                return response()->json(['message'=>'Expence Area Added Success']);
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
        return response()->json(ExpenceArea::find($id));
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
            'expence_area'=>"required|max:200|min:1",
        ]);
        if($validator->passes()){
            $expence=ExpenceArea::find($id);
            $expence->name=$request->expence_area;
            $expence->author_id=auth()->user()->id;
            $expence->save();
            if ($expence) {
                return response()->json(['message'=>'Expence Area Updated Success']);
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
        //
    }

    public function getExpenceArea(Request $request)
    {
        $donors= ExpenceArea::where('name','like','%'.$request->searchTerm.'%')->take(15)->get();
        foreach ($donors as $value){
            $set_data[]=['id'=>$value->id,'text'=>$value->name];
        }
        return $set_data;
    }
}
