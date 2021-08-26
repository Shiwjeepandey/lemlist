<?php



// this controller handles all the campaigns related urls and crud operations

namespace App\Http\Controllers\Admin;



use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\CampaignRepository;

use App\Repositories\LeadRepository;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;



class LeadController extends Controller
{



    public function index(CampaignRepository $campaignRepositery)
    {

        $this->objCampaignRepositery = $campaignRepositery;

        $arrCampaigns = $this->objCampaignRepositery->getAllCampaigns();

        return view('leads.upload_leads', ['arrCampaigns' => $arrCampaigns]);
    }



    function upload_leads(Request $request, LeadRepository $objLeadRepository)

    {



        $objLeadRepository->uploadLeadOnLemlist($request);

        Session::flash('success', 'Leads uploaded successfully!');

        return redirect(route("leads.uploaded-leads"));
    }



    public function upload_csv_file(Request $request)
    {

        if ($request->ajax()) {

            $request->validate([

                'file' => 'required|mimes:xlx,csv,txt|max:1024*5',

            ]);

            $varOrginalNameWithExtention = $request->file->getClientOriginalName();

            $varExtention = $request->file->getClientOriginalExtension();

            $varOrginalNameWithoutExtention = trim(str_replace('.' . $varExtention, "", str_replace(" ", "-", $varOrginalNameWithExtention)));

            //var_dump($varOrginalNameWithoutExtention);exit;

            $fileName = $varOrginalNameWithoutExtention . "-" . time() . '.' . $varExtention;

            $request->file->move(public_path('uploads/csv'), $fileName);

            $arrReturnData = ['file_name' => $fileName];

            return response()->json($arrReturnData);
        }
    }



    public function sync_with_lemlist(Request $request)
    {

        if ($request->ajax()) {

            $this->objCampaignRepositery->syncCampaign();

            return response()->json(array('processed' => 1));
        }
    }



    public function uploadedLeads(Request $request, LeadRepository $objLeadRepository)
    {

        return view('leads.uploaded_leads', []);
    }

    public function getSheets(Request $request, LeadRepository $objLeadRepository)
    {

        if ($request->ajax()) {

            $arrSheets = $objLeadRepository->getAllSheetsWithDataTable();

            return ($arrSheets);
        }
    }

    public function getLeads(Request $request, $id, LeadRepository $objLeadRepository)
    {

        $arrSheet = $objLeadRepository->getSheetWithId($id);

        return view('leads.list', ['id' => $id, 'arrSheet' => $arrSheet]);
    }

    public function getLeadList(Request $request, $id, LeadRepository $objLeadRepository)
    {

        if ($request->ajax()) {

            $arrLeads = $objLeadRepository->getLeadsWithDataTable($id);

            return ($arrLeads);
        }
    }

    public function getLeadView(Request $request, $id, LeadRepository $objLeadRepository)
    {

        $arrLead = $objLeadRepository->getLeadsWithId($id);

        return view('leads.view', ['id' => $id, 'arrLead' => $arrLead]);
    }
}
