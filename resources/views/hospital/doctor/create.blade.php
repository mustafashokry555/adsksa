@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Doctors')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('hospital.doctor.add_new_doctor')  }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.doctor_name') }} EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text"
                                        value="{{ old('name_en') }}" class="form-control"
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
                                        value="{{ old('name_ar') }}" class="form-control"
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
                                <label for="email" class="col-form-label col-md-2">{{ __('hospital.doctor.doctor_email')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="text" class="form-control"
                                        placeholder="{{ __('hospital.doctor.enter_doctor_email')  }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="D">
                            <!-- Speciality -->
                            <div class="form-group row">
                                <label for="speciality_id" class="col-form-label col-md-2">{{ __('hospital.doctor.speciality')  }}</label>
                                <div class="col-md-10">
                                    <select id="speciality_id" name="speciality_id" class="form-select select" required>
                                        <option>-- Select speciality --</option>
                                        @foreach ($specialities as $speciality)
                                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('speciality_id')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- gender -->
                            <div class="form-group row">
                                <label for="speciality_id" class="col-form-label col-md-2">{{ __('hospital.doctor.gender')  }}</label>
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
                                    <label class="col-form-label col-md-2" for="address">{{ __('hospital.doctor.address')  }}</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="{{ __('hospital.doctor.enter_address')  }}" required>
                                        @error('address')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="country">{{ __('hospital.doctor.country') }}</label>
                                    <select id="country_id" name="country_id" class="form-select select" required>
                                        <option value="" disabled selected>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name_en }} < {{ $country->name_ar }} >
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="country">{{ __('hospital.doctor.country') }}</label>
                                    <select id="state_id" name="state_id" class="form-select select" required>
                                        <option disabled selected>-- Select State --</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                                {{ $state->name_en }} < {{ $state->name_ar }} >
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="state">{{ __('hospital.doctor.state') }}</label>
                                    <select id="city_id" name="city_id" class="form-select select" required>
                                        <option disabled selected>-- Select City --</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name_en }} < {{ $city->name_ar }} >
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip_code">{{ __('hospital.doctor.zip_code')  }}</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        placeholder="{{ __('hospital.doctor.zip_code')  }}">
                                    @error('zip_code')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
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
                                <input type="number" class="form-control" id="pricing" name="pricing"
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

                            {{-- password --}}
                            <div class="form-group row">
                                <label for="password" class="col-form-label col-md-2">{{ __('hospital.doctor.password')  }}</label>
                                <div class="col-md-10">
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="*********" required>
                                </div>
                            </div>

                            {{-- confirm password --}}
                            <div class="form-group row">
                                <label for="password" class="col-form-label col-md-2">{{ __('hospital.doctor.confirm_password')  }}</label>
                                <div class="col-md-10">
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" placeholder="*********" required>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Doctor Schedule -->
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
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    @if ($doctor->schedules[$i]->from ?? '')
                                        <div class="col-md-3 mb-3">
                                            <label for="from">From</label>
                                            <input type="time" class="form-control" id="from" name="from[]"
                                                value="{{ $doctor->schedules[$i]->from }}">
                                        </div>
                                    @else
                                        <div class="col-md-3 mb-3">
                                            <label for="from">From</label>
                                            <input type="time" class="form-control" id="from" name="from[]">
                                        </div>
                                    @endif
                                    @if ($doctor->schedules[$i]->to ?? '')
                                        <div class="col-md-3 mb-3">
                                            <label for="to">To</label>
                                            <input type="time" class="form-control" id="to" name="to[]"
                                                value="{{ $doctor->schedules[$i]->to }}">
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
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> {{ __('hospital.doctor.add_doctor')  }}
                            </button>
                        </form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        $('.js-example-basic-multiple').select2();
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
