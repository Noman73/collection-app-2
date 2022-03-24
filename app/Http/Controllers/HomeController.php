<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Collection;
use App\Models\RittikiRelation;
use App\Models\Submission;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->hasRole('collector')){
            $data=Collection::with('totalrittik')->where('author_id',auth()->user()->id)->get();
            $submission=Submission::where('collector_id',auth()->user()->id)->sum('ammount');
        }elseif(Auth::user()->hasRole('admin')){
            $data=Collection::with('totalrittik')->get();
            $submission=Submission::sum('ammount','submission');

        }
        return view('backend.dashboard.dashboard',compact('data','submission'));
    }
    public function loadData(Request $request)
    {
        $fromDate=strtotime($request->fromDate);
        $toDate=strtotime($request->toDate);
        $from= gmdate("Y-m-d H:i:s", $fromDate);
        $to= gmdate("Y-m-d H:i:s", $toDate);
        $rittikies=0;
        if(Auth::user()->hasRole('collector')){
            $data=Collection::with('totalrittik')->where('author_id',auth()->user()->id)->whereBetween('created_at', [$from, $to])->get();
            $sostoyoni=number_format($data->sum('sostoyoni'),2,'.','');
            $istovriti=number_format($data->sum('istovriti'),2,'.','');
            $dokkhina=number_format($data->sum('dokkhina'),2,'.','');
            $songothoni=number_format($data->sum('songothoni'),2,'.','');
            $pronami=number_format($data->sum('pronami'),2,'.','');
            $advertise=number_format($data->sum('advertise'),2,'.','');
            $mandir_construction=number_format($data->sum('mandir_construction'),2,'.','');
            $kristi_bandhob=number_format($data->sum('kristi_bandhob'),2,'.','');
            $sri_thakur_vog=number_format($data->sum('sri_thakur_vog'),2,'.','');
            $ananda_bazar=number_format($data->sum('ananda_bazar'),2,'.','');
            $various=number_format($data->sum('various'),2,'.','');
            $total_paid=Submission::whereBetween('created_at', [$from, $to])->sum('ammount');
            foreach($data as $rittiki){
                $rittikies+=$rittiki->totalrittik->sum('ammount');
            }
            $dataArray=['sostoyoni'=>$sostoyoni,'istovriti'=>$istovriti,'dokkhina'=>$dokkhina,'songothoni'=>$songothoni,'pronami'=>$pronami,'advertise'=>$advertise,'mandir_construction'=>$mandir_construction,'kristi_bandhob'=>$kristi_bandhob,'sri_thakur_vog'=>$sri_thakur_vog,'ananda_bazar'=>$ananda_bazar,'various'=>$various,'rittiki'=>$rittikies,'total_paid'=>$total_paid];
        }elseif(Auth::user()->hasRole('admin')){
            $data=Collection::with('totalrittik')->whereBetween('created_at', [$from, $to])->get();
            $sostoyoni=number_format($data->sum('sostoyoni'),2,'.','');
            $istovriti=number_format($data->sum('istovriti'),2,'.','');
            $dokkhina=number_format($data->sum('dokkhina'),2,'.','');
            $songothoni=number_format($data->sum('songothoni'),2,'.','');
            $pronami=number_format($data->sum('pronami'),2,'.','');
            $advertise=number_format($data->sum('advertise'),2,'.','');
            $mandir_construction=number_format($data->sum('mandir_construction'),2,'.','');
            $kristi_bandhob=number_format($data->sum('kristi_bandhob'),2,'.','');
            $sri_thakur_vog=number_format($data->sum('sri_thakur_vog'),2,'.','');
            $ananda_bazar=number_format($data->sum('ananda_bazar'),2,'.','');
            $various=number_format($data->sum('various'),2,'.','');
            foreach($data as $rittiki){
                $rittikies+=$rittiki->totalrittik->sum('ammount');
            }
            $total_paid=Submission::where('collector_id',auth()->user()->id)->whereBetween('created_at', [$from, $to])->sum('ammount');
            $total=$sostoyoni+$istovriti+$dokkhina+$songothoni+$pronami+$advertise+$mandir_construction+$kristi_bandhob+$sri_thakur_vog+$ananda_bazar+$various+$rittikies;
            $dataArray=['sostoyoni'=>$sostoyoni,'istovriti'=>$istovriti,'dokkhina'=>$dokkhina,'songothoni'=>$songothoni,'pronami'=>$pronami,'advertise'=>$advertise,'mandir_construction'=>$mandir_construction,'kristi_bandhob'=>$kristi_bandhob,'sri_thakur_vog'=>$sri_thakur_vog,'ananda_bazar'=>$ananda_bazar,'various'=>$various,'rittiki'=>$rittikies,'total_paid'=>$total_paid,'total'=>$total,'total_having'=>(floatval($total)-floatval($total_paid))];
        }
        return response()->json($dataArray);
    }
}
