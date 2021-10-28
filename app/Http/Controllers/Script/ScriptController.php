<?php

namespace App\Http\Controllers\Script;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CampaignRepository;
use App\Repositories\LeadRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use App\Api\LemlistApi;
use App\Lead;

class ScriptController extends Controller{

    /*
    * Script for email bounce for campaignIds
    */
    public function emailbounce(Request $request){
        $objLemlistApi = new LemlistApi('activities');
        $cmp_id = $request->input('cmp_id');
        $objResult = $objLemlistApi->callApiWithGetData("?type=emailsBounced&campaignId={$cmp_id}");
        if(!empty($objResult)){
            foreach($objResult as $key=>$value){
                $objLeadModel = new Lead();
                $objExistedLead = $objLeadModel->where('email',$value->leadEmail)
                                                ->where('is_inserted_lemlist','1\'')
                                                ->where('campaign_id',$value->campaignId)
                                                ->get();
                
                //echo "<pre>";var_dump($objExistedLead->());
            }
        }
        
    }


}
