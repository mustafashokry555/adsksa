@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Supplier @endslot
@endcomponent


					<div class="row">
						<div class="col-md-12">
						
							<!-- Recent Orders -->
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Supplier</h5>
										</div>
										<div class="col-auto custom-list d-flex">
											<div class="form-custom me-2">
												<div id="tableSearch"  class="dataTables_wrapper"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body p-0">
									<div class="table-responsive">
										<table class="datatable table table-borderless hover-table" id="data-table">
											<thead class="thead-light">
												<tr>
													<th>ID</th>
													<th>Product</th>
													<th>Name</th>
													<th>Phone</th>
													<th>Email</th>
													<th>Address</th>
													<th>Company</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product1.jpg')}}" alt="User Image"> Abilify</a>
														</h2>
													</td>
													<td>Discarsa</td>
													<td>+51 1542565</td>
													<td>Discarsa@gmail.com</td>
													<td>Paseo Los Robles</td>
													<td>Discarsa Nicaragua</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-supplier')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>2</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product2.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>Proveedor</td>
													<td>+51 23687541</td>
													<td>proveedor@gmail.com</td>
													<td>Av circunvalación # 234	</td>
													<td>mi farmacia</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-supplier')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>3</td>
													<td>
														<h2 class="table-avatar">
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Adderall</a>
														</h2>
													</td>
													<td>Discarsa</td>
													<td>+51 96588552</td>
													<td>Discarsa@gmail.com</td>
													<td>Paseo Los Robles</td>
													<td>Discarsa Nicaragua</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-supplier')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div id="tablepagination"  class="dataTables_wrapper"></div>
							<!-- /Recent Orders -->
							
						</div>
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->

@component('pharmacy-admin/components.modal-popup') 
@slot('title') Supplier @endslot
@endcomponent
 		
@endsection