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

                            {{-- Country --}}
                            <div class="form-group row">
                                <label for="country_id" class="col-form-label col-md-2">{{ __('admin.hospital.country') }}</label>
                                <div class="col-md-10">
                                    <select id="country_id" name="country_id" class="form-control" required>
                                        <option value="" disabled selected>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name_en }} < {{ $country->name_ar }} ></option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- State --}}
                            <div class="form-group row">
                                <label for="state_id"
                                    class="col-form-label col-md-2">State</label>
                                <div class="col-md-10">
                                    <select id="state_id" name="state_id" class="form-select select" required>
                                        <option value="">-- Select State --</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name_en }} < {{ $state->name_ar }} ></option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- City --}}
                            <div class="form-group row">
                                <label for="city_id"
                                    class="col-form-label col-md-2">City</label>
                                <div class="col-md-10">
                                    <select id="city_id" name="city_id" class="form-select select" required>
                                        <option value="">-- Select City --</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name_en }} < {{ $city->name_ar }} ></option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2"
                                    for="address">{{ __('admin.doctor.zip_code') }}</label>
                                <div class="col-md-10">
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
<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script>
    // get states fun 
    function getStatesAndCities(countryId) {
        // States
        $.ajax({
            url: '{{ route("get.states") }}', // Define this route in Laravel
            type: 'GET',
            data: { country_id: countryId },
            success: function (data) {
                $('#state_id').empty(); // Clear the cities dropdown
                $('#state_id').append('<option value="" disabled selected>Select State</option>');
                $.each(data, function (key, state) {
                    $('#state_id').append('<option value="' + state.id + '">' + state.name_en +' < '+ state.name_ar +' > '+'</option>');
                });
            },
            error: function () {
                alert('Error Loading States');
            }
        });

        // Cities
        $.ajax({
            url: '{{ route("get.cities") }}', // Define this route in Laravel
            type: 'GET',
            data: { country_id: countryId },
            success: function (data) {
                $('#city_id').empty(); // Clear the cities dropdown
                $('#city_id').append('<option value="" disabled selected>Select City</option>');
                $.each(data, function (key, city) {
                    $('#city_id').append('<option value="' + city.id + '">' + city.name_en +' < '+ city.name_ar +' > '+'</option>');
                });
            },
            error: function () {
                alert('Error Loading Cities');
            }
        });
    }
    function getCities(stateId) {
        // Cities
        $.ajax({
            url: '{{ route("get.cities") }}', // Define this route in Laravel
            type: 'GET',
            data: { state_id: stateId },
            success: function (data) {
                $('#city_id').empty(); // Clear the cities dropdown
                $('#city_id').append('<option value="" disabled selected>Select City</option>');
                $.each(data, function (key, city) {
                    $('#city_id').append('<option value="' + city.id + '">' + city.name_en +' < '+ city.name_ar +' > '+'</option>');
                });
            },
            error: function () {
                alert('Error Loading Cities');
            }
        });
    }
    $(document).ready(function() {
        $('#country_id').on('change', function () {
            var countryId = $(this).val();
            if (countryId) {
                getStatesAndCities(countryId);
            } else {
                $('#state_id').empty(); // Clear the cities dropdown if no country is selected
                $('#state_id').append('<option value="" disabled selected>Select State</option>');
                $('#city_id').empty(); // Clear the cities dropdown if no country is selected
                $('#city_id').append('<option value="" disabled selected>Select City</option>');
            }
        });
        $('#state_id').on('change', function () {
            var stateId = $(this).val();
            if (stateId) {
                getCities(stateId);
            } else {
                $('#city_id').empty(); // Clear the cities dropdown if no country is selected
                $('#city_id').append('<option value="" disabled selected>Select City</option>');
            }
        });
    });
</script>
