@extends('layout.mainlayout_admin')
@section('title', 'Dashboard')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid pb-0">

        <h4 class="mb-3">{{ __('admin.dashboard.overview')  }}</h4>

        <div class="row">
            <div class="col-xl-2 col-sm-6 col-12">
                <div class="card">
                    <a href="{{ route('hospital.index') }}" class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="feather-user-plus"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">{{ __('admin.dashboard.hospitals')  }}</h5>
                                <div class="dash-counts">
                                    <p>{{ count($hospitals) }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="trade-level mb-0"><span class="text-danger me-1"><i class="fas fa-caret-down me-1"></i>1.15%</span> last week</p> --}}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-12">
                <div class="card">
                    <a href="{{ route('speciality.index') }}" class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="feather-user-plus"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">{{ __('admin.dashboard.specialities')  }}</h5>
                                <div class="dash-counts">
                                    <p>{{ count($specialities) }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="trade-level mb-0"><span class="text-danger me-1"><i class="fas fa-caret-down me-1"></i>1.15%</span> last week</p> --}}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-12">
                <div class="card">
                    <a href="{{ route('doctor.index') }}" class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="feather-user-plus"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">{{ __('admin.dashboard.doctors')  }}</h5>
                                <div class="dash-counts">
                                    <p>{{ count($doctors) }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="trade-level mb-0"><span class="text-danger me-1"><i class="fas fa-caret-down me-1"></i>1.15%</span> last week</p> --}}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-12">
                <div class="card">
                    <a href="{{ route('patient.index') }}" class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-blue">
                                <i class="feather-users"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">{{ __('admin.dashboard.patients')  }}</h5>
                                <div class="dash-counts">
                                    <p>{{ count($patients) }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="trade-level mb-0"><span class="text-success me-1"><i class="fas fa-caret-up me-1"></i>4.5%</span> last week</p> --}}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-12">
                <div class="card">
                    <a href="{{ route('appointments') }}" class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-warning">
                                <img src="{{ URL::asset('/assets_admin/img/icon/calendar.png') }}" alt="User Image">
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">{{ __('admin.dashboard.appointment')  }}</h5>
                                <div class="dash-counts">
                                    <p>{{ count($appointments) }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="trade-level mb-0"><span class="text-success me-1"><i class="fas fa-caret-up me-1"></i>9.65%</span> last week</p> --}}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-danger">
                                <img src="{{ URL::asset('/assets_admin/img/icon/chart.png') }}" alt="User Image">
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">{{ __('admin.dashboard.revenue')  }}</h5>
                                <div class="dash-counts">
                                    <p>{{ __('admin.dashboard.specialities')  }}{{ $totalIncome }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="trade-level mb-0"><span class="text-danger me-1"><i class="fas fa-caret-up me-1"></i>40.5%</span> last week</p> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Appointments -->
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <form action="{{ url('/home') }}" method="get" id="chart1_form">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.dashboard.revenue')  }} </h5>
                                </div>
                                <div class="col-auto d-flex">

                                    <select class="select change_year" name="year">
                                        @forelse($distinctYears as $year)
                                        <option value="{{ $year }}" {{ request()->year == $year ? 'selected' : '' }}>{{ $year }}
                                        </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <div class="ms-2">
                                        <select class="select change_year" name="hospital">
                                            <option value="">All Hospital</option>
                                            @forelse($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}" {{ request()->hospital == $hospital->id ? 'selected' : '' }}>
                                                {{ $hospital->hospital_name }}
                                            </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div id="sales_chart"></div>
                    </div>
                </div>
            </div>
            <!-- /Appointments -->

            <!-- Income Report -->
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">{{ __('admin.dashboard.income_report')  }}</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <form action="{{ url('/home') }}" method="get" id="month_chart">
                                    <select class="select" name="month" id="month_change">
                                        @forelse(@array_reverse($months ?? []) as $month)
                                        <option value={{ $month }} {{ request()->month == $month ? 'selected' : '' }}>{{ $month }}
                                        </option>
                                        @empty
                                        <option>{{ __('admin.dashboard.no_data')  }}</option>
                                        @endforelse
                                        <!-- <option>Weekly</option> -->
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-end w-100">
                            <div class="income-rev">{{ __('admin.dashboard.total_revenue')  }} : <span>{{ __('admin.dashboard.SAR')  }} {{ $totalRevanue }} </span></div>
                        </div>
                        <div id="income-report"></div>
                    </div>
                </div>
            </div>
            <!-- /Income Report -->
        </div>

        <!-- Today’s  Appointment -->
        <div class="row">
            <div class="col-md-6">
                <div class="section-heading">
                    <h5 class="mb-0">{{__('admin.dashboard.todays_appointment')  }} <span class="num-circle">{{ count($today_appointments) }}</span>
                    </h5>
                </div>
            </div>

            <div class="col-md-6 text-end">
                <div class="owl-nav slide-nav-3 text-end nav-control"></div>
            </div>

            <div class="col-md-12">
                <hr class="mt-0">
                <div class="owl-carousel appointment-slider owl-theme">
                @foreach ($today_appointments as $appointment)
                    <div class="item">
                        <div class="appointment-item">
                            <div class="app-head">
                                {{-- <p>Consultation ID : #4544478 </p> --}}
                                <!-- <div class="con-time">50 Min</div> -->
                            </div>
                            <div class="app-user">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="app-img">
                                            <img src="{{ $appointment->doctor->profile_image }}" alt="" class="img-fluid">
                                            <div class="app-name">
<<<<<<< Updated upstream
                                                <h6>{{ $appointment?->doctor?->name ?? '' }}</h6>
=======
                                                <h6>{{ __('admin.dashboard.dr')  }}. {{ $appointment?->doctor?->name ?? '' }}</h6>
>>>>>>> Stashed changes
                                                {{-- <p>{{@$speciality?->name?? ''}}</p> --}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="app-img justify-content-sm-end">
                                            <img src="{{ $appointment->patient->profile_image }}" alt="" class="img-fluid">

                                            <div class="app-name">
                                                <h6>{{ $appointment?->patient->name ?? '' }}</h6>
                                                <p>{{ $appointment?->patient->gender ?? '' }}</p>
                                                {{-- <p>ID : 781212</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="app-info">
                                <div>
                                    <p>{{ __('admin.dashboard.today')  }}</p>

                                    <h6>{{ date('H:i A', strtotime($appointment->appointment_time)) }}</h6>
                                </div>
                                <div>
                                    <p>{{ __('admin.dashboard.booked_on_') }}</p>
                                    <h6 class="fw-normal">{{ $appointment?->appointment_date }}</h6>
                                </div>
                            </div>
                            <div class="app-footer">
                                <div class="app-mode">
                                    <!-- <p>Mode of Consultation</p>
                                    <a href="#" class="mode-box text-danger"><i class="feather-video"></i></a> -->
                                </div>
                                <h6>{{ $appointment->fee != 0 ? __('admin.dashboard.SAR') . $appointment->fee : __('admin.dashboard.free') }}</h6>

                            </div>
                        </div>
                    </div>
                    @endforeach
@if (count($today_appointments) == 0)
<!-- <p>No Appointments Found For Today</p> -->
@endif









</div>
</div>

</div>
<!-- /Today’s  Appointment -->

<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header border-bottom-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title">{{ __('admin.dashboard.recent_patient') }}</h5>
                    </div>
                    <div class="col-auto d-flex">
                        {{-- <div class="bookingrange btn btn-white btn-sm">
                                        <div class="cal-ico">
                                            <span>Select Date</span>
                                            <i class="feather-chevron-down ms-1"></i>
                                        </div>
                                    </div> --}}
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-borderless hover-table">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('admin.dashboard.id') }}</th>
                                <th>{{ __('admin.dashboard.patient') }}</th>
                                {{-- <th>Disease</th> --}}
                                <th>{{ __('admin.dashboard.member_since') }}</th>
                                <th>{{ __('admin.dashboard.contact') }}</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recent_patients as $rec_pat)
                            <tr>
                                <td>#{{ $rec_pat?->id }}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="{{ url('admin/profile') }}"><img class="avatar avatar-img" src="{{ $rec_pat->profile_image }}" alt="User Image"></a>
                                        <a href="#" class="user-name">{{ $rec_pat?->name ?? '' }}
                                            <span class="text-muted">{{ $rec_pat?->gender ?? '' }}

                                                {{ $rec_pat?->age ? ', ' . $rec_pat?->age . ' Years Old' : '' }}
                                            </span></a>
                                    </h2>
                                </td>
                                {{-- <td><span class="disease-name">Allergies & Asthma</span></td> --}}
                                <td>
                                    {{-- <span class="text-yellow user-name">New Patient</span> --}}
                                    <span class="d-block">{{ $rec_pat?->created_at?->toDateString() }}</span>
                                </td>
                                <td>{{$rec_pat->mobile??'N/A'}}</td>
                                <!-- @if ($rec_pat?->patient?->status === 'Active')
                                <td><span class="badge bg-badge-grey text-success"><i class="fas fa-circle me-1"></i>
                                        Enabled</span>
                                </td>
                                @else
                                <td><span class="badge bg-badge-grey text-danger"><i class="fas fa-circle me-1"></i>
                                        Disabled</span>
                                </td>
                                @endif -->
                                {{-- <td class="text-right">
                                                            <i class="feather-chevron-right"></i>
                                                        </td> --}}
                            </tr>
                            @empty
                            <h6>{{ __('admin.dashboard.no_data') }}</h6>
                            @endforelse
                            {{-- <tr>
                                            <td>#8774</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{ url('admin/profile') }}"><img class="avatar avatar-img" src="{{ URL::asset('/assets_admin/img/profiles/avatar-04.jpg') }}" alt="User Image"></a>
                            <a href="#" class="user-name">Bess Twishes <span class="text-muted">Female,30 Years Old</span></a>
                            </h2>
                            </td>
                            <td><span class="disease-name">Sleep Problem</span></td>
                            <td>
                                <span class="text-danger user-name">Old Patient</span>
                                <span class="d-block">23 Nov 2020</span>
                            </td>
                            <td><span class="badge bg-badge-grey text-danger"><i class="fas fa-circle me-1"></i> Disabled</span></td>
                            <td class="text-right">
                                <i class="feather-chevron-right"></i>
                            </td>
                            </tr> --}}
                            {{-- <tr>
                                            <td>#4546</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{ url('admin/profile') }}"><img class="avatar avatar-img" src="{{ URL::asset('/assets_admin/img/profiles/avatar-02.jpg') }}" alt="User Image"></a>
                            <a href="#" class="user-name">Abdul Aziz Lazis <span class="text-muted">Male, 25 Years Old</span></a>
                            </h2>
                            </td>
                            <td><span class="disease-name">Tooth Pain</span></td>
                            <td>
                                <span class="text-danger user-name">Old Patient</span>
                                <span class="d-block">23 Nov 2020</span>
                            </td>
                            <td><span class="badge bg-badge-grey text-success"><i class="fas fa-circle me-1"></i> Enabled</span></td>
                            <td class="text-right">
                                <i class="feather-chevron-right"></i>
                            </td>
                            </tr> --}}
                            {{-- <tr>
                                            <td>#4546</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{ url('admin/profile') }}"><img class="avatar avatar-img" src="{{ URL::asset('/assets_admin/img/profiles/avatar-05.jpg') }}" alt="User Image"></a>
                            <a href="#" class="user-name">Alex Siauw <span class="text-muted">Male, 29 Years Old</span></a>
                            </h2>
                            </td>
                            <td><span class="disease-name">Pain on knee</span></td>
                            <td>
                                <span class="text-yellow user-name">New Patient</span>
                                <span class="d-block">23 Nov 2020</span>
                            </td>
                            <td><span class="badge bg-badge-grey text-success"><i class="fas fa-circle me-1"></i> Enabled</span></td>
                            <td class="text-right">
                                <i class="feather-chevron-right"></i>
                            </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Recent Activities -->

    <!-- Top Doctors -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">{{ __('admin.dashboard.top_doctors') }}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table doc-table">
                        <tbody>

                            @forelse($top_doctors as $doctor)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar-pos avatar-online" href="#"><img class="avatar avatar-img" src="{{ $doctor->profile_image }}" alt="User Image"></a>
                                        <a href="#" class="user-name"><span class="text-muted">{{ __('admin.dashboard.dr')  }}.
                                                {{ $doctor->name }}</span>
                                            <span class="tab-subtext">
                                                @forelse($doctor?->specializations as $item)
                                                {{ $item->specialization_title }},
                                                @empty
                                                @endforelse
                                            </span></a>
                                    </h2>
                                </td>
                                <!-- <td><span class="table-rating"><i class="fas fa-star me-2"></i> 4.5</span> -->
                                </td>
                                <!-- <td class="text-right"><span class="text-muted">200 Patients</span></td> -->
                            </tr>
                            @empty
                            <td>{{ __('admin.dashboard.no_data')  }}</td>

                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Top Doctors -->
</div>

<div class="row">
    <!-- Popular by Speciality -->
    <div class="col-xl-6 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title">{{ __('admin.dashboard.popular_by_speciality')  }}</h5>
                    </div>
                    {{-- <div class="col-auto">
                                    <select class="select">
                                        <option>This Week</option>
                                        <option>This Month</option>
                                    </select>
                                </div> --}}
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            @forelse ($popular_by_specialities as $popular_rec)
                            <tr class="speciality-item">
                                <td class="spl-name">
                                    <div class="spl-box rounded">
                                        <img src="{{ $popular_rec->image }}" alt="User Image">
                                    </div>
                                    <div class="spl-count">
                                        <h6>{{ $popular_rec?->name ?? '' }}</h6>
                                        @php
                                           $doctors = \App\Models\User::where('speciality_id',$popular_rec->id)->count();
                                        @endphp
                                        <p>{{ __('admin.dashboard.doctors')  }} : {{$doctors}} </p>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <h6>{{ __('admin.dashboard.no_data')  }}</h6>
                            @endforelse
                            {{-- <td class="con-revenue">
                                                <p class="text-muted">Revenue</p>
                                                <h6>$6000K</h6>
                                            </td> --}}
                            {{-- <td class="spl-consult">
                                            <p class="text-muted">Consultations</p>
                                            <h6>200</h6>
                                        </td> --}}
                            {{-- <tr class="speciality-item">
                                            <td class="spl-name">
                                                <div class="spl-box">
                                                    <img src="{{ URL::asset('/assets_admin/img/icon/neurology.png') }}"
                            alt="User Image">
                </div>
                <div class="spl-count">
                    <h6>Neurology</h6>
                    <p>Patients : 980 </p>
                </div>
                </td>
                <td class="con-revenue">
                    <p class="text-muted">Revenue</p>
                    <h6>$6000K</h6>
                </td>
                <td class="spl-consult">
                    <p class="text-muted">Consultations</p>
                    <h6>98</h6>
                </td>
                </tr> --}}
                {{-- <tr class="speciality-item">
                                            <td class="spl-name">
                                                <div class="spl-box">
                                                    <img src="{{ URL::asset('/assets_admin/img/icon/ortho.png') }}"
                alt="User Image">
            </div>
            <div class="spl-count">
                <h6>Orthopedic</h6>
                <p>Patients : 600</p>
            </div>
            </td>
            <td class="con-revenue">
                <p class="text-muted">Revenue</p>
                <h6>$6000K</h6>
            </td>
            <td class="spl-consult">
                <p class="text-muted">Consultations</p>
                <h6>78</h6>
            </td>
            </tr> --}}
            {{-- <tr class="speciality-item">
                                            <td class="spl-name">
                                                <div class="spl-box">
                                                    <img src="{{ URL::asset('/assets_admin/img/icon/cardio.png') }}"
            alt="User Image">
        </div>
        <div class="spl-count">
            <h6>Urology</h6>
            <p>Patients : 400</p>
        </div>
        </td>
        <td class="con-revenue">
            <p class="text-muted">Revenue</p>
            <h6>$6000K</h6>
        </td>
        <td class="spl-consult">
            <p class="text-muted">Consultations</p>
            <h6>65</h6>
        </td>
        </tr> --}}
        {{-- <tr class="speciality-item">
                                            <td class="spl-name">
                                                <div class="spl-box">
                                                    <img src="{{ URL::asset('/assets_admin/img/icon/dental.png') }}"
        alt="User Image">
    </div>
    <div class="spl-count">
        <h6>Urology</h6>
        <p>Patients : 400</p>
    </div>
    </td>
    <td class="con-revenue">
        <p class="text-muted">Revenue</p>
        <h6>$6000K</h6>
    </td>
    <td class="spl-consult">
        <p class="text-muted">Consultations</p>
        <h6>59</h6>
    </td>
    </tr> --}}
    </tbody>
    </table>
</div>
</div>
</div>
</div>
<!-- /Popular by Speciality -->

<!-- Consultaion Today -->
<!-- <div class="col-xl-4 col-md-6">
                            <div class="row">
                                <div class="col-md-6 pe-md-0">
                                    <div class="card cons-card mb-3">
                                        <h6>Consultaion Today</h6>
                                        <div id="income-month"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card pat-card mb-1">
                                        <div class="card-body">
                                            <p>New Patients</p>
                                            <h3>45</h3>
                                            <p class="trade-level mb-0"><span class="text-danger me-1"><i
                                                        class="fas fa-caret-down me-1"></i>1.15%</span> last week
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card pat-card mb-3">
                                        <div class="card-body">
                                            <p>Old Patients</p>
                                            <h3>45</h3>
                                            <p class="trade-level mb-0"><span class="text-success me-1"><i
                                                        class="fas fa-caret-up me-1"></i>9.5%</span> last week</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="card-title">Appointment Status</h5>
                                                </div>
                                                <div class="col-auto">
                                                    <select class="select">
                                                        <option>This Week</option>
                                                        <option>This Month</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div id="status_chart"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="app-status">
                                                        <p>Completed Appointment</p>
                                                        <h6 class="text-primary">650</h6>
                                                        <p>Cancelled Appointment</p>
                                                        <h6>250</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
<!-- /Consultaion Today -->

<!-- Upcoming Appointments -->
<div class="col-xl-6">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">{{ __('admin.dashboard.upcoming_appointments')  }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body up-content">
            <div class="nav nav-tabs">
                <div class="nav nav-tabs upcomimg-app">
                    <!-- <div class="pricing-carousel owl-carousel owl-theme">
                                                                                                                                                                            </div>
                                                                                                                                                                                        </div> -->
                </div>
            </div>
            <div class="tab-content upcoming-content">
                <div id="home" class="tab-pane in active">
                    @forelse($upcoming_appointments as $appt)
                    <div class="appointment-items">
                        <div class="app-user">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="app-img">
                                        <img src="{{ $appt->doctor->profile_image }}" alt="" class="img-fluid">
                                        <div class="app-name">
<<<<<<< Updated upstream
                                            <h6> {{ $appt?->doctor?->name ?? '' }} </h6>
=======
                                            <h6>{{ __('admin.dashboard.dr')  }}. {{ $appt?->doctor?->name ?? '' }} </h6>
>>>>>>> Stashed changes
                                            <!-- <p>Orthopaedics</p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="app-img">
                                        <img src="{{ $appt->patient->profile_image }}" alt="" class="img-fluid">
                                        <div class="app-name">
                                            <h6>{{ $appt?->patient?->name ?? '' }}</h6>
                                            <!-- <p>ID : 781212, M</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-time">
                            <p><i class="feather-clock me-1"></i>

                                <!-- {{ $appt?->appointment_time ?? '' }} / -->
                                {{ date('H:i A', strtotime($appt->appointment_time)) }}/
                                {{ date('d M Y', strtotime($appt->appointment_date)) }}
                                <!-- {{ $appt?->appointment_date ?? '' }} -->
                            </p>
                        </div>
                        <div class="app-infos">
                            <div class="row align-items-center">
                                <!-- <div class="col-4 col-sm-4">
                                    <p>Duration</p>
                                    <p class="mb-0">20 Min</p>
                                </div> -->
                                <div class="col-8 col-sm-4">
                                    <p>Consultation Fee</p>
                                    <h6> {{ $appt?->fee==0?'FREE':  'SAR '.$appt?->fee }}</h6>
                                </div>
                                <div class="col-sm-4">
                                    <div class="float-sm-end">
                                        <!-- <div class="mode-app text-yellow">
                                            <i class="feather-video"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    {{ __('admin.dashboard.no_data')  }}
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    <!-- /Upcoming Appointments -->
</div>

<div class="row">

    <!-- Recent Prescriptions -->
    <!-- <div class="col-xl-4 col-md-6">
                                                                             </div>
                                                                                                   </div> -->
    <!-- /Top Countries -->

    <!-- Doctor Ratings -->
    <!-- <div class="col-xl-4">
                                                                                                                                                                        <div class="row">
                                                                                                                          </div>
                                                                                                                                                                    </div> -->
    <!-- /Doctor Ratings -->
</div>

</div>
</div>
<!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.change_year').change(function() {

            $('#chart1_form').submit();
        })

        $('#month_change').change(function() {
            $('#month_chart').submit();
        })

        function generateData(baseval, count, yrange) {
            var i = 0;
            var series = [];
            while (i < count) {
                var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

                series.push([x, y, z]);
                baseval += 86400000;
                i++;
            }
            return series;
        }


        // Column chart
        if ($('#sales_chart').length > 0) {
            var columnCtx = document.getElementById("sales_chart"),
                columnConfig = {
                    colors: ['#0CE0FF', '#1B5A90', '#DFE5FC'],
                    series: [{
                            name: "Revenue",
                            type: "column",
                            data: <?php echo json_encode(array_values($yearlyReport)); ?>,
                        },
                        // {
                        // name: "Audio call",
                        // type: "column",
                        // data: [3, 3, 2, 3, 1.5, 1, 3, 2, 3, 1.5, 2, 3]
                        // },
                        // {
                        //     name: "Chat",
                        //     type: "column",
                        //     data: [4.5, 3.8, 2.5, 3, 4.5, 3, 4.5, 3, 4, 5, 1.5, 2]
                        // }
                    ],
                    chart: {
                        type: 'bar',
                        fontFamily: 'Poppins, sans-serif',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '60%',
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    grid: {
                        show: false,
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: <?php echo json_encode(array_keys($yearlyReport)); ?>,
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return "SAR "+val
                            }
                        },
                        axisBorder: {
                            show: true,
                        },
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "SAR "+val
                            }
                        }
                    }
                };
            var columnChart = new ApexCharts(columnCtx, columnConfig);
            columnChart.render();
        }

        // Column chart
        if ($('#totsales_chart').length > 0) {
            var columnCtx = document.getElementById("totsales_chart"),
                columnConfig = {
                    colors: ['#0CE0FF'],
                    series: [{
                        name: "Video Call",
                        type: "column",
                        data: [4, 2.8, 5, 2, 3.2, 1.2, 2, 3]
                    }],
                    chart: {
                        type: 'bar',
                        fontFamily: 'Poppins, sans-serif',
                        height: 360,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    grid: {
                        show: false,
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['22/11/2021', '23/11/2021', '24/11/2021', '25/11/2021', '25/11/2021',
                            '25/11/2021', '27/11/2021', '28/11/2021'
                        ],
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val + "k"
                            }
                        },
                        axisBorder: {
                            show: true,
                        },
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + "k"
                            }
                        }
                    }
                };
            var columnChart = new ApexCharts(columnCtx, columnConfig);
            columnChart.render();
        }

        // Income Report
        if ($('#income-report').length > 0) {
            var options = {
                series: [{
                        name: "Revenue",
                        data: <?php echo json_encode(array_values($monthlyReport)); ?>
                    },
                    // {
                    //     name: "Audio Call",
                    //     data: [0, 3, 3.5, 2.5, 3.5]
                    // },
                    // {
                    //     name: "Chat",
                    //     data: [0, 4, 4.5, 3.8, 4]
                    // }
                ],
                colors: ['#0CE0FF', '#1B5A90', '#DFE5FC'],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight',
                    width: 1,
                },
                markers: {
                    size: 3,
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                },
                grid: {
                    show: false,
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return  "SAR "+val
                        }
                    },
                    axisBorder: {
                        show: true,
                    },
                },
                xaxis: {
                    categories: <?php echo json_encode(array_keys($monthlyReport)); ?>,
                }
            };

            var chart = new ApexCharts(document.querySelector("#income-report"), options);
            chart.render();
        }










    });
</script>
