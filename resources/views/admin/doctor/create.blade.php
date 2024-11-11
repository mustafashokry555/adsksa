@extends('layout.mainlayout_admin')
@section('title', 'Add New Doctor')
@section('content')
    <div class="page-wrapper">

        <!-- Doctor -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.doctor.add_new_doctor') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.doctor_name') }} EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" class="form-control"
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
                                    <input id="name_ar" name="name_ar" type="text" class="form-control"
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
                                    <input id="email" name="email" type="text" class="form-control"
                                        placeholder="{{ __('admin.doctor.enter_doctor_email') }}" required>
                                    @error('email')
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
                                        placeholder="*********" required>
                                    @error('password')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.patient.confirm_password') }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="password_confirmation" type="password" class="form-control"
                                        placeholder="*********" required>
                                    @error('password_confirmation')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="D">
                            <!-- Speciality -->
                            <div class="form-group row">
                                <label for="speciality_id"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.speciality') }}</label>
                                <div class="col-md-10">
                                    <select id="speciality_id" name="speciality_id" class="form-select select" required>
                                        <option>-- Select speciality --</option>
                                        @foreach ($specialities as $speciality)
                                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
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
                                <label for="speciality_id"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.gender') }}</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select" required>
                                        <option>-- Select Gender --</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Others</option>
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
                                            placeholder="{{ __('admin.doctor.enter_doctor_address') }}" required>
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
                                        placeholder="{{ __('admin.doctor.enter_country') }}" name="country" required>
                                    @error('country')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">{{ __('admin.doctor.state') }}</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="{{ __('admin.doctor.enter_state') }}" required>
                                    @error('state')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip_code">{{ __('admin.doctor.zip_code') }}</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        placeholder="{{ __('admin.doctor.enter_zip_code') }}" required>
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
                                    class="col-form-label col-md-2">{{ __('admin.doctor.hospital') }}</label>
                                <div class="col-md-10">
                                    <select id="hospital_id" name="hospital_id" class="form-select select" required>
                                        <option value="">-- Select Hospital --</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}">{{ $hospital->hospital_name }}</option>
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
                                <label for="pricing" class="col-form-label col-md-2">{{ __('admin.doctor.pricing') }}
                                    (SAR)</label>
                                <div class="col-md-10">
                                    <input id="pricing" name="pricing" class="form-control" type="number" required>
                                    <!-- <select id="pricing" name="pricing" class="form-select select" required> -->
                                    <!-- <option>-- Select Fee --</option>
                                            <option value="Free">Free</option>
                                            <option value="10">$10</option>
                                            <option value="20">$20</option>
                                            <option value="30">$30</option> -->
                                    @error('pricing')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <!-- </select> -->
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="profile_image"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.image') }}</label>
                                <div class="col-md-10">
                                    <input id="profile_image" name="profile_image" class="form-control" type="file"
                                        required>
                                    @error('profile_image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Basic -->
                            <!-- <div class="col-md-12">
                                    <div class="pro-title d-flex justify-content-between">
                                        <h4>Add Doctor Schedule</h4>
                                    </div>
                                </div>
                                @for ($i = 0; $i <= 6; $i++)
    <div class="form-row row">
                                        <div class="col-md-6 mb-3">
                                            <label for="from">Day</label>
                                            <input type="text" class="form-control" value="{{ \App\Commons::Days[$i] }}"
                                                   readonly>
                                        </div>
                                        <input type="hidden" name="user_id"
                                               value="{{ auth()->id() }}">
                                        @if ($schedules[$i]->from ?? '')
    <div class="col-md-3 mb-3">
                                                <label for="from">From</label>
                                                <input type="time" class="form-control" id="from" name="from[]"
                                                       value="{{ $schedules[$i]->from }}">
                                            </div>
@else
    <div class="col-md-3 mb-3">
                                                <label for="from">From</label>
                                                <input type="time" class="form-control" id="from" name="from[]">
                                            </div>
    @endif
                                        @if ($schedules[$i]->to ?? '')
    <div class="col-md-3 mb-3">
                                                <label for="to">To</label>
                                                <input type="time" class="form-control" id="to" name="to[]"
                                                       value="{{ $schedules[$i]->to }}">
                                            </div>
@else
    <div class="col-md-3 mb-3">
                                                <label for="to">To</label>
                                                <input type="time" class="form-control" id="to" name="to[]">
                                            </div>
    @endif
                                    </div>
                                    <input type="hidden" name="days[]" value="{{ \App\Commons::Days[$i] }}">
    @endfor -->
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                {{ __('admin.doctor.add_doctor') }}
                            </button>
                        </form>
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
