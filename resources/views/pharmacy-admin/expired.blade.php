@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Expired @endslot
@endcomponent


					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Expired List</h5>
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
													<th>#</th>
													<th>Brand Name</th>
													<th>Genetic Name</th>
													<th>Category</th>
													<th>Price</th>
													<th>Quantity</th>
													<th>Discount</th>
													<th>Expire</th>
													<th class="text-end">Actions</th>
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
													<td>Aripiprazole</td>
													<td>Phytopathology</td>
													<td>$22</td>
													<td><span class="btn btn-sm bg-danger-light">THERE ONLY 2</span></td>
													<td>0%</td>
													<td><span class="btn btn-sm bg-danger-light">THE PRODUCT IS EXPIRED</span></td>
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
													<td>2</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product2.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>Amphetamine</td>
													<td>Phytopathology</td>
													<td>$45</td>
													<td>50</td>
													<td>10%</td>
													<td><span class="btn btn-sm bg-danger-light">THE PRODUCT IS EXPIRED</span></td>
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
													<td>3</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>Aripiprazole</td>
													<td>Phytopathology</td>
													<td>$87</td>
													<td><span class="btn btn-sm bg-danger-light">THERE ONLY 5</span></td>
													<td>70%</td>
													<td><span class="btn btn-sm bg-danger-light">THE PRODUCT IS EXPIRED</span></td>
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
													<td>4</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product4.jpg')}}" alt="User Image"> Abilify</a>
														</h2>
													</td>
													<td>Aripiprazole</td>
													<td>Phytopathology</td>
													<td>$85</td>
													<td>$225</td>
													<td>90%</td>
													<td><span class="btn btn-sm bg-danger-light">THE PRODUCT IS EXPIRED</span></td>
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
													<td>5</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product5.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>Amphetamine</td>
													<td>Phytopathology</td>
													<td>$105</td>
													<td>$56</td>
													<td>20%</td>
													<td><span class="btn btn-sm bg-danger-light">THE PRODUCT IS EXPIRED</span></td>
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
													<td>6</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product6.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>Aripiprazole</td>
													<td>Phytopathology</td>
													<td>$65</td>
													<td><span class="btn btn-sm bg-danger-light">THERE ONLY 7</span></td>
													<td>80%</td>
													<td><span class="btn btn-sm bg-danger-light">THE PRODUCT IS EXPIRED</span></td>
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
        </div>
		<!-- /Main Wrapper -->
@component('pharmacy-admin/components.modal-popup') 
@slot('title') Expired @endslot
@endcomponent 	
				
@endsection