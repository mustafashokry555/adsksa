@extends('layout.mainlayout_admin')
@section('title', 'Appointment Reports')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        @if(session()->has('flash'))
        <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif

        <!-- Appointments Report -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">{{ __('admin.appointment_report.appointment_report')  }}</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <form action="{{ url('/appointment-reports') }}" method="get" id="month_chart">
                                    <select class="select" name="month" id="month_change">
                                        @forelse(@array_reverse($months ?? []) as $month)
                                        <option value={{ $month }} {{ request()->month == $month ? 'selected' : '' }}>{{ $month }}
                                        </option>
                                        @empty
                                        <option>{{ __('admin.appointment_report.no_data')  }}</option>
                                        @endforelse
                                        <!-- <option>Weekly</option> -->مكالمة فيديو
                                    </select>
                                </form>
                            </div>
                            <!-- <div class="col-auto">
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
                                </div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sales_chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Appointments Report -->

        <!-- Upcoming Appointments -->
        <div class="row">
            <div class="col-sm-12">
                <!-- <div class="app-listing">
                    <div class="import-list">
                        <a href="#"><i class="feather-download"></i> Export</a>
                    </div>
                </div> -->

                <div class="card">
                <div class="card-header border-bottom-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title">{{ __('admin.appointment_report.appointment_list')  }}</h5>
                                    </div>
                                    <div class="col-auto d-flex">
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
                                        <th>{{ __('admin.appointment_report.patient')  }}</th>
                                        <th>{{ __('admin.appointment_report.doctor')  }}</th>
                                        <th>{{ __('admin.appointment_report.hospital')  }}</th>
                                        <!-- <th>Disease</th> -->
                                        <th>{{ __('admin.appointment_report.consultation_type')  }}</th>
                                        <th>{{ __('admin.appointment_report.date_and_time')  }}</th>
                                        <th>{{ __('admin.appointment_report.amount')  }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($appointments as $appointment)
                                    @php
                                    $patient = \App\Models\User::query()->where('id', @$appointment?->patient_id)->first();
                                    $doctor = \App\Models\User::query()->where('id', @$appointment?->doctor_id)->first();
                                    $hospital = \App\Models\Hospital::query()?->where('id',@$doctor?->hospital_id)?->first();
                                    @endphp
                                    <tr>

                                        <td>
                                            <h2 class="table-avatar">
                                                @if($patient?->profile_image)
                                                <a href="#"><img class="avatar avatar-img" src="{{ asset( $patient->profile_image) }}" alt="User Image"></a>
                                                @else
                                                <a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_admin/img/profiles/avatar-07.jpg')}}" alt="User Image"></a>
                                                @endif
                                                <a href="#"><span class="user-name">{{ $patient?->name }}s</span> <span class="text-muted">Male, {{ $patient?->age }} Years Old</span></a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                @if($doctor?->profile_image ?? '')
                                                <a class="avatar-pos" href="#"><img class="avatar avatar-img" src="{{ asset( $doctor?->profile_image) }}" alt="User Image"></a>
                                                @else
                                                <a class="avatar-pos" href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_admin/img/profiles/avatar-05.jpg')}}" alt="User Image"></a>
                                                @endif
                                                <a href="{{url('admin/profile')}}" class="user-name"><span class="text-muted">{{ __('admin.appointment_report.dr')  }}. {{ $doctor?->name }}</span> <span class="tab-subtext">{{ @$doctor?->speciality?->name }}</span></a>
                                            </h2>
                                        </td>
                                        <td><span class="">{{$hospital?->hospital_name}}</span></td>
                                        <!-- <td><span class="disease-name">Allergies & Asthma</span></td> -->
                                        <td class="status">
                                            <span>{{ __('admin.appointment_report.scheduled_appointment')  }}</span>
                                            <a href="#" class="d-block text-primary mt-2">
                                                <span class="d-flex align-items-center"><i class="feather-video me-2"></i>{{ __('admin.appointment_report.video_call')  }}</span>
                                            </a>
                                        </td>
                                        <td><span class="user-name">{{ date('d M Y', strtotime(@$appointment->appointment_date)) }} </span><span class="d-block">{{ date('H:i A', strtotime(@$appointment->appointment_time)) }}</span></td>
                                        @if($appointment->fee == 0)
                                        <td>{{ __('admin.appointment_report.free')  }}</td>
                                        @else
                                        <td>{{ __('admin.appointment_report.SAR')  }} {{ $appointment?->fee }}</td>
                                        @endif
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

// Pop up module
{{-- <!-- Add Event Modal -->--}}
{{-- <div class="modal custom-modal fade none-border" id="delete_review">--}}
{{-- <div class="modal-dialog modal-dialog-centered">--}}
{{-- <div class="modal-content">--}}
{{-- <div class="modal-header">--}}
{{-- <h4 class="modal-title">Delete {{ $review->review_title }}</h4>--}}
{{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>--}}
{{-- </div>--}}
{{-- <div class="modal-body"></div>--}}
{{-- <div class="modal-footer justify-content-center">--}}
{{-- <button type="button" class="btn btn-danger delete-event submit-btn" data-bs-dismiss="modal">Delete</button>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
<!-- /Add Event Modal -->

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#month_change').change(function() {
            $('#month_chart').submit();
        })
        if ($('#sales_chart').length > 0) {

            var columnCtx = document.getElementById("sales_chart"),
                columnConfig = {
                    colors: ['#0CE0FF', '#1B5A90', '#DFE5FC'],
                    series: [{
                            name: "Revenue",
                            type: "column",
                            data: <?php echo json_encode(array_values($monthlyReport)); ?>,
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
                        categories: <?php echo json_encode(array_keys($monthlyReport)); ?>,
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val + "Appointments"
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
                                return val + " Appointments"
                            }
                        }
                    }
                };
            var columnChart = new ApexCharts(columnCtx, columnConfig);
            columnChart.render();
        }
    })
</script>
