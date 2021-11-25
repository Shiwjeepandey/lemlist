@extends('layout.auth')
@section('title')
Leads
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
                            <a href="{{ route('combined.search') }}" class="text-muted">Combined Sheet</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                    
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center d-none">
                <!--begin::Actions-->
                <a href="{{ route('combined.download-sheet')}} " class="btn btn-dark font-weight-bolder btn-sm d-none">Download CSV</a>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
    @if(!empty($get['daterange']))
    @php $getDateRange = $get['daterange'];@endphp
    @else
    @php $getDateRange = "";@endphp
    @endif
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">Combined Sheet</h3>
                            </div>
                            <div class="card-toolbar">
										<a href="javascript:;" data-href="{{ route('combined.download-sheet').'?user_id='.$userId.'&compaign_id='.$compaignId.'&daterange='.$getDateRange }} " class="btn btn-light-primary font-weight-bolder mr-2 download-sheet">
										<i class="ki ki-long-arrow-back icon-xs d-none"></i>Download Csv</a>
								 																		 								 
								</div>
                            
                            <select class="form-control pull-right col-3 mt-3 d-none" id="actions">
                                <option value="">Select Action</option>
                                <option value="delete">Delete</option>
                                {{-- <option value="restore">Restore</option> --}}
                            </select>
                        </div>
                        <div class="card-body">

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

                              
                        <form method="get" action="{{ route('combined.search') }}" id="search-form">
                            <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                        <label id="exampleSelect1">Sales Person</label>
                                            <select name="user_id" class="form-control select_user" id="exampleSelect1" data-parsley-error-message="Please select user">
                                                <option value="">Select a sales person</option>
                                                @if(!empty($objUsers['data'][0]))
                                                    @foreach($objUsers['data'] as $user)
                                                    <option value="{{ $user['id'] }}" {{ (!empty($get['user_id']) && ($get['user_id'] == $user['id'] )) ? 'selected' : '' }}>{{ $user['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label id="exampleSelect1">Compaigns</label>
                                            <select name="compaign_id" class="form-control select_compaign selectpicker" id="exampleSelect1" data-live-search="true">
                                                <option value="">Select a compaign</option>
                                                @if(!empty($objCampaigns[0]))
                                                    @foreach($objCampaigns as $comp)
                                                    <option value="{{ $comp->campaign_id }}" {{ (!empty($get['compaign_id']) && ($get['compaign_id'] == $comp->campaign_id )) ? 'selected' : '' }}>{{ $comp->campaign_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                <label id="exampleSelect1">Select Date Range</label>
                                 <input type="text" class="form-control" name="daterange" id="daterange" placeholder="select date range"  value="{{ $getDateRange }}"/>
                                </div>
                                
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary mt-8">Search</button>
                                </div>
                           
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-3">
                               <strong>Lead Count :</strong>
                                {{ $leadCount }}
                            </div>
                            {{-- <div class="col-3">
                               <strong>Sheet Count :</strong>
                               {{ $sheetCount }}
                            </div> --}}
                                
                           
                            </div>

                        <div class="table-responsive">
                                <table class="table" id="exports-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Campaign Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Company</th>
                                            <!-- <th scope="col">Lemlist Inserted</th> -->
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>   
                    <!--end::Card-->               
                </div>
            </div>
            
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!-- Button trigger modal-->

<div id="success-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Campaigns Removal Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want remove these ?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <a type="button" id="remove-restore-campaigns" class="btn btn-primary text-white remove-activity">Yes</a>
            </div>
        </div>
    </div>
</div>

<div id="download-error-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Download Csv Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                   First select a sales person then search after that download csv file
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- End Remove Modal -->
@endsection
@section('script')
<script type="text/javascript" src="{{ url('public/admin')}}/assets/vendors/js/datepicker/latest/moment.min.js"></script>
<script type="text/javascript" src="{{ url('public/admin')}}/assets/vendors/js/datepicker/latest/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('public/admin')}}/assets/vendors/css/datepicker/latest/daterangepicker.css" />
<script>
    $(function() {
        var serviceUrl = "{{ route('combined.get-lead').'?userId='.$userId.'&compaignId='.$compaignId.'&fromArrayDate='.$fromArrayDate.'&toDate='.$toArrayDate }}";
        serviceUrl = serviceUrl.replace(/&amp;/gi, '&');
        $('#search-form').parsley();
       var table =  $('#exports-table').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                processing: true,
                serverSide: true,
                ajax: serviceUrl,
                order: [
                        [3, "desc"]
                        ],
                    columnDefs: [ { orderable: false, targets: [0] } ],
                columns: [
                    { data: 'DT_RowIndex', searchable: false },
                    { data: 'compaign.campaign_name' },
                    { data: 'email' },
                    { data: 'full_name' },
                    { data: 'keyword' },
                    //{ data: 'is_inserted_lemlist' },
                    { data: 'action' },
                ],
                searching: false,
                "initComplete": function(settings, json) {
                    var api = this.api();
                    var numRows = api.rows( ).count();
                    // Place the value in your HTML using jQuery, etc
                    if(numRows==0){
                        $('.download-sheet').addClass('d-none'); 
                    }else{
                        $('.download-sheet').removeClass('d-none');
                    }
                }
                
            });
            
        var date = new Date();
		var currentMonth = date.getMonth();
		var currentDate = date.getDate();
		var currentYear = date.getFullYear();
        var startDate = new Date(currentYear, currentMonth-3, currentDate);
        var endDate = new Date(currentYear, currentMonth, currentDate);

       $('input[name="daterange"]').daterangepicker({
            changeYear: true,
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            minDate: new Date(currentYear, currentMonth-3, currentDate),
			maxDate: new Date(currentYear, currentMonth, currentDate)
 
        }, function(start, end, label) {
               console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
     });
     $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
         $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
     });

    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    });
    $("body").on("click",".download-sheet",function(){
       var data_href=$(this).attr('data-href');
       var sales_person = $('.select_user').val();
        if(sales_person!=''){
          $('.download-sheet').attr('href',data_href);
       }else{
         $('.download-sheet').attr('href','javascript:;');
         $('#download-error-modal').modal('show', {backdrop:'static',keyboard:false}); 
       }
    });

</script>
@endsection