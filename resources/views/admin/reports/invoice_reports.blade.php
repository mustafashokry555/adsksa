@extends('layout.mainlayout_admin')
@section('title', 'Invoice Reports')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
                <!-- Total Invoice -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title">{{ __('admin.invoice_reports.invoice_reports')  }}</h5>
                                    </div>
                                    <div class="card">

                                    <div class="col-auto d-flex">
                                    <form action="{{ url('/invoice-reports') }}" method="get" id="month_chart">
                                        <select class="select" name="month" id="month_change">
                                            @forelse(@array_reverse($months ?? []) as $month)
                                            <option value={{ $month }} {{ request()->month == $month ? 'selected' : '' }}>{{ $month }}
                                            </option>
                                            @empty
                                            <option>{{ __('admin.invoice_reports.no_data')  }}</option>
                                            @endforelse
                                            <!-- <option>Weekly</option> -->
                                        </select>
                                    </form>
                            </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- <div class="income-rev float-none mb-0">Todays Total Invoice : <span>45</span></div> -->
                                <div id="sales_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Total Invoice -->

                <!-- Invoice Report -->
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
                                        <h5 class="card-title">{{ __('admin.invoice_reports.invoice_list')  }}</h5>
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
                                            <th>{{ __('admin.invoice_reports.invoice_number')  }}</th>
                                            <th>{{ __('admin.invoice_reports.patient')  }}</th>
                                            <th>{{ __('admin.invoice_reports.hospital')  }}</th>
                                            <th>{{ __('admin.invoice_reports.created_date')  }}</th>
                                            <th>{{ __('admin.invoice_reports.total_amount')  }}</th>
                                            <th>{{ __('admin.invoice_reports.status')  }}</th>
                                            <!-- <th></th> -->
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($invoices as $invoice)
                                                @php
                                                $patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
                                                @endphp
                                                <tr>
                                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#transaction"><span class="text-primary user-name">INV 000{{ $loop->index + 1 }}</span></a></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            @if($patient && $patient->profile_image)
                                                                <a href="#"><img class="avatar avatar-img" src="{{ asset($patient->profile_image) }}" alt="User Image"></a>
                                                            @else
                                                                <a href="#"><img class="avatar avatar-img" src="{{ URL::asset('/assets_admin/img/profiles/avatar-07.jpg') }}" alt="User Image"></a>
                                                            @endif
                                                            <a href="#"><span class="user-name">{{ $patient ? $patient->name : 'Unknown Patient' }}</span></a>
                                                        </h2>
                                                    </td>
                                                    @php
                                                    $hospital = \App\Models\Hospital::query()->where('id', $invoice->hospital_id)->first();
                                                    @endphp
                                                    <td>{{ $hospital ? $hospital->hospital_name : 'Unknown Hospital' }}</td>
                                                    <td><span class="user-name">{{ date('d M Y', strtotime($invoice->appointment_date)) }}</span><span class="d-block">{{ date('H:i a', strtotime($invoice->appointment_time)) }}</span></td>
                                                    <td>{{ $invoice->fee ? __('admin.invoice_reports.SAR') . $invoice->fee : __('admin.invoice_reports.free') }}</td>
                                                    <td><span class="badge bg-badge-grey text-success"><i class="fas fa-circle me-1"></i> {{ __('admin.invoice_reports.paid') }}</span></td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6">No invoices found</td>
                                                </tr>
                                            @endforelse
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="tablepagination"  class="dataTables_wrapper"></div>

                    </div>
                </div>
                <!-- /Invoice Report -->
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
                                return val + " Invoices"
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
                                return val + " Invoices"
                            }
                        }
                    }
                };
            var columnChart = new ApexCharts(columnCtx, columnConfig);
            columnChart.render();
        }
    })
</script>
