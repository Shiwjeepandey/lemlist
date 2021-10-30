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
        $arrData['leadCount'] = Lead::count();
        $arrData['sheetCount'] = Sheet::count();
        $arrData['emailBounceCount']=Activity::where('type','email_bounce')->count();
        $arrData['emailunsubscribe']=Activity::where('type','emailunsubscribe')->count();

        $duplicates = DB::table('tbl_leads')
            ->select('email', DB::raw('COUNT(*) as `count`'))
            ->groupBy('email')
            ->having('count', '>', 1)
            ->get(); 
           // echo "<pre>";var_dump($duplicates);exit;
        $duplicateLeadCount = 0;
        if(!empty($duplicates[0])){
            $sumDuplicate = 0;
           foreach($duplicates as $duplicate){
            $sumDuplicate = $sumDuplicate+$duplicate->count;
           }
           $duplicateLeadCount = $sumDuplicate-$duplicates->count();
        }
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
