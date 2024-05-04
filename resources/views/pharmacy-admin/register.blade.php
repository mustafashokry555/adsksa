@extends('layout.mainlayout_pharmacy_admin')
@section('content')	
@component('admin/components.header-menu')                
@endcomponent		
			<div class="row">
			
				<!-- Login Banner -->
				<div class="col-md-6 login-bg">
					<div class="login-banner"></div>
				</div>
				<!-- /Login Banner -->
				
				<div class="col-md-6 login-wrap-bg">		
				
					<!-- Login -->
					<div class="login-wrapper">
						<div class="loginbox">
							<div class="img-logo">
								<img src="{{ URL::asset('/assets_admin/img/logo.png')}}" class="img-fluid" alt="Logo">
							</div>
							<h3>Getting Started</h3>
							<p class="account-subtitle">Register with email</p>
										
							<form action="{{ route('pharmacy-admin/register.custom') }}" method="POST">
								@csrf
								<div class="form-group form-focus">
									<input type="text" class="form-control floating" id="name" name="name" value="{{old('name')}}">
									<label class="focus-label">Name</label>
									<div class="text-danger pt-2">
					                 	@error('name')
					            			{{$message}}
					                	@enderror
					            	</div>
								</div>
								<div class="form-group form-focus">
									<input type="text" id="email_address" class="form-control floating" name="email">
									<label class="focus-label"> Email</label>
									<div class="text-danger pt-2">
					                   @error('email')
					                		{{$message}}
					                    @enderror
					                </div>
								</div>
								<div class="form-group form-focus">
									<input type="password" id="password" class="form-control floating pass-input" name="password" value="{{old('password')}}">
									<label class="focus-label">Enter Password</label><span class="fa fa-eye-slash toggle-password pt-4"></span>
									<div class="text-danger pt-2">
				                    	@error('password')
				                			{{$message}}
				                    	@enderror
				                	</div>
								</div>
							
								<div class="form-group">
									<div class="row">
										<div class="col-12">
											<label class="custom_check mr-2 mb-0"> I agree to the <a href="#" class="text-primary"> terms of service</a> and <a href="#" class="text-primary">privacy policy</a>
												<input type="checkbox" name="radio">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="d-grid">
									<button class="btn btn-primary" type="submit">Register</button>
								</div>
								<div class="dont-have">Already have an account? <a href="{{url('pharmacy-admin/login')}}">Login</a></div>
								<div class="login-or">
									<span class="or-line"></span>
									<p class="span-or">or login with </p>
								</div>
								<!-- Social Login -->
								<div class="social-login">
									<a href="#"><img src="{{ URL::asset('/assets_admin/img/icon/google.png')}}" class="img-fluid" alt="Logo"></a>
									<a href="#"><img src="{{ URL::asset('/assets_admin/img/icon/facebook.png')}}" class="img-fluid" alt="Logo"></a>
									<a href="#"><img src="{{ URL::asset('/assets_admin/img/icon/twitter.png')}}" class="img-fluid" alt="Logo"></a>
								</div>
								<!-- /Social Login -->
							</form>
						</div>
					</div>
					<!-- /Login -->
					
				</div>
				
			</div>
        </div>
		<!-- /Main Wrapper -->
@endsection