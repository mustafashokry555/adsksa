<?php error_reporting(0);?>
<div class="main-wrapper">
<!-- Header -->
			<header class="header">
				<div class="container">
					<div class="nav-bg-five">
						<nav class="navbar navbar-expand-lg header-nav nav-transparent">
							<div class="navbar-header">
								<a id="mobile_btn" href="javascript:void(0);">
									<span class="bar-icon">
										<span></span>
										<span></span>
										<span></span>
									</span>
								</a>
								<a href="{{url('index')}}" class="navbar-brand logo">
									<img src="{{ URL::asset('/assets/img/logo.png')}}" class="img-fluid" alt="Logo">
								</a>
							</div>
							<div class="main-menu-wrapper">
								<div class="menu-header">
									<a href="{{url('index')}}" class="menu-logo">
										<img src="{{ URL::asset('/assets/img/logo.png')}}" class="img-fluid" alt="Logo">
									</a>
									<a id="menu_close" class="menu-close" href="javascript:void(0);">
										<i class="fas fa-times"></i>
									</a>
								</div>
								<ul class="main-nav black-font">
									<li class="has-submenu <?php if($page=="index" || $page=="index-1" || $page=="index-2" || $page=="index-3" || $page=="index-5"|| $page=="index-4" || $page=="index-6" || $page=="index-7" || $page=="index-8" || $page=="index-9" || $page=="index-10" || $page=="index-11" || $page=="index-12" || $page=="index-13" || $page=="index-14") { echo 'active'; } ?>">
										<a href="">Home <i class="fas fa-chevron-down"></i></a>
										<ul class="submenu">
										<li class="<?php if($page=="index") { echo 'active'; } ?>">
										<a href="{{url('index')}}">Home</a>
									    </li>
										<li class="<?php if($page=="index-2") { echo 'active'; } ?>"><a href="{{url('index-2')}}">Home 2</a></li>
										<li class="<?php if($page=="index-3") { echo 'active'; } ?>"><a href="{{url('index-3')}}">Home 3</a></li>
										<li class="<?php if($page=="index-4") { echo 'active'; } ?>"><a href="{{url('index-4')}}">Home 4</a></li>
										<li class="<?php if($page=="index-5") { echo 'active'; } ?>"><a href="{{url('index-5')}}">Home 5</a></li>
										<li class="<?php if($page=="index-6") { echo 'active'; } ?>"><a href="{{url('index-6')}}">Home 6</a></li>
										<li class="<?php if($page=="index-7") { echo 'active'; } ?>"><a href="{{url('index-7')}}">Home 7</a></li>
										<li class="<?php if($page=="index-8") { echo 'active'; } ?>"><a href="{{url('index-8')}}">Home 8</a></li>
										<li class="<?php if($page=="index-9") { echo 'active'; } ?>"><a href="{{url('index-9')}}">Home 9</a></li>
										<li class="<?php if($page=="index-10") { echo 'active'; } ?>"><a href="{{url('index-10')}}">Home 10</a></li>
										<li class="<?php if($page=="index-11") { echo 'active'; } ?>"><a href="{{url('index-11')}}">Home 11</a></li>
										<li class="<?php if($page=="index-12") { echo 'active'; } ?>"><a href="{{url('index-12')}}">Home 12</a></li>
										<li class="<?php if($page=="index-13") { echo 'active'; } ?>"><a href="{{url('index-13')}}">Home 13</a></li>
										<li class="<?php if($page=="index-14") { echo 'active'; } ?>"><a href="{{url('index-14')}}">Home 14</a></li>
										</ul>
									</li>
									<li class="has-submenu <?php if($page=="review" || $page=="register" || $page=="doctor-dashboard" || $page=="appointments" || $page=="schedule-timings" || $page=="my-patients" || $page=="patient-profile" || $page=="chat-doctor" || $page=="invoices" || $page=="doctor-profile-settings" || $page=="doctor-add-blog" || $page=="doctor-blog" || $page=="doctor-pending-blog" || $page=="edit-blog") { echo 'active'; } ?>">
										<a href="">Doctors <i class="fas fa-chevron-down"></i></a>
										<ul class="submenu">
											<li class="<?php if($page=="doctor-dashboard") { echo 'active'; } ?>"><a href="{{url('doctor-dashboard')}}">Doctor Dashboard</a></li>
											<li class="<?php if($page=="appointments") { echo 'active'; } ?>"><a href="{{url('appointments')}}">Appointments</a></li>
											<li class="<?php if($page=="schedule-timings") { echo 'active'; } ?>"><a href="{{url('schedule-timings')}}">Schedule Timing</a></li>
											<li class="<?php if($page=="my-patients") { echo 'active'; } ?>"><a href="{{url('my-patients')}}">Patients List</a></li>
											<li class="<?php if($page=="patient-profile") { echo 'active'; } ?>"><a href="{{url('patient-profile')}}">Patients Profile</a></li>
											<li class="<?php if($page=="chat-doctor") { echo 'active'; } ?>"><a href="{{url('chat-doctor')}}">Chat</a></li>
											<li class="<?php if($page=="invoices") { echo 'active'; } ?>"><a href="{{url('invoices')}}">Invoices</a></li>
											<li class="<?php if($page=="doctor-profile-settings") { echo 'active'; } ?>"><a href="{{url('doctor-profile-settings')}}">Profile Settings</a></li>
											<li class="<?php if($page=="review") { echo 'active'; } ?>"><a href="{{url('reviews')}}">Reviews</a></li>
											<li class="<?php if($page=="register") { echo 'active'; } ?>"><a href="{{url('doctor-register')}}">Doctor Register</a></li>
											<li class="has-submenu <?php if($page=="doctor-add-blog" || $page=="doctor-blog" || $page=="doctor-pending-blog" || $page=="edit-blog") { echo 'active'; } ?>">
												<a href="{{url('doctor-blog')}}">Blog</a>
												<ul class="submenu">
													<li class="<?php if($page=="doctor-blog" || $page=="doctor-pending-blog" || $page=="edit-blog") { echo 'active'; } ?>"><a href="{{url('doctor-blog')}}">Blog</a></li>
													<li><a href="{{url('blog-details')}}">Blog view</a></li>
													<li class="<?php if($page=="doctor-add-blog") { echo 'active'; } ?>"><a href="{{url('doctor-add-blog')}}">Add Blog</a></li>
												</ul>
											</li>
										</ul>
									</li>	
									<li class="has-submenu <?php if($page=="map-grid" || $page=="map-list" || $page=="map-list-1" || $page=="search1" || $page=="doctor-profile" || $page=="booking" || $page=="checkout" || $page=="booking-success" || $page=="patient-dashboard" || $page=="favourites" || $page=="chat" || $page=="profile-settings" || $page=="change-password") { echo 'active'; } ?>">
										<a href="">Patients <i class="fas fa-chevron-down"></i></a>
										<ul class="submenu">
											<li class="has-submenu <?php if($page=="map-grid" || $page=="map-list" || $page=="map-list-1") { echo 'active'; } ?>">
												<a href="#">Doctors</a>
												<ul class="submenu">
													<li class="<?php if($page=="map-grid") { echo 'active'; } ?>"><a href="{{url('map-grid')}}">Map Grid</a></li>
													<li class="<?php if($page=="map-list") { echo 'active'; } ?>"><a href="{{url('map-list')}}">Map List</a></li>
													<li class="<?php if($page=="map-list-1") { echo 'active'; } ?>"><a href="{{url('map-list-1')}}">Map List 1</a></li>
												</ul>
											</li>
											<li class="<?php if($page=="search1") { echo 'active'; } ?>"><a href="{{url('search')}}">Search Doctor</a></li>
											<li class="<?php if($page=="doctor-profile") { echo 'active'; } ?>"><a href="{{url('doctor-profile')}}">Doctor Profile</a></li>
											<li class="<?php if($page=="booking") { echo 'active'; } ?>"><a href="{{url('booking')}}">Booking</a></li>
											<li class="<?php if($page=="checkout") { echo 'active'; } ?>"><a href="{{url('checkout')}}">Checkout</a></li>
											<li class="<?php if($page=="booking-success") { echo 'active'; } ?>"><a href="{{url('booking-success')}}">Booking Success</a></li>
											<li class="<?php if($page=="patient-dashboard") { echo 'active'; } ?>"><a href="{{url('patient-dashboard')}}">Patient Dashboard</a></li>
											<li class="<?php if($page=="favourites") { echo 'active'; } ?>"><a href="{{url('favourites')}}">Favourites</a></li>
											<li class="<?php if($page=="chat") { echo 'active'; } ?>"><a href="{{url('chat')}}">Chat</a></li>
											<li class="<?php if($page=="profile-settings") { echo 'active'; } ?>"><a href="{{url('profile-settings')}}">Profile Settings</a></li>
											<li class="<?php if($page=="change-password") { echo 'active'; } ?>"><a href="{{url('change-password')}}">Change Password</a></li>
										</ul>
									</li>
									<li class="has-submenu <?php if($page=="voice-call" || $page=="video-call" || $page=="onboarding-email" || $page=="patient-email" || $page=="search" || $page=="calendar" || $page=="components" || $page=="invoices1" || $page=="invoice-view" || $page=="blank-page" || $page=="login" || $page=="register1" || $page=="forgot-pswd") { echo 'active'; } ?>">
										<a href="">Pages <i class="fas fa-chevron-down"></i></a>
										<ul class="submenu">
											<li class="<?php if($page=="voice-call") { echo 'active'; } ?>"><a href="{{url('voice-call')}}">Voice Call</a></li>
											<li class="<?php if($page=="video-call") { echo 'active'; } ?>"><a href="{{url('video-call')}}">Video Call</a></li>
											<li class="<?php if($page=="search") { echo 'active'; } ?>"><a href="{{url('search')}}">Search Doctors</a></li>
											<li class="<?php if($page=="calendar") { echo 'active'; } ?>"><a href="{{url('calendar')}}">Calendar</a></li>
											<li class="<?php if($page=="onboarding-email") { echo 'active'; } ?>"><a href="{{url('onboarding-email')}}">Doctor Onboarding</a></li>
											<li class="<?php if($page=="patient-email") { echo 'active'; } ?>"><a href="{{url('patient-email')}}">Patient Onboarding</a></li>
											<li class="<?php if($page=="components") { echo 'active'; } ?>"><a href="{{url('components')}}">Components</a></li>
											<li class="has-submenu <?php if($page=="invoices1" || $page=="invoice-view") { echo 'active'; } ?>">
												<a href="{{url('invoices')}}">Invoices</a>
												<ul class="submenu">
													<li class="<?php if($page=="invoices1") { echo 'active'; } ?>"><a href="{{url('invoices')}}">Invoices</a></li>
													<li class="<?php if($page=="invoice-view") { echo 'active'; } ?>"><a href="{{url('invoice-view')}}">Invoice View</a></li>
												</ul>
											</li>
											<li class="<?php if($page=="blank-page") { echo 'active'; } ?>"><a href="{{url('blank-page')}}">Starter Page</a></li>
											<li class="<?php if($page=="login") { echo 'active'; } ?>"><a href="{{url('login')}}">Login</a></li>
											<li class="<?php if($page=="register1") { echo 'active'; } ?>"><a href="{{url('register')}}">Register</a></li>
											<li class="<?php if($page=="forgot-pswd") { echo 'active'; } ?>"><a href="{{url('forgot-password')}}">Forgot Password</a></li>
										</ul>
									</li>
									<li class="has-submenu <?php if($page=="blog-list" || $page=="blog-grid" || $page=="blog-details") { echo 'active'; } ?>">
		                            <a href="">Blog <i class="fas fa-chevron-down"></i></a>
		                            <ul class="submenu">
		                                <li class="<?php if($page=="blog-list") { echo 'active'; } ?>"><a href="{{url('blog-list')}}">Blog List</a></li>
		                                <li class="<?php if($page=="blog-grid") { echo 'active'; } ?>"><a href="{{url('blog-grid')}}">Blog Grid</a></li>
		                                <li class="<?php if($page=="blog-details") { echo 'active'; } ?>"><a href="{{url('blog-details')}}">Blog Details</a></li>
		                            </ul>
		                        </li>
									<li class="has-submenu">
										<a href="#" target="_blank">Admin <i class="fas fa-chevron-down"></i></a>
										<ul class="submenu">
											<li><a href="{{url('admin/login')}}" target="_blank">Admin</a></li>
											<li><a href="{{url('pharmacy-admin/login')}}" target="_blank">Pharmacy Admin</a></li>
										</ul>
									</li>
									<li class="login-link">
										<a href="{{url('login')}}">Login / Signup</a>
									</li>
								</ul>		 
							</div>		 
							<ul class="nav header-navbar-rht">
								<li class="nav-item contact-item">
									<div class="header-contact-img">
										<i class="feather-phone"></i>
									</div>
									<div class="header-contact-detail">
										<p class="contact-info-header">+1 315 369 5943</p>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link btn-five" href="{{url('login')}}">Sign In</a>
								</li>
								<li class="nav-item">
									<a class="nav-link btn-five-light" href="{{url('register')}}">Sign Up</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</header>
			<!-- /Header -->