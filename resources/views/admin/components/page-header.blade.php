
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        @if(!Route::is(['doctor.index','past-appointments','patient-list','pharmacy-category','pharmacy-list','product-category','product-list','ratings','speciality.index','hospital.index','transaction','upcoming-appointments']))
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">{{ $title }}</h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        @endif
        @if(Route::is(['patient-list','ratings','transaction']))
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">{{ $li_1 }} <span class="ms-1">48</span></div>
                    <div class="SortBy">
                        <div class="selectBoxes order-by">
                            <p class="mb-0"><img src="{{ URL::asset('/assets_admin/img/icon/sort.png')}}" class="me-2" alt="icon"> {{ $li_2 }}</p>
                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                        </div>
                        <div id="checkBox">
                            @if(!Route::is(['ratings','transaction']))
                            @if(!Route::is(['patient-list']))
                            <form action="doctor.index">
                            @endif
                            @if(Route::is(['patient-list']))
                           <form action="patient-list">
                            @endif
                                <p class="lab-title">Specialities</p>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="year">
                                    <span class="checkmark"></span> Number of Appointment
                                </label>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="year">
                                    <span class="checkmark"></span> Total Income
                                </label>
                                <label class="custom_radio w-100 mb-4">
                                    <input type="radio" name="year">
                                    <span class="checkmark"></span> Ratings
                                </label>
                                <p class="lab-title">Sort By</p>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Ascending
                                </label>
                                <label class="custom_radio w-100 mb-4">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Descending
                                </label>
                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                            </form>
                            @endif
                            @if(Route::is(['ratings']))
                            <form action="ratings">
                                <p class="lab-title">Sort By</p>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Ascending
                                </label>
                                <label class="custom_radio w-100 mb-4">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Descending
                                </label>
                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                            </form>
                            @endif
                            @if(Route::is(['transaction']))
                            <form action="transaction">
                                <p class="lab-title">Order By </p>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Invoice Number
                                </label>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Total Amount
                                </label>
                                <label class="custom_radio w-100 mb-4">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> ID
                                </label>
                                <p class="lab-title">Sort By</p>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Ascending
                                </label>
                                <label class="custom_radio w-100 mb-4">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Descending
                                </label>
                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        @endif
        @if(Route::is(['past-appointments','upcoming-appointments']))
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="list-links">
                        @if(!Route::is(['upcoming-appointments']))
                        <li><a href="{{url('admin/upcoming-appointments')}}">Upcoming Appointments <span>(48)</span></a></li>
                        <li class="active"><a href="{{url('admin/past-appointments')}}">Past Appointments <span>(98)</span></a></li>
                        @endif
                        @if(Route::is(['upcoming-appointments']))
                        <li class="active"><a href="{{url('admin/upcoming-appointments')}}">Upcoming Appointments <span>(48)</span></a></li>
                        <li><a href="{{url('admin/past-appointments')}}">Past Appointments <span>(98)</span></a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-auto">
                    <div class="bookingrange btn btn-white btn-sm">
                        <div class="cal-ico">
                            <i class="feather-calendar me-1"></i>
                            <span>Select Date</span>
                        </div>
                        <div class="ico">
                            <i class="fas fa-chevron-left"></i>
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        @endif
        @if(Route::is(['pharmacy-category','pharmacy-list','product-category','product-list','speciality.index', 'hospital.index', 'doctor.index']))
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">{{ $li_1 }} <span class="ms-1">48</span></div>
                    <a href="#" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addModal"><i class="feather-plus-square me-1"></i> Add New</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        @endif
