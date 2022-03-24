<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scrolling;
use Validator;
class ScrollingController extends Controller
{
    public function showForm(){
        return view('backend.scroller.scrolling');
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'description'=>"required|max:200|min:1",
        ]);
        if($validator->passes()){
            if(Scrolling::count()>0){
                $donor=Scrolling::first();
            }else{
                $donor=new Scrolling;
            }
            $donor->description=$request->description;
            $donor->author_id=auth()->user()->id;
            $donor->save();
            if ($donor) {
                return response()->json(['message'=>'description Added Success']);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }
}
