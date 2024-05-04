@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Sales @endslot
@endcomponent


					<div class="row">
						<div class="col-md-12">
						
							<!-- Recent Orders -->
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Sales List</h5>
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
													<th>Invoice No</th>
													<th>Medicine Name</th>
													<th>Total Price</th>
													<th>Date</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>20170001</td>
													<td>Abilify,Actamin,Actamin</td>
													<td>$220</td>
													<td>12-5-2020</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="{{url('#edit_invoice_report')}}">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-black" href="{{url('pharmacy-admin/invoice')}}">
																<i class="fas fa-file-alt me-1"></i> Invoice
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>20169999</td>
													<td>Abilify,Actamin</td>
													<td>$100</td>
													<td>13-5-2020</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="{{url('#edit_invoice_report')}}">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-black" href="{{url('pharmacy-admin/invoice')}}">
																<i class="fas fa-file-alt me-1"></i> Invoice
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>20169998</td>
													<td>Abilify</td>
													<td>$150</td>
													<td>14-5-2020</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="{{url('#edit_invoice_report')}}">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-black" href="{{url('pharmacy-admin/invoice')}}">
																<i class="fas fa-file-alt me-1"></i> Invoice
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>20170001</td>
													<td>Abilify,Actamin,Actamin</td>
													<td>$220</td>
													<td>15-5-2020</td>
													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="{{url('#edit_invoice_report')}}">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a class="text-black" href="{{url('pharmacy-admin/invoice')}}">
																<i class="fas fa-file-alt me-1"></i> Invoice
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
@slot('title') Sales @endslot
@endcomponent 
		
@endsection