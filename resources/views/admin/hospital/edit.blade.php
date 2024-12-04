@extends('layout.mainlayout_admin')
@section('title', 'Edit Hospital')
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
                        <h5 class="card-title">{{ __('admin.hospital.edit_hospital') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hospital.update', $hospital) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="hospital_name"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.insurance') }}</label>
                                <div class="col-md-10">
                                    <select id="insurance" name="insurance[]" type="text"
                                        class="form-control js-example-basic-multiple" placeholder="Enter Hospital name"
                                        multiple="multiple" required>


                                        @forelse($insurances as $item)
                                            <option value="{{ $item->id }}"
                                                {{ in_array($item->id, $selectedInsuranceIds) ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
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
                                    <input id="hospital_name_en" name="hospital_name_en" value="{{ $hospital->hospital_name_en }}"
                                        type="text" class="form-control"
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
                                    <input id="hospital_name_ar" name="hospital_name_ar" value="{{ $hospital->hospital_name_ar }}"
                                        type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_hospital_name_ar') }}" required>
                                    @error('hospital_name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Mail -->
                            <div class="form-group row">
                                <label for="mail" class="col-form-label col-md-2">Mail</label>
                                <div class="col-md-10">
                                    <input id="mail" name="mail" value="{{ $hospital->mail ?? '' }}" 
                                        type="email" class="form-control" 
                                        placeholder="Enter Hospital Mail">
                                    @error('mail')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="form-group row">
                                <label for="phone" class="col-form-label col-md-2">Hospital phone</label>
                                <div class="col-md-10">
                                    <input id="phone" name="phone" value="{{ $hospital->phone ?? '' }}" 
                                        type="text" class="form-control" 
                                        placeholder="Enter Hospital phone">
                                    @error('phone')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- WhatsApp -->
                            <div class="form-group row">
                                <label for="whatsapp" class="col-form-label col-md-2">Hospital Whatsapp</label>
                                <div class="col-md-10">
                                    <input id="whatsapp" name="whatsapp" value="{{ $hospital->whatsapp ?? '' }}" 
                                        type="text" class="form-control" 
                                        placeholder="Enter Hospital Whatsapp">
                                    @error('whatsapp')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Facebook -->
                            <div class="form-group row">
                                <label for="facebook" class="col-form-label col-md-2">Hospital Facebook</label>
                                <div class="col-md-10">
                                    <input id="facebook" name="facebook" value="{{ $hospital->facebook ?? '' }}" 
                                        type="text" class="form-control" 
                                        placeholder="Enter Hospital Facebook">
                                    @error('facebook')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Instagram -->
                            <div class="form-group row">
                                <label for="instagram" class="col-form-label col-md-2">Hospital Instagram</label>
                                <div class="col-md-10">
                                    <input id="instagram" name="instagram" value="{{ $hospital->instagram ?? '' }}" 
                                        type="text" class="form-control" 
                                        placeholder="Enter Hospital Instagram">
                                    @error('instagram')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- TikTok -->
                            <div class="form-group row">
                                <label for="tiktok" class="col-form-label col-md-2">Hospital Tiktok</label>
                                <div class="col-md-10">
                                    <input id="tiktok" name="tiktok" value="{{ $hospital->tiktok ?? '' }}" 
                                        type="text" class="form-control" 
                                        placeholder="Enter Hospital Tiktok">
                                    @error('tiktok')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.location') }}</label>
                                <div class="col-md-10">
                                    <input id="address" name="address" value="{{ $hospital->address }}" type="text"
                                        class="form-control" placeholder="{{ __('admin.hospital.enter_location') }}"
                                        required>
                                    @error('address')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.city') }}</label>
                                <div class="col-md-10">
                                    <input id="city" name="city" type="text" value="{{ $hospital->city }}"
                                        class="form-control" placeholder="{{ __('admin.hospital.enter_city') }}" required>
                                    @error('city')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.country') }}</label>
                                <div class="col-md-10">
                                    <input id="country" name="country" value="{{ $hospital->country }}" type="text"
                                        class="form-control" placeholder="{{ __('admin.hospital.enter_country') }}"
                                        required>
                                    @error('country')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.state') }}</label>
                                <div class="col-md-10">
                                    <input id="state" name="state" type="text" value="{{ $hospital->state }}"
                                        class="form-control" placeholder="{{ __('admin.hospital.enter_state') }}" required>
                                    @error('state')
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
                                    <input id="zip" name="zip" type="text" value="{{ $hospital->zip }}"
                                        class="form-control" placeholder="{{ __('admin.hospital.enter_hospital_zip') }}"
                                        required>
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
                                    <input type="hidden" id="addressLocation" required name="location">
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
                                    <input id="image" name="image" class="form-control" type="file">
                                    @error('image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Display existing images -->
                            <div class="form-group row">
                                <label for="existing_images" class="col-form-label col-md-2">Profile Images</label>
                                <div class="col-md-10">
                                    @if($hospital->profile_images)
                                        @foreach($hospital->profile_images as $index => $image)
                                            <div class="d-inline-block position-relative" id="image-{{ $index }}">
                                                {{-- <p>{{ $image }}</p> --}}
                                                <img src="{{ $hospital->images_links[$index] }}" alt="Profile Image" class="img-thumbnail" style="width: 150px; height: 150px; margin-right: 10px;">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="removeImage({{ $index }}, '{{ $image }}')">X</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No Images Found</p>
                                    @endif
                                </div>
                            </div>
                            <!-- JavaScript for removing images -->
                            <script>
                                function removeImage(index, image) {
                                    if (confirm("Are you sure you want to delete this image?")) {
                                        // Add the image to the hidden field for deletion
                                        document.getElementById('deletedImages').value += image + ',';

                                        // Remove the image from the DOM
                                        var imageElement = document.getElementById('image-' + index);
                                        if (imageElement) {
                                            imageElement.remove();
                                        }
                                    }
                                }
                            </script>
                            <input type="hidden" id="deletedImages" name="deletedImages" value="">
                            <!-- Upload new images -->
                            <div class="form-group row">
                                <label for="profile_images" class="col-form-label col-md-2">Images</label>
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
                                        value="{{ $admin->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.hospital_administrator_email') }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" class="form-control"
                                        value="{{ $admin->email }}"
                                        placeholder="{{ __('admin.hospital.enter_hospital_administrator_email') }}">
                                    @error('email')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="about" class="col-form-label col-md-2">About Hospital 1</label>
                                <div class="col-md-10">
                                    <textarea id="about" name="about" type="text" class="form-control" placeholder="About The Hospital">{{ $hospital->about }}</textarea>
                                    @error('about')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="about1" class="col-form-label col-md-2">About Hospital 2</label>
                                <div class="col-md-10">
                                    <textarea id="about1"  name="about1" type="text" class="form-control" placeholder="About The Hospital">{{ $hospital->about1 }}</textarea>
                                    @error('about1')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="about2" class="col-form-label col-md-2">About Hospital 3</label>
                                <div class="col-md-10">
                                    <textarea id="about2"  name="about2" type="text" class="form-control" placeholder="About The Hospital">{{ $hospital->about2 }}</textarea>
                                    @error('about2')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="opening_hours" class="col-form-label col-md-2">Opening Hours</label>
                                <div class="col-md-10">
                                    <input id="opening_hours" value="{{ $hospital->opening_hours }}" name="opening_hours" type="text" class="form-control"
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
                                        placeholder="*********">
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
                                        class="form-control" placeholder="*********">
                                    @error('password_confirmation')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                {{ __('admin.hospital.update_hospital') }}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        mapboxgl.accessToken = 'pk.eyJ1IjoiZW0yMDAwMTExIiwiYSI6ImNsajRrcXlicjA0MjMza3F6YjI5eW5pN2IifQ.bY21DI8kEvlV7z97OKlJJA';
        initMap();
    });
    let map;
    let marker;
    let selectedLocation = null;

    function initMap() {
        const initialCoords = [
            {{ $hospital->long ?? 39.826288 }}, // Default longitude (e.g., Kaaba)
            {{ $hospital->lat ?? 21.422438 }}  // Default latitude (e.g., Kaaba)
        ];
        currentLat = {{ $hospital->lat ?? null }};
        currentLong = {{ $hospital->long ?? null }};
        currentLocation = "{{ $hospital->location ?? null }}";
        if (currentLat != null && currentLong != null && currentLocation != null ) {
            $('#latitude').val(currentLat);
            $('#longitude').val(currentLong);
            $('#addressLocation').val(currentLocation);
        }
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: initialCoords,
            zoom: 5
        });

        // Add navigation control (zoom in/out buttons)
        map.addControl(new mapboxgl.NavigationControl(), 'top-right');

        // Initialize marker
        marker = new mapboxgl.Marker({
            draggable: true
        })
        .setLngLat(initialCoords)
        .addTo(map);

        // Set the initial text under the map if the hospital's location exists
        const initialLocation = '{{ $hospital->location ?? "Please Select A Hospital Location" }}';
        document.getElementById('selectedLocation').textContent = `Selected Location: ${initialLocation}`;
        

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
