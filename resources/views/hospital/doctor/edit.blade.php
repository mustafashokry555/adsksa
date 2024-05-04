@extends('layout.mainlayout_hospital')
@section('title', 'Edit Doctors')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('hospital.doctor.edit_doctor')  }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('doctor.update', $doctor) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">{{ __('hospital.doctor.doctor_name')  }}</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" value="{{ $doctor->name }}"
                                           class="form-control" placeholder="{{ __('hospital.doctor.enter_doctor_name')  }}" required>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('hospital.doctor.doctor_email')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="text" value="{{ $doctor->email }}"
                                           class="form-control" placeholder="{{ __('hospital.doctor.enter_doctor_email')  }}" required>
                                </div>
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="D">
                            <!-- Speciality -->
                            <div class="form-group row">
                                <label for="speciality_id" class="col-form-label col-md-2">{{ __('hospital.doctor.speciality')  }}</label>
                                <div class="col-md-10">
                                    <select id="speciality_id" name="speciality_id" class="form-select select" required>
                                        <option value="">-- Select speciality --</option>
                                        @foreach($specialities as $speciality)
                                            <option value="{{ $speciality->id }}"
                                                {{ old('speciality_id', $doctor->speciality_id ) == $speciality->id ? 'selected' : '' }}
                                            >
                                                {{ $speciality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- gender -->
                            <div class="form-group row">
                                <label for="speciality_id" class="col-form-label col-md-2">{{ __('hospital.doctor.gender')  }}</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select" required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="M" {{ $doctor->gender == "M" ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="F" {{ $doctor->gender == "F" ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="O" {{ $doctor->gender == "O" ? 'selected' : '' }}>Others
                                        </option>
                                    </select>
                                    @error('gender')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="form-row row">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2" for="address">{{ __('hospital.doctor.address')  }}</label>
                                    <div class="col-md-10">
                                    <input type="text" class="form-control" id="address" name="address"
                                           placeholder="{{ __('hospital.doctor.enter_address')  }}" value="{{ $doctor->address }}" required>
                                    @error('address')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="country">{{ __('hospital.doctor.country')  }}</label>
                                    <input type="text" class="form-control" id="country" placeholder="{{ __('hospital.doctor.country')  }}"
                                           name="country" value="{{ $doctor->country }}" required>
                                    @error('country')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">{{ __('hospital.doctor.state')  }}</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="{{ __('hospital.doctor.state')  }}"
                                           value="{{ $doctor->state }}" required>
                                    @error('state')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip_code">{{ __('hospital.doctor.zip_code')  }}</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                           placeholder="{{ __('hospital.doctor.zip_code')  }}" value="{{ $doctor->zip_code }}" required>
                                    @error('zip_code')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- hospital -->
                            <input type="hidden" name="hospital_id" value="{{ auth()->user()->hospital_id }}">
                            <!-- Pricing -->
                            <div class="form-group row">
                                <label for="pricing" class="col-form-label col-md-2">{{ __('hospital.doctor.pricing')  }}</label>
                                <div class="col-md-10">
                                <input type="number" class="form-control" value="{{$doctor->pricing}}" id="zip_code" name="pricing"
                                        placeholder="{{ __('hospital.doctor.enter_price')  }}">

                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="profile_image" class="col-form-label col-md-2">{{ __('hospital.doctor.doctor_image')  }}</label>
                                <div class="col-md-10">
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> {{ __('hospital.doctor.update_doctor')  }}
                            </button>
</form>
                            <!-- Doctor Schedule -->


                            <div class="col-md-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">{{ __('hospital.doctor.doctor_schedule')  }}</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <ul role="tablist" class="nav nav-pills card-header-pills float-end">
                                    <li class="nav-item" role="presentation">
                                        <a href="#regular-avail" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">{{ __('hospital.doctor.regular_availability')  }}</a>
                                    </li>
                                    <!-- <li class="nav-item" role="presentation">
                                        <a href="#onetime-avail" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">One-time Availability</a>
                                    </li> -->
                                    <li class="nav-item" role="presentation">
                                        <a href="#unavail" data-bs-toggle="tab" class="nav-link" aria-selected="false" tabindex="-1" role="tab">{{ __('hospital.doctor.unavailibility')  }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content pt-0">
                            <div role="tabpanel" id="regular-avail" class="tab-pane fade active show">
                                <div class="profile-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card schedule-widget mb-0">

                                                <!-- Schedule Header -->
                                                <div class="schedule-header">

                                                    <!-- Schedule Nav -->
                                                    <div class="schedule-nav">
                                                        <ul class="nav nav-tabs nav-justified" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_sunday" aria-selected="false" tabindex="-1" role="tab">{{ __('hospital.doctor.sunday')  }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active" data-bs-toggle="tab" href="#slot_monday" aria-selected="true" role="tab">{{ __('hospital.doctor.monday')  }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_tuesday" aria-selected="false" tabindex="-1" role="tab">{{ __('hospital.doctor.tuesday')  }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_wednesday" aria-selected="false" tabindex="-1" role="tab">{{ __('hospital.doctor.wednesday')  }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_thursday" aria-selected="false" tabindex="-1" role="tab">{{ __('hospital.doctor.thursday')  }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_friday" aria-selected="false" tabindex="-1" role="tab">{{ __('hospital.doctor.friday')  }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_saturday" aria-selected="false" tabindex="-1" role="tab">{{ __('hospital.doctor.saturday')  }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /Schedule Nav -->

                                                </div>
                                                <!-- /Schedule Header -->

                                                <!-- Schedule Content -->
                                                <div class="tab-content schedule-cont">

                                                    <!-- Sunday Slot -->
                                                    <div id="slot_sunday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $sundaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'sunday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>{{ __('hospital.doctor.time_slots')  }}</span>
                                                            <div>
                                                                @if ($sundaySlots)
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'sunday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>{{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_sun').submit();">
                                                                    <i class="fa fa-trash me-1"></i>{{ __('hospital.doctor.clear_all')  }}
                                                                </a>
                                                                <form action="{{route('hospital.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'sunday'])}}" id="clear_sun" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'sunday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_slot')  }}
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($sundaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($sundaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">{{ __('hospital.doctor.not_available')  }}</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Sunday Slot -->

                                                    <!-- Monday Slot -->
                                                    <div id="slot_monday" class="tab-pane fade show active" role="tabpanel">
                                                        @php
                                                            $mondaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'monday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>{{ __('hospital.doctor.time_slots')  }}</span>
                                                            <div>
                                                                @if ($mondaySlots)
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'monday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>{{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_mon').submit();">
                                                                    <i class="fa fa-trash me-1"></i>{{ __('hospital.doctor.clear_all')  }}
                                                                </a>
                                                                <form action="{{route('hospital.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'monday'])}}" id="clear_mon" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'monday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_slot')  }}
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>

                                                        @if ($mondaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($mondaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">{{ __('hospital.doctor.not_available')  }}</p>
                                                        @endif

                                                    </div>
                                                    <!-- /Monday Slot -->

                                                    <!-- Tuesday Slot -->
                                                    <div id="slot_tuesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $tuesdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'tuesday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>{{ __('hospital.doctor.time_slots')  }}</span>
                                                            <div>
                                                                @if ($tuesdaySlots)
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'tuesday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>{{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_tues').submit();">
                                                                    <i class="fa fa-trash me-1"></i>{{ __('hospital.doctor.clear_all')  }}
                                                                </a>
                                                                <form action="{{route('hospital.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'tuesday'])}}" id="clear_tues" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'tuesday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_slot')  }}
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($tuesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($tuesdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">{{ __('hospital.doctor.not_available')  }}</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Tuesday Slot -->

                                                    <!-- Wednesday Slot -->
                                                    <div id="slot_wednesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $wednesdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'wednesday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>{{ __('hospital.doctor.time_slots')  }}</span>
                                                            <div>
                                                                @if ($wednesdaySlots)
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'wednesday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>{{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_wed').submit();">
                                                                    <i class="fa fa-trash me-1"></i>{{ __('hospital.doctor.clear_all')  }}
                                                                </a>
                                                                <form action="{{route('hospital.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'wednesday'])}}" id="clear_wed" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'wednesday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_slot')  }}
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($wednesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($wednesdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">{{ __('hospital.doctor.not_available')  }}</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Wednesday Slot -->

                                                    <!-- Thursday Slot -->
                                                    <div id="slot_thursday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $thursdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'thursday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>{{ __('hospital.doctor.time_slots')  }}</span>
                                                            <div>
                                                                @if ($thursdaySlots)
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'thursday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>{{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_thurs').submit();">
                                                                    <i class="fa fa-trash me-1"></i>{{ __('hospital.doctor.clear_all')  }}
                                                                </a>
                                                                <form action="{{route('hospital.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'thursday'])}}" id="clear_thurs" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'thursday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_slot')  }}
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($thursdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($thursdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}o
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">{{ __('hospital.doctor.not_available')  }}</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Thursday Slot -->

                                                    <!-- Friday Slot -->
                                                    <div id="slot_friday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $fridaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'friday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>{{ __('hospital.doctor.time_slots')  }}</span>
                                                            <div>
                                                                @if ($fridaySlots)
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'friday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>{{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_fri').submit();">
                                                                    <i class="fa fa-trash me-1"></i>{{ __('hospital.doctor.clear_all')  }}
                                                                </a>
                                                                <form action="{{route('hospital.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'friday'])}}" id="clear_fri" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'friday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_slot')  }}
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($fridaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($fridaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">{{ __('hospital.doctor.not_available')  }}</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Friday Slot -->

                                                    <!-- Saturday Slot -->
                                                    <div id="slot_saturday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $saturdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'saturday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>{{ __('hospital.doctor.time_slots')  }}</span>
                                                            @if ($saturdaySlots)
                                                            <a class="edit-link" href="{{route('hospital.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'saturday'])}}">
                                                                <i class="fa fa-edit me-1"></i>{{ __('hospital.doctor.edit')  }}
                                                            </a>
                                                            <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_sat').submit();">
                                                                <i class="fa fa-trash me-1"></i>{{ __('hospital.doctor.clear_all')  }}
                                                            </a>
                                                            <form action="{{route('hospital.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'saturday'])}}" id="clear_sat" method="POST">@csrf</form>
                                                            @else
                                                            <a class="edit-link" href="{{route('hospital.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'saturday'])}}">
                                                                <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_slot')  }}
                                                            </a>
                                                            @endif
                                                        </h4>
                                                        @if ($saturdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($saturdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">{{ __('hospital.doctor.not_available')  }}</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Saturday Slot -->

                                                </div>
                                                <!-- /Schedule Content -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" id="onetime-avail" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header border-bottom-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title"></h5>
                                            </div>
                                            <div class="col-auto d-flex">
                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.onetime',['doctor'=> $doctor])}}">
                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_availability')  }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                       <th>{{ __('hospital.doctor.SR')  }}</th>
                                                       <th>{{ __('hospital.doctor.date')  }}</th>
                                                       <th>{{ __('hospital.doctor.time_interval')  }}</th>
                                                       <th>{{ __('hospital.doctor.slots')  }}</th>
                                                       <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $items = $doctor->oneTimeailabilities->sortBy("date")->values();
                                                    @endphp
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{date("d-m-Y", strtotime($item->date))}}</td>
                                                            <td>{{$item->time_interval}}</td>
                                                            <td class="doc-times">
                                                                @foreach ($item->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    <small>{{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}</small>
                                                                </div>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <a class="text-black" href="{{route('hospital.doctor-schedule.onetime.edit',['doctor'=> $doctor, $item->date])}}">
                                                                    <i class="feather-edit-3 me-1"></i> {{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('delet_form_{{$key}}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> {{ __('hospital.doctor.delete')  }}
                                                                </a>
                                                                <form class="d-inline" action="{{route('hospital.doctor-schedule.onetime.delete',['doctor'=> $doctor, $item->date])}}" method="post" id="delet_form_{{$key}}">@csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" id="unavail" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header border-bottom-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title"></h5>
                                            </div>
                                            <div class="col-auto d-flex">
                                                <a class="edit-link" href="{{route('hospital.doctor-schedule.unavailability',['doctor'=> $doctor])}}">
                                                    <i class="fa fa-plus-circle"></i> {{ __('hospital.doctor.add_availability')  }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                       <th>{{ __('hospital.doctor.SR')  }}</th>
                                                       <th>{{ __('hospital.doctor.date')  }}</th>
                                                       <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $items = $doctor->unavailailities->sortBy("date")->values();
                                                    @endphp
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{date("d-m-Y", strtotime($item->date))}}</td>
                                                            <td>
                                                                <a class="text-black" href="{{route('hospital.doctor-schedule.unavailability.edit',['doctor'=> $doctor, $item->date])}}">
                                                                    <i class="feather-edit-3 me-1"></i> {{ __('hospital.doctor.edit')  }}
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('delet_form_un{{$key}}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> {{ __('hospital.doctor.delete')  }}
                                                                </a>
                                                                <form class="d-inline" action="{{route('hospital.doctor-schedule.unavailability.delete',['doctor'=> $doctor, $item->date])}}" method="post" id="delet_form_un{{$key}}">@csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
