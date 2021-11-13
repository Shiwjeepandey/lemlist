<?php

namespace App\Http\Controllers\Script;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CampaignRepository;
use App\Repositories\LeadRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use App\Api\LemlistApi;
use App\Lead;
use App\Activity;
use Illuminate\Support\Facades\DB;

class ScriptController extends Controller{ 

    /*
    * to list the webhooks on lemlist
    */
    public function listLemlistWebhooks(Request $request)
    {
        $objLemlistApi = new LemlistApi('hooks');
        $objResult = $objLemlistApi->callApi();
        dd($objResult);
    }

     /*
    * to create the webhooks on lemlist
    */
    public function createLemlistWebhooks(Request $request)
    {
        $objLemlistApi = new LemlistApi('hooks');
        $objResult = $objLemlistApi->callApiWithData([
            'targetUrl'=>"https://lemlist.statuscrawl.io/webhooks/email-unsubscribe",
            'type'=>"emailsUnsubscribed",
            'isFirst'=>true
        ]);
        dd($objResult);
    }
    
    /*
    * process webhooks
    */
    public function processWebhooks(Request $request)
    {
        $data = json_encode($request->post());
        DB::insert('insert into tbl_temp (type,data_json) values (?,?)', ['',$data]);
    }

    /*
    * process webhooks
    */
    public function processEmailSentWebhooks(Request $request)
    {
        $data = json_encode($request->post());
        DB::insert('insert into tbl_temp (type,data_json) values (?,?)', ['emailsSent',$data]);
    }

    /*
    * process for email bounces
    */
    public function processBounceWebhooks(Request $request)
    {
        $arrPostData = $request->post();
        if(!empty($arrPostData)){
            $objLeadModel = new Lead();
            $objExistedLead = $objLeadModel->where('email',$arrPostData['leadEmail'])
                                                ->where('is_inserted_lemlist','1\'')
                                                ->where('campaign_id',$arrPostData['campaignId'])
                                                ->get();
            if(!empty($objExistedLead[0]->id)){
                $emailbounce=Lead::find($objExistedLead[0]->id);
                $emailbounce->email_bounce='1';
                $emailbounce->update();
            }
        }
        $data = json_encode($arrPostData);
        DB::insert('insert into tbl_temp (type,data_json) values (?,?)', ['emailsBounced',$data]);
    }

     /*
    * process for email bounces
    */
    public function processUnsubscribeWebhooks(Request $request)
    {
        $arrPostData = $request->post();
        if(!empty($arrPostData)){
            $objLeadModel = new Lead();
            $objExistedLead = $objLeadModel->where('email',$arrPostData['leadEmail'])
                                                ->where('is_inserted_lemlist','1\'')
                                                ->where('campaign_id',$arrPostData['campaignId'])
                                                ->get();
            if(!empty($objExistedLead[0]->id)){
                $emailunsubscribe=Lead::find($objExistedLead[0]->id);
                $emailunsubscribe->email_unsubscribe='1';
                $emailunsubscribe->update();
            }
        }
        $data = json_encode($arrPostData);
        DB::insert('insert into tbl_temp (type,data_json) values (?,?)', ['emailsUnsubscribed',$data]);
    }
    

    
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
                
                   if(!empty($objExistedLead[0]->id))
                   {

                      $emailbounce=Lead::find($objExistedLead[0]->id);
                      $emailbounce->email_bounce='1';
                      $emailbounce->update();
                      if(!empty($emailbounce))
                      { 
                        $activity=new Activity;
                        $checkemail=$activity->where('email',$value->leadEmail)
                                              ->where('type','email_bounce')
                                              ->get();
                        
                        if(sizeof($checkemail)==0)
                        {
                            $activity->email=$value->leadEmail;
                            $activity->campaign_id=$value->campaignId;
                            $activity->raw_data=$objExistedLead;
                            $activity->type='email_bounce';
                            $activity->create_date=time();
                            $activity->save();
                        }
                      }
                   }   
                                          
            }
            return redirect(route('campaigns.index'));
           

        }
        else{
            return "data not found"; 
        }
        
    }
   
    public function emailunsubscribe(Request $request){
        $objLemlistApi = new LemlistApi('activities');
        $cmp_id = $request->input('cmp_id'); 
        $objResult = $objLemlistApi->callApiWithGetData("?type=emailsUnsubscribed&campaignId={$cmp_id}");
    
        if(!empty($objResult)){
            foreach($objResult as $key=>$value){
                $objLeadModel = new Lead();
                 $objExistedLead = $objLeadModel->where('email',$value->leadEmail)
                                                ->where('is_inserted_lemlist','1\'')
                                                ->where('campaign_id',$value->campaignId)
                                                ->get();
                
                   if(!empty($objExistedLead[0]->id))
                   {

                      $emailunsubscribe=Lead::find($objExistedLead[0]->id);
                      $emailunsubscribe->email_unsubscribe='1';
                      $emailunsubscribe->update();
                      if(!empty($emailunsubscribe))
                      { 
                        $activity=new Activity;
                      
                        $checkemail=$activity->where('email',$value->leadEmail)
                                              ->where('type','emailunsubscribe')
                                              ->get();
                        
                        if(sizeof($checkemail)==0)
                        {
                            $activity->email=$value->leadEmail;
                            $activity->campaign_id=$value->campaignId;
                            $activity->raw_data=$objExistedLead;
                            $activity->type='emailunsubscribe';
                            $activity->create_date=time();
                            $activity->save();
                        }
                        
                       
                      }
                   }   
                                          
            }
            return redirect(route('campaigns.index'));
           

        }
        else{
            return "data not found unsubscribe"; 
        }
        
    }


}
