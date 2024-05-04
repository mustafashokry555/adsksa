        @if(Route::is(['accounts','patient-accounts']))
        <!-- Payment Request Moodal -->

        <div class="modal fade custom-modal" id="payment_request_modal" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Payment Request</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="payment_request_form" method="post">
                            <input type="hidden" name="payment_type" id="payment_type" value="1">
                            <div class="form-group">
                                <label>Request Amount</label>
                                <input type="text" name="request_amount" id="request_amount" class="form-control" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label>Description (Optional)</label>
                                <textarea class="form-control" name="description" id="description"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" id="request_btn" class="btn btn-primary">Request</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /Payment Request Moodal -->

        <!-- Account Details Modal-->
        <div class="modal fade custom-modal" id="account_modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Account Details</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="accounts_form" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Bank Name</label>
                                        <input type="text" name="bank_name" class="form-control bank_name" value="Wells Fargo & Co">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Branch Name</label>
                                        <input type="text" name="branch_name" class="form-control branch_name" value="Lenexa">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Account Number</label>
                                        <input type="text" name="account_no" class="form-control account_no" value="5396 5250 1908 3838">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Account Name</label>
                                        <input type="text" name="account_name" class="form-control acc_name" value="Dr. Darren Elder">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="submit" id="acc_btn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Account Details Modal-->
        @endif
        @if(Route::is(['appointments']))
        <!-- Appointment Details Modal -->
        <div class="modal fade custom-modal" id="appt_details">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Appointment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="info-details">
                            <li>
                                <div class="details-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="title">#APT0001</span>
                                            <span class="text">21 Oct 2019 10:00 AM</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-end">
                                                <button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <span class="title">Status:</span>
                                <span class="text">Completed</span>
                            </li>
                            <li>
                                <span class="title">Confirm Date:</span>
                                <span class="text">29 Jun 2019</span>
                            </li>
                            <li>
                                <span class="title">Paid Amount</span>
                                <span class="text">$450</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Appointment Details Modal -->
        @endif
        @if(Route::is(['calendar']))
        <!-- Add Event Modal -->
        <div id="add_event" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Event</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Event Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Event Date <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Event Modal -->

        <!-- Add Event Modal -->
        <div class="modal custom-modal fade none-border" id="my_event">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Event</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-success save-event submit-btn">Create event</button>
                        <button type="button" class="btn btn-danger delete-event submit-btn" data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Event Modal -->

        <!-- Add Category Modal -->
        <div class="modal custom-modal fade" id="add_new_event">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" />
                            </div>
                            <div class="form-group">
                                <label>Choose Category Color</label>
                                <select class="form-select form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                    <option value="inverse">Inverse</option>
                                </select>
                            </div>
                            <div class="submit-section text-center">
                                <button type="button" class="btn btn-primary save-category submit-btn" data-bs-dismiss="modal">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Category Modal -->
        @endif
        @if(Route::is(['chat-doctor']))
        <!-- Voice Call Modal -->
        <div class="modal fade call-modal" id="voice_call">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <!-- Outgoing Call -->
                        <div class="call-box incoming-box">
                            <div class="call-wrapper">
                                <div class="call-inner">
                                    <div class="call-user">
                                        <img alt="User Image" src="{{ URL::asset('/assets/img/patients/patient.jpg')}}" class="call-avatar">
                                        <h4>Richard Wilson</h4>
                                        <span>Connecting...</span>
                                    </div>
                                    <div class="call-items">
                                        <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
                                        <a href="{{url('voice-call')}}" class="btn call-item call-start"><i class="material-icons">call</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Outgoing Call -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /Voice Call Modal -->

        <!-- Video Call Modal -->
        <div class="modal fade call-modal" id="video_call">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <!-- Incoming Call -->
                        <div class="call-box incoming-box">
                            <div class="call-wrapper">
                                <div class="call-inner">
                                    <div class="call-user">
                                        <img class="call-avatar" src="{{ URL::asset('/assets/img/patients/patient.jpg')}}" alt="User Image">
                                        <h4>Richard Wilson</h4>
                                        <span>Calling ...</span>
                                    </div>
                                    <div class="call-items">
                                        <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
                                        <a href="{{url('video-call')}}" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Incoming Call -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Video Call Modal -->
        @endif
        @if(Route::is(['chat','doctor-profile','pharmacy-details','product-description']))
        <!-- Voice Call Modal -->
        <div class="modal fade call-modal" id="voice_call">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <!-- Outgoing Call -->
                        <div class="call-box incoming-box">
                            <div class="call-wrapper">
                                <div class="call-inner">
                                    <div class="call-user">
                                        <img alt="User Image" src="{{ URL::asset('/assets/img/doctor/doctor-thumb-02.jpg')}}" class="call-avatar">
                                        <h4>Darren Elder</h4>
                                        <span>Connecting...</span>
                                    </div>
                                    <div class="call-items">
                                        <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
                                        <a href="{{url('voice-call')}}" class="btn call-item call-start"><i class="material-icons">call</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Outgoing Call -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /Voice Call Modal -->

        <!-- Video Call Modal -->
        <div class="modal fade call-modal" id="video_call">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <!-- Incoming Call -->
                        <div class="call-box incoming-box">
                            <div class="call-wrapper">
                                <div class="call-inner">
                                    <div class="call-user">
                                        <img class="call-avatar" src="{{ URL::asset('/assets/img/doctor/doctor-thumb-02.jpg')}}" alt="User Image">
                                        <h4>Darren Elder</h4>
                                        <span>Calling ...</span>
                                    </div>
                                    <div class="call-items">
                                        <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
                                        <a href="{{url('video-call')}}" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Incoming Call -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Video Call Modal -->
        @endif
        @if(Route::is(['dependent']))
        <!-- Add Dependent Modal-->
        <div id="modal_form" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" enctype="multipart/form-data" autocomplete="off" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Add new member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label mb-10"> Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Relationship </label>
                                <input type="text" name="relationship" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Gender </label>
                                <select class="form-select form-control" name="gender">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">DOB </label>
                                <input type="text" name="dob" id="dob" value="" readonly="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Photo </label>
                                <input type="file" name="profile_image" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Dependent Modal-->

        <!-- Edit Dependent Modal-->
        <div id="edit_form" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" enctype="multipart/form-data" autocomplete="off" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label mb-10"> Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="Christopher">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Relationship </label>
                                <input type="text" name="relationship" class="form-control" value="son">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Gender </label>
                                <select class="form-select form-control" name="gender">
                                    <option value="">Select</option>
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">DOB </label>
                                <input type="text" name="dob" id="editdob" value="01/12/2021" readonly="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Photo </label>
                                <input type="file"  name="profile_image" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Edit Dependent Modal-->
        @endif
        @if(Route::is(['doctor-add-blog','doctor-blog','doctor-pending-blog','edit-blog']))
        <!-- Model -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acc_title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="acc_msg"></p>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-success si_accept_confirm">Yes</a>
                        <button type="button" class="btn btn-danger si_accept_cancel" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteNotConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acc_title">Active Service?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="acc_msg">Service is Booked and Inprogress..</p>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger si_accept_cancel" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Model -->
        @endif
        @if(Route::is(['medical-details']))
        <!-- Add Medical Detail -->
        <div id="modal_medical_form" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" enctype="multipart/form-data" autocomplete="off" id="medical_form" method="GET">
                        <div class="modal-header">
                            <h5 class="modal-title">Add new data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="" name="id">
                            <input type="hidden" value="insert" name="method">
                            <div class="form-group">
                                <label for="category_name" class="control-label mb-10"> BMI <span class="text-danger">*</span></label>
                                <input type="text" parsley-trigger="change" id="bmi" name="bmi" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-10">Heart rate </label>
                                <input type="text" parsley-trigger="change" id="hr" name="hr" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-10">Weight</label>
                                <input type="text" parsley-trigger="change" id="Weight" name="Weight" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-10">Fbc</label>
                                <input type="text" parsley-trigger="change" id="Fbc" name="Fbc" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="keywords" class="control-label mb-10">Created Date </label>
                                <input type="text" name="dob" id="dob" value="" readonly="" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" id="btnMedicalsave" class="btn btn-outline btn-success ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Medical Detail -->

        <!-- Edit Medical Detail -->
        <div id="edit_medical_form" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" enctype="multipart/form-data" autocomplete="off" id="medical_form" method="GET">
                        <div class="modal-header">
                            <h5 class="modal-title">Add new data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="" name="id">
                            <input type="hidden" value="insert" name="method">
                            <div class="form-group">
                                <label for="category_name" class="control-label mb-10"> BMI <span class="text-danger">*</span></label>
                                <input type="text" parsley-trigger="change" id="bmi" name="bmi" class="form-control" value="23.7">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-10">Heart rate </label>
                                <input type="text" parsley-trigger="change" id="hr" name="hr" class="form-control" value="89">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-10">Weight</label>
                                <input type="text" parsley-trigger="change" id="Weight" name="Weight" class="form-control" value="74">
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-10">Fbc</label>
                                <input type="text" parsley-trigger="change" id="Fbc" name="Fbc" class="form-control" value="140">
                            </div>
                            <div class="form-group">
                                <label for="keywords" class="control-label mb-10">Created Date </label>
                                <input type="text" name="dob" id="editdob" value="11/11/2019" readonly="" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" id="btnMedicalsave" class="btn btn-outline btn-success ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Edit Medical Detail -->
        @endif
        @if(Route::is(['medical-records']))
        <!-- Medical Records Modal -->
        <div class="modal fade custom-modal custom-medicalrecord-modal" id="add_medical_records_modal" style="display: none;" data-select2-id="add_medical_records_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Medical Records</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <form id="medical_records_form" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Title Name</label>
                                        <input type="text" name="description" class="form-control" placeholder="Enter Title Name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Patient</label>
                                        <select class="select">
                                            <option>Myself</option>
                                            <option>Child_1</option>
                                            <option>Self</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Hospital Name</label>
                                        <input type="text" name="hospital" class="form-control" placeholder="Enter name here..">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Upload</label>
                                        <div class="upload-medical-records">
                                            <input class="form-control" type="file" name="user_file" id="user_files_mr">
                                            <div class="upload-content dropzone">
                                                <div class="text-center">
                                                    <div class="upload-icon mb-2"><img src="{{ URL::asset('/assets/img/upload-icon.png')}}" alt=""></div>
                                                    <h5>Drag &amp; Drop</h5>
                                                    <h6>or <span class="text-danger">Browse</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Symptoms</label>
                                        <input type="text" data-role="tagsinput" class="input-tags form-control" value="Fever, Fatigue" name="services" id="services">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="tratment_date" id="tratment_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <div class="submit-section text-center">
                                    <button type="submit" id="medical_btn" class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Medical Records Modal -->
        @endif
        @if(Route::is(['patient-dashboard']))
        <!-- Graph One-->
        <div class="modal fade custom-modal show" id="graph1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">BMI Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="bmi-status"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Graph One-->

        <!-- Graph Two-->
        <div class="modal fade custom-modal show" id="graph2">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Heart Rate Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="heartrate-status"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Graph Two-->

        <!-- Graph Three-->
        <div class="modal fade custom-modal show" id="graph3">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">FBC Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="fbc-status"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Graph Three-->

        <!-- Graph Four-->
        <div class="modal fade custom-modal show" id="graph4">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Weight Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="weight-status"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Graph Four-->
        @endif
        @if(Route::is(['patient-profile']))
        <!-- Add Medical Records Modal -->
        <div class="modal fade custom-modal" id="add_medical_records">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Medical Records</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control datetimepicker" value="31-10-2019">
                            </div>
                            <div class="form-group">
                                <label>Description ( Optional )</label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload File</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="submit-section text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                <button type="button" class="btn btn-secondary submit-btn" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Medical Records Modal -->
        @endif
        @if(Route::is(['schedule-timings']))
        <!-- Add Time Slot Modal -->
        <div class="modal fade custom-modal" id="add_time_slot">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Time Slots</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="hours-info">
                                <div class="row form-row hours-cont">
                                    <div class="col-12 col-md-10">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Start Time</label>
                                                    <select class="form-control">
                                                        <option>-</option>
                                                        <option>12.00 am</option>
                                                        <option>12.30 am</option>
                                                        <option>1.00 am</option>
                                                        <option>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>End Time</label>
                                                    <select class="form-control">
                                                        <option>-</option>
                                                        <option>12.00 am</option>
                                                        <option>12.30 am</option>
                                                        <option>1.00 am</option>
                                                        <option>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-more mb-3">
                                <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                            <div class="submit-section text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Time Slot Modal -->

        <!-- Edit Time Slot Modal -->
        <div class="modal fade custom-modal" id="edit_time_slot">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Time Slots</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="hours-info">
                                <div class="row form-row hours-cont">
                                    <div class="col-12 col-md-10">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Start Time</label>
                                                    <select class="form-control form-select">
                                                        <option>-</option>
                                                        <option selected>12.00 am</option>
                                                        <option>12.30 am</option>
                                                        <option>1.00 am</option>
                                                        <option>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>End Time</label>
                                                    <select class="form-control form-select">
                                                        <option>-</option>
                                                        <option>12.00 am</option>
                                                        <option selected>12.30 am</option>
                                                        <option>1.00 am</option>
                                                        <option>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-row hours-cont">
                                    <div class="col-12 col-md-10">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Start Time</label>
                                                    <select class="form-control form-select">
                                                        <option>-</option>
                                                        <option>12.00 am</option>
                                                        <option selected>12.30 am</option>
                                                        <option>1.00 am</option>
                                                        <option>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>End Time</label>
                                                    <select class="form-control form-select">
                                                        <option>-</option>
                                                        <option>12.00 am</option>
                                                        <option>12.30 am</option>
                                                        <option selected>1.00 am</option>
                                                        <option>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                                </div>

                                <div class="row form-row hours-cont">
                                    <div class="col-12 col-md-10">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Start Time</label>
                                                    <select class="form-control form-select">
                                                        <option>-</option>
                                                        <option>12.00 am</option>
                                                        <option>12.30 am</option>
                                                        <option selected>1.00 am</option>
                                                        <option>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>End Time</label>
                                                    <select class="form-control form-select">
                                                        <option>-</option>
                                                        <option>12.00 am</option>
                                                        <option>12.30 am</option>
                                                        <option>1.00 am</option>
                                                        <option selected>1.30 am</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                                </div>

                            </div>

                            <div class="add-more mb-3">
                                <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                            <div class="submit-section text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Time Slot Modal -->
        @endif
        @if(Route::is(['components']))
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                    <button class="btn btn-secondary" type="button" data-original-title="" title="">Save changes</button>
                </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                </div>
                <div class="modal-body">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <p>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <p>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <p>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <p>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <p>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <p>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                    <button class="btn btn-primary" type="button" data-original-title="" title="">Save changes</button>
                </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                        <button class="btn btn-primary" type="button" data-original-title="" title="">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="tooltipmodal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                  </div>
                  <div class="modal-body">
                        <h5>Popover in a modal</h5>
                        <p>This <a class="btn btn-primary popover-test" href="#" role="button" title="Popover title" data-bs-toggle="popover" data-bs-content="Popover body content is set in this attribute." data-bs-original-title="Popover title">button</a> triggers a popover on click.</p>
                        <hr>
                        <h5>Tooltips in a modal</h5>
                        <p><a class="tooltip-test" href="#" title="" data-bs-original-title="Tooltip" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus">This link</a> and <a class="tooltip-test" href="#" title="" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-toggle="popover" data-bs-original-title="Tooltip">that link</a> have tooltips on hover.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                        <button class="btn btn-primary" type="button" data-original-title="" title="">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="grid-modal" tabindex="-1" role="dialog" aria-labelledby="grid-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                  <div class="modal-body grid-showcase">
                        <div class="container-fluid bd-example-row">
                            <div class="row">
                                <div class="col-md-4"><span>.col-md-4</span></div>
                                <div class="col-md-4 ms-auto"><span>.col-md-4 .ms-auto</span></div>
                            </div>
                        <div class="row">
                                <div class="col-md-3 ms-auto"><span>.col-md-3 .ms-auto</span></div>
                                <div class="col-md-2 ms-auto"><span>.col-md-2 .ms-auto</span></div>
                        </div>
                        <div class="row">
                                <div class="col-md-6 ms-auto"><span>.col-md-6 .ms-auto</span></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9"><span>Level 1: .col-sm-9</span>
                              <div class="row">
                                <div class="col-8 col-sm-6"><span>Level 2: .col-8 .col-sm-6</span></div>
                                <div class="col-4 col-sm-6"><span>Level 2: .col-4 .col-sm-6</span></div>
                              </div>
                            </div>
                        </div>
                        </div>
                    </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                    <button class="btn btn-primary" type="button" data-original-title="" title="">Save changes</button>
                  </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalfat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">New message</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="col-form-label" for="recipient-name">Recipient:</label>
                            <input class="form-control" type="text" value="@fat" data-original-title="" title="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="message-text">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                    <button class="btn btn-primary" type="button" data-original-title="" title="">Send message</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalmdo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New message</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="form-group">
                            <label class="col-form-label" for="recipient-name">Recipient:</label>
                            <input class="form-control" id="recipient-name" type="text" value="@Mat" data-original-title="" title="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="message-text">Message:</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                        <button class="btn btn-primary" type="button" data-original-title="" title="">Send message</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalgetbootstrap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New message</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                            <label class="col-form-label" for="recipient-name">Recipient:</label>
                            <input class="form-control" type="text" value="@getbootstrap" data-original-title="" title="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="message-text">Message:</label>
                            <textarea class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                        <button class="btn btn-primary" type="button" data-original-title="" title="">Send message</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">...</div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">...</div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Small modal</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">...</div>
                </div>
            </div>
        </div>
        @endif
