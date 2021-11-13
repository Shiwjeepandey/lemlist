<?php

// this controller handles all the campaigns related urls and crud operations
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CampaignRepository;
use Illuminate\Contracts\View\View;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller{

    private $objCampaignRepositery;

    public function __construct(CampaignRepository $campaignRepositery){
        $this->objCampaignRepositery = $campaignRepositery;
    }

    public function index(){
		return view('campaigns.index',[
        ]);
    } 
 
    public function get_campaigns(Request $request){
        if ($request->ajax()){
            $arrCampaigns = $this->objCampaignRepositery->getAllCampaignsWithDataTable();
            return ($arrCampaigns);
        }
    } 
    // delete campaigns
    public function delete_campaigns(Request $request){

        if ($request->ajax()){
            $varAction = $request->post('action');
            if($varAction=='Delete'){
                $arrCampaigns = $this->objCampaignRepositery->deleteRestoreAll($request->post('cmp'),1);
                Session::flash('success', 'Campaigns Deleted successfully!');
            }else if($varAction=='Reporting'){
                $arrCampaigns = $this->objCampaignRepositery->insertType($request->post('cmp'),'Reporting');
                Session::flash('success', 'Campaigns Assign Reporting Successfully!');
            }
            else if($varAction=='Lead_Distribution'){
                $arrCampaigns = $this->objCampaignRepositery->insertType($request->post('cmp'),'Lead Distribution');
                Session::flash('success', 'Campaigns Assign Lead Distribution Successfully!');
            }
          
            return response('done');
        }
    } 
 

    public function sync_with_lemlist(Request $request){
        if ($request->ajax()){
            $this->objCampaignRepositery->syncCampaign();
            return response()->json(array('processed'=>1));
        }
    }
   
   


} 