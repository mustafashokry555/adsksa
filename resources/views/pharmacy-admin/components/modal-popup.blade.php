@if(!Route::is(['product-list']))
<!-- Add Modal -->
<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content doctor-profile">
            <div class="modal-header">
                <h3 class="mb-0">Add Category</h3>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /ADD Modal -->
@if(Route::is(['invoice-report']))
<!-- Edit Details Modal -->
<div class="modal fade" id="edit_specialities_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content doctor-profile">
            <div class="modal-header">
                <h5 class="modal-title">Edit Invoice Report</h5>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Medicine Image</label>
                                <div class="custom-file" id="customFile2">
                                    <label class="custom-file-upload">
                                        <input type="file" id="site_logo1" name="site_logo1">
                                        <span class="file-upload-text"></span>
                                        <span class="change-user">
                                            Choose File
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Medicine Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input type="text"  class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="category" required=""> 
                                    <option value="1" selected="selected">Paid</option>
                                    <option value="2">Unpaid</option>
                                    <option value="3">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Created Date</label>
                                <input type="text"  class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Details Modal -->
@endif
@if(!Route::is(['invoice-report']))
<!-- Edit Details Modal -->
<div class="modal fade" id="edit_specialities_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content doctor-profile">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" class="form-control" value="Cardiology">
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Details Modal -->
@endif
<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content doctor-profile">
            <div class="modal-header border-bottom-0 justify-content-end">
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <div class="delete-wrap text-center">
                    <div class="del-icon"><i class="feather-x-circle"></i></div>
                    <h2>Sure you Want to delete</h2>
                    <p>“{{ $title }}”</p>
                    <div class="submit-section">
                        <a href="" class="btn btn-success me-2">Yes</a>
                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                    </div>                              
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
@endif
@if(Route::is(['product-list']))
<!-- Modal -->
<div class="modal fade contentmodal" id="addproduct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header">
                <h3 class="mb-0">Add Product</h3>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form action="product-list">
                    <div class="add-wrap">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Product Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-group">
                            <select class="select">
                                <option>Select Category</option>
                                <option>Pharmacy</option>
                                <option>Hospital</option>
                            </select>
                        </div>
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Price <span class="text-danger">*</span></label>
                        </div>
                        <div class="change-photo-btn">
                            <div><i class="feather-upload"></i>
                            <p>Upload File</p></div>
                            <input type="file" class="upload">
                            <span class="file-upload-text"></span>
                        </div>
                        <p class="file-name text-success">Successfully Product image.jpg uploaded <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                        </div>                              
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->

<!-- Modal -->
<div class="modal fade contentmodal" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header">
                <h3 class="mb-0">Edit Product</h3>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form action="product-list">
                    <div class="add-wrap">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" value="Safi Natural">
                            <label class="focus-label">Product Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-group">
                            <select class="select">
                                <option>Select Category</option>
                                <option>surgical systems</option>
                                <option selected>Neuromodulation</option>
                            </select>
                        </div>
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" value="$330.00">
                            <label class="focus-label">Price <span class="text-danger">*</span></label>
                        </div>
                        <div class="change-photo-btn">
                            <div><i class="feather-upload"></i>
                            <p>Upload File</p></div>
                            <input type="file" class="upload">
                            <span class="file-upload-text"></span>
                        </div>
                        <p class="file-name text-success">Successfully Product image.jpg uploaded <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                        </div>                              
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->

<!-- Modal -->
<div class="modal fade contentmodal" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header border-bottom-0 justify-content-end">
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <div class="delete-wrap text-center">
                    <div class="del-icon"><i class="feather-x-circle"></i></div>
                    <h2>Sure you Want to delete</h2>
                    <p>“Product List”</p>
                    <div class="submit-section">
                        <a href="{{url('pharmacy-admin/product-list')}}" class="btn btn-success me-2">Yes</a>
                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                    </div>                              
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
@endif
@if(Route::is(['sales']))
<!-- Edit Details Modal -->
<div class="modal fade" id="edit_invoice_report" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content doctor-profile">
            <div class="modal-header">
                <h5 class="modal-title">Edit Invoice Report</h5>
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" class="form-control" value="20169998">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Medicine Name</label>
                                <input type="text" class="form-control" value="Abilify">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input type="text" class="form-control" value="$150.00">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Created Date</label>
                                <input type="text" class="form-control" value="14-5-2020">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Details Modal -->
@endif