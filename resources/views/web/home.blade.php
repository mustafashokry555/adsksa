@extends('web.layout.layout')
@section('content')
    <style>
        .search_bar {
            display: flex;
            gap: 10px;
            padding: 10px;
            border: 1px solid;
            border-radius: 9px;
            align-items: end;
        }

        .search_bar .drop_down_wrap .dropdown {
            background: transparent;
        }

        .search_bar .drop_down_wrap {
            padding: 5px;
            /* border: 1px solid; */
            border-radius: 5px;
            width: 20%;
            padding-bottom: 0px;
        }

        .drop_down_wrap input {
            width: 100%;
        }

        .search_bar .drop_down_wrap .dropdown button {
            background: transparent;
            color: #000;
            padding: 0px;
            border: 0px;
        }

        .search_bar .drop_down_wrap .dropdown button:focus {
            outline: none;
            box-shadow: none;
        }

        .btn_search {
            flex: 1;
            background-color: #1aeebe;
            border: 0px;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            font-size: 17px;
            font-weight: 500;
        }

        .main-menu-wrapper {
            margin-left: 391px;
        }
    </style>
    <section class="home" style="margin: 50px 0 0 0;">
        <div class="content" style="min-height: 273.9px; height: 40vh;;">
            <div class="container-fluid">
                <div class="row " style="display: flex; justify-content: center;">
                    <div class="col-md-12 mx-auto">
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-12 col-md-12">
                                    <div class="home-four-doctor">
                                        <div class="home-four-header">
                                            <!-- <h2 style="color: #272b41">{{ __('web.Search Doctor, Make an') }} <span>{{ __('web.Appointment') }}</span></h2> -->
                                            <h2 style="color: #009eff">{{ __('Find Doctor') }} <span
                                                    style="color: #12b3ab">{{ __('make an ') }}<span
                                                        style="color: #1aeebe">{{ __('web.Appointment') }}</span></h2>
                                        </div>
                                        <form method="GET" action="{{ route('single_search_doctor') }}"
                                            class="banner-four-search">
                                            <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="search_bar"
                                                style="background-color:white">
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Enter_country') }}</label>
                                                    <div class="dropdown">
                                                        <select id="countrySelect" name="country"
                                                            class="select form-control">
                                                            <option selected disabled>{{ __('web.Enter_country') }}</option>
                                                            <option value='all'>{{ __('web.All') }}</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Enter State') }}</label>
                                                    <div class="dropdown">
                                                        <select id="stateSelect" name="state" class="select form-control">
                                                            <option selected disabled>{{ __('web.Enter State') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Enter City') }}</label>
                                                    <div class="dropdown">
                                                        <select id="citySelect" name="city" class="select form-control">
                                                            <option selected disabled>{{ __('web.Enter City') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Select a Insurance') }}</label>
                                                    <div class="dropdown">
                                                        <select id="insuranceSelect" name="insurance"
                                                            class="select form-control">
                                                            <option selected disabled>{{ __('web.Select a Insurance') }}
                                                            </option>
                                                            <option value='all'>{{ __('web.All') }}</option>
                                                            @foreach ($insurances as $insurance)
                                                                <option value="{{ $insurance->id }}">
                                                                    {{ $insurance->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Select a specility') }}</label>
                                                    <div class="dropdown">
                                                        <select id="specialitySelect" name="speciality"
                                                            class="select form-control">
                                                            <option selected disabled>{{ __('web.Select a specility') }}
                                                            </option>
                                                            <option value='all'>{{ __('web.All') }}</option>
                                                            @foreach ($specialities as $speciality)
                                                                <option value="{{ $speciality->id }}">
                                                                    {{ $speciality->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <button class="btn_search">{{ __('web.Search') }}</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session()->has('flash'))
        <x-alert>{{ session('flash')['message'] }}</x-alert>
    @endif

    <script>
        // Add event listener for country select
        document.getElementById('countrySelect').addEventListener('change', function() {
            loadStates(this.value);
            loadCities(this.value, null);
        });

        // Add event listener for country select
        document.getElementById('stateSelect').addEventListener('change', function() {
            loadCities(null, this.value);
        });

        // Load all cities when document is ready
        document.addEventListener('DOMContentLoaded', function() {
            loadStates();
            loadCities();
        });

        async function loadStates(countryId = null) {
            const stateSelect = document.getElementById('stateSelect');

            // Reset the state dropdown
            stateSelect.innerHTML = `
                <option selected disabled>${'{{ __('web.Enter State') }}'}</option>
                <option value="all">${'{{ __('web.All') }}'}</option>
            `;

            try {
                // Build the URL based on whether we have a countryId
                const url = countryId ?
                    `/get-states?country_id=${countryId}` :
                    '/get-states'; // Endpoint for all cities

                const response = await fetch(url);
                const data = await response.json();

                // Enable the state select and add the options
                stateSelect.disabled = false;
                data.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                });
            } catch (error) {
                console.error('Error loading cities:', error);
                stateSelect.disabled = true;
            }
        }

        async function loadCities(countryId = null, stateId = null) {

            const citySelect = document.getElementById('citySelect');

            // Reset the state dropdown
            citySelect.innerHTML = `
                <option selected disabled>${'{{ __('web.Enter City') }}'}</option>
                <option value="all">${'{{ __('web.All') }}'}</option>
            `;

            try {
                var url = null;
                if (stateId) {
                    url = `/get-cities?state_id=${stateId}`;
                } else {
                    if (countryId) {
                        url = `/get-cities?country_id=${countryId}`;
                    } else {
                        url = `/get-cities`;
                    }
                }

                const response = await fetch(url);
                const data = await response.json();

                // Enable the state select and add the options
                citySelect.disabled = false;
                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            } catch (error) {
                console.error('Error loading cities:', error);
                citySelect.disabled = true;
            }
        }
    </script>
@endsection
