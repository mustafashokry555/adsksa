@extends('layout.mainlayout_admin')
@section('title', 'Income Reports')
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
                                        <h5 class="card-title">{{ __('admin.income_report.income_report')  }}</h5>
                                    </div>
                                    <div class="col-auto d-flex">
                                <form action="{{ url('/income-reports') }}" method="get" id="month_chart">
                                    <select class="select" name="month" id="month_change">
                                        @forelse(@array_reverse($months ?? []) as $month)
                                        <option value={{ $month }} {{ request()->month == $month ? 'selected' : '' }}>{{ $month }}
                                        </option>
                                        @empty
                                        <option>{{ __('admin.income_report.no_data')  }}</option>
                                        @endforelse
                                        <!-- <option>Weekly</option> -->
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
                                <div class="w-100">
                                    <div class="income-rev">{{ __('admin.income_report.total_revenue')  }} : <span>{{ __('admin.income_report.SAR')  }} {{$totalIncome}}</span></div>
                                </div>
                                <div id="sales_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Appointments Report -->

                <!-- Upcoming Appointments -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="app-listing">
                            <div class="custom-list">
                                <!-- <div class="SortBy">
                                    <div class="selectBoxes order-by">
                                        <p class="mb-0"><img src="{{ URL::asset('/assets_admin/img/icon/sort.png')}}" class="me-2" alt="icon"> Order by </p>
                                        <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBox">
                                        <form action="income-report">
                                            <p class="lab-title">Order By </p>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> ID
                                            </label>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> Amount
                                            </label>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> Date
                                            </label>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> Number of Appointments
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
                                </div> -->
                            </div>
                            <!-- <div class="import-list">
                                <a href="#"><i class="feather-download"></i> Export</a>
                            </div> -->
                        </div>

                        <div class="card">
                        <div class="card-header border-bottom-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title">{{ __('admin.income_report.income_list')  }}</h5>
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
                                            <th>{{ __('admin.income_report.doctor')  }}</th>
                                            <th>{{ __('admin.income_report.hospital')  }}</th>
                                            <th>{{ __('admin.income_report.specialities')  }}</th>
                                            <th>{{ __('admin.income_report.member_since')  }}</th>
                                            <th>{{ __('admin.income_report.number_of_appointments')  }}</th>
                                            <th>{{ __('admin.income_report.total_income')  }}</th>
{{--                                            <th>Account Status</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($doctors as $doctor)
                                            @php
                                            $appointments = \App\Models\Appointment::query()->where('doctor_id', $doctor->id)->get();
                                            $total_appointments = count($appointments);
                                            @endphp
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    @if($doctor?->profile_image ?? '')
                                                    <a class="avatar-pos" href="#"><img class="avatar avatar-img" src="{{ asset($doctor->profile_image) }}" alt="User Image"></a>
                                                    @else
                                                    <a class="avatar-pos" href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_admin/img/profiles/avatar-05.jpg')}}" alt="User Image"></a>
                                                    @endif
                                                    <a href="{{url('admin/profile')}}" class="user-name">{{ __('admin.income_report.dr')  }}. {{ $doctor?->name??"" }}</a>
                                                </h2>
                                            </td>
                                            @php
                                            $hospital = \App\Models\Hospital::query()?->where('id',$doctor->hospital_id)?->first();
                                            @endphp
                                            <td>{{$hospital->hospital_name}}</td>
                                            <td>{{ $doctor?->speciality?->name??"" }}</td>
                                            <td><span class="user-name">{{ $doctor?->created_at?->format('d M Y')??"" }} </span></td>
                                            <td>{{ $total_appointments }}</td>

                                            <td> {{ __('admin.income_report.SAR')  }} {{ \App\Models\Appointment::query()->where('doctor_id', $doctor->id)->sum('fee')??0 }}</td>

{{--                                            <td>--}}
{{--                                                <label class="toggle-switch" for="status1">--}}
{{--                                                    <input type="checkbox" class="toggle-switch-input" id="status1">--}}
{{--                                                    <span class="toggle-switch-label">--}}
{{--																<span class="toggle-switch-indicator"></span>--}}
{{--															</span>--}}
{{--                                                </label>--}}
{{--                                            </td>--}}
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

                <div id="tablepagination"  class="dataTables_wrapper"></div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

    // Pop up module
    {{--    <!-- Add Event Modal -->--}}
    {{--    <div class="modal custom-modal fade none-border" id="delete_review">--}}
    {{--        <div class="modal-dialog modal-dialog-centered">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h4 class="modal-title">Delete {{ $review->review_title }}</h4>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body"></div>--}}
    {{--                <div class="modal-footer justify-content-center">--}}
    {{--                    <button type="button" class="btn btn-danger delete-event submit-btn" data-bs-dismiss="modal">Delete</button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
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
                                return val + " SAR"
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
                                return val + " SAR"
                            }
                        }
                    }
                };
            var columnChart = new ApexCharts(columnCtx, columnConfig);
            columnChart.render();
        }
    })
</script>
