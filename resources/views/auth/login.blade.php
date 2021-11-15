@extends('layout.app')
@section('content')
<!--begin::Login-->
<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
	<!--begin::Aside-->
	<div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
		<!--begin: Aside Container-->
		<div class="d-flex flex-column-fluid flex-column justify-content-between">
			
			<!--begin::Aside body-->
			<div class="d-flex flex-column-fluid flex-column flex-center">
				<!--begin::Signin-->
				<div class="login-form login-signin py-11">
					<!--begin::Form-->
					<form class="form fv-plugins-bootstrap fv-plugins-framework" action= "{{route('login.post')}}" method="POST"  novalidate="novalidate" id="kt_login_signin_form">
					 @csrf
						<!--begin::Title-->
						<div class="pb-13 pt-lg-0 pt-3  text-center">
							<img style="width: 80px;" class="text-center" src="{{ url('public/admin')}}/assets/media/svg/logos/sl-logo-l.svg" alt=""><br>	
									{{-- <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
										Sign In
									</h3> --}}
								</div>
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
								<!--begin::Title-->
						<!--begin::Form group-->
						<div class="form-group fv-plugins-icon-container">
							<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="email" name="email"  autocomplete="off">
						<div class="fv-plugins-message-container"></div></div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group fv-plugins-icon-container">
							<div class="d-flex justify-content-between mt-n5">
								<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
								<a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
							</div>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off">
						<div class="fv-plugins-message-container"></div></div>
						<!--end::Form group-->
						<!--begin::Action-->
						<div class="text-center pt-2">
							<button id="kt_login_signin_submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign In</button>
						</div>
						<!--end::Action-->
					<input type="hidden"><div></div></form>
					<!--end::Form-->
				</div>
				<!--end::Signin-->
				<!--begin::Forgot-->
				<div class="login-form login-forgot">
					<!--begin::Form-->
					<form class="form fv-plugins-bootstrap fv-plugins-framework" novalidate="novalidate" id="kt_login_forgot_form">
						<!--begin::Title-->
						<div class="text-center pb-8">
							<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Forgotten Password ?</h2>
							<p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
						</div>
						<!--end::Title-->
						<!--begin::Form group-->
						<div class="form-group fv-plugins-icon-container">
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off">
						<div class="fv-plugins-message-container"></div></div>
						<!--end::Form group-->
						<!--begin::Form group-->
						<div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
							<button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Submit</button>
							<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancel</button>
						</div>
						<!--end::Form group-->
					<div></div></form>
					<!--end::Form-->
				</div>
				<!--end::Forgot-->
			</div>
			<!--end::Aside body-->
			
		</div>
		<!--end: Aside Container-->
	</div>
	<!--begin::Aside-->
	<!--begin::Content-->
	<div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="background-color: #B1DCED;">
		<!--begin::Title-->
		<div class="d-flex flex-column justify-content-center text-center pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
			
			<h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">
				
				Welcome To {{ config('constants.SITE_NAME') }}
			</h3>
		</div>
		<!--end::Title-->
		<!--begin::Image-->
		<div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{ url('public/admin')}}/assets/media/svg/illustrations/login-visual-2.svg)"></div>
		<!--end::Image-->
	</div>
	<!--end::Content-->
</div>
<!--end::Login-->
@endsection
@section('script')
<script type="text/javascript">
$('#login-form').parsley();
$('#forgot-form').parsley();
$('#kt_login_forgot').click(function(){
	$('.login-signin').hide();
	$('.login-forgot').show();
});
$('#kt_login_forgot_cancel').click(function(){
	$('.login-signin').show();
	$('.login-forgot').hide();
});
</script>
@endsection
