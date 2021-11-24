@extends('layout.auth')
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
				<h5 class="text-dark font-weight-bold my-1 mr-5">Users</h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('users.index') }}" class="text-muted">Users</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Edit User</a>
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
		<div class="row">
			<div class="col-md-12">
				<!--begin::Card-->
				<div class="card card-custom gutter-b example example-compact">
					<div class="card-header">
						<h3 class="card-title">Edit User</h3>
						<div class="card-toolbar">
							<a href="{{ route('users.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
							<i class="ki ki-long-arrow-back icon-xs"></i>Back</a>
							
						</div>
						
					</div>
					<!--begin::Form-->
					  <form action="{{ route('users.edit.post',['id'=>$users->id]) }}" class="form-horizontal" enctype="multipart/form-data" method="post" id="user-form">
						@csrf
						<div class="card-body">
						<div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label>Name
							  <span class="text-danger">*</span></label>
							   <input required type="text" name="name" placeholder="Please enter name" class="form-control" data-parsley-error-message="Please enter name" value="{{$users->name}}">
							</div>
						  </div>
						 <div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputPassword1">Phone
								<span class="text-danger">*</span></label>
								<input required type="text" name="phone" placeholder="Please enter phone number" class="form-control" data-parsley-error-message="Please enter phone no" value="{{$users->phone}}">
							</div>
						 </div>
					   </div>
					   <div class="row">
						  <div class="col-md-6">
							<div class="form-group">
							 <label>Email Id
							  <span class="text-danger">*</span></label>
							   <input required type="email" placeholder="Please enter email" class="form-control" data-parsley-error-message="Please enter email id" value="{{$users->email}}">
							</div>
						  </div>
						<div class="col-md-6">
							<div class="form-group">
							 <label>Role
							  <span class="text-danger">*</span></label>
							   <select name="role" class="form-control" id="exampleSelect1" data-parsley-error-message="Please select role" required>
									<option value="">Select Role</option>
										@if(!empty($roles))
										@foreach($roles as $role)
										<option value="{{$role->id}}" {{ ( $role->id == $users->role_id) ? 'selected' : '' }}>{{$role->name}}</option>
										@endforeach
										@endif
								</select>
							</div>
						  </div>
					   </div>
						
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						
					</div>
					</form>
					<!--end::Form-->
				</div>
				<!--end::Card-->
				
				
			</div>
			
		</div>
	</div>
	<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!-- Start Remove Modal -->
<div id="modal-remove-activity" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Removal Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want remove this User?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary text-white remove-activity">Yes</a>
            </div>
        </div>
    </div>
</div>
<!-- End Remove Modal -->
@endsection
@section('script')
<script>
$('#user-form').parsley();
$("body").on("click",".remove-user",function(){
		var id = $(this).attr('data-id');
		var dataHref = $("#user-delete-"+id).attr('data-href');
		$(".remove-activity").attr('href',dataHref);
	 });
</script>
@endsection