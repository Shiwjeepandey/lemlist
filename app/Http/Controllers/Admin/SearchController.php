<?php

// this controller handles all the campaigns related urls and crud operations
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CampaignRepository;
use App\Repositories\LeadRepository;
use App\Repositories\UserRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class SearchController extends Controller
{
  protected $campaignRepositery;
  protected $LeadRepository;
  protected $userRepositery;
  private $varExcludeUsers =['claire@statuslabs.com','esther@statuslabs.com'];
  public function __construct(CampaignRepository $campaignRepositery, LeadRepository $LeadRepository, UserRepository $userRepositery)
  {
    $this->objCampaignRepositery = $campaignRepositery;
    $this->objLeadRepositery = $LeadRepository;
    $this->userRepositery = $userRepositery;
  }

  public function index(Request $request)
  {
    $arrData = array();
    $get = $request->input();

    if (!empty($get['user_id'])) {
      $arrData['userId'] = $get['user_id'];
      $objCampaigns = $this->objCampaignRepositery->getUserCampaigns($arrData['userId']);
    } else {
      $arrData['userId'] = "";
      $objCampaigns = $this->objCampaignRepositery->getAllCampaigns();
    }
    $arrData['objCampaigns'] = $objCampaigns;

    $objUsers = $this->userRepositery->getAllUsers($this->varExcludeUsers, "name");
    $arrData['objUsers'] = $objUsers;
    // echo "<pre>";var_dump($arrData['objUsers']);exit;
    if (!empty($get['daterange'])) {
      $searchDateRange = explode('-', $get['daterange']);
      $fromArray = str_replace(' ', '', $searchDateRange[0]);
      $fromArraySkip = explode('/', $fromArray);
      $fromArrayDate = $fromArraySkip[2] . '-' . $fromArraySkip[0] . '-' . $fromArraySkip[1];
      $toArray = str_replace(' ', '', $searchDateRange[1]);
      $toArraySkip = explode('/', $toArray);
      $toArrayDate = $toArraySkip[2] . '-' . $toArraySkip[0] . '-' . $toArraySkip[1];
      //var_dump($fromArrayDate);
      //var_dump($toArrayDate);exit;
      $arrData['fromArrayDate'] = $fromArrayDate;
      $arrData['toArrayDate'] = $toArrayDate;
    } else {
      $arrData['fromArrayDate'] = "";
      $arrData['toArrayDate'] = "";
    }
    
    if (!empty($get['compaign_id'])) {
      $arrData['compaignId'] = $get['compaign_id'];
    } else {
      $arrData['compaignId'] = "";
    }
    $arrData['get'] = $get;
    $arrData['leadCount'] = $this->objLeadRepositery->getAllLeadCount($arrData['userId'], $arrData['compaignId'], $arrData['fromArrayDate'], $arrData['toArrayDate']);
    $arrData['sheetCount'] = $this->objLeadRepositery->getAllSheetCount($arrData['userId'], $arrData['compaignId'], $arrData['fromArrayDate'], $arrData['toArrayDate']);
    //echo "<pre>";var_dump($arrData['leadCount']);

    return view('combined.search', $arrData);
  }
  public function searchSheet(Request $request)
  {
    $get = $request->input();
    //echo "<pre>";var_dump($get);
    $get = $request->input();
    $objCampaigns = $this->objCampaignRepositery->getAllCampaigns();
    $arrData['objCampaigns'] = $objCampaigns;

    $objUsers = $this->userRepositery->getAllUsers();
    $arrData['objUsers'] = $objUsers;
    // echo "<pre>";var_dump($arrData['objUsers']);exit;
    if (!empty($get['daterange'])) {
      $searchDateRange = explode('-', $get['daterange']);
      $fromArray = str_replace(' ', '', $searchDateRange[0]);
      $fromArraySkip = explode('/', $fromArray);
      $fromArrayDate = $fromArraySkip[2] . '-' . $fromArraySkip[0] . '-' . $fromArraySkip[1];
      $toArray = str_replace(' ', '', $searchDateRange[1]);
      $toArraySkip = explode('/', $toArray);
      $toArrayDate = $toArraySkip[2] . '-' . $toArraySkip[0] . '-' . $toArraySkip[1];
      //var_dump($fromArrayDate);
      //var_dump($toArrayDate);exit;
      $arrData['fromArrayDate'] = $fromArrayDate;
      $arrData['toArrayDate'] = $toArrayDate;
    } else {
      $arrData['fromArrayDate'] = "";
      $arrData['toArrayDate'] = "";
    }
    if (!empty($get['user_id'])) {
      $arrData['userId'] = $get['user_id'];
    } else {
      $arrData['userId'] = "";
    }
    if (!empty($get['compaign_id'])) {
      $arrData['compaignId'] = $get['compaign_id'];
    } else {
      $arrData['compaignId'] = "";
    }
    $arrData['get'] = $get;
    echo "<pre>";
    var_dump($arrData['get']);
    return view('combined.search', $arrData);
  }
  public function getLeadList(Request $request)
  {
    if ($request->ajax()) {
      $get = $request->input();
      if (!empty($get['userId'])) {
        $userId = $get['userId'];
      } else {
        $userId = "";
      }
      if (!empty($get['compaignId'])) {
        $compaignId = $get['compaignId'];
      } else {
        $compaignId = "";
      }
      if (!empty($get['fromArrayDate'])) {
        $fromDate = $get['fromArrayDate'];
      } else {
        $fromDate = "";
      }
      if (!empty($get['toDate'])) {
        $toDate = $get['toDate'];
      } else {
        $toDate = "";
      }
      $arrLeads = $this->objLeadRepositery->getLeadsWithSearchDataTable($userId, $compaignId, $fromDate, $toDate);
      return ($arrLeads);
    }
  }
  public function getDownloadLeadList(Request $request)
  {
    $get = $request->input();
    //echo "<pre>";var_dump($get);exit;
    if (!empty($get['user_id'])) {
      $userId = $get['user_id'];
    } else {
      $userId = "";
    }
    if (!empty($get['compaign_id'])) {
      $compaignId = $get['compaign_id'];
    } else {
      $compaignId = "";
    }
    if (!empty($get['daterange'])) {
      $searchDateRange = explode('-', $get['daterange']);
      $fromArray = str_replace(' ', '', $searchDateRange[0]);
      $fromArraySkip = explode('/', $fromArray);
      $fromArrayDate = $fromArraySkip[2] . '-' . $fromArraySkip[0] . '-' . $fromArraySkip[1];
      $toArray = str_replace(' ', '', $searchDateRange[1]);
      $toArraySkip = explode('/', $toArray);
      $toArrayDate = $toArraySkip[2] . '-' . $toArraySkip[0] . '-' . $toArraySkip[1];
      //var_dump($fromArrayDate);
      //var_dump($toArrayDate);exit;
      $fromDate = $fromArrayDate;
      $toDate = $toArrayDate;
    } else {
      $fromDate = "";
      $toDate = "";
    }
    $arrLeads = $this->objLeadRepositery->getLeadsWithDownloadCsv($userId, $compaignId, $fromDate, $toDate);
    return response()->download($arrLeads);
  }
  public function getCombinedLeadView(Request $request, $id, LeadRepository $objLeadRepository)
  {
    $get = $request->input();
    //echo "<pre>";var_dump($get);exit;
    if (!empty($get['user_id'])) {
      $userId = $get['user_id'];
    } else {
      $userId = "";
    }
    if (!empty($get['compaign_id'])) {
      $compaignId = $get['compaign_id'];
    } else {
      $compaignId = "";
    }
    if (!empty($get['daterange'])) {
      $dateRange = $get['daterange'];
    } else {
      $dateRange = "";
    }
    $arrLead = $this->objLeadRepositery->getLeadsWithId($id);
    return view('combined.view', ['id' => $id, 'arrLead' => $arrLead, 'userId' => $userId, 'compaignId' => $compaignId, 'daterange' => $dateRange]);
  }

  // get the campaigns based on the user
    public function getUserCampaigns(Request $request){
      if ($request->ajax()) {
        $post = $request->input();
        $objCamp = $this->objCampaignRepositery->getUserCampaigns($post['user_id']);
        $varOptions = "<option value=''>All Campaigns</option>";
        if(!empty($objCamp)){
          $varinnerOption = "";
          foreach($objCamp as $arrCamp){
             $varinnerOption.="<option value='{$arrCamp->campaign_id}'>{$arrCamp->campaign_name}</option>";
          }
          $varOptions = $varOptions.$varinnerOption;
        }
        return ['options'=>$varOptions];
      }
    }

}
