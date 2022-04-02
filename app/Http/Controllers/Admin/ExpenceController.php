<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expence;
use Validator;
use DataTables;
class ExpenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()){
            $get=Expence::with('expence_area')->get();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
                            <a data-url="'.route('expence.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                            <a data-url="'.route('expence.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>
                        </div>';
            return $button;
          })
          ->addColumn('name',function($get){
            return $get->expence_area->name;
        })
          ->rawColumns(['action'])->make(true);
        }
        return view('backend.expence.expence');
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
        // return response()->json($request->all());
        $validator=Validator::make($request->all(),[
            'expence_area'=>"required|max:200|min:1",
            'ammount'=>"required|max:20|min:1",
        ]);
        if($validator->passes()){
            $expence=new Expence;
            $expence->exp_id=$request->expence_area;
            $expence->ammount=$request->ammount;
            $expence->author_id=auth()->user()->id;
            $expence->save();
            if ($expence) {
                return response()->json(['message'=>'Expence Added Success']);
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
        return response()->json(Expence::with('expence_area')->find($id));
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
            'ammount'=>"required|max:20|min:1",
        ]);
        if($validator->passes()){
            $expence=Expence::find($id);
            $expence->exp_id=$request->expence_area;
            $expence->ammount=$request->ammount;
            $expence->author_id=auth()->user()->id;
            $expence->save();
            if ($expence) {
                return response()->json(['message'=>'Expence Added Success']);
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
        $validator=Validator::make($request->all(),[
            'expence_area'=>"required|max:200|min:1",
            'ammount'=>"required|max:20|min:1",
        ]);
        if($validator->passes()){
            $expence=Expence::find($id);
            $expence->exp_id=$request->expence_area;
            $expence->ammount=$request->ammount;
            $expence->author_id=auth()->user()->id;
            $expence->save();
            if ($expence) {
                return response()->json(['message'=>'Expence Added Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }
}
