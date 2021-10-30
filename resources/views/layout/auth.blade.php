
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="_token" content="{{csrf_token()}}">
        <title>@yield('title') | {{ config('constants.SITE_NAME') }}</title>
		<link rel="canonical" href="#" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<link href="{{ url('public/admin')}}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{ url('public/admin')}}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ url('public/admin')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ url('public/admin')}}/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="stylesheet" href="{{ url('public/admin/assets/js/parsleyjs/parsley.css') }}">
		<link rel="stylesheet" href="{{ url('public/admin/assets/css/custom.css') }}">
		@yield('css')
		<link rel="shortcut icon" href="#" />
		 <script>
            var BASEURL = "{{ url('/') }}";
            var APIV1URL = "{{ url('api/v1') }}";
        </script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		@include('includes.mobile-header')
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					@include('includes.header')
					<!--end::Header-->
					<!--begin::Content-->
					 @yield('content')
					<!--end::Content-->
					<!--begin::Footer-->
					@include('includes.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<!-- begin::User Panel-->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">User Profile
				<small class="text-muted font-size-sm ml-2 d-none">12 messages</small></h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content pr-5 mr-n5">
				<!--begin::Header-->
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						<div class="symbol-label" style="background-image:url({{ !empty(Auth::user()->image) ? Auth::user()->image : url('public/admin/assets/media/users/default.jpg')}})"></div>
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ Auth::user()->name }}</a>
						<div class="text-muted mt-1">{{ Auth::user()->roles->name }}</div>
						<div class="navi mt-2">
							<a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
											<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
													<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary">{{ Auth::user()->email }}</span>
								</span>
							</a>
							<a href="{{ route('logout') }}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
						</div>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Separator-->
				<div class="separator separator-dashed mt-8 mb-5"></div>
				<!--end::Separator-->
				<!--begin::Nav-->
				<div class="navi navi-spacer-x-0 p-0">
				   <!--begin::Item-->
					<a href="{{ route('users.profile-change',['id'=>Auth::user()->id])}}" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
										<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							
							<div class="navi-text">
								<div class="font-weight-bold">Profile</div>
								<div class="text-muted">Change Profile</div>
							</div>
							
						</div>
					</a>
					<!--end:Item-->
					<!--begin::Item-->
					<a href="{{ route('users.change-password',['id'=>Auth::user()->id])}}" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
								<span class="svg-icon svg-icon-primary">
									<!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-2.svg-->
									<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>

								</div>
							</div>
							
							<div class="navi-text">
								<div class="font-weight-bold">Password</div>
								<div class="text-muted">Change password</div>
							</div>
							
						</div>
					</a>
					<!--end:Item-->
					
				</div>
				<!--end::Nav-->
				
				<!--begin::Separator-->
				<div class="separator separator-dashed my-7"></div>
				<!--end::Separator-->
				
			</div>
			<!--end::Content-->
		</div>
		<!-- end::User Panel-->
	
		
		
		
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ url('public/admin')}}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{ url('public/admin')}}/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="{{ url('public/admin')}}/assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<script src="{{ url('public/admin')}}/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ url('public/admin')}}/assets/js/pages/crud/datatables/basic/basic.js"></script>
		<!--begin::Page Vendors(used by this page)-->
		<script src="{{ url('public/admin')}}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="{{ url('public/admin')}}/assets/plugins/custom/gmaps/gmaps.js"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ url('public/admin')}}/assets/js/pages/widgets.js"></script>
		<script src="{{ url('public/admin')}}/assets/js/pages/crud/file-upload/image-input.js"></script>
		<!--end::Page Scripts-->
		 <script src="{{ url('public/admin/assets/js/parsleyjs/parsley.min.js') }}"></script>
		<!--begin::Page Vendors(used by this page)-->
		<script>
			 $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
        	});
		</script>
		 <script src="{{ url('public/admin/assets/js/custom.js') }}"></script>

			 
		 @yield('script')
	</body>
	<!--end::Body-->
</html>