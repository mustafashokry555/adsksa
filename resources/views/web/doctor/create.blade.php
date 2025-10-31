<?php $page = 'index-13'; ?>
{{-- @extends('layout.mainlayout_index1') --}}
@extends('web.layout.layout')
@section('title', 'Make Appointment')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/pick-hours-availability-calendar/css/mark-your-calendar.css') }}">
@endpush
@section('main-content')
    {{-- @section('content') --}}
    <!-- Header -->
    {{-- @include('components.patient_header') --}}
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="create-appointment">
        <!-- Page Content -->
        <div class="content">
            <div class="container">
                <div class="row" id="slots-section">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="booking-doc-info mb-3">
                                    <a href="{{ route('doctor_profile', $doctor->id) }}" class="booking-doc-img">
                                        @if ($doctor->profile_image ?? '')
                                            <img src="{{ asset($doctor->profile_image) }}" alt="User Image">
                                        @else
                                            <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                                alt="User Image">
                                        @endif
                                    </a>
                                    <div class="booking-info">
                                        <h4>
                                            <a href="{{ route('doctor_profile', $doctor->id) }}">Dr. {{ $doctor->name }}</a>
                                        </h4>
                                        ({{ $doctor?->hospital?->hospital_name }})
                                        <div class="rating">
                                            @php
                                                $reviews = App\Models\Review::query()
                                                    ->where('doctor_id', $doctor->id)
                                                    ->get();
                                                $review_sum = App\Models\Review::where('doctor_id', $doctor->id)->sum(
                                                    'star_rated',
                                                );
                                                if ($reviews->count() > 0) {
                                                    $review_value = $review_sum / $reviews->count();
                                                } else {
                                                    $review_value = 0;
                                                }
                                            @endphp
                                            @php
                                                $rat_num = number_format($review_value);
                                            @endphp
                                            @for ($i = 1; $i <= $rat_num; $i++)
                                                <i class="fas fa-star filled"></i>
                                            @endfor
                                            @for ($j = $rat_num; $j < 5; $j++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            <span class="d-inline-block average-rating">{{ $reviews->count() }}</span>
                                        </div>
                                        @if ($doctor->address)
                                            <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i>
                                                {{ $doctor->address }},
                                                {{ $doctor->country ? $doctor->country->name : '' }}
                                                ,
                                                {{ $doctor->state ? $doctor->state->name : '' }}
                                                ,
                                                {{ $doctor->city ? $doctor->city->name : '' }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <h4 class="card-title">Make Appointment</h4>

                                <div class="profile-box">
                                    @foreach ($errors->all() as $message)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @endforeach
                                    <form action="{{ route('store_appointment') }}" method="POST" id="app-form">
                                        @csrf
                                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                        <input type="hidden" name="patient_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="hospital_id" value="{{ $doctor->hospital_id }}">
                                        <input type="hidden" name="status" value="P">
                                        {{-- <input type="hidden" id="selected_slot" name="selected_slot" value=""> --}}
                                        <div class="forinputs">
                                            <div class="row">
                                                <div class="col-sm-6 col-12 avail-time">
                                                    <div class="mb-3">
                                                        <div
                                                            class="d-flex flex-wrap schedule-calendar-col justify-content-start">

                                                            <span class="input-group-text">Insurance</span>
                                                            <div class="me-3">
                                                                <select type="button" name="insurance_id" value="Search"
                                                                    class="form-control">
                                                                    <option value="">--Select insurance--</option>
                                                                    @forelse($insurances as $insurance)
                                                                        <option value="{{ $insurance->id }}">
                                                                            {{ $insurance->name }}</option>
                                                                    @empty
                                                                    @endforelse


                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-12 avail-time">
                                                    <div class="mb-3">
                                                        <div
                                                            class="d-flex flex-wrap schedule-calendar-col justify-content-start">

                                                            <span class="input-group-text">Date:</span>
                                                            <div class="me-3">
                                                                <input type="text" class="form-control"
                                                                    name="schedule_date" id="schedule_date"
                                                                    value="{{ old('schedule_date', \Carbon\Carbon::now(auth()->user()->timezone)->format('d/m/Y')) }}"
                                                                    min="<?php echo date('Y-m-d'); ?>">
                                                            </div>
                                                            <div class="search-time-mobile">
                                                                <input type="button" name="submit"
                                                                    id="search_availability" value="Search"
                                                                    class="btn btn-primary h-100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="token-slot mt-2" id="slots-wrapper"></div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="submit-section proceed-btn text-end mt-3">
                                            <button type="submit" class="btn btn-primary submit-btn next">NEXT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /Page Content -->
    </section>
    <!-- /Page Content -->

@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pick-hours-availability-calendar/js/mark-your-calendar.js') }}"></script>
    <script>
        var renderSlots = function(slots = []) {
            var html = ``;
            $.each(slots, function(idx, val) {
                var dateTime = moment(val).format("YYYY-MM-DD HH:mm");
                html += "<div class='form-check-inline visits m-1 mb-0'>\
                                        <label class='visit-btns'>\
                                            <input id='token_data' type='radio' class='form-check-input' data-date='" +
                    moment(
                        val)
                    .format(
                        "YYYY-MM-DD") + "' data-timezone=''\
                                            data-start-time='" + moment(val).format("YYYY-MM-DD HH:mm") +
                    "' data-session='1' name='selected_slot' value='" + moment(val).format("YYYY-MM-DD HH:mm") + "'>\
                                            <span class='visit-rsn' data-bs-toggle='tooltip' data-bs-original-title='" +
                    moment(
                        val)
                    .format("hh:mm A") + "'>" + moment(val).format("hh:mm A") + "</span>\
                                        </label>\
                                    </div>";
                // console.log(val, dateTime);
            });
            $('#slots-wrapper').html(html);
            // $('#selected_slot').val(selectedSlot);
        }
    </script>
    <script>
        var getAvailablity = function(date) {
            if (!date) {
                return false;
            }

            var formatedDate = moment(date, "DD/MM/YYYY").format("YYYY-MM-DD");
            $.ajax({
                url: "{{ route('get_availability', $doctor->id) }}",
                method: "GET",
                data: {
                    selectedDate: encodeURI(formatedDate),
                },
                success: function(resp) {
                    // console.log('resp',resp);
                    if (resp.status == "success") {
                        if (!resp.data.length) {
                            $("#slots-wrapper").html("<h3>Not Available</h3>");
                            return false;
                        }
                        renderSlots(resp.data);
                    }
                    if (resp.status == "error") {
                        $("#slots-wrapper").html("<h3>" + resp.message + "</h3>");
                        return false;
                    }
                },
                error: function(err) {
                    console.log('err', err);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {

            // $('.slots-section')
            // $('#payment-form')

            // $('.next').click(function(e) {
            //     e.preventDefault();
            //     $('.forinputs').hide();
            //     $('#payment-form').show();
            //     $(this).hide();
            // })

            // $(document).on('click', '.submit', function() {
            //     alert("skjdhfkj");
            //     $('.profile-box').show();
            //     // setTimeout(function () {
            //     $('.app-form').submit();
            //     // },1000)
            // });


            var searchBtn = $("#search_availability");
            var dateInput = $("#schedule_date");
            var slotsWrapper = $("#slots-wrapper");

            searchBtn.on("click", function(e) {
                e.stopPropagation();
                getAvailablity(dateInput.val());

            });

            $("#schedule_date").datepicker({
                minDate: 0,
                dateFormat: "dd/mm/yy"
            });
            getAvailablity(dateInput.val());
        });
    </script>
@endpush
