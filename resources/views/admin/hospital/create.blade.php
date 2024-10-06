@extends('layout.mainlayout_admin')
@section('title', 'Add New Hospital')
@section('content')

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
                            <div class="form-group row">
                                <label for="city"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.city') }}</label>
                                <div class="col-md-10">
                                    <input id="city" name="city" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_city') }}" required>
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
                                    <input id="country" name="country" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_country') }}" required>
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
                                    <input id="state" name="state" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_state') }}" required>
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
                                    <input id="zip" name="zip" type="text" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_hospital_zip') }}" required>
                                    @error('zip')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location"
                                    class="col-form-label col-md-2">location</label>
                                <div class="col-md-10">
                                    <input id="pac-input" dir="rtl" name="location" type="text" class="form-control"
                                        placeholder="location" style="background-color: #fff; color:black" required>
                                    <div id="map"style="height: 500px; " class="form-control"></div>
                                    @error('location')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
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
                                <label for="email"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.hospital_administrator_name') }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" class="form-control"
                                        placeholder="{{ __('admin.hospital.enter_hospital_administrator_name') }}"
                                        required>
                                    @error('email')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
<script>
    $("#pac-input").focusin(function() {
        $(this).val('');
    });

    $('#latitude').val('');
    $('#longitude').val('');


    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 30.209095839506176,
                lng: 31.219282979077857 
            },
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        // move pin and current location
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(pos),
                    map: map,
                    title: 'موقعك الحالي'
                });
                markers.push(marker);
                marker.addListener('click', function() {
                    geocodeLatLng(geocoder, map, infoWindow, marker);
                });
                // to get current position address on load
                google.maps.event.trigger(marker, 'click');
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            console.log('dsdsdsdsddsd');
            handleLocationError(false, infoWindow, map.getCenter());
        }

        var geocoder = new google.maps.Geocoder();
        google.maps.event.addListener(map, 'click', function(event) {
            SelectedLatLng = event.latLng;

            geocoder.geocode({
                'latLng': event.latLng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        deleteMarkers();
                        addMarkerRunTime(event.latLng);
                        SelectedLocation = results[0].formatted_address;
                        console.log(results[0].formatted_address);
                        var cordinations = splitLatLng(String(event.latLng));
                        // console.log(cordinations);
                        // console.log($("#longitude").val());
                        $("#pac-input").val(results[0].formatted_address);
                    }
                }
            });
        });

        function geocodeLatLng(geocoder, map, infowindow, markerCurrent) {
            var latlng = {
                lat: markerCurrent.position.lat(),
                lng: markerCurrent.position.lng()
            };
            /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
            $('#latitude').val(markerCurrent.position.lat());
            $('#longitude').val(markerCurrent.position.lng());

            geocoder.geocode({
                'location': latlng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setZoom(8);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        markers.push(marker);
                        infowindow.setContent(results[0].formatted_address);
                        SelectedLocation = results[0].formatted_address;
                        $("#pac-input").val(results[0].formatted_address);

                        infowindow.open(map, marker);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
            SelectedLatLng = (markerCurrent.position.lat(), markerCurrent.position.lng());
        }

        function addMarkerRunTime(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }

        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        function clearMarkers() {
            setMapOnAll(null);
        }

        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        // $("#pac-input").val("أبحث هنا ");
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(100, 100),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));


                $('#latitude').val(place.geometry.location.lat());
                $('#longitude').val(place.geometry.location.lng());

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

    function splitLatLng(latLng) {
        var newString = latLng.substring(0, latLng.length - 1);
        var newString2 = newString.substring(1);
        var trainindIdArray = newString2.split(',');
        var lat = trainindIdArray[0];
        var Lng = trainindIdArray[1];

        $("#latitude").val(lat);
        $("#longitude").val(Lng);
        var cordinations = { lat: lat, lng: Lng };
        return cordinations
    }
</script>
<script src="https://maps.gomaps.pro/maps/api/js?key=AlzaSy-3tB5867_WHmOPY60IqX5tIwWvoyLik0m&libraries=places&callback=initAutocomplete&language=AR&region=EG&loading=async"></script>
