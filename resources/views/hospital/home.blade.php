<?php $page = 'doctor-dashboard'; ?>
@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Dashboard')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">

        <div class="row">
            <div class="col-md-12">
                <div class="card dash-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('doctor.index') }}" class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="100">
                                            <img src="{{ URL::asset('/assets/img/icon-01.png') }}" class="img-fluid"
                                                alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Doctors</h6>
                                        <h3>{{ count(\App\Models\User::query()->where('hospital_id', \Illuminate\Support\Facades\Auth::user()->hospital_id)->where('user_type', 'D')->get()) }}
                                        </h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('patient.index') }}" class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="100">
                                            <img src="{{ URL::asset('/assets/img/icon-02.png') }}" class="img-fluid"
                                                alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Patient</h6>
                                        <h3>{{ count($totalpatients) }}
                                        </h3>
                                        <!-- <p class="text-muted">{{ now()->format('Y-m-d') }}</p> -->
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('appointments') }}">
                                    <div class="dash-widget dct-border-rht">
                                        <div class="circle-bar circle-bar3">
                                            <div class="circle-graph3" data-percent="50">
                                                <img src="{{ URL::asset('/assets/img/icon-03.png') }}" class="img-fluid"
                                                    alt="Patient">
                                            </div>
                                        </div>
                                        <div class="dash-widget-info">
                                            <h6>Today Appoinments</h6>
                                            <h3>{{ count($today_appointments) }}</h3>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('appointments') }}">
                                    <div class="dash-widget">
                                        <div class="circle-bar circle-bar3">
                                            <div class="circle-graph3" data-percent="50">
                                                <img src="{{ URL::asset('/assets/img/icon-03.png') }}" class="img-fluid"
                                                    alt="Patient">
                                            </div>
                                        </div>
                                        <div class="dash-widget-info">
                                            <h6>Total Appoinments</h6>
                                            <h3>{{ $total_appointments }}</h3>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
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
                                    <h5 class="card-title">Revenue </h5>
                                </div>
                                <div class="col-auto d-flex">

                                    <select class="select change_year" name="year">
                                        @forelse(@$distinctYears as $year)
                                            <option value="{{ $year }}"
                                                {{ request()->year == $year ? 'selected' : '' }}>{{ $year }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <!-- <div class="ms-2">
                                            <select class="select change_year" name="hospital">

                                            </select>
                                        </div> -->
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
                                <h5 class="card-title">Income Report</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <form action="{{ url('/home') }}" method="get" id="month_chart">
                                    <select class="select" name="month" id="month_change">
                                        @forelse(@array_reverse($months ?? []) as $month)
                                            <option value={{ $month }}
                                                {{ request()->month == $month ? 'selected' : '' }}>{{ $month }}
                                            </option>
                                        @empty
                                            <option>No data</option>
                                        @endforelse
                                        <!-- <option>Weekly</option> -->
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-end w-100">
                            <div class="income-rev">Total Revenue : <span>SAR {{ @$totalRevanue }} </span></div>
                        </div>
                        <div id="income-report"></div>
                    </div>
                </div>
            </div>
            <!-- /Income Report -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Patient Appoinment</h4>
                <div class="appointment-tab">

                    <!-- Appointment Tab -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('#upcoming-appointments') }}"
                                data-bs-toggle="tab">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('#today-appointments') }}" data-bs-toggle="tab">Today</a>
                        </li>
                    </ul>
                    <!-- /Appointment Tab -->

                    <div class="tab-content">

                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable1"
                                            class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Insurance</th>
                                                    <th>Appt Date</th>
                                                    <!-- <th>Purpose</th> -->
                                                    <th>Paid Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($appointments as $appointment)
                                                    @php
                                                        $patient = \App\Models\User::query()
                                                            ->where('id', $appointment->patient_id)
                                                            ->first();
                                                        $doctor = \App\Models\User::query()
                                                            ->where('id', $appointment->doctor_id)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $appointment->id }}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($doctor)
                                                                    <a href="{{ route('profile.show', ['profile' => $doctor->id]) }}"
                                                                        class="avatar avatar-sm me-2">
                                                                        @if (@$doctor->profile_image)
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ asset($doctor->profile_image) }}"
                                                                                alt="Patient Image">
                                                                        @else
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                                alt="Patient Image">
                                                                        @endif
                                                                    </a>
                                                                    <a
                                                                        href="{{ route('profile.show', ['profile' => $doctor->id]) }}">{{ @$doctor->name }}</a>
                                                                @else
                                                                    <span>Deleted Doctor</span>
                                                                @endif
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($patient)
                                                                    <a href="{{ route('profile.show', ['profile' => $patient->id]) }}"
                                                                        class="avatar avatar-sm me-2">
                                                                        @if ($patient->profile_image)
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ asset($patient->profile_image) }}"
                                                                                alt="Patient Image">
                                                                        @else
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                                alt="Patient Image">
                                                                        @endif
                                                                    </a>

                                                                    <a
                                                                        href="{{ route('profile.show', ['profile' => $patient->id]) }}">{{ $patient->name }}</a>
                                                                @else
                                                                    {{-- deleted patient --}}
                                                                    <span>Deleted Patient</span>
                                                                @endif
                                                            </h2>
                                                        </td>
                                                        <td> {{ $appointment->insurance?->name ?? 'N/A' }}</td>
                                                        <td>{{ date('d M Y', strtotime($appointment->appointment_date)) }}
                                                            <span
                                                                class="d-block text-info">{{ date('H:i A', strtotime($appointment->appointment_time)) }}</span>
                                                        </td>
                                                        <!-- <td>New Patient</td> -->
                                                        <td class="text-center">
                                                            {{ @$appointment->fee ? 'SAR ' . @$appointment->fee : 'FREE' }}
                                                        </td>
                                                        @if ($appointment->status == 'P')
                                                            <td><span
                                                                    class="badge rounded-pill bg-warning-light">Pending</span>
                                                            </td>
                                                        @elseif($appointment->status == 'C')
                                                            <td><span
                                                                    class="badge rounded-pill bg-success-light">Confirm</span>
                                                            </td>
                                                        @elseif($appointment->status == 'D')
                                                            <td><span
                                                                    class="badge rounded-pill bg-danger-light">Cancelled</span>
                                                            </td>
                                                        @else
                                                            <td><span
                                                                    class="badge rounded-pill bg-danger-light">N/A</span>
                                                            </td>
                                                        @endif
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <div class="d-flex justify-content-end gap-3">
                                                                    @if ($appointment->status == 'P')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @elseif($appointment->status == 'D')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Confirmed
                                                                        </a>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <!-- <tr class="bg-danger-light">
                                                                    <td class="text-center" colspan="6">No appointment available
                                                                    </td>
                                                                </tr> -->
                                                @endforelse
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->

                        <!-- Today Appointment Tab -->
                        <div class="tab-pane" id="today-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Doctor Name</th>
                                                    <th>Patient Name</th>
                                                    <th>Insurance</th>
                                                    <th>Appt Date</th>
                                                    <th>Type</th>
                                                    <th>Paid Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($today_appointments as $today_appointment)
                                                    @php
                                                        $patient = \App\Models\User::query()
                                                            ->where('id', $today_appointment->patient_id)
                                                            ->first();
                                                        $doctor = \App\Models\User::query()
                                                            ->where('id', $today_appointment->doctor_id)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $today_appointment->id }}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($doctor)
                                                                    <a href="{{ route('profile.show', ['profile' => $doctor->id]) }}"
                                                                        class="avatar avatar-sm me-2">
                                                                        @if (@$doctor->profile_image)
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ asset($doctor->profile_image) }}"
                                                                                alt="Patient Image">
                                                                        @else
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                                alt="Patient Image">
                                                                        @endif
                                                                    </a>
                                                                    <a
                                                                        href="{{ route('profile.show', ['profile' => $doctor->id]) }}">{{ @$doctor->name }}</a>
                                                                @else
                                                                    <span>Doctor Not Found</span>
                                                                @endif
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($patient)
                                                                    <a href="{{ route('profile.show', ['profile' => $patient->id]) }}"
                                                                        class="avatar avatar-sm me-2">
                                                                        @if ($patient->profile_image)
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ asset($patient->profile_image) }}"
                                                                                alt="Patient Image">
                                                                        @else
                                                                            <img class="avatar-img rounded-circle"
                                                                                src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                                alt="Patient Image">
                                                                        @endif
                                                                    </a>
                                                                    <a
                                                                        href="{{ route('profile.show', ['profile' => $patient->id]) }}">{{ $patient->name }}</a>
                                                                @else
                                                                    <span>Not Found</span>
                                                                @endif
                                                            </h2>
                                                        </td>
                                                        <td> {{ $today_appointment->insurance?->name ?? 'N/A' }}</td>
                                                        <td>{{ date('d M Y', strtotime($today_appointment->appointment_date)) }}
                                                            <span
                                                                class="d-block text-info">{{ date('H:i A', strtotime($today_appointment->appointment_time)) }}</span>
                                                        </td>
                                                        <td>New Patient</td>
                                                        <td>

                                                            {{ @$today_appointment->fee ? 'SAR ' . @$today_appointment->fee : 'FREE' }}

                                                        </td>
                                                        @if ($today_appointment->status == 'P')
                                                            <td><span
                                                                    class="badge rounded-pill bg-warning-light">Pending</span>
                                                            </td>
                                                        @elseif($today_appointment->status == 'C')
                                                            <td><span
                                                                    class="badge rounded-pill bg-success-light">Confirm</span>
                                                            </td>
                                                        @elseif($today_appointment->status == 'D')
                                                            <td><span
                                                                    class="badge rounded-pill bg-danger-light">Cancelled</span>
                                                            </td>
                                                        @else
                                                            <td><span
                                                                    class="badge rounded-pill bg-danger-light">N/A</span>
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <div class="table-action">
                                                                <div class="d-flex justify-content-end gap-3">
                                                                    @if ($today_appointment->status == 'P')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @elseif($today_appointment->status == 'D')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Confirmed
                                                                        </a>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <!-- <tr class="bg-danger-light">
                                                                        <td class="text-center" colspan="6">No Appointments found</td>
                                                                    </tr> -->
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Today Appointment Tab -->

                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                                return "SAR " + val
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
                                return "SAR " + val
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
                            return "SAR " + val
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
