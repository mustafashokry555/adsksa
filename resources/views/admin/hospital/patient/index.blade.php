@extends('layout.mainlayout_admin')
@section('title', 'Doctors')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3"> {{ __('admin.hospital.patients')  }} <span class="ms-1">{{ count($patients) }}</span></div>
                    </div>
                </div>
            </div>
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Doctor List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.hospital.patients')  }} </h5>
                                </div>
                                <div></div>
{{--                                <div class="col-auto d-flex flex-wrap">--}}
{{--                                    <div class="form-custom me-2">--}}
{{--                                        <div id="tableSearch" class="dataTables_wrapper"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="multipleSelection">--}}
{{--                                        <div class="selectBox">--}}
{{--                                            <p class="mb-0 me-2"><i class="feather-filter me-1"></i> Filter By--}}
{{--                                                Speciality </p>--}}
{{--                                            <span class="down-icon"><i class="feather-chevron-down"></i></span>--}}
{{--                                        </div>--}}
{{--                                        <div id="checkBoxes">--}}
{{--                                            <form action="doctor-list">--}}
{{--                                                <p class="lab-title">Doctors</p>--}}
{{--                                                <div class="selectBox-cont">--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year" checked>--}}
{{--                                                        <span class="checkmark"></span> Urology--}}
{{--                                                    </label>--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year">--}}
{{--                                                        <span class="checkmark"></span> Neurology--}}
{{--                                                    </label>--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year">--}}
{{--                                                        <span class="checkmark"></span> Orthopedic--}}
{{--                                                    </label>--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year">--}}
{{--                                                        <span class="checkmark"></span> Cardiologist--}}
{{--                                                    </label>--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year">--}}
{{--                                                        <span class="checkmark"></span> Dentist--}}
{{--                                                    </label>--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year">--}}
{{--                                                        <span class="checkmark"></span> Gynacologist--}}
{{--                                                    </label>--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year">--}}
{{--                                                        <span class="checkmark"></span> Pediatrist--}}
{{--                                                    </label>--}}
{{--                                                    <label class="custom_check w-100">--}}
{{--                                                        <input type="checkbox" name="year">--}}
{{--                                                        <span class="checkmark"></span> Orthopedic--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <button type="submit" class="btn w-100 btn-primary">Apply</button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('admin.hospital.id')  }} </th>
                                        <th>{{ __('admin.hospital.patient')  }} </th>
                                        <th>{{ __('admin.hospital.address')  }} </th>
                                        <th>{{ __('admin.hospital.member_since')  }} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar-pos" href="#" data-bs-target="#doctorlist"
                                                       data-bs-toggle="modal"><img class="avatar avatar-img"
                                                                                   src="{{ asset($patient->profile_image) }}"
                                                                                   alt="User Image"></a>
                                                    <a href="#" data-bs-target="#doctorlist" data-bs-toggle="modal"
                                                       class="user-name">{{ @$patient->name }}</a>
                                                </h2>
                                            </td>
                                            @if($patient->address ?? '')
                                                <td><span class="user-name">{{ $patient?->hospital->address??null }} </span>
                                                    <span class="d-block">{{ $patient->hospital->city??null }}</span>
                                                    <span class="d-block">{{ $patient->hospital->state??null }}</span>
                                                    <span class="d-block">{{ $patient->hospital->country??null }}</span>
                                                </td>
                                            @else
                                                <td class="bg-danger-light">Address Not Available</td>
                                            @endif
                                            <td><span class="user-name">26 November 2022 </span><span class="d-block">12/20/2022</span>
                                            </td>
                                            <form method="POST" id="delete{{ $patient->id }}"
                                                  action="{{ route('hospitalDoctors.destroy', $patient) }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </tr>
                                    @empty
                                        <tr class="col-span-5">
                                            <td class="bg-danger-light text-center" colspan="5">No Patients available</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"> {{ $patients->links() }}</div>
                </div>
            </div>
            <!-- /Doctor List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
