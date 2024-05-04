@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Transactions @endslot
@endcomponent

					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Transactions List</h5>
										</div>
										<div class="col-auto custom-list d-flex">
											<div class="form-custom me-2">
												<div id="tableSearch"  class="dataTables_wrapper"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body p-0">
									<table class="datatable table table-borderless hover-table" id="data-table">
											<thead class="thead-light">
												<tr>
													<th>Invoice No</th>
													<th>Product ID</th>
													<th>Product Name</th>
													<th>Total Amount</th>
													<th class="text-center">Status</th>
													<th class="text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0001</td>
													<td>#01</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product1.jpg')}}" alt="User Image"> Abilify</a>
														</h2>
													</td>
													<td>$100.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0002</td>
													<td>#02</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product2.jpg')}}" alt="User Image"> ITONE eye drops 10ml</a>
														</h2>
													</td>
													<td>$200.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0003</td>
													<td>#03</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Safi Natural Blood Purifier </a>
														</h2>
													</td>
													<td>$250.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0004</td>
													<td>#04</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product4.jpg')}}" alt="User Image"> Moisturization & Nourishment </a>
														</h2>
													</td>
													<td>$150.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0005</td>
													<td>#05</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product5.jpg')}}" alt="User Image"> Blackhead Removal</a>
														</h2>
													</td>
													<td>$350.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0006</td>
													<td>#06</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product6.jpg')}}" alt="User Image"> Abilify</a>
														</h2>
													</td>
													<td>$300.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0007</td>
													<td>#07</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product1.jpg')}}" alt="User Image"> Blackhead Removal</a>
														</h2>
													</td>
													<td>$250.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0008</td>
													<td>#08</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product2.jpg')}}" alt="User Image"> ITONE eye drops 10ml</a>
														</h2>
													</td>
													<td>$150.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0009</td>
													<td>#09</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Whitening & Fairness</a>
														</h2>
													</td>
													<td>$100.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td><a href="{{url('pharmacy-admin/invoice')}}">#IN0010</td>
													<td>#10</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product4.jpg')}}" alt="User Image"> Adderall</a>
														</h2>
													</td>
													<td>$120.00</td>
													<td class="text-center">
														<span class="badge rounded-pill bg-success inv-badge">Paid</span>
													</td>
													<td class="text-end">
														<div class="actions">
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
								<div id="tablepagination"  class="dataTables_wrapper"></div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
@component('pharmacy-admin/components.modal-popup') 
@slot('title') Transactions List @endslot
@endcomponent 	
	
@endsection