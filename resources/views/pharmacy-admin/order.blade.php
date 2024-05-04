@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Order @endslot
@endcomponent

					<div class="row">
						<div class="col-md-12">
						
							<!-- Recent Orders -->
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Order List</h5>
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
													<th>Supplier ID</th>
													<th>Supplier Name</th>
													<th>Order by</th>
													<th>Add order</th>
													<th>Order list</th>
													<th class="text-end">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>256</td>
													<td>Douglas Meyer</td>
													<td>Trinity General Hospital</td>
													<td>10-5-2020</td>
													<td>Dolofin Antigripal(Dolo)  3</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>2</td>
													<td>20</td>
													<td>Tyler Robinson</td>
													<td>Grand Valley Clinic</td>
													<td>10-5-2020</td>
													<td>Dolofin Antigripal(Dolo)  50<br>
													Dolofin Antigripal(Dolo)  4</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>3</td>
													<td>15</td>
													<td>Mary Dixon</td>
													<td>Grand Plains Clinic</td>
													<td>10-5-2020</td>
													<td>Dolo 650(CIpla)  0</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>4</td>
													<td>156</td>
													<td>Kurt Wooten</td>
													<td>Mercy Vale Clinic</td>
													<td>10-5-2020</td>
													<td>Tektonik(None)  2</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>5</td>
													<td>23</td>
													<td>Vickie Pritchett</td>
													<td>Kindred Soul Clinic</td>
													<td>10-5-2020</td>
													<td>Dolofin Antigripal(Dolo)  4</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>6</td>
													<td>35</td>
													<td>Joanne Fry</td>
													<td>Hope Haven Hospital</td>
													<td>10-5-2020</td>
													<td>Dolo 650(CIpla)  0</td>
													<td class="text-end">
														<div class="actions">
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>7</td>
													<td>205</td>
													<td>Christopher Johnson</td>
													<td>Hill Crest Clinic</td>
													<td>10-5-2020</td>
													<td>Dolofin Antigripal(Dolo)  50<br>
													Dolofin Antigripal(Dolo)  4</td>
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
@slot('title') Order @endslot
@endcomponent
		
@endsection