@extends('layout.mainlayout_admin')
@section('title', 'User Reports')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- User Reports -->
            <div class="row">
                <div class="col-sm-12">
                    <!-- <div class="app-listing">
                        <div class="import-list">
                            <a href="#"><i class="feather-download"></i> Import</a>
                        </div>
                    </div> -->

                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.user_reports.user_reports')  }}</h5>
                                </div>
                                <div class="col-auto d-flex">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('admin.user_reports.patient_name')  }}</th>
                                        <!-- <th>Doctor</th> -->
                                        <!-- <th>Hospital</th> -->
                                        <th>{{ __('admin.user_reports.number_of_appointments')  }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($patients as $patient)
                                        @php
                                            $appointments = \App\Models\Appointment::query()->where('patient_id', $patient->id )->get();
                                            $total_appt = count($appointments);
                                        @endphp
                                        @if($total_appt > 0)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    @if($patient->profile_image ?? '')
                                                        <a href="#"><img class="avatar avatar-img"
                                                                         src="{{ asset($patient->profile_image ) }}"
                                                                         alt="User Image"></a>
                                                    @else
                                                        <a href="#"><img class="avatar avatar-img"
                                                                         src="{{ URL::asset('/assets_admin/img/profiles/avatar-07.jpg')}}"
                                                                         alt="User Image"></a>
                                                    @endif
                                                    <a href="#"><span class="user-name">{{ $patient->name }}</span></a>
                                                </h2>
                                            </td>

                                            <td>{{ $total_appt }}</td>
                                        </tr>
                                        @endif
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>

                </div>
            </div>
            <!-- /User Reports -->
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
