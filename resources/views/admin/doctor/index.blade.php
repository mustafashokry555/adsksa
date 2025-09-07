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
            <style>
                .switch {
                    position: relative;
                    display: inline-block;
                    width: 50px;
                    height: 25px;
                }

                .switch input {
                    opacity: 0;
                    width: 0;
                    height: 0;
                }

                .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    transition: 0.4s;
                    border-radius: 25px;
                }

                .slider:before {
                    position: absolute;
                    content: "";
                    height: 19px;
                    width: 19px;
                    left: 3px;
                    bottom: 3px;
                    background-color: white;
                    transition: 0.4s;
                    border-radius: 50%;
                }

                input:checked+.slider {
                    background-color: #4caf50;
                }

                input:checked+.slider:before {
                    transform: translateX(24px);
                }
            </style>
            <div id="flash-message" style="display: none" class="alert alert-success mt-2">
                {{ session()->has('flash') ? session('flash')['message'] : '' }}
            </div>
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
                                            <th>Status</th>
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
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                            {{ strtolower($doctor->status) === 'active' ? 'checked' : '' }}
                                                            data-id="{{ $doctor->id }}">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                @if ($doctor->speciality ?? '')
                                                    <td>{{ $doctor?->speciality?->name ?? '' }}</td>
                                                @else
                                                    <td>N/A</td>
                                                @endif
                                                <td>
                                                    {{-- <span class="user-name">{{ $doctor->address }} </span> --}}
                                                    <span class="d-block">{{ $doctor->country ? $doctor->country->name : null }}</span>
                                                    <span class="d-block">{{ $doctor->state ? $doctor->state->name : null  }}</span>
                                                    <span class="d-block">{{ $doctor->city ? $doctor->city->name : null   }}</span>
                                                </td>
                                                <td>
                                                    <span class="user-name">{{ $doctor->created_at->format('l, F jS Y') }}</span>
                                                </td>
                                                <td> {{ $doctor->pricing !== 'Free' ? 'SAR ' . $doctor->pricing : 'FREE' }}</td>
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

    <script>
        document.querySelectorAll('.switch input').forEach((toggle) => {
            toggle.addEventListener('change', function() {
                let doctorId = this.dataset.id;
                let isActive = this.checked ? 'Active' : 'Inactive';

                fetch(`/doctor/${doctorId}/toggle-active`, {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            is_active: isActive
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Show flash message
                        let flash = document.getElementById("flash-message");
                        flash.innerText = data.message;
                        flash.style.display = "block";

                        // Auto-hide after 3s
                        setTimeout(() => {
                            flash.style.display = "none";
                        }, 3000);
                    })
                    .catch(err => console.error(err));
            });
        });
    </script>
@endsection
