@extends('layout.mainlayout_admin')
@section('title', 'Edit Doctor')
@section('content')
    <div class="page-wrapper">

        <!-- Doctor -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.doctor.edit_doctors') }}</h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <form method="POST" action="{{ route('doctor.update', $doctor) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.doctor_name') }} EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text"
                                        value="{{ old('name', $doctor->name_en) }}" class="form-control"
                                        placeholder="{{ __('admin.doctor.enter_doctor_name') }}" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.doctor_name') }} AR</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text"
                                        value="{{ old('name', $doctor->name_ar) }}" class="form-control"
                                        placeholder="{{ __('admin.doctor.enter_doctor_name') }}" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.doctor_email') }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email"
                                        value="{{ old('email', $doctor->email) }}" class="form-control"
                                        placeholder="{{ __('admin.doctor.enter_doctor_email') }}" required>
                                    @error('email')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="D" readonly>
                            <!-- Speciality -->
                            <div class="form-group row">
                                <label for="speciality_id"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.specialities') }}</label>
                                <div class="col-md-10">
                                    <select id="speciality_id" name="speciality_id" class="form-select select" required>
                                        <option value="">Select speciality</option>
                                        @foreach ($specialities as $speciality)
                                            <option value="{{ $speciality->id }}"
                                                {{ old('speciality_id', $doctor->speciality_id) == $speciality->id ? 'selected' : '' }}>
                                                {{ $speciality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('speciality_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- gender -->
                            <div class="form-group row">
                                <label for="gender"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.gender') }}</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select">
                                        <option value="">-- Select Gender --</option>
                                        <option value="M"
                                            {{ old('gender', $doctor->gender) == 'M' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="F"
                                            {{ old('gender', $doctor->gender) == 'F' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="O"
                                            {{ old('gender', $doctor->gender) == 'O' ? 'selected' : '' }}>Others
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="form-row row">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2"
                                        for="address">{{ __('admin.doctor.address') }}</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="{{ __('admin.doctor.enter_doctor_name') }}"
                                            value="{{ old('address', $doctor->address) }}">
                                        @error('address')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="country">{{ __('admin.doctor.country') }}</label>
                                    <input type="text" class="form-control" id="country"
                                        placeholder="{{ __('admin.doctor.enter_country') }}" name="country"
                                        value="{{ old('country', $doctor->country) }}">
                                    @error('country')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">{{ __('admin.doctor.state') }}</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="{{ __('admin.doctor.enter_state') }}"
                                        value="{{ old('state', $doctor->state) }}">
                                    @error('state')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip_code">{{ __('admin.doctor.zip_code') }}Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        placeholder="{{ __('admin.doctor.enter_zip_code') }}"
                                        value="{{ old('zip_code', $doctor->zip_code) }}">
                                    @error('zip_code')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- hospital -->
                            <div class="form-group row">
                                <label for="hospital_id"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.hospital')  }}</label>
                                <div class="col-md-10">
                                    <select id="hospital_id" name="hospital_id" class="form-select select" required>
                                        <option value="">-- Select Hospital --</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}"
                                                {{ old('hospital_id', $doctor->hospital_id) == $hospital->id ? 'selected' : '' }}>
                                                {{ $hospital->hospital_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('hospital_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Pricing -->
                            <div class="form-group row">
                                <label for="pricing"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.pricing')  }} (SAR)</label>
                                <div class="col-md-10">
                                    <input type="number" name="pricing" id="pricing" class="form-select"
                                        value="{{ old('pricing', $doctor->pricing) }}">
                                    @error('pricing')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.password') }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="password" type="password" class="form-control"
                                        placeholder="*********">
                                    @error('password')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                    class="col-form-label col-md-2">{{ __('admin.patient.confirm_password') }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="password_confirmation" type="password"
                                        class="form-control" placeholder="*********">
                                    @error('password_confirmation')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="profile_image"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.image') }}</label>
                                <div class="col-md-10">
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                    @error('profile_image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i
                                    class="feather-plus-square me-1"></i>{{ __('admin.doctor.update_doctor') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">{{ __('admin.doctor.doctor_schedule') }}</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <ul role="tablist" class="nav nav-pills card-header-pills float-end">
                                    <li class="nav-item" role="presentation">
                                        <a href="#regular-avail" data-bs-toggle="tab" class="nav-link active"
                                            aria-selected="true"
                                            role="tab">{{ __('admin.doctor.regular_availability') }}</a>
                                    </li>
                                    <!-- <li class="nav-item" role="presentation">
                                        <a href="#onetime-avail" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">One-time Availability</a>
                                    </li> -->
                                    <li class="nav-item" role="presentation">
                                        <a href="#unavail" data-bs-toggle="tab" class="nav-link" aria-selected="false"
                                            tabindex="-1" role="tab">{{ __('admin.doctor.unavailability') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                                        <ul class="nav nav-tabs nav-tabs-solid nav-justified"
                                                            role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_sunday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.sunday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active" data-bs-toggle="tab"
                                                                    href="#slot_monday" aria-selected="true"
                                                                    role="tab">{{ __('admin.doctor.monday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_tuesday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.tuesday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_wednesday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.wednesday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_thursday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.thursday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_friday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.friday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_saturday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.saturday') }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /Schedule Nav -->

                                                </div>
                                                <!-- /Schedule Header -->

                                                <!-- Schedule Content -->
                                                <div class="tab-content schedule-cont p-5">

                                                    <!-- Sunday Slot -->
                                                    <div id="slot_sunday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $sundaySlots = $doctor->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'sunday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($sundaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular.edit', ['doctor' => $doctor, 'week_day' => 'sunday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_sun').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.doctor-schedule.regular.destroy', ['doctor' => $doctor, 'week_day' => 'sunday']) }}"
                                                                        id="clear_sun" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular', ['doctor' => $doctor, 'week_day' => 'sunday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($sundaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($sundaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Sunday Slot -->

                                                    <!-- Monday Slot -->
                                                    <div id="slot_monday" class="tab-pane fade show active"
                                                        role="tabpanel">
                                                        @php
                                                            $mondaySlots = $doctor->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'monday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($mondaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular.edit', ['doctor' => $doctor, 'week_day' => 'monday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_mon').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.doctor-schedule.regular.destroy', ['doctor' => $doctor, 'week_day' => 'monday']) }}"
                                                                        id="clear_mon" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular', ['doctor' => $doctor, 'week_day' => 'monday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>

                                                        @if ($mondaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($mondaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif

                                                    </div>
                                                    <!-- /Monday Slot -->

                                                    <!-- Tuesday Slot -->
                                                    <div id="slot_tuesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $tuesdaySlots = $doctor->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'tuesday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($tuesdaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular.edit', ['doctor' => $doctor, 'week_day' => 'tuesday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_tues').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.doctor-schedule.regular.destroy', ['doctor' => $doctor, 'week_day' => 'tuesday']) }}"
                                                                        id="clear_tues" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular', ['doctor' => $doctor, 'week_day' => 'tuesday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($tuesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($tuesdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Tuesday Slot -->

                                                    <!-- Wednesday Slot -->
                                                    <div id="slot_wednesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $wednesdaySlots = $doctor->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'wednesday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($wednesdaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular.edit', ['doctor' => $doctor, 'week_day' => 'wednesday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_wed').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.doctor-schedule.regular.destroy', ['doctor' => $doctor, 'week_day' => 'wednesday']) }}"
                                                                        id="clear_wed" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular', ['doctor' => $doctor, 'week_day' => 'wednesday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($wednesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($wednesdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Wednesday Slot -->

                                                    <!-- Thursday Slot -->
                                                    <div id="slot_thursday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $thursdaySlots = $doctor->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'thursday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($thursdaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular.edit', ['doctor' => $doctor, 'week_day' => 'thursday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_thurs').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.doctor-schedule.regular.destroy', ['doctor' => $doctor, 'week_day' => 'thursday']) }}"
                                                                        id="clear_thurs" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular', ['doctor' => $doctor, 'week_day' => 'thursday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($thursdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($thursdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Thursday Slot -->

                                                    <!-- Friday Slot -->
                                                    <div id="slot_friday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $fridaySlots = $doctor->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'friday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($fridaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular.edit', ['doctor' => $doctor, 'week_day' => 'friday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_fri').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.doctor-schedule.regular.destroy', ['doctor' => $doctor, 'week_day' => 'friday']) }}"
                                                                        id="clear_fri" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.doctor-schedule.regular', ['doctor' => $doctor, 'week_day' => 'friday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($fridaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($fridaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Friday Slot -->

                                                    <!-- Saturday Slot -->
                                                    <div id="slot_saturday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $saturdaySlots = $doctor->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'saturday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            @if ($saturdaySlots)
                                                                <a class="edit-link"
                                                                    href="{{ route('hospital.doctor-schedule.regular.edit', ['doctor' => $doctor, 'week_day' => 'saturday']) }}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href=""
                                                                    onclick="event.preventDefault();document.getElementById('clear_sat').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form
                                                                    action="{{ route('hospital.doctor-schedule.regular.destroy', ['doctor' => $doctor, 'week_day' => 'saturday']) }}"
                                                                    id="clear_sat" method="POST">@csrf</form>
                                                            @else
                                                                <a class="edit-link"
                                                                    href="{{ route('hospital.doctor-schedule.regular', ['doctor' => $doctor, 'week_day' => 'saturday']) }}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                            @endif
                                                        </h4>
                                                        @if ($saturdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($saturdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
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
                                                <a class="edit-link"
                                                    href="{{ route('hospital.doctor-schedule.onetime', ['doctor' => $doctor]) }}">
                                                    <i class="fa fa-plus-circle"></i> Add Availability
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>SR.</th>
                                                        <th>Date</th>
                                                        <th>Time Interval</th>
                                                        <th>Slots</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $items = $doctor->oneTimeailabilities->sortBy('date')->values();
                                                    @endphp
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                            <td>{{ $item->time_interval }}</td>
                                                            <td class="doc-times">
                                                                @foreach ($item->slots as $slot)
                                                                    <div class="doc-slot-list">
                                                                        <small>{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                            -
                                                                            {{ date('h:i A', strtotime($slot['end_time'])) }}</small>
                                                                    </div>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <a class="text-black"
                                                                    href="{{ route('hospital.doctor-schedule.onetime.edit', ['doctor' => $doctor, $item->date]) }}">
                                                                    <i class="feather-edit-3 me-1"></i> Edit
                                                                </a>
                                                                <a class="text-danger" href=""
                                                                    onclick="event.preventDefault();document.getElementById('delet_form_{{ $key }}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> Delete
                                                                </a>
                                                                <form class="d-inline"
                                                                    action="{{ route('hospital.doctor-schedule.onetime.delete', ['doctor' => $doctor, $item->date]) }}"
                                                                    method="post" id="delet_form_{{ $key }}">
                                                                    @csrf</form>
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
                                                <a class="edit-link"
                                                    href="{{ route('hospital.doctor-schedule.unavailability', ['doctor' => $doctor]) }}">
                                                    <i class="fa fa-plus-circle"></i> Add Unavailability
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>SR.</th>
                                                        <th>Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $items = $doctor->unavailailities->sortBy('date')->values();
                                                    @endphp
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                            <td>
                                                                <a class="text-black"
                                                                    href="{{ route('hospital.doctor-schedule.unavailability.edit', ['doctor' => $doctor, $item->date]) }}">
                                                                    <i class="feather-edit-3 me-1"></i> Edit
                                                                </a>
                                                                <a class="text-danger" href=""
                                                                    onclick="event.preventDefault();document.getElementById('delet_form_un{{ $key }}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> Delete
                                                                </a>
                                                                <form class="d-inline"
                                                                    action="{{ route('hospital.doctor-schedule.unavailability.delete', ['doctor' => $doctor, $item->date]) }}"
                                                                    method="post"
                                                                    id="delet_form_un{{ $key }}">@csrf</form>
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
        <!-- /Doctor -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
