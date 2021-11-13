@extends('layout.auth')

@section('title')

Upload Leads

@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">

        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <!--begin::Info-->

            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->

                <div class="d-flex align-items-baseline flex-wrap mr-5">

                    <!--begin::Page Title-->

                    <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>

                    <!--end::Page Title-->

                    <!--begin::Breadcrumb-->

                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                        <li class="breadcrumb-item text-muted">

                            <a href="{{ route('dashboard') }}" class="text-muted">Home</a>

                        </li>

                        <li class="breadcrumb-item text-muted">

                            <a href="{{ route('leads.upload-leads') }}" class="text-muted">Upload Leads</a>

                        </li>

                    </ul>

                    <!--end::Breadcrumb-->

                    

                </div>

                <!--end::Page Heading-->

            </div>

            <!--end::Info-->

        </div>

    </div>

    <!--end::Subheader-->

<!--begin::Entry-->

<div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container">

        <!--begin::Card-->

        <div class="card card-custom">

            <!--begin::Card Body-->

            <div class="card-body p-0">



                <!--begin::success/error message-->

						@if(session()->get('success'))

                        <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">

                            <div class="alert-icon"><i class="flaticon-warning"></i></div>

                            <div class="alert-text">{{ session()->get('success') }}  </div>

                            <div class="alert-close">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>

                                </button>

                            </div>

                        </div>

                    @endif

                    @if(session()->get('error'))

                        <div class="alert alert-custom alert-notice alert-light-danger fade show" role="alert">

                            <div class="alert-icon"><i class="flaticon-warning"></i></div>

                            <div class="alert-text">{{ session()->get('error') }} </div>

                            <div class="alert-close">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>

                                </button>

                            </div>

                        </div>

                    @endif





                <!--begin::Wizard 5-->

                <div class="wizard wizard-5 d-flex flex-column flex-lg-row flex-row-fluid" id="kt_wizard">

                    <!--begin::Aside-->

                    <div class="wizard-aside bg-white d-flex flex-column flex-row-auto w-100 w-lg-300px w-xl-400px w-xxl-500px">

                        <!--begin::Aside Top-->

                        <div class="d-flex flex-column-fluid flex-column px-xxl-30 px-10">

                            <!--begin: Wizard Nav-->

                            <div class="wizard-nav d-flex d-flex justify-content-center pt-10 pt-lg-10">

                                <!--begin::Wizard Steps-->

                                <div class="wizard-steps">

                                    <!--begin::Wizard Step 1 Nav-->

                                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">

                                        <div class="wizard-wrapper">

                                            <div class="wizard-icon">

                                                <i class="wizard-check ki ki-check"></i>

                                                <span class="wizard-number">1</span>

                                            </div>

                                            <div class="wizard-label">

                                                <h3 class="wizard-title">Upload the csv file</h3>

                                                <div class="wizard-desc">The csv file of leads which you want to upload on Lemlist</div>

                                            </div>

                                        </div>

                                    </div>

                                    <!--end::Wizard Step 1 Nav-->

                                    <!--begin::Wizard Step 2 Nav-->

                                    <div class="wizard-step" data-wizard-type="step">

                                        <div class="wizard-wrapper">

                                            <div class="wizard-icon">

                                                <i class="wizard-check ki ki-check"></i>

                                                <span class="wizard-number">2</span>

                                            </div>

                                            <div class="wizard-label">

                                                <h3 class="wizard-title">Select The Campaigns</h3>

                                                <div class="wizard-desc">Leads will posted on the selected Campaigns</div>

                                            </div>

                                        </div>

                                    </div>

                                    <!--end::Wizard Step 2 Nav-->

                                    <!--begin::Wizard Step 3 Nav-->

                                    <div class="wizard-step" data-wizard-type="step">

                                        <div class="wizard-wrapper">

                                            <div class="wizard-icon">

                                                <i class="wizard-check ki ki-check"></i>

                                                <span class="wizard-number">3</span>

                                            </div>

                                            <div class="wizard-label">

                                                <h3 class="wizard-title">Completed!</h3>

                                                <div class="wizard-desc">Review and Submit</div>

                                            </div>

                                        </div>

                                    </div>

                                    <!--end::Wizard Step 3 Nav-->

                                </div>

                                <!--end::Wizard Steps-->

                            </div>

                            <!--end: Wizard Nav-->

                        </div>

                        <!--end::Aside Top-->

                        <!--begin::Aside Bottom-->

                        <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-y-bottom bgi-position-x-center bgi-size-contain pt-2 pt-lg-5 h-350px" style="background-image: url({{ url('public/admin/assets/media/svg/illustrations/features.svg') }})"></div>

                        <!--end::Aside Bottom-->

                    </div>

                    <!--begin::Aside-->

                    <!--begin::Content-->

                    <div class="wizard-content bg-gray-100 d-flex flex-column flex-row-fluid py-15 px-5 px-lg-10">

                        <!--begin::Title-->

                        {{-- <div class="text-right mb-lg-30 mb-15 mr-xxl-10">

                            <span class="font-weight-bold text-muted font-size-h5">Having issues?</span>

                            <a href="javascript:;" class="font-weight-bolder text-primary font-size-h4" id="kt_login_signup">Get Help</a>

                        </div> --}}

                        <!--end::Title-->

                        <!--begin::Form-->

                        <div class="d-flex justify-content-center flex-row-fluid">

                            

                            <form method="POST" action="{{ route('leads.upload-leads-data')}}" class="pb-5 w-100 w-md-500px w-lg-650px" novalidate="novalidate" id="kt_form">

                                @csrf

                                <!--begin: Wizard Step 1-->

                                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                                    <!--begin::Title-->

                                    <div class="pb-10 pb-lg-15">

                                        <h3 class="font-weight-bolder text-dark font-size-h2">

                                            Upload Your Csv File Here

                                        </h3>

                                    </div>

                                    <!--begin::Title-->

                                    <!--begin::Form Group-->

                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="dropzone dropzone-default" id="kt_dropzone_upload_csvfile_only">

                                            <div class="dropzone-msg dz-message needsclick">

                                                <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>

                                                <span class="dropzone-msg-desc">

                                                    Please upload a single csv file i.e. lead file <br/>

                                                    <strong>(not more than 5MB)</strong>.

                                            </span>

                                            </div>

                                        </div>

                                    </div>

                                    <!--end::Form Group-->

                                    <div class="form-group">

                                        <input type="hidden" class="form-control h-auto p-5 border-0 rounded-lg font-size-h6" name="file_uploaded"  value="" id="file_uploaded"/>

                                    </div>

                                </div>

                                <!--end: Wizard Step 1-->

                                <!--begin: Wizard Step 2-->

                                <div class="pb-5" data-wizard-type="step-content">

                                    <!--begin::Title-->

                                    <div class="pb-10 pb-lg-15">

                                        <h3 class="font-weight-bolder text-dark font-size-h2 pb-3">Select The Campaigns</h3>

                                        <label class="checkbox checkbox-lg">

                                            <input type="checkbox" name="Checkboxes4" id="select_all_campaigns" value="">

                                            <span></span>&nbsp;&nbsp;&nbsp; <strong>Select All </strong>

                                        </label>

                                    </div>

                                    <!--end::Title-->

                                    <!--end::Row-->

                                    <div class="row" style="max-height: 500px; overflow-y:scroll">

                                        @if (!empty($arrCampaigns))

                                            @foreach ($arrCampaigns as $item)

                                            <div class="col-lg-6 col-md-6">

                                                <!--end::Form Group-->

                                                <div class="form-group">

                                                    <div class="checkbox-list">

                                                        <label class="checkbox checkbox-lg">

                                                            <input class="campaigns_checkbox" type="checkbox" name="campaigns[]" id="{{$item->campaign_id}}" value="{{$item->campaign_id}}" data-name="{{$item->campaign_name}}">

                                                            <span></span>{{$item->campaign_name}}

                                                        </label>

                                                    </div>

                                                </div>

                                                <!--begin::Form Group-->

                                            </div>

                                            @endforeach

                                        @endif

                                        

                                        {{-- <div class="col-lg-6 col-md-6">

                                            <!--end::Form Group-->

                                            <div class="form-group">

                                                <div class="checkbox-list">

                                                    <label class="checkbox">

                                                        <input type="checkbox" name="Checkboxes4">

                                                        <span></span>Default

                                                    </label>

                                                </div>

                                            </div>

                                            <!--end::Form Group-->

                                        </div> --}}

                                    </div>

                                    <!--begin::Row-->

                                </div>

                                <!--end: Wizard Step 2-->

                                <!--begin: Wizard Step 3-->

                                <div class="pb-5" data-wizard-type="step-content">

                                    <!--begin::Title-->

                                    <div class="pb-10 pb-lg-15">

                                        <h3 class="font-weight-bolder text-dark font-size-h2">Complete</h3>

                                        <div class="text-muted font-weight-bold font-size-h4">Complete Your Signup And Become A Member!</div>

                                    </div>

                                    <!--end::Title-->

                                    <!--begin::Section-->

                                    <h4 class="font-weight-bolder mb-3">Campaign Selected:</h4>

                                    <div class="text-dark-50 font-weight-bold line-height-lg mb-8" id="confirm_campaigns">

                                        

                                    </div>

                                    <!--end::Section-->

                                </div>

                                <!--end: Wizard Step 3-->

                                <!--begin: Wizard Actions-->

                                <div class="d-flex justify-content-between pt-3">

                                    <div class="mr-2">

                                        <button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3" data-wizard-type="action-prev">

                                        <span class="svg-icon svg-icon-md mr-1">

                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Left-2.svg-->

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                    <polygon points="0 0 24 0 24 24 0 24" />

                                                    <rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)" x="14" y="7" width="2" height="10" rx="1" />

                                                    <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />

                                                </g>

                                            </svg>

                                            <!--end::Svg Icon-->

                                        </span>Previous</button>

                                    </div>

                                    <div>

                                        <button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3" data-wizard-type="action-submit" id="submitButtonUploadLead">Submit

                                            <span class="svg-icon svg-icon-md ml-2">

                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->

                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                        <polygon points="0 0 24 0 24 24 0 24" />

                                                        <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />

                                                        <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />

                                                    </g>

                                                </svg>

                                                <!--end::Svg Icon-->

                                            </span>

                                        </button>

                                        <button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3" data-wizard-type="action-next">Next Step

                                            <span class="svg-icon svg-icon-md ml-1">

                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Right-2.svg-->

                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                                        <polygon points="0 0 24 0 24 24 0 24" />

                                                        <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />

                                                        <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />

                                                    </g>

                                                </svg>

                                                <!--end::Svg Icon-->

                                            </span>

                                        </button>

                                    </div>

                                </div>

                                <!--end: Wizard Actions-->

                            </form>

                        </div>

                        <!--end::Form-->

                    </div>

                    <!--end::Content-->

                </div>

                <!--end::Wizard 5-->

            </div>

            <!--end::Card Body-->

        </div>

        <!--end::Card-->

    </div>

    <!--end::Container-->

</div>

<!--end::Entry-->

</div>

@endsection



@section('css')

    <!--begin::Page Custom Styles(used by this page)-->

    <link href="{{ url('public/admin/assets/css/pages/wizard/wizard-5.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles-->

@endsection



@section('script')

    <!--begin::Page Scripts(used by this page)-->

    <script>

       var upload_file_url = "{{ route('leads.upload-csv-file')}}";

    </script>

    <script src="{{ url('public/admin/assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script>

    <script src="{{ url('public/admin/assets/js/pages/custom/wizard/wizard-5.js') }}"></script>

    <script>

        var dropzone_id = '#kt_dropzone_upload_csvfile_only';

        $(dropzone_id).dropzone({

            url: upload_file_url, // Set the url for your upload script location

            paramName: "file", // The name that will be used to transfer the file

            maxFiles: 1,

            maxFilesize: 5, // MB

            addRemoveLinks: true,

            acceptedFiles: ".csv",

            addRemoveLinks:true,

            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},

            accept: function(file, done) {

                if (file.name == "justinbieber.jpg") {

                    done("Naha, you don't.");

                } else {

                    done();

                }

            },

            success: function (file, response) {

                if(file.status=='success'){

                    $('#file_uploaded').val(response.file_name);

                }

                var thisProgressBar = dropzone_id + " .dz-success";

                setTimeout(function(){

                    $( thisProgressBar + " .dz-progress").css('opacity', '0');

                }, 300)

            },

        });



        $('body').on('click','#select_all_campaigns',function(e){

            var $this = $(this);

            if($this.is(":checked")){

               $('.campaigns_checkbox').attr('checked','checked');

            }else{

                $('.campaigns_checkbox').removeAttr('checked');

            }

        })



    </script>

    

    <!--end::Page Scripts-->    

@endsection