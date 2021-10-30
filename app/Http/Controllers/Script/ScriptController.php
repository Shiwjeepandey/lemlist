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
                
                   if(!empty($objExistedLead[0]->id))
                   {

                      $emailbounce=Lead::find($objExistedLead[0]->id);
                      $emailbounce->email_bounce='1';
                      $emailbounce->update();
                      if(!empty($emailbounce))
                      { 
                        $activity=new Activity;
                        //   $activity=new Activity([
                        //   'email'=>$value->leadEmail,
                        //   'campaign_id'=>$value->campaignId,
                        //   'raw_data'=>$objExistedLead,
                        //   'create_date'=>time(),
                        //   ]);

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
