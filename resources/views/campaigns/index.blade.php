@extends('layout.auth')
@section('title')
Campaigns
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
                            <a href="{{ route('campaigns.index') }}" class="text-muted">Campaigns</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                    
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <button type="button" class="btn btn-dark font-weight-bolder btn-sm" id="syncWithLemlist">Sync With Lemlist</button>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">All Campaigns</h3>
                            </div>
                            <select class="form-control pull-right col-3 mt-3" id="actions">
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

                            <div class="table-responsive">
                                <table class="table" id="exports-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <label class="checkbox checkbox-lg">
                                                    <input type="checkbox" name="Checkboxes4" id="select_all_campaigns" value="">
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th scope="col">Campaign Id</th>
                                            <th scope="col">Campaign Name</th>
                                            <th scope="col">Last Synced</th>
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

<div id="error-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Select at least one campaigns
                </p>
            </div>
        </div>
    </div>
</div>


<!-- End Remove Modal -->
@endsection
@section('script')
<script>
		$('#exports-table').DataTable({
            dom: 'Bfrtip',
            buttons: [],
            processing: true,
            serverSide: true,
            pageLength:25,
            ajax: {
                url:"{{ route('campaigns.get-campaigns')}}",
                type: 'GET',
                dataType:'json',
                data: function (d) {
                    
                    //d.user = $('.search_by_user').val();
                    //d.project = $('#search_by_project').val();
                }
            },
            order: [
                    [3, "desc"],
                    [2, "asc"],
                ],
                columnDefs: [ { orderable: false, targets: [0,1] } ],
            columns: [
                { data: 'all_chk', searchable: false },
                { data: 'campaign_id' },
                { data: 'campaign_name' },
                { data: 'updated_at' },
            ],
            searching: true,
            language: {
                    processing: '<span class="spinner spinner-track spinner-primary spinner-lg mr-15"></span> ',
                    searchPlaceholder: 'Search by campaign name ...',
                    sSearch: ''
            }
	    });

        $(".search-filter").click(function(){
            $('#exports-table').DataTable().draw(true);
        });
        $('body').on('click','#select_all_campaigns',function(e){
            var $this = $(this);
            if($this.is(":checked")){
               $('.campaigns_checkbox').attr('checked','checked');
            }else{
                $('.campaigns_checkbox').removeAttr('checked');
            }
        })

        var checkboxValues = [];
        $('body').on('change','#actions',function(e){
            if($(this).val()!=""){
                $('input[name=campaigns]:checked').map(function() {
                    checkboxValues.push($(this).val());
                });
                if(checkboxValues!=""){
                    $('#success-modal').modal('show');
                }else{
                    $('#error-modal').modal('show');
                }
            }
            
        })

        $('body').on('click','#remove-restore-campaigns',function(e){
           if(checkboxValues!=""){
                var $this = $(this);
                $this.html('Processing.....')
                $this.attr('disabled','disabled')
                $this.addClass('spinner spinner-white spinner-right')
                $.ajax({
                    url:"<?php echo route('campaigns.delete-campaigns')?>",
                    type:"POST",
                    data:{
                        "cmp":checkboxValues,
                        "action":$('#actions').val()
                    },
                    success:function(response){
                        window.location.reload();
                    }
                })
           }
        })

        //$('input[name="locationthemes"]:checked').serialize()

        $('body').on('click','#syncWithLemlist',function(e){
            e.preventDefault();
            var $this = $(this)
            $this.html('Syncing.....')
            $this.attr('disabled','disabled')
            $this.addClass('spinner spinner-white spinner-right')
            //sync-with-lemlist
            $.ajax({
                url:"{{ route('campaigns.sync-with-lemlist')}}",
                type: 'POST',
                dataType:'json',
                success: function (response) {
                    if(response.processed==1){
                        window.location.reload()
                    }
                }
            });
        })
</script>
@endsection