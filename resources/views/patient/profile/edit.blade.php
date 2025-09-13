<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Edit Profile')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="edit-profile">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('layout.partials.nav_patient')
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <div class="container">
                            <!-- Profile Information -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <form method="POST" action="{{ route('profile.update', $patient) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <!-- Basic -->
                                            <div class="col-md-12">
                                                <div class="pro-title d-flex justify-content-between">
                                                    <h6>Personal information</h6>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="name_en">Name</label>
                                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                                        placeholder="name_en" value="{{ $patient->name }}" required>
                                                    <input type="text" name="name_ar"
                                                    hidden value="{{ $patient->name }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                        placeholder="email" value="{{ $patient->email }}" required>
                                                    @error('email')
                                                        <div class="text-danger pt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                {{-- @if ($patient->username ?? '')
                                                    <div class="col-md-4 mb-3">
                                                        <label for="username">Username</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="username">@</span>
                                                            <input type="text" disabled class="form-control"
                                                                id="username" name="username" placeholder="Username"
                                                                value="{{ $patient->username }}" required>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-4 mb-3">
                                                        <label for="username">Username</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="username">@</span>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" placeholder="Username">
                                                        </div>
                                                    </div>
                                                @endif --}}
                                                <div class="col-md-4 mb-3">
                                                    <label for="mobile">Phone number</label>
                                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                                        placeholder="+12345678" value="{{ $patient->mobile }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="profile_image">Profile Image</label>
                                                    <input id="profile_image" name="profile_image" class="form-control"
                                                        type="file">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="date_of_birth">Date of birth</label>
                                                    <input type="date" class="form-control" id="date_of_birth"
                                                        name="date_of_birth" placeholder="date_of_birth"
                                                        value="{{ $patient->date_of_birth }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="gender">Gender</label>
                                                    <div class="col-md-10">
                                                        <select id="gender" name="gender" class="form-select select">
                                                            <option value="">-- Select Gender --</option>
                                                            <option value="M"
                                                                {{ $patient->gender == 'M' ? 'selected' : '' }}>
                                                                Male
                                                            </option>
                                                            <option value="F"
                                                                {{ $patient->gender == 'F' ? 'selected' : '' }}>
                                                                Female
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Personal Info -->
                                            {{-- <div class="form-row row">
                                                
                                                <div class="col-md-4 mb-3">
                                                    <label for="age">Age</label>
                                                    <input type="number" class="form-control" id="age"
                                                        name="age" placeholder="Enter you age"
                                                        value="{{ $patient->age }}" required>
                                                </div>
                                            </div> --}}
                                            <!-- Description -->
                                            <div class="form-row row">
                                                <label for="description" class="col-form-label col-md-2">Description</label>
                                                <div class="col-md-12 mb-3">
                                                    <textarea rows="5" cols="5" id="description" name="description" class="form-control"
                                                        placeholder="Enter text here" value="{{ $patient->description }}">{{ $patient->description }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="form-row row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        placeholder="Address" value="{{ $patient->address }}" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="country">{{ __('hospital.doctor.country') }}</label>
                                                    <select id="country_id" name="country_id" class="form-select select"
                                                        required>
                                                        <option value="" disabled selected>Select Country</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                {{ old('country_id', $patient->country?->id) == $country->id ? 'selected' : '' }}>
                                                                {{ $country->name_en }} < {{ $country->name_ar }}>
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
                                                    <select id="state_id" name="state_id" class="form-select select"
                                                        required>
                                                        <option disabled selected>-- Select State --</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}"
                                                                {{ old('state_id', $patient->state_id) == $state->id ? 'selected' : '' }}>
                                                                {{ $state->name_en }} < {{ $state->name_ar }}>
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
                                                    <select id="city_id" name="city_id" class="form-select select"
                                                        required>
                                                        <option disabled selected>-- Select City --</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ old('city_id', $patient->city_id) == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name_en }} < {{ $city->name_ar }}>
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
                                                    <label for="zip_code">Zip Code</label>
                                                    <input type="text" class="form-control" id="zip_code"
                                                        name="zip_code" placeholder="Zip Code"
                                                        value="{{ $patient->zip_code }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pro-title">
                                                    <h6>Social media links</h6>
                                                    <p>Please provide correct links to make you accessible.</p>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="twitter">Twitter Profile Link</label>
                                                    <input type="url" class="form-control" id="twitter"
                                                        name="twitter" placeholder="https://www.twitter.com/"
                                                        value="{{ $patient->twitter }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="facebook">Facebook Profile link</label>
                                                    <input type="url" class="form-control" id="facebook"
                                                        name="facebook" placeholder="https://www.facebook.com/"
                                                        value="{{ $patient->facebook }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="linkedin">Linkedin Profile link</label>
                                                    <input type="url" class="form-control" id="linkedin"
                                                        name="linkedin" placeholder="https://www.linkedn.com/"
                                                        value="{{ $patient->linkedin }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="instagram">Instagram Profile link</label>
                                                    <input type="url" class="form-control" id="instagram"
                                                        name="instagram" placeholder="https://www.instagram.com/"
                                                        value="{{ $patient->instagram }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="youtube">Youtube link</label>
                                                    <input type="url" class="form-control" id="youtube"
                                                        name="youtube" placeholder="https://www.youbute.com/"
                                                        value="{{ $patient->youtube }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pinterest">Pinterest link</label>
                                                    <input type="url" class="form-control" id="pinterest"
                                                        name="pinterest" placeholder="https://www.pinterest.com/"
                                                        value="{{ $patient->pinterest }}">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Update Profile</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Profile Information -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- /Page Content -->

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
