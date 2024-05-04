@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Doctors')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="page-header p-8 m-2">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">{{ __('hospital.doctor.doctors')  }} <span class="ms-1">{{ count($doctors) }}</span></div>
                    <a href="{{ route('doctor.create') }}" class="btn btn-primary btn-add"><i
                            class="feather-plus-square me-1"></i> {{ __('hospital.doctor.add_new')  }} </a>
                </div>
                <br></br>
                <div class="col-md-12 d-flex justify-content-end">
                    <form method="POST" action="{{ route('doctor.import') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" required="required">
                        <input type="hidden" name="hospital_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                        <button class="btn btn-primary btn-add"> <i class="feather-plus-square me-1">{{ __('hospital.doctor.imports')  }}</i></button>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{url('/doctors_demo_sheet.xlsx')}}" download=""><ul>{{ __('hospital.doctor.doctors')  }}</ul></a>

        @if (session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="row">
            <div class="col-md-12">

                <div>
                    <div class="tab-content">

                        <!-- Doctor List -->
                        <div>
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable1">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('hospital.doctor.id')  }}</th>
                                                    <th>{{ __('hospital.doctor.doctor')  }}</th>
                                                    <th>{{ __('hospital.doctor.speciality')  }}</th>
                                                    <th>{{ __('hospital.doctor.address')  }}</th>
                                                    <th>{{ __('hospital.doctor.member_since')  }}</th>
                                                    <th>{{ __('hospital.doctor.fee')  }}</th>
                                                    <th>{{ __('hospital.doctor.action')  }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($doctors as $doctor)

                                                    <tr>
                                                    <td>{{$doctor->id}}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($doctor->profile_image ?? '')
                                                                    <a class="avatar avatar-sm me-2"
                                                                        href="{{ route('profile.show', $doctor) }}"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="{{ asset($doctor->profile_image) }}"
                                                                            alt="User Image"></a>
                                                                @else
                                                                    <a class="avatar avatar-sm me-2"
                                                                        href="{{ route('profile.show', ['profile' => $doctor->id]) }}"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                            alt="User Image"></a>
                                                                @endif
                                                                <a
                                                                    href="{{ route('profile.show', ['profile' => $doctor->id]) }}">{{ $doctor->name }}
                                                                    <span></span></a>
                                                            </h2>
                                                        </td>
                                                        @if ($doctor?->speciality_id ?? '')
                                                            <td>{{ $doctor?->speciality?->name ?? '' }}</td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif
                                                        <td>
                                                            @if ($doctor?->address ?? '')
                                                                <span class="user-name">{{ $doctor?->address }} </span>
                                                                <span class="d-block">{{ $doctor?->state }}</span>
                                                                <span class="d-block">{{ $doctor?->country }}</span>
                                                            @else
                                                                <span class="d-block">{{ __('hospital.doctor.no_address_found')  }}</span>
                                                            @endif
                                                        </td>
                                                        <td>11 Nov 2019 <span class="d-block text-info">10.00 AM</span></td>
                                                        <td class="text-center">
                                                            {{ $doctor?->pricing ? '$' . $doctor?->pricing : 'N/A' }}
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="{{ route('doctor.edit', $doctor) }}"
                                                                    class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-edit"></i> {{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                    onclick="if (window.confirm('Are you sure you want to delete this hospital <{{ $doctor->name }} >')){ document.getElementById( 'delete{{ $doctor->id }}').submit(); }"
                                                                    class="btn btn-sm bg-danger-light">
                                                                    <i class="fas fa-trash"></i> {{ __('hospital.doctor.delete')  }}
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
                                                    <!-- <tr class="col-span-6">
                                                                            <td>No Doctors Available</td>
                                                                        </tr> -->
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Doctor List -->

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
