<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Validator;
use Hash;
use App\Rules\roleRule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        // return Auth::user()->getRoleNames()[0];
        if(request()->ajax()){
            $get=User::all();
            return DataTables::of($get)
              ->addIndexColumn()
              ->addColumn('action',function($get){
              $button  ='<div class="d-flex justify-content-center">
              <a data-url="'.route('user.edit',$get->id).'"  href="javascript:void(0)" class="btn btn-primary shadow btn-xs sharp me-1 editRow"><i class="fas fa-pencil-alt"></i></a>
              <a data-url="'.route('user.destroy',$get->id).'" href="javascript:void(0)" class="btn btn-danger shadow btn-xs sharp ml-1 deleteRow"><i class="fa fa-trash"></i></a>
          </div>';
            return $button;
          })
          ->addColumn('role',function($get){
              foreach($get->roles->take(1) as $roles){
                  $role=$roles->name;
              }
              return $role;
          })
          ->addColumn('isban',function($get){
            return ($get->isban==1? 'blocked': "active");
        })
          ->rawColumns(['action','role'])->make(true);
        }
        return view('backend.user.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'name'=>"required|max:200|min:1",
            'email'=>"required|email|max:200|min:1",
            'adress'=>"required|max:200|min:1",
            'mobile'=>"required|max:11|min:11|unique:users,mobile",
            'status'=>"required|max:1",
            'password'=>"required|max:50|min:6|confirmed",
            'role'=>["required","max:50","min:1",new roleRule],
        ]);
        if($validator->passes()){
            $user=new User;
            $user->name=$request->name;
            $user->adress=$request->adress;
            $user->mobile=$request->mobile;
            $user->email=$request->email;
            $user->isban=$request->status;
            $user->password=Hash::make($request->password);
            $user->assignRole($request->role);
            $user->save();
            if ($user) {
                return response()->json(['message'=>'User Added Success']);
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
        return response()->json(User::with('roles')->find($id));
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
            'email'=>"required|email|max:200|min:1",
            'adress'=>"required|max:200|min:1",
            'mobile'=>"required|max:11|min:11|unique:users,mobile,".$id,
            'role'=>"required|max:50|min:1",
            'status'=>"required|max:1|min:1",
        ]);
        if($validator->passes()){
            $user=User::find($id);
            $user->name=$request->name;
            $user->adress=$request->adress;
            $user->mobile=$request->mobile;
            $user->email=$request->email;
            $user->isban=$request->status;
            $user->assignRole($request->role);
            $user->save();
            if ($user) {
                return response()->json(['message'=>'User Updated Success']);
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

   
}
