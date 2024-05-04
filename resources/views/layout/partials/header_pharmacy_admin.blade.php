<!-- Main Wrapper -->
		<div class="main-wrapper">

			<!-- Header -->
			<div class="header">

				<!-- Logo -->
				<div class="header-left">
					<a href="{{url('index_pharmacy_admin')}}" class="logo">
						<img src="{{ URL::asset('/assets_pharmacy/img/logo.png')}}" alt="Logo">
					</a>
					<a href="{{url('index_pharmacy_admin')}}" class="logo logo-small">
						<img src="{{ URL::asset('/assets_pharmacy/img/logo-small.png')}}" alt="Logo" width="30" height="30">
					</a>
					<a href="javascript:void(0);" id="toggle_btn">
						<i class="feather-chevrons-left"></i>
					</a>
				</div>
				<!-- /Logo -->

				<!-- Search -->
				<div class="top-nav-search">
					<div class="main">
						<form class="search" method="post" action="index_pharmacy_admin" >
							<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							<input type="text" class="form-control" placeholder="Search here...">
						</form>
					</div>
				</div>
				<!-- /Search -->

				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fas fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->

				<!-- Header Menu -->
				<ul class="nav nav-tabs user-menu">
					<!-- Flag -->
					<li class="nav-item">
						<a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
							<i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
						</a>
					</li>
					<!-- /Flag -->

					<!-- Notifications -->
					<li class="nav-item dropdown noti-nav">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<i class="feather-bell"></i> <span class="badge"></span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="#">
											<div class="media d-flex">
												<span class="avatar">
													<img class="avatar-img" alt="" src="{{ URL::asset('/assets_pharmacy/img/profiles/avatar-02.jpg')}}">
												</span>
												<div class="media-body">
													<h6>Travis Tremble <span class="notification-time">18.30 PM</span></h6>
													<p class="noti-details">Sent a amount of $210 for his Appointment  <span class="noti-title">Dr.Ruby perin </span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media d-flex">
												<span class="avatar">
													<img class="avatar-img" alt="" src="{{ URL::asset('/assets_pharmacy/img/profiles/avatar-05.jpg')}}">
												</span>
												<div class="media-body">
													<h6>Travis Tremble <span class="notification-time">12 Min Ago</span></h6>
													<p class="noti-details"> has booked her appointment to  <span class="noti-title">Dr. Hendry Watt</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media d-flex">
												<div class="avatar">
													<img class="avatar-img" alt="" src="{{ URL::asset('/assets_pharmacy/img/profiles/avatar-03.jpg')}}">
												</div>
												<div class="media-body">
													<h6>Travis Tremble <span class="notification-time">6 Min Ago</span></h6>
													<p class="noti-details"> Sent a amount  $210 for his Appointment   <span class="noti-title">Dr.Maria Dyen</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="#">
											<div class="media d-flex">
												<div class="avatar avatar-sm">
													<img class="avatar-img" alt="" src="{{ URL::asset('/assets_pharmacy/img/profiles/avatar-06.jpg')}}">
												</div>
												<div class="media-body">
													<h6>Travis Tremble <span class="notification-time">8.30 AM</span></h6>
													<p class="noti-details"> Send a message to his doctor</p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->

					<!-- User Menu -->
					<li class="nav-item dropdown main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img">
								<img src="{{ URL::asset('/assets_pharmacy/img/profiles/avatar-01.jpg')}}" alt="">
								<span class="status online"></span>
							</span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="{{ URL::asset('/assets_pharmacy/img/profiles/avatar-01.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<!-- <h6>Robert Haddin</h6> -->
									<!-- <p class="text-muted mb-0">Administrator</p> -->
								</div>
							</div>
							<a class="dropdown-item" href="{{url('pharmacy-admin/profile')}}"><i class="feather-user me-1"></i> My Profile</a>
							<a class="dropdown-item" href="{{url('pharmacy-admin/settings')}}"><i class="feather-sliders me-1"></i>Settings</a>
							<hr class="my-0 ms-2 me-2">
							<a
                                onclick="document.getElementById('formlogout').submit();"
                                class="dropdown-item" href="#"><i class="feather-log-out me-1">
                                </i>
                                Logout
                            </a>

                            <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
						</div>
					</li>
					<!-- /User Menu -->

				</ul>
				<!-- /Header Menu -->

			</div>
			<!-- /Header -->
