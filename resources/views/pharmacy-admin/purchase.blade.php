@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Purchase @endslot
@endcomponent

					<div class="row">
						<div class="col-md-12">
						
							<!-- Recent Orders -->
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Purchase</h5>
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
													<th>Purchase Date</th>
													<th>Medicine Name</th>
													<th>Medicine Category</th>
													<th>Purchase Price</th>
													<th>Quantity</th>
													<th>Supplier</th>
													<th>Expire Date</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>13-5-2020</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product1.jpg')}}" alt="User Image"> Abilify</a>
														</h2>
													</td>
													<td>Aripiprazole</td>
													<td>$220</td>
													<td>60</td>
													<td>Bradley</td>
													<td>13-06-20</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-purchase')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>12-5-2020</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product2.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>Phytopathology‎</td>
													<td>$30</td>
													<td>20</td>
													<td>Douglas</td>
													<td>13-06-20</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-purchase')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>11-5-2020</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Adderall</a>
														</h2>
													</td>
													<td>Phytopathology‎</td>
													<td>$58</td>
													<td>33</td>
													<td>Douglas</td>
													<td>20-06-20</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-purchase')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>10-5-2020</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product4.jpg')}}" alt="User Image"> Abilify	</a>
														</h2>
													</td>
													<td>Aripiprazole</td>
													<td>$336</td>
													<td>50</td>
													<td>Bradley</td>
													<td>13-06-20</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-purchase')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>9-5-2020</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product6.jpg')}}" alt="User Image"> Actamin</a>
														</h2>
													</td>
													<td>Phytopathology‎</td>
													<td>$10</td>
													<td>605</td>
													<td>Douglas</td>
													<td>13-06-20</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-purchase')}}" class="text-black">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>8-5-2020</td>
													<td>
														<h2 class="table-avatar">
															<a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_pharmacy/img/products/product3.jpg')}}" alt="User Image"> Adderall</a>
														</h2>
													</td>
													<td>Phytopathology‎</td>
													<td>$15</td>
													<td>160</td>
													<td>Douglas</td>
													<td>20-06-20</td>
													<td class="text-end">
														<div class="actions">
															<a href="{{url('pharmacy-admin/edit-purchase')}}" class="text-black">
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
@slot('title') Purchase @endslot
@endcomponent 

@endsection