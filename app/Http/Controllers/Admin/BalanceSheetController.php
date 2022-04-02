<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class BalanceSheetController extends Controller
{
    public function getForm()
    {
        return view('backend.balanceSheet.bs');
    }

    public function getData(Request $request)
    {

        $fromDate=strtotime($request->fromDate);
        $toDate=strtotime($request->toDate);
        $from= gmdate("Y-m-d H:i:s", $fromDate);
        $to= gmdate("Y-m-d H:i:s", $toDate);
        $query="SELECT collections.created_at created_at,'collection' as names,collections.sostoyoni+collections.istovriti+collections.dokkhina+collections.songothoni+collections.pronami+collections.advertise+collections.mandir_construction+collections.kristi_bandhob+collections.sri_thakur_vog+collections.ananda_bazar+collections.various+rittiki_relations.ammount
                total,0 expence from collections
                inner join (
                    select collection_id,sum(ammount) ammount from rittiki_relations group by collection_id
                ) rittiki_relations on collections.id=rittiki_relations.collection_id
                where collections.created_at >= :collection_from and collections.created_at <=:collection_to 
                UNION ALL
                SELECT expences.created_at,expence_areas.name,0,ammount from expences
                inner join expence_areas  on expence_areas.id=expences.exp_id
                where expences.created_at >= :ex_from and expences.created_at <= :ex_to 
                order by created_at
                ";
        $data=DB::select($query,['collection_from'=>$from,"collection_to"=>$to,"ex_from"=>$from,"ex_to"=>$to]);
        
        return $data;
    }
}
