@extends('layout.mainlayout_admin')
@section('title', 'Banners')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Banners <span class="ms-1">{{ count($banners) }}</span></div>
                        <a href="{{ route('banner.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i> Add New</a>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Banners List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Banners</h5>
                                </div>
                                <div class="col-auto d-flex flex-wrap">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                    @if ($hospitals)    
                                        <div class="multipleSelection">
                                            <div class="selectBox">
                                                <p class="mb-0 me-2"><i class="feather-filter me-1"></i> Filter By
                                                    Hospitals </p>
                                                <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                            </div>
                                            <div id="checkBoxes">
                                                @php
                                                    $selectedHospitals = request()->hospitals ?? [];

                                                @endphp
                                                <form action="{{ route('banner.index') }}">
                                                    <p class="lab-title">Banners</p>
                                                    <div class="selectBox-cont">
                                                        @forelse($hospitals as $hospital)
                                                            <label class="custom_check w-100">
                                                                <input type="checkbox" name="hospitals[]"
                                                                    value="{{ $hospital->id }}"
                                                                    {{ in_array($hospital->id, $selectedHospitals) ? 'checked' : '' }}>
                                                                <span class="checkmark"></span> {{ $hospital->hospital_name }}
                                                            </label>
                                                        @empty
                                                        @endforelse

                                                    </div>
                                                    <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('admin.doctor.id') }}</th>
                                            <th>{{ __('admin.doctor.hospital') }}</th>
                                            <th>Subject</th>
                                            <th>Banner Status</th>
                                            <th>Expire Date</th>
                                            <th>{{ __('admin.doctor.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($banners as $banner)
                                            <tr>
                                                <td>{{ $banner->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar-pos" href="#" data-bs-target="#bannerlist"
                                                            data-bs-toggle="modal">
                                                            @if ($banner->image ?? '')
                                                                <img class="avatar avatar-img"
                                                                    src="{{ asset($banner->image) }}"
                                                                    alt="Banner Image">
                                                            @else
                                                                <img class="avatar avatar-img"
                                                                    src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                        </a>
                                                        <a href="#" data-bs-target="#bannerlist"
                                                            data-bs-toggle="modal" class="hospital-name">Dr.
                                                            {{ $banner->hospital->hospital_name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $banner->subject }}</td>
                                                @if ($banner->is_active)
                                                    <td>
                                                        <span class="badge rounded-pill bg-success-light">
                                                            Avtive
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge rounded-pill bg-danger-light">
                                                            Not Avtive
                                                        </span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <span class="user-name">
                                                        {{ \Carbon\Carbon::parse($banner->expired_at)->format('l, F jS Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black" href="{{ route('banner.edit', $banner) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        <a class="text-danger" href="javascript:void(0);"
                                                            onclick="if (window.confirm('Are you sure you want to delete this hospital <{{ $banner->name }} >')){ document.getElementById( 'delete{{ $banner->id }}').submit(); }">
                                                            <i class="feather-trash-2 me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                                <form method="POST" id="delete{{ $banner->id }}"
                                                    action="{{ route('banner.destroy', $banner) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </tr>
                                        @empty
                                            <tr class="col-span-5">
                                                <td>No Banners available</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
            <!-- /Banner List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
