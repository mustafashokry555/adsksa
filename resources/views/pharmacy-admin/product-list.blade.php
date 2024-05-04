@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Categories @endslot
    @slot('li_1') Add New @endslot
@endcomponent

					
					<!-- Product List -->
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Product List</h5>
										</div>
										<div class="col-auto d-flex flex-wrap">
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
												   <th>Product Name</th>
												   <th>Price</th>
												   <th>Date</th>
												   <th class="text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>#4546</td>
													<td>
														<h2 class="table-avatar">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product1.jpg')}}" alt="User Image"> Safi Natural Blood Purifier</a>
														</h2>
													</td>
													<td>$330.00</td>
													<td>12/20/2022</td>
													<td class="text-end">
														<div class="actions">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>															
														</div>
													</td>
												</tr>
												<tr>
													<td>#8774</td>
													<td>
														<h2 class="table-avatar">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product2.jpg')}}" alt="User Image"> Benadrys Cough Syrup</a>
														</h2>
													</td>
													<td>$330.00</td>
													<td>12/20/2022</td>
													<td class="text-end">
														<div class="actions">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>															
														</div>
													</td>
												</tr>
												<tr>
													<td>#4546</td>
													<td>
														<h2 class="table-avatar">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Natural Syrup for bronchtas</a>
														</h2>
													</td>
													<td>$330.00</td>
													<td>12/20/2022</td>
													<td class="text-end">
														<div class="actions">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>															
														</div>
													</td>
												</tr>
												<tr>
													<td>#4546</td>
													<td>
														<h2 class="table-avatar">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product4.jpg')}}" alt="User Image"> Safi Natural Blood Purifier</a>
														</h2>
													</td>
													<td>$330.00</td>
													<td>12/20/2022</td>
													<td class="text-end">
														<div class="actions">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>															
														</div>
													</td>
												</tr>
												<tr>
													<td>#5656</td>
													<td>
														<h2 class="table-avatar">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product5.jpg')}}" alt="User Image"> Headache pills</a>
														</h2>
													</td>
													<td>$330.00</td>
													<td>12/20/2022</td>
													<td class="text-end">
														<div class="actions">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>															
														</div>
													</td>
												</tr>
												<tr>
													<td>#4145</td>
													<td>
														<h2 class="table-avatar">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product6.jpg')}}" alt="User Image"> Natura ayurvedic medicine</a>
														</h2>
													</td>
													<td>$330.00</td>
													<td>12/20/2022</td>
													<td class="text-end">
														<div class="actions">
															<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
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
					<!-- /Product List -->
				</div>
			</div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->
@component('pharmacy-admin/components.modal-popup') 
@endcomponent 	
 	
@endsection