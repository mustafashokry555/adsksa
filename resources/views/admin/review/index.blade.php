@extends('layout.mainlayout_admin')
@section('title', 'Reviews')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">{{ __('admin.reviews.reviews') }} <span
                                class="ms-1">{{ count($reviews) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Ratings -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.reviews.reviews') }}</h5>
                                </div>
                                <div class="col-auto custom-list d-flex">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                    <!-- <div class="multipleSelection">
                                            <div class="selectBox">
                                                <p class="mb-0"><i class="feather-filter me-1"></i> Filter </p>
                                                <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                            </div>
                                            <div id="checkBoxes">
                                                <form action="ratings">
                                                    <p class="lab-title">Ratings</p>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year" checked>
                                                        <span class="checkmark"></span> 5
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> 4
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> 3
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> 2
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> 1
                                                    </label>
                                                    <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                                </form>
                                            </div>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('admin.reviews.id') }}</th>
                                            <th>{{ __('admin.reviews.patient') }}</th>
                                            <th>{{ __('admin.reviews.doctor') }}</th>
                                            <th>{{ __('admin.reviews.hospital') }}</th>
                                            <th>{{ __('admin.reviews.date') }}</th>
                                            <th class="desc-info">{{ __('admin.reviews.ratings') }}</th>
                                            <th>{{ __('admin.reviews.description') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reviews as $review)
                                            @php
                                                $patient = \App\Models\User::query()
                                                    ->where('id', $review->user_id)
                                                    ->first();
                                                $doctor = \App\Models\User::query()
                                                    ->where('id', $review->doctor_id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                {{--                                        <td><a href="#" class="text-black" data-bs-toggle="modal" data-bs-target="#Ratings">#4546</a></td> --}}
                                                <td>{{ $review->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar gap-2">
                                                        @if ($patient->profile_image ?? '')
                                                            <img class="avatar avatar-img"
                                                                src="{{ asset($patient->profile_image) }}"
                                                                alt="User Image">
                                                        @else
                                                            <img class="avatar avatar-img"
                                                                src="{{ URL::asset('/assets_admin/img/profiles/avatar-07.jpg') }}"
                                                                alt="User Image">
                                                        @endif
                                                        <a href="javascript:void(0)"><span
                                                                class="user-name">{{ $patient->name }}</span></a>
                                                    </h2>
                                                </td>

                                                <td>
                                                    <h2 class="table-avatar gap-2">
                                                        @if ($doctor->profile_image ?? '')
                                                            <img class="avatar avatar-img"
                                                                src="{{ asset($doctor->profile_image) }}"
                                                                alt="User Image">
                                                        @else
                                                            <img class="avatar avatar-img"
                                                                src="{{ URL::asset('/assets_admin/img/profiles/avatar-02.jpg') }}"
                                                                alt="User Image">
                                                        @endif
                                                        <a href="javascript:void(0)" class="user-name">
                                                            <span class="text-muted"> {{ $doctor?->name }}</span>
                                                            <span class="text-muted">{{ __('admin.reviews.dr') }}.{{ $doctor?->name }}</span>
                                                            <span class="tab-subtext">{{ $doctor?->speciality?->name }}</span>
                                                            </a>
                                                    </h2>
                                                </td>
                                                <td>{{ $doctor?->hospital?->hospital_name ?? 'N/A' }}</td>
                                                <td><span class="user-name">{{ $review->created_at->format('d M Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="ratings">
                                                        @for ($i = 1; $i <= $review->star_rated; $i++)
                                                            <i class="far fa-star filled"></i>
                                                        @endfor
                                                        @for ($j = $review->star_rated; $j < 5; $j++)
                                                            <i class="far fa-star"></i>
                                                        @endfor
                                                    </div>
                                                </td>
                                                <td class="desc-info">{{ $review->review_title }}</td>

                                            </tr>
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
            <!-- /Ratings -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

    // Pop up module
    {{--    <!-- Add Event Modal --> --}}
    {{--    <div class="modal custom-modal fade none-border" id="delete_review"> --}}
    {{--        <div class="modal-dialog modal-dialog-centered"> --}}
    {{--            <div class="modal-content"> --}}
    {{--                <div class="modal-header"> --}}
    {{--                    <h4 class="modal-title">Delete {{ $review->review_title }}</h4> --}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button> --}}
    {{--                </div> --}}
    {{--                <div class="modal-body"></div> --}}
    {{--                <div class="modal-footer justify-content-center"> --}}
    {{--                    <button type="button" class="btn btn-danger delete-event submit-btn" data-bs-dismiss="modal">Delete</button> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    <!-- /Add Event Modal -->

@endsection
