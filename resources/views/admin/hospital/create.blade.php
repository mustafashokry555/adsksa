@extends('layout.mainlayout_admin')
@section('title', 'Add New Hospital')
@section('content')
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-bottom: 20px;
        }
        .mapboxgl-ctrl-geocoder {
            width: 100%;
            max-width: none;
            margin-bottom: 10px;
        }
    </style>
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.hospital.add_hospital') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hospital.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="hospital_name"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.insurance') }}</label>
                                <div class="col-md-10">
                                    <select id="insurance" name="insurance[]" type="text"
                                        class="form-control js-example-basic-multiple" placeholder="Enter Hospital name"
                                        multiple="multiple" required>


                                        @forelse($insurances as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty
                                        @endforelse

                                    </select>
                                    @error('hospital_name')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hospital_name_en"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.hospital_name_en') }}</label>
                                <div class="col-md-10">
                                    <input id="hospital_name_en" name="hospital_name_en" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_hospital_name_en') }}" required>
                                    @error('hospital_name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hospital_name_ar"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.hospital_name_ar') }}</label>
                                <div class="col-md-10">
                                    <input id="hospital_name_ar" name="hospital_name_ar" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_hospital_name_ar') }}" required>
                                    @error('hospital_name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- mail -->
                            <div class="form-group row">
                                <label for="mail" class="col-form-label col-md-2">Mail</label>
                                <div class="col-md-10">
                                    <input id="mail" name="mail" value="{{ old('mail') }}"
                                        type="email" class="form-control" placeholder="Enter Hospital Mail">
                                    @error('mail')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="form-group row">
                                <label for="phone" class="col-form-label col-md-2">Phone</label>
                                <div class="col-md-10">
                                    <input id="phone" name="phone" value="{{ old('phone') }}"
                                        type="text" class="form-control" placeholder="Enter Hospital Phone">
                                    @error('phone')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- WhatsApp -->
                            <div class="form-group row">
                                <label for="whatsapp" class="col-form-label col-md-2">WhatsApp</label>
                                <div class="col-md-10">
                                    <input id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                                        type="text" class="form-control" placeholder="Enter Hospital WhatsApp">
                                    @error('whatsapp')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Facebook -->
                            <div class="form-group row">
                                <label for="facebook" class="col-form-label col-md-2">Facebook</label>
                                <div class="col-md-10">
                                    <input id="facebook" name="facebook" value="{{ old('facebook') }}"
                                        type="text" class="form-control" placeholder="Enter Hospital Facebook URL">
                                    @error('facebook')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Instagram -->
                            <div class="form-group row">
                                <label for="instagram" class="col-form-label col-md-2">Instagram</label>
                                <div class="col-md-10">
                                    <input id="instagram" name="instagram" value="{{ old('instagram') }}"
                                        type="text" class="form-control" placeholder="Enter Hospital Instagram URL">
                                    @error('instagram')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- TikTok -->
                            <div class="form-group row">
                                <label for="tiktok" class="col-form-label col-md-2">TikTok</label>
                                <div class="col-md-10">
                                    <input id="tiktok" name="tiktok" value="{{ old('tiktok') }}"
                                        type="text" class="form-control" placeholder="Enter Hospital TikTok URL">
                                    @error('tiktok')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hospital_type_id" class="col-form-label col-md-2">Hospital Type</label>
                                <div class="col-md-10">
                                    <select id="hospital_type_id" name="hospital_type_id" class="form-control" required>
                                        <option value="" disabled selected>Select Hospital Types</option>
                                        @foreach ($hospital_types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name_en }} < {{ $type->name_ar }} ></option>
                                        @endforeach
                                    </select>
                                    @error('hospital_type_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.address') }}</label>
                                <div class="col-md-10">
                                    <input id="address" name="address" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_address') }}" required>
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
                                <label for="zip"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.hospital_zip') }}</label>
                                <div class="col-md-10">
                                    <input id="zip" name="zip" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_hospital_zip') }}" required>
                                    @error('zip')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Maps --}}
                            <div class="form-group row">
                                <label for="map" class="col-form-label col-md-2">Select Location:</label>
                                <div class="col-md-10">
                                    <div id="geocoder" class="geocoder"></div>
                                    <div id="map"></div>
                                    <div id="selectedLocation"></div>
                                    <input type="hidden" id="latitude" name="lat">
                                    <input type="hidden" id="longitude" name="long">
                                    <input type="hidden" id="addressLocation" name="location">
                                    @error('location')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Maps --}}
                            <div class="form-group row">
                                <label for="image"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.image') }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="image" class="form-control" type="file" required>
                                    @error('image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Upload new images -->
                            <div class="form-group row">
                                <label for="profile_images" class="col-form-label col-md-2">Profile Images</label>
                                <div class="col-md-10">
                                    <input id="profile_images" name="profile_images[]" class="form-control" type="file" multiple>
                                    @error('profile_images')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.hospital_administrator_name') }}</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_hospital_administrator_name') }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">Hospital Administrator Email</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" class="form-control"
                                        placeholder="Enter Hospital Administrator Email" required>
                                    @error('email')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="about_en" class="col-form-label col-md-2">About Hospital (EN)</label>
                                <div class="col-md-10">
                                    <textarea id="about_en" name="about_en" type="text" class="form-control" placeholder="About The Hospital"></textarea>
                                    @error('about_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="about_ar" class="col-form-label col-md-2">About Hospital (AR)</label>
                                <div class="col-md-10">
                                    <textarea id="about_ar" name="about_ar" type="text" class="form-control" placeholder="About The Hospital"></textarea>
                                    @error('about_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            </div>
                            <div class="form-group row">
                                <label for="opening_hours" class="col-form-label col-md-2">Opening Hours</label>
                                <div class="col-md-10">
                                    <input id="opening_hours" name="opening_hours" type="text" class="form-control"
                                        placeholder="The Hospital Opening Hours">
                                    @error('opening_hours')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.password') }}</label>
                                <div class="col-md-10">
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="*********" required>
                                    @error('password')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.confirm_password') }}</label>
                                <div class="col-md-10">
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" placeholder="*********" required>
                                    @error('password_confirmation')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" value="H" name="user_type" id="user_type">
                            <input type="hidden" name="hospital_id" id="hospital_id">
                            <button class="btn btn-primary btn-add"><i
                                    class="feather-plus-square me-1"></i>{{ __('admin.hospital.add_hospital') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Specialities -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection


<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
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
        mapboxgl.accessToken = 'pk.eyJ1IjoiZW0yMDAwMTExIiwiYSI6ImNsajRrcXlicjA0MjMza3F6YjI5eW5pN2IifQ.bY21DI8kEvlV7z97OKlJJA';
        initMap();
    });
    let map;
    let marker;
    let selectedLocation = null;

    function initMap() {
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [39.826288, 21.422438], // Kaaba
            zoom: 5
        });

        // Add navigation control (zoom in/out buttons)
        map.addControl(new mapboxgl.NavigationControl(), 'top-right');

        // Initialize marker
        marker = new mapboxgl.Marker({
            draggable: true
        })
        .setLngLat([39.826288, 21.422438])
        .addTo(map);

        // Update selectedLocation when marker is dragged
        marker.on('dragend', onMarkerDragEnd);

        // Add click event to map
        map.on('click', onMapClick);

        // Initialize the geocoder
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: false
        });

        // Add the geocoder to the map
        document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

        // Listen for the 'result' event from the geocoder
        geocoder.on('result', function(e) {
            const coords = e.result.center;
            updateMarkerPosition(coords);
        });
    }

    function onMapClick(e) {
        updateMarkerPosition([e.lngLat.lng, e.lngLat.lat]);
    }

    function onMarkerDragEnd() {
        const lngLat = marker.getLngLat();
        updateMarkerPosition([lngLat.lng, lngLat.lat]);
    }

    function updateMarkerPosition(coords) {
        marker.setLngLat(coords);
        console.log(coords);

        selectedLocation = {
            lng: coords[0],
            lat: coords[1]
        };
        getAddressFromCoordinates(coords);
    }
    function getAddressFromCoordinates(coords) {
        $('#latitude').val(coords[1]);
        $('#longitude').val(coords[0]);
        const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${coords[0]},${coords[1]}.json?access_token=${mapboxgl.accessToken}`;
        fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.features && data.features.length > 0) {
                const address = data.features[0].place_name;
                updateSelectedLocationText(address);
                $('#addressLocation').val(address);
                } else {
                    updateSelectedLocationText('Address not found');
                }
            })
            .catch(error => {
                console.error('Error fetching address:', error);
                updateSelectedLocationText('Error fetching address');
            });
    }
    function updateSelectedLocationText(address) {
        const locationDiv = document.getElementById('selectedLocation');
        if (selectedLocation) {
            locationDiv.textContent = `Selected Location: ${address}`;
        } else {
            locationDiv.textContent = '';
        }
    }


</script>
