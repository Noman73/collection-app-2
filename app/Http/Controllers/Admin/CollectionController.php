<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\RittikiRelation;
use App\Models\User;
use Validator;
use DataTables;
use Auth;
class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        // return Auth::user()->hasRole('collector');
        // if(Auth::user()->hasRole('collector')){
        //     return "okkk";
        // }else{
        //     return Auth::user()->assignRole('admin');;
        // }
        if (request()->ajax()){
            if(Auth::user()->hasRole('collector')){
                $get=Collection::with('donor','totalrittik')->where('author_id',auth()->user()->id)->get();
            }elseif(Auth::user()->hasRole('admin')){
                $get=Collection::with('donor','totalrittik')->get();
            }
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
                    $button  ='<div class="d-flex justify-content-center">';
                    if(Auth::user()->hasRole('admin')){
                        $button.='<a data-url="'.route('collection.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
                    <a data-url="'.route('collection.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp deleteRow"><i class="fa fa-trash"></i></a>';
                    }
                    $button.='</div>';
            return $button;
          })
          ->addColumn('name',function($get){
             return $get->donor->name;
        })
        ->addColumn('adress',function($get){
            return $get->donor->adress;
        })
       ->addColumn('totalrittik',function($get){
            return $get->totalrittik->sum('ammount');
        })
        ->addColumn('total',function($get){
            return $get->totalrittik->sum('ammount')+$get->total;
        })
        ->rawColumns(['action','adress','name'])->make(true);
        }
        return view('backend.collection.collection');
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
        // return $request->all();
        $validator=Validator::make($request->all(),[
            'donor'=>"required|max:200|min:1",
            'sostoyoni'=>"required|max:200|min:1",
            'istovriti'=>"required|max:200|min:1",
            'dokkhina'=>"required|max:200|min:1",
            'songothoni'=>"required|max:200|min:1",
            'pronami'=>"required|max:200|min:1",
            'advertisement'=>"required|max:200|min:1",
            'mandir_construction'=>"required|max:200|min:1",
            'various'=>"required|max:200|min:1",
            'rittiki'=>"required|max:200|min:1",
            'rittiki_ammount'=>"required|max:200|min:1",
            'kristi_bandhob'=>"required|max:200|min:1",
            'sri_thakur_vog'=>"required|max:200|min:1",
            'ananda_bazar'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $collection=new Collection;
            $collection->donor_id=$request->donor;
            $collection->sostoyoni=$request->sostoyoni;
            $collection->istovriti=$request->istovriti;
            $collection->dokkhina=$request->dokkhina;
            $collection->songothoni=$request->songothoni;
            $collection->pronami=$request->pronami;
            $collection->advertise=$request->advertisement;
            $collection->mandir_construction=$request->mandir_construction;
            $collection->kristi_bandhob=$request->kristi_bandhob;
            $collection->sri_thakur_vog=$request->sri_thakur_vog;
            $collection->ananda_bazar=$request->ananda_bazar;
            $collection->various=$request->various;
            $collection->total=$request->various+$request->sostoyoni+$request->istovriti+$request->dokkhina+$request->songothoni+$request->pronami+$request->advertisement+$request->mandir_construction;
            $collection->author_id=auth()->user()->id;
            $collection->save();
            $ammount=explode(',',$request->rittiki_ammount);
            $i=0;
            foreach(explode(',',$request->rittiki) as $data){
                $rittiki_relations=new RittikiRelation;
                $rittiki_relations->collection_id=$collection->id;
                $rittiki_relations->ammount=$ammount[$i];
                $rittiki_relations->rittiki_id=$data;
                $rittiki_relations->donor_id=$collection->donor_id;
                $rittiki_relations->author_id=auth()->user()->id;
                $rittiki_relations->save();
                $i++;
            }
            if ($collection){
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
        return response()->json(Collection::with('rittik','donor')->find($id));
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
        // return response()->json($request->all());
        $validator=Validator::make($request->all(),[
            'donor'=>"required|max:200|min:1",
            'sostoyoni'=>"required|max:200|min:1",
            'istovriti'=>"required|max:200|min:1",
            'dokkhina'=>"required|max:200|min:1",
            'songothoni'=>"required|max:200|min:1",
            'pronami'=>"required|max:200|min:1",
            'advertisement'=>"required|max:200|min:1",
            'mandir_construction'=>"required|max:200|min:1",
            'various'=>"required|max:200|min:1",
            'rittiki'=>"required|max:200|min:1",
            'rittiki_ammount'=>"required|max:200|min:1",
        ]);

        if($validator->passes()){
            $collection=Collection::find($id);
            $collection->donor_id=$request->donor;
            $collection->sostoyoni=$request->sostoyoni;
            $collection->istovriti=$request->istovriti;
            $collection->dokkhina=$request->dokkhina;
            $collection->songothoni=$request->songothoni;
            $collection->pronami=$request->pronami;
            $collection->advertise=$request->advertisement;
            $collection->mandir_construction=$request->mandir_construction;
            $collection->various=$request->various;
            $collection->total=$request->various+$request->sostoyoni+$request->istovriti+$request->dokkhina+$request->songothoni+$request->pronami+$request->advertisement+$request->mandir_construction;
            $collection->author_id=auth()->user()->id;
            $collection->save();
            $ammount=explode(',',$request->rittiki_ammount);
            $rel_no=explode(',',$request->rel_no);
            $i=0;
            foreach(explode(',',$request->rittiki) as $data){
                if(isset($rel_no[$i])){
                $rittiki_relations=RittikiRelation::find($rel_no[$i]);
                $rittiki_relations->collection_id=$collection->id;
                $rittiki_relations->ammount=$ammount[$i];
                $rittiki_relations->rittiki_id=$data;
                $rittiki_relations->donor_id=$collection->donor_id;
                $rittiki_relations->author_id=auth()->user()->id;
                $rittiki_relations->save();
                $i++;
                }else{
                    $rittiki_relations=new RittikiRelation;
                    $rittiki_relations->collection_id=$collection->id;
                    $rittiki_relations->ammount=$ammount[$i];
                    $rittiki_relations->rittiki_id=$data;
                    $rittiki_relations->donor_id=$collection->donor_id;
                    $rittiki_relations->author_id=auth()->user()->id;
                    $rittiki_relations->save();
                    $i++;
                }
                
            }
            if ($collection){
                return response()->json(['message'=>'Collection Updated Success']);
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
        $delete=Collection::where('id',$id)->delete();
        if ($delete) {
            return response()->json(['message'=>'কালেকশন ডিলেট করা হয়েছে']);
        }else{
            return response()->json(['warning'=>'কিছু একটা ভুল করেছেন']);
        }
    }
}
