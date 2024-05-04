@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Invoice Reports @endslot
@endcomponent


					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Invoice Reports List</h5>
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
													<th>Invoice Number</th>
													<th>Medicine Name</th>
													<th>Total Amount</th>
													<th>Created Date</th>
													<th class="text-center">Status</th>
													<th class="text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0001</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product1.jpg')}}" alt="User Image"> Abilify</a>
														</h2>
													</td>
													<td>$100.00</td>
													<td>9 Sep 2019</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0002</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product2.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>$200.00</td>
													<td>29 Oct 2019</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0003</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>$250.00</td>
													<td>25 Sep 2019</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-danger inv-badge">Pending</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0004</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product4.jpg')}}" alt="User Image"> Abilify</a>
														</h2>
													</td>
													<td>$150.00</td>
													<td>9 Oct 2019</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-warning inv-badge">Unpaid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0005</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product5.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>$350.00</td>
													<td>19 Nov 2019</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0006</a></td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product6.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>$300.00</td>
													<td>12 Oct 2019</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
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
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
@component('pharmacy-admin/components.modal-popup') 
@slot('title') Invoice Report @endslot
@endcomponent 	
	
@endsection