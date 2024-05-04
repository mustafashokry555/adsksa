@extends('layout.mainlayout_pharmacy_admin')
@section('content')
@component('pharmacy-admin/components.page-header')                
    @slot('title') Categories @endslot
    @slot('li_1') Add New @endslot
@endcomponent


	<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Categories List</h5>
										</div>
										<div class="col-auto custom-list d-flex">
											
											<div class="form-custom me-2">
												<div id="tableSearch"  class="dataTables_wrapper"></div>
											</div>
											<div class="SortBy">
												<div class="selectBoxes order-by">
													<p class="mb-0"><img src="{{ URL::asset('/assets_pharmacy/img/icon/sort.png')}}" class="me-2" alt="icon"> Order by </p>
													<span class="down-icon"><i class="feather-chevron-down"></i></span>
												</div>						  
												<div id="checkBox">
													<form action="categories">
														<p class="lab-title">Order By </p>
														<label class="custom_radio w-100">
															<input type="radio" name="sort">
															<span class="checkmark"></span> ID
														</label>
														<label class="custom_radio w-100">
															<input type="radio" name="sort">
															<span class="checkmark"></span> Amount
														</label>
														<label class="custom_radio w-100">
															<input type="radio" name="sort">
															<span class="checkmark"></span> Date Created
														</label>
														<p class="lab-title">Sort By</p>
														<label class="custom_radio w-100">
															<input type="radio" name="sort">
															<span class="checkmark"></span> Ascending
														</label>
														<label class="custom_radio w-100">
															<input type="radio" name="sort">
															<span class="checkmark"></span> Descending
														</label>
														<button type="submit" class="btn w-100 btn-primary">Apply</button>
													</form>
												</div>
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
													<th>Name</th>
													<th>Created date</th>
													<th class="text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>01</td>
													
													<td>
														<h2 class="table-avatar">	
															Phytopathology‎
														</h2>
													</td>
													
													<td>01-May-2020-12:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>02</td>
													
													<td>
														<h2 class="table-avatar">	
															Family care
														</h2>
													</td>
													
													<td>03-May-2020-08:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>03</td>
													
													<td>
														<h2 class="table-avatar">	
															Cancer
														</h2>
													</td>
													
													<td>05-May-2020-06:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>04</td>
													
													<td>
														<h2 class="table-avatar">	
															Hair care
														</h2>
													</td>
													
													<td>06-May-2020-01:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>05</td>
													
													<td>
														<h2 class="table-avatar">	
															Skin care	
														</h2>
													</td>
													
													<td>05-May-2020-02:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>06</td>
													
													<td>
														<h2 class="table-avatar">	
															Rare diseases‎	
														</h2>
													</td>
													
													<td>06-May-2020-06:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>07</td>
													
													<td>
														<h2 class="table-avatar">	
															Baby care
														</h2>
													</td>
													
													<td>07-May-2020-12:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>08</td>
													
													<td>
														<h2 class="table-avatar">	
															Inflammations	
														</h2>
													</td>
													
													<td>07-May-2020-05:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>09</td>
													
													<td>
														<h2 class="table-avatar">	
															Sleep disorders‎
														</h2>
													</td>
													
													<td>07-May-2020-08:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
																<i class="feather-trash-2 me-1"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												<tr>
													<td>10</td>
													
													<td>
														<h2 class="table-avatar">	
															Infectious diseases‎	
														</h2>
													</td>
													
													<td>08-May-2020-02:00</td>

													<td class="text-end">
														<div class="actions">
															<a class="text-black" data-bs-toggle="modal" href="#edit_specialities_details">
																<i class="feather-edit-3 me-1"></i> Edit
															</a>
															<a  data-bs-toggle="modal" href="{{url('#delete_modal')}}
" class="text-danger">
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
@slot('title') Categories @endslot 
@endcomponent 
		
@endsection