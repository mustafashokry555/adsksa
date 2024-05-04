    @if(Route::is(['doctor.index']))
        <!-- Modal -->
        <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content doctor-profile">
                    <div class="modal-header">
                        <h3 class="mb-0">Add Doctor</h3>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="add-wrap">
                                <div class="form-group form-focus">
                                    <input type="text" id="name" name="name"  class="form-control floating">
                                    <label for="name" class="focus-label">Doctor Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" id="speciality" name="speciality"  class="form-control floating">
                                    <label for="speciality" class="focus-label">Doctor Speciality<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" id="fee" name="fee"  class="form-control floating">
                                    <label for="fee" class="focus-label">Fee<span class="text-danger">*</span></label>
                                </div>
                                <div class="change-photo-btn">
                                    <div><i class="feather-upload"></i>
                                        <p>Upload File</p></div>
                                    <input id="image" type="file" name="image" class="upload">
                                </div>
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
    <div class="modal fade contentmodal" id="doctorlist" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header justify-content-center border-bottom-0">
                    <h4 class="modal-title">Doctor Details</h4>
                    <button type="button" class="close-btn pos-top" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="media d-flex align-items-center justify-content-between">
                        <div class="flex-shrink-0 d-flex align-items-center">
                            <img src="{{ URL::asset('/assets/img/doctor/doctor-09.jpg')}}" alt="" class="doctor">
                            <div class="doc-info">
                                <div class="docs-id"> #454445</div>
                                <h3>Dr. Rayan miller</h3>
                                <p>BDS, MDS - Oral & Maxillofacial Surgery</p>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="ratings">
                                <p><i class="fas fa-star filled me-1"></i>4.5</p>
                            </div>
                        </div>
                    </div>
                    <div class="member-wrapper">
                        <h5>Details</h5>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Member Since</h6>
                                    <p>Nov 21, 2022</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Speciality</h6>
                                    <p>Dentist</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Consultation Fees</h6>
                                    <p>$100 / Consultation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="member-wrapper">
                        <h5>Personal Information</h5>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Gender</h6>
                                    <p>Male</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Date of Birth</h6>
                                    <p>21, Dec 2022</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Location</h6>
                                    <p>Newyork, USA</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Phone Number</h6>
                                    <p>+1 5454 2154 4545</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Email ID</h6>
                                    <p>Doctor@Doccure.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lang-wrap">
                        <p>No of Consultation / Cancelled : <span>85/21</span></p>
                        <p>Total Income Earned  :  <span>$4,544,784</span></p>
                    </div>
                    <div class="submit-section">
                        <a data-bs-dismiss="modal" data-bs-toggle="modal" href="{{url('#editModal')}}" class="btn btn-primary me-2">Edit</a>
                        <a data-bs-dismiss="modal" data-bs-toggle="modal" href="{{url('#deleteModal')}}" class="btn btn-secondary">Delete Account</a>
                    </div>
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
                    <h3 class="mb-0">Edit Doctor</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="doctor-list">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="Dr. Rayan miller">
                                <label class="focus-label">Doctor Name <span class="text-danger">*</span></label>
                            </div>
                            <label class="mb-1">Doctor Image</label>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input type="file" class="upload">
                                <span class="file-upload-text"></span>
                            </div>
                            <p class="file-name text-success">Successfully Product image.jpg uploaded <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
                            <div class="form-group">
                                <select class="select">
                                    <option>Select Speciality</option>
                                    <option>Dentist</option>
                                    <option selected>Neurology</option>
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="$330.00">
                                <label class="focus-label">Consultation Fees <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="Newyork, USA">
                                <label class="focus-label">Location <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="+1 5454 2154 4545">
                                <label class="focus-label">Phone <span class="text-danger">*</span></label>
                            </div>
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
                        <form action="doctor-list">
                            <div class="del-icon"><i class="feather-x-circle"></i></div>
                            <h2>Sure you Want to delete</h2>
                            <p>“Doctor”</p>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Yes</button>
                                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['pharmacy-list']))
    <!-- Modal -->
    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Pharmacy</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="pharmacy-list">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating">
                                <label class="focus-label">Pharmacy Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group">
                                <select class="select">
                                    <option>Select Category*</option>
                                    <option>Pharmacy</option>
                                    <option>Hospital</option>
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating">
                                <label class="focus-label">Pharmacy Address <span class="text-danger">*</span></label>
                            </div>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input type="file" class="upload">
                                <span class="file-upload-text"></span>
                            </div>
                            <p class="file-name text-success">Successfully Product image.jpg uploaded <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating">
                                <label class="focus-label">Administrator Name <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating">
                                <label class="focus-label">Phone Number <span class="text-danger">*</span></label>
                            </div>
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
                    <h3 class="mb-0">Edit Pharmacy</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="pharmacy-list">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="Community pharmacy">
                                <label class="focus-label">Pharmacy Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group">
                                <select class="select">
                                    <option>Select Category*</option>
                                    <option selected>Pharmacy</option>
                                    <option>Hospital</option>
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="96 Red Hawk Road Cyrus, MN 56323">
                                <label class="focus-label">Pharmacy Address <span class="text-danger">*</span></label>
                            </div>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input type="file" class="upload">
                                <span class="file-upload-text"></span>
                            </div>
                            <p class="file-name text-success">Product image.jpg <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="Patinson">
                                <label class="focus-label">Administrator Name <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="8789904950">
                                <label class="focus-label">Phone Name <span class="text-danger">*</span></label>
                            </div>
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
                        <p>“Pharmacy Name”</p>
                        <div class="submit-section">
                            <a href="{{url('admin/product-category')}}" class="btn btn-success me-2">Yes</a>
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['pharmacy-category']))
    <!-- Modal -->
    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Category</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="add-wrap">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Category Name<span class="text-danger">*</span></label>
                        </div>
                        <div class="form-group file-icon">
                            <label class="mb-1">Category Icon</label>
                            <div class="custom-file" id="customFile1">
                                <label class="custom-file-upload">
                                    <input type="file" id="site_logo" name="site_logo">
                                    <span class="file-upload-text"></span>
                                    <span class="change-user">
                                        choose-file
                                    </span>
                                </label>
                            </div>
                        </div>
                        <label class="mb-1">Category Image</label>
                        <div class="change-photo-btn">
                            <div><i class="feather-upload"></i>
                            <p>Upload File</p></div>
                            <input type="file" class="upload">
                            <span class="file-upload-text"></span>
                        </div>
                        <p class="text-success">Successfully Product image.jpg uploaded</p>
                        <div class="submit-section">
                            <a href="#" class="btn btn-primary btn-save">Save Changes</a>
                        </div>
                    </div>
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
                    <h3 class="mb-0">Edit Category</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="add-wrap">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" value="Community pharmacy">
                            <label class="focus-label">Category Name<span class="text-danger">*</span></label>
                        </div>
                        <div class="form-group file-icon">
                            <label class="mb-1">Category Icon</label>
                            <div class="custom-file" id="customFile1">
                                <label class="custom-file-upload">
                                    <input type="file" id="site_logo" name="site_logo">
                                    <span class="file-upload-text"></span>
                                    <span class="change-user">
                                        choose-file
                                    </span>
                                </label>
                            </div>
                        </div>
                        <label class="mb-1">Category Image</label>
                        <div class="change-photo-btn">
                            <div><i class="feather-upload"></i>
                            <p>Upload File</p></div>
                            <input type="file" class="upload">
                            <span class="file-upload-text"></span>
                        </div>
                        <p class="file-name text-success">Successfully Product image.jpg uploaded</p>
                        <div class="submit-section">
                            <a href="#" class="btn btn-primary btn-save">Save Changes</a>
                        </div>
                    </div>
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
                        <p>“Pharmacy Name”</p>
                        <div class="submit-section">
                            <a href="{{url('admin/product-category')}}" class="btn btn-success me-2">Yes</a>
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['patient-list']))
    <!-- Modal -->
    <div class="modal fade contentmodal" id="patientlist" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header justify-content-center border-bottom-0">
                    <h4 class="modal-title">Patient Details</h4>
                    <button type="button" class="close-btn pos-top" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <div class="media d-flex align-items-center justify-content-between">
                        <div class="flex-shrink-0 d-flex align-items-center">
                            <img src="{{ URL::asset('/assets_admin/img/profiles/avatar-02.jpg')}}" alt="patient" class="doctor">
                            <div>
                                <div class="docs-id"> #454445</div>
                                <h3>Harden Mike</h3>
                                <p>Male, 45 Years</p>
                            </div>
                        </div>
                    </div>
                    <div class="member-wrapper">
                        <h5>Personal Details</h5>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Registered On</h6>
                                    <p>Nov 21, 2022</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Phone Number</h6>
                                    <p>+1 5454 2154 4545</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Email ID</h6>
                                    <p>Doctor@Doccure.com</p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="mem-info">
                                    <h6>Location</h6>
                                    <p>4417 Goosetown Drive, Taylorsville, North Carolina, 28681</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Date of Birth</h6>
                                    <p>21, Dec 2022</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lang-wrap">
                        <p>No of Consultation / Cancelled : <span>85/21</span></p>
                        <p>Total Income Earned  :  <span>$4,544,784</span></p>
                    </div>
                    <div class="submit-section">
                        <a data-bs-dismiss="modal" data-bs-toggle="modal" href="{{url('#editModal')}}" class="btn btn-primary me-2">Edit</a>
                        <a data-bs-dismiss="modal" data-bs-toggle="modal" href="{{url('#deleteModal')}}" class="btn btn-secondary">Delete Account</a>
                    </div>
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
                    <h3 class="mb-0">Edit Patient</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="patient-list">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="Dr. Rayan miller">
                                <label class="focus-label">Doctor Name <span class="text-danger">*</span></label>
                            </div>
                            <label class="mb-1">Patient Image</label>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input type="file" class="upload">
                                <span class="file-upload-text"></span>
                            </div>
                            <p class="file-name text-success">Successfully Product image.jpg uploaded <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="$330.00">
                                <label class="focus-label">Consultation Fees <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="Newyork, USA">
                                <label class="focus-label">Location <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="+1 5454 2154 4545">
                                <label class="focus-label">Phone <span class="text-danger">*</span></label>
                            </div>
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
                        <form action="patient-list">
                            <div class="del-icon"><i class="feather-x-circle"></i></div>
                            <h2>Sure you Want to delete</h2>
                            <p>“Patient”</p>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Yes</button>
                                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['invoice-report','transaction']))
    <!-- Modal -->
    <div class="modal fade contentmodal" id="transaction" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header border-bottom-0 justify-content-end pb-0">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="rating-wrapper">
                        <h4 class="text-center mb-4">Transaction Details</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Consultation ID </h6>
                                    <p>#454445</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Paid On </h6>
                                    <p>14 Nov 2022 05:30 PM</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Payment Mode</h6>
                                    <p>Online</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Consultation Fees</h6>
                                    <p>$300.00</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Tax Fees</h6>
                                    <p>$30.00</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mem-info">
                                    <h6>Total Fees</h6>
                                    <p>$300.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <a href="#" class="btn btn-primary btn-download">Download Invoice</a>
                        </div>
                    </div>
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
                        <p>“Transaction”</p>
                        <div class="submit-section">
                            <a href="{{url('admin/transaction')}}" class="btn btn-success me-2">Yes</a>
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['product-category']))
    <!-- Modal -->
    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Category</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="product-category">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating">
                                <label class="focus-label">Category Name<span class="text-danger">*</span></label>
                            </div>
                            <label class="mb-1">Category Image</label>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input type="file" class="upload">
                                <span class="file-upload-text"></span>
                            </div>
                            <p class="text-success">Successfully Product image.jpg uploaded</p>
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
                    <h3 class="mb-0">Edit Category</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="product-category">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="Neuromodulation">
                                <label class="focus-label">Category Name<span class="text-danger">*</span></label>
                            </div>
                            <label class="mb-1">Category Image</label>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input type="file" class="upload">
                                <span class="file-upload-text"></span>
                            </div>
                            <p class="text-success">Successfully Product image.jpg uploaded</p>
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
                        <p>“Category”</p>
                        <div class="submit-section">
                            <a href="{{url('admin/product-category')}}" class="btn btn-success me-2">Yes</a>
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
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
                        <p>“Product”</p>
                        <div class="submit-section">
                            <a href="{{url('admin/product-list')}}" class="btn btn-success me-2">Yes</a>
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['ratings']))
    <!-- Modal -->
    <div class="modal fade contentmodal" id="Ratings" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header justify-content-center border-bottom-0">
                <div>
                    <h4 class="modal-title">Rating Details</h4>
                    <button type="button" class="close-btn pos-top" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                </div>
                <div class="modal-body">
                    <div class="rating-wrapper mb-2">
                        <h5>Consultation ID</h5>
                        <p>#454445</p>
                        <h5>Reviews</h5>
                        <div class="ratings mb-3">
                            <i class="far fa-star filled"></i>
                            <i class="far fa-star filled"></i>
                            <i class="far fa-star filled"></i>
                            <i class="far fa-star filled"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <h5>Description</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
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
                    <form action="ratings">
                        <div class="delete-wrap text-center">
                            <div class="del-icon"><i class="feather-x-circle"></i></div>
                            <h2>Sure you Want to delete</h2>
                            <p>“Rating”</p>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Yes</button>
                                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['speciality.index']))
    <!-- Modal -->
    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Speciality</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('speciality.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" id="name" name="name"  class="form-control floating">
                                <label for="name" class="focus-label">Speciality Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input id="image" type="file" name="image" class="upload">
                            </div>
                            <p class="text-success">Successfully specialityimage.jpg uploaded <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
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
                    <h3 class="mb-0">Edit Speciality</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="specialities">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" value="">
                                <label class="focus-label">Speciality Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                <p>Upload File</p></div>
                                <input type="file" class="upload">
                                <span class="file-upload-text"></span>
                            </div>
                            <p class="file-name text-success">specialityimage.jpg <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
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
                    <form action="specialities">
                        <div class="delete-wrap text-center">
                            <div class="del-icon"><i class="feather-x-circle"></i></div>
                            <h2>Sure you Want to delete</h2>
                            <p>“Cardiolody”</p>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Yes</button>
                                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    @endif
    @if(Route::is(['hospital.index']))
        <!-- Modal -->
        <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content doctor-profile">
                    <div class="modal-header">
                        <h3 class="mb-0">Add Hospital</h3>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('hospital.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="add-wrap">
                                <div class="form-group form-focus">
                                    <input type="text" id="name" name="name"  class="form-control floating">
                                    <label for="name" class="focus-label">Hospital Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" id="location" name="location"  class="form-control floating">
                                    <label for="location" class="focus-label">Hospital Location<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" id="zip" name="zip"  class="form-control floating">
                                    <label for="zip" class="focus-label">Zip Code<span class="text-danger">*</span></label>
                                </div>
                                <div class="change-photo-btn">
                                    <div><i class="feather-upload"></i>
                                        <p>Upload File</p></div>
                                    <input id="image" type="file" name="image" class="upload">
                                </div>
                                <h3 class="mb-0">Add Hospital Administrator</h3>
                                <div class="form-group form-focus">
                                    <input type="text" id="name" name="name"  class="form-control floating">
                                    <label for="name" class="focus-label">Administrator name<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" id="email" name="email"  class="form-control floating">
                                    <label for="email" class="focus-label">Administrator Email<span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="password" id="password" name="password"  class="form-control floating">
                                    <label for="password" class="focus-label">Password<span class="text-danger">*</span></label>
                                </div>
                                <input type="hidden" name="hospital_id">
                                <input type="hidden" name="user_type" value="H">
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
                        <h3 class="mb-0">Edit Speciality</h3>
                        <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="feather-x-circle"></i></button>
                    </div>
                    <div class="modal-body">
                        <form action="specialities">
                            <div class="add-wrap">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" value="">
                                    <label class="focus-label">Speciality Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="change-photo-btn">
                                    <div><i class="feather-upload"></i>
                                        <p>Upload File</p></div>
                                    <input type="file" class="upload">
                                    <span class="file-upload-text"></span>
                                </div>
                                <p class="file-name text-success">specialityimage.jpg <a href="#" class="text-danger"><i class="feather-x"></i></a></p>
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
                        <form action="specialities">
                            <div class="delete-wrap text-center">
                                <div class="del-icon"><i class="feather-x-circle"></i></div>
                                <h2>Sure you Want to delete</h2>
                                <p>“Cardiolody”</p>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-success me-2">Yes</button>
                                    <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal -->
    @endif
