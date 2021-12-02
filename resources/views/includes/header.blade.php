<div id="kt_header" class="header header-fixed">
<!--begin::Container-->
<div class="container-fluid d-flex align-items-stretch justify-content-between">
	<!--begin::Header Menu Wrapper-->
	<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
		<!--begin::Header Logo-->
		<div class="header-logo">
			<a href="{{ route('dashboard') }}">
				<img alt="Logo" src="{{ url('public/admin')}}/assets/media/svg/logos/logo-light.png">
				<span style="display: inline-flex; flex-direction: column; color: #fff;  position: relative; top: 7px;}">
					<img alt="Logo" src="{{ url('public/admin')}}/assets/media/svg/logos/logo-light-text.png"><br>
				    <small style="font-size: 9px; font-weight: 500; text-align:right; font-style:italic;">Lemlist Portal</small>
				</span>
				{{-- <h6>Lemlist</h6> --}}
			</a>
		</div>
		<!--end::Header Logo-->
		<!--begin::Header Menu-->
		<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
			<!--begin::Header Nav-->
			<ul class="menu-nav">
			<li class="menu-item menu-item-submenu menu-item-rel menu-item-{{Request::is('dashboard*') ? 'active' : ''}}" data-menu-toggle="click" aria-haspopup="true">
					<a href="{{ route('dashboard') }}" class="menu-link">
						<span class="menu-text">Dashboard</span>
						<i class="menu-arrow"></i>
					</a>
					
				</li>
			@if(!empty(Auth::user()) && (Auth::user()->role_id !=2))
				<li class="menu-item menu-item-submenu menu-item-rel menu-item-{{Request::is('users*') ? 'active' : ''}}" data-menu-toggle="click" aria-haspopup="true">
					<a href="{{ route('users.index') }}" class="menu-link">
						<span class="menu-text">Users</span>
						<i class="menu-arrow"></i>
					</a>
				</li>
			@endif
				<li class="menu-item menu-item-submenu menu-item-rel menu-item-{{Request::is('campaigns*') ? 'active' : ''}}" data-menu-toggle="click" aria-haspopup="true">
					<a href="{{ route('campaigns.index') }}" class="menu-link">
						<span class="menu-text">Campaigns</span>
						<i class="menu-arrow"></i>
					</a>
				</li>
				<li class="menu-item menu-item-submenu menu-item-rel menu-item-{{Request::is('leads*') ? 'active' : ''}}" data-menu-toggle="click" aria-haspopup="true">
					<a href="{{ route('leads.uploaded-leads') }}" class="menu-link">
						<span class="menu-text">Uploaded Leads</span>
						<i class="menu-arrow"></i>
					</a>
				</li>
				<li class="menu-item menu-item-submenu menu-item-rel menu-item-{{Request::is('combined*') ? 'active' : ''}}" data-menu-toggle="click" aria-haspopup="true">
					<a href="{{ route('combined.search') }}" class="menu-link">
						<span class="menu-text">Combined Leads</span>
						<i class="menu-arrow"></i>
					</a>
				</li>
			</ul>
			<!--end::Header Nav-->
		</div>
		<!--end::Header Menu-->
	</div>
	<!--end::Header Menu Wrapper-->
	<!--begin::Topbar-->
	<div class="topbar">
		
		<!--begin::User-->
		<div class="topbar-item">
			<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
				<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
				<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
				<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
					<span class="symbol-label font-size-h5 font-weight-bold">{{ substr(ucfirst(Auth::user()->name) ,0,1)}}</span>
				</span>
			</div>
		</div>
		<!--end::User-->
	</div>
	<!--end::Topbar-->
</div>
<!--end::Container-->
</div>