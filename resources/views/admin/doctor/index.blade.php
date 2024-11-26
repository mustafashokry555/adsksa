@extends('layout.mainlayout_admin')
@section('title', 'Doctors')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">{{ __('admin.doctor.doctors') }} <span
                                class="ms-1">{{ count($doctors) }}</span></div>
                        <a href="{{ route('doctor.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i>{{ __('admin.speciality.add_new') }} </a>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Doctor List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.doctor.doctors') }}</h5>
                                </div>
                                <div class="col-auto d-flex flex-wrap">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                    <div class="multipleSelection">
                                        <div class="selectBox">
                                            <p class="mb-0 me-2"><i class="feather-filter me-1"></i> Filter By
                                                Speciality </p>
                                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                        </div>
                                        <div id="checkBoxes">
                                            @php
                                                $selectedSpeciality = request()->speciality ?? [];

                                            @endphp
                                            <form action="{{ route('doctor.index') }}">
                                                <p class="lab-title">Doctors</p>
                                                <div class="selectBox-cont">
                                                    @forelse($specialities as $speciality)
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="speciality[]"
                                                                value="{{ $speciality->id }}"
                                                                {{ in_array($speciality->id, $selectedSpeciality) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span> {{ $speciality->name }}
                                                        </label>
                                                    @empty
                                                    @endforelse

                                                </div>
                                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('admin.doctor.id') }}</th>
                                            <th>{{ __('admin.doctor.doctor') }}</th>
                                            <th>{{ __('admin.doctor.hospital') }}</th>
                                            <th>{{ __('admin.doctor.specialities') }}</th>
                                            <th>{{ __('admin.doctor.address') }}</th>
                                            <th>{{ __('admin.doctor.member_since') }}</th>
                                            {{-- <th>Number of Appointments</th> --}}
                                            <th>{{ __('admin.doctor.total_income') }}</th>
                                            {{-- <th>Account Status</th> --}}
                                            <th>{{ __('admin.doctor.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($doctors as $doctor)
                                            <tr>
                                                <td>{{ $doctor->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar-pos" href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal">
                                                            @if ($doctor->profile_image ?? '')
                                                                <img class="avatar avatar-img"
                                                                    src="{{ asset($doctor->profile_image) }}"
                                                                    alt="User Image">
                                                            @else
                                                                <img class="avatar avatar-img"
                                                                    src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                        </a>
                                                        <a href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal" class="user-name">Dr.
                                                            {{ $doctor->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $doctor?->hospital?->hospital_name }}</td>
                                                @if ($doctor->speciality ?? '')
                                                    <td>{{ $doctor?->speciality?->name ?? '' }}</td>
                                                @else
                                                    <td>N/A</td>
                                                @endif
                                                @if ($doctor->address ?? '')
                                                    <td><span class="user-name">{{ $doctor->address }} </span>
                                                        <span class="d-block">{{ $doctor->state }}</span>
                                                        <span class="d-block">{{ $doctor->country }}</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="user-name">No Address Found </span>
                                                    </td>
                                                @endif
                                                <td><span
                                                        class="user-name">{{ $doctor->created_at->format('l, F jS Y') }}</span>
                                                </td>
                                                {{--													<td>545</td> --}}
                                                <td> {{ $doctor->pricing !== 'Free' ? 'SAR ' . $doctor->pricing : 'FREE' }}</td>
                                                {{--													<td> --}}
                                                {{--														<label class="toggle-switch" for="status1"> --}}
                                                {{--															<input type="checkbox" class="toggle-switch-input" id="status1"> --}}
                                                {{--															<span class="toggle-switch-label"> --}}
                                                {{--																<span class="toggle-switch-indicator"></span> --}}
                                                {{--															</span> --}}
                                                {{--														</label> --}}
                                                {{--													</td> --}}
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black"
                                                            href="{{ route('doctor_patients', $doctor) }}">Patients</a>
                                                        <a class="text-black" href="{{ route('doctor.edit', $doctor) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        <a class="text-danger" href="javascript:void(0);"
                                                            onclick="if (window.confirm('Are you sure you want to delete this hospital <{{ $doctor->name }} >')){ document.getElementById( 'delete{{ $doctor->id }}').submit(); }">
                                                            <i class="feather-trash-2 me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                                <form method="POST" id="delete{{ $doctor->id }}"
                                                    action="{{ route('doctor.destroy', $doctor) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </tr>
                                        @empty
                                            <tr class="col-span-5">
                                                <td>No Doctors available</td>
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
            <!-- /Doctor List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
