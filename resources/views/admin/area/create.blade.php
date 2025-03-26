@extends('layout.mainlayout_admin')
@section('title', 'Add New Area')
@section('content')
    <div class="page-wrapper">

        <!-- Area -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Area</h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <form method="POST" action="{{ route('areas.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">Name EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text"
                                        value="{{ old('name_en') }}" class="form-control"
                                        placeholder="Enter Name EN" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar"
                                    class="col-form-label col-md-2">Name AR</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text"
                                        value="{{ old('name_ar') }}" class="form-control"
                                        placeholder="Enter Name AR" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Country -->
                            <div class="form-group row">
                                <label for="country_id"
                                    class="col-form-label col-md-2">Country</label>
                                <div class="col-md-10">
                                    <select id="country_id" name="country_id" class="form-select select" required>
                                        <option value="">-- Select Country --</option>
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
                            <!-- City -->
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
                            <button class="btn btn-primary btn-add">
                                <i class="feather-plus-square me-1"></i>Add New Area
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Area -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>

<script>
    // get cities fun 
    function getCities(countryId) {
        $.ajax({
            url: '{{ route("get.cities") }}', // Define this route in Laravel
            type: 'GET',
            data: { country_id: countryId },    
            success: function (data) {
                $('#city_id').empty(); // Clear the cities dropdown
                $('#city_id').append('<option value="" disabled selected>Select State</option>');
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
                getCities(countryId);
            } else {
                $('#city_id').empty(); // Clear the cities dropdown if no country is selected
                $('#city_id').append('<option value="" disabled selected>Select City</option>');
            }
        });
    });
</script>