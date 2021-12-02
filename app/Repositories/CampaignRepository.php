<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Campaign;
use App\Api\LemlistApi;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CampaignRepository extends BaseRepository
{
 
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Campaign::class;
    }


    /*
    * function to get all capaigns from database
    * @param void
    * @return array of objects
    * @author Shiv Kumar Tiwari
    */ 
    public function getAllCampaigns()
    {

        $campaigns = $this->_model;
        $campaigns = $campaigns->where('is_delete', 0)->orderBy('id', 'desc')->get();
        return $campaigns;
    }
    public function getAllCampaignsbydistribute()
    {
        $campaigns = $this->_model;
        $campaigns = $campaigns->where('is_delete', 0)->where('type','Lead Distribution')->orderBy('id', 'desc')->get();
        return $campaigns;
    }
    public function getAllCampaignsWithDataTable()
    {

        $campaigns = $this->_model->where('is_delete',0);
        $table = new DataTables();
        return $table->eloquent($campaigns)
            ->addColumn('all_chk', function ($data) {
                return "<label class='checkbox checkbox-lg'><input type='checkbox' name='campaigns' id='chk_{$data->campaign_id}' class='campaigns_checkbox' value='{$data->campaign_id}'><span></span></label>";
            })
            ->addColumn('campaign_id', function ($data) {
              
                return "<a href='script-emailsent?cmp_id={$data->campaign_id}' target='_blank'>{$data->campaign_id}</a>";
            })
            // ->addColumn('email_unsubscribe', function ($data) {
              
            //     return "<a href='script-emailunsubscribe?cmp_id={$data->campaign_id}' target='_blank'>{$data->campaign_id}</a>";
            // })
            ->editColumn('updated_at', function ($data) {
                return date("d M, Y H:i:s", strtotime($data->updated_at));
            })->addIndexColumn()
            ->rawColumns(['all_chk','campaign_id'])
            //,'campaign_id'
            ->toJson();
    }

    /**

     * Show the application dashboard.
     *
     * @return void 
     */

    public function deleteRestoreAll($request, $varData){
        $this->_model->whereIn('campaign_id',$request)->update(array('is_delete'=>$varData));
    }
    public function insertType($request, $varData){
        $this->_model->whereIn('campaign_id',$request)->update(array('type'=>$varData));
    }
    /*
    * function to get all capaigns from Lemlist and save or update into our database
    * @param void
    * @return void
    * @author Shiv Kumar Tiwari
    */
    public function syncCampaign()
    {
        $user = Auth::user();
        $objLemlistApi = new LemlistApi('campaigns');
        $jsonData = $objLemlistApi->callApi();
        if (!empty($jsonData)) {
            foreach ($jsonData as $arrCmpData) {
                if (!empty($arrCmpData->name)) {
                    $arrCheck = ['campaign_id' => $arrCmpData->_id];
                    $attributes = [
                        'campaign_id' => $arrCmpData->_id,
                        'campaign_name' => $arrCmpData->name
                    ];
                    $this->_model->updateOrCreate($arrCheck, $attributes);
                }
            }
        }
    }
    public function getLatestCompaign(){
        $campaigns = $this->_model->where('is_delete', 0);
        $campaigns = $campaigns->orderBy('id', 'desc')->limit(5)->get();
		return $campaigns;
    }
    // get all the campaigns based on a user
    public function getUserCampaigns($user){
        $modelUser = new User();
        $objUser = $modelUser->where('id',$user)->first();
        if(!empty($objUser->name)){
            $firstName = explode(" ",$objUser->name);
            $objCampaigns = $this->_model->where('campaign_name','like',"%{$firstName[0]}%")->orderBy('campaign_name','asc')->get();
        }else{
            $objCampaigns = $this->_model->orderBy('campaign_name','asc')->get();
        }
        return $objCampaigns;
    }
}
