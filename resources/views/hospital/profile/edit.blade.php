@extends('layout.mainlayout_hospital')
@section('title', 'Edit Profile')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form method="POST" action="{{ route('profile.update', $hospital_admin) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h6>{{ __('hospital.profile.personal_information')  }}</h6>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="name_en">{{ __('hospital.profile.name')  }}</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                        placeholder="{{ __('hospital.profile.name')  }}" value="{{ $hospital_admin->name_en }}" required>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="name_ar">{{ __('hospital.profile.name')  }}</label>
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                        placeholder="{{ __('hospital.profile.name')  }}" value="{{ $hospital_admin->name_ar }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email">{{ __('hospital.profile.email')  }}</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="{{ __('hospital.profile.email')  }}" value="{{ $hospital_admin->email }}" required readonly>
                                </div>
                                @if ($hospital_admin->username ?? '')
                                    <div class="col-md-4 mb-3">
                                        <label for="username">{{ __('hospital.profile.username')  }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="username">@</span>
                                            <input type="text" readonly class="form-control" id="username"
                                                name="username" placeholder="{{ __('hospital.profile.username')  }}"
                                                value="{{ $hospital_admin->username }}" required>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4 mb-3">
                                        <label for="username">{{ __('hospital.profile.username')  }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="username">@</span>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="{{ __('hospital.profile.username')  }}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4 mb-3">
                                    <label for="mobile">{{ __('hospital.profile.mobile')  }}</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                        placeholder="+12345678" value="{{ $hospital_admin->mobile }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="profile_image">{{ __('hospital.profile.profile_image')  }}</label>
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="form-row row">
                                <label for="description" class="col-form-label col-md-2">{{ __('hospital.profile.description')  }}</label>
                                <div class="col-md-12 mb-3">
                                    <textarea rows="5" cols="5" id="description" name="description" class="form-control" placeholder="{{ __('hospital.profile.description')  }}" >{{ $hospital_admin->description }}</textarea>
                                </div>
                            </div>
                            <!-- Personal Info -->
                            <!-- <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="date_of_birth">Date of birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        placeholder="date_of_birth" value="{{ $hospital_admin->date_of_birth }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="gender">Gender</label>
                                    <div class="col-md-10">
                                        <select id="gender" name="gender" class="form-select select" required>
                                            <option>-- Select Gender --</option>
                                            <option value="M" {{ $hospital_admin->gender == 'M' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="F" {{ $hospital_admin->gender == 'F' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option value="O" {{ $hospital_admin->gender == 'O' ? 'selected' : '' }}>
                                                Others
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="age" name="age"
                                        placeholder="Enter you age" value="{{ $hospital_admin->age }}" required>
                                </div>
                            </div> -->
                            <!-- Address -->
                            <div class="form-row row">
                                <div class="col-md-12 mb-3">
                                    <label for="address">{{ __('hospital.profile.address')  }}</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="{{ __('hospital.profile.address')  }}" value="{{ $hospital_admin->address }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="country">{{ __('hospital.doctor.country') }}</label>
                                    <select id="country_id" name="country_id" class="form-select select" required>
                                        <option value="" disabled selected>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country_id', $hospital_admin->country?->id) == $country->id ? 'selected' : '' }}>
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
                                                {{ old('state_id', $hospital_admin->state_id) == $state->id ? 'selected' : '' }}>
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
                                                {{ old('city_id', $hospital_admin->city_id) == $city->id ? 'selected' : '' }}>
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
                                    <label for="zip_code">{{ __('hospital.doctor.zip_code') }}</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        placeholder="{{ __('hospital.doctor.zip_code') }}" value="{{ $hospital_admin->zip_code }}"
                                        required>
                                    @error('zip_code')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pro-title">
                                    <h6>{{ __('hospital.profile.social_links')  }}</h6>
                                    <p>{{ __('hospital.profile.accessible')  }}.</p>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="twitter">{{ __('hospital.profile.twitter_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter"
                                        placeholder="https://www.twitter.com/" value="{{ $hospital_admin->twitter }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="facebook">{{ __('hospital.profile.facebook_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook"
                                        placeholder="https://www.facebook.com/" value="{{ $hospital_admin->facebook }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="linkedin">{{ __('hospital.profile.linkedin_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin"
                                        placeholder="https://www.linkedn.com/" value="{{ $hospital_admin->linkedin }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="instagram">{{ __('hospital.profile.instagram_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="instagram" name="instagram"
                                        placeholder="https://www.instagram.com/"
                                        value="{{ $hospital_admin->instagram }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="youtube">{{ __('hospital.profile.youtube_link')  }}</label>
                                    <input type="url" class="form-control" id="youtube" name="youtube"
                                        placeholder="https://www.youbute.com/" value="{{ $hospital_admin->youtube }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pinterest">{{ __('hospital.profile.pinterest_link')  }}</label>
                                    <input type="url" class="form-control" id="pinterest" name="pinterest"
                                        placeholder="https://www.pinterest.com/"
                                        value="{{ $hospital_admin->pinterest }}">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">{{ __('hospital.profile.update_profile')  }}</button>
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
