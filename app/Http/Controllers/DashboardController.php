<?php

namespace App\Http\Controllers;

use App\User;
use App\Campaign;
use App\Role;
use App\Lead;
use App\Sheet;
use App\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\CampaignRepository;
use App\Repositories\LeadRepository;

   
class DashboardController extends Controller{
    public function index(CampaignRepository $campaignRepositery,LeadRepository $objLeadRepository){
		$arrData = array();
        $arrData['userCount'] = User::where('role_id',2)->count();
        $arrData['compaignCount'] = Campaign::count();
        $arrData['leadCount'] = Lead::whereIn('uploaded_by',[33,34])->count();
        //$arrData['leadCount'] = Lead::count();
        $arrData['sheetCount'] = Sheet::count();
        $arrData['emailBounceCount']=Lead::where('email_bounce','1')->whereIn('uploaded_by',[33,34])->count();
        $arrData['emailunsubscribe']=Lead::where('email_unsubscribe','1')->whereIn('uploaded_by',[33,34])->count();
        $duplicates = DB::table('tbl_leads')
                        ->select(DB::raw('COUNT(*) as `count`'))
                        ->where('is_inserted_lemlist',0)
                        ->get();
        $duplicateLeadCount = !empty($duplicates[0]) ? $duplicates[0]->count : 0 ;
        $arrData['getLatestCompaign'] = $campaignRepositery->getLatestCompaign();
        $arrData['getLatestSheet'] = $objLeadRepository->getLatestSheets();
        $arrData['getLatestLeads'] = $objLeadRepository->getLatestLeads();
       // echo "<pre>";var_dump($arrData['getLatestCompaign']);exit;
        $arrData['duplicateLeadCount'] = $duplicateLeadCount;
        return view('index',$arrData);
    }

    public function subadmin(){
        return view('admin.subadmin.index');
    }

}
