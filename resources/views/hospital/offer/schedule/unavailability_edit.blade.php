@extends('layout.mainlayout_hospital')
@section('title', 'Unavailability Settings')
@section('content')
<div class="col-md-7 col-lg-8 col-xl-9">
    <div class="page-header p-8 m-2">
        <div class="row align-items-center">
            <div class="col-md-12 d-flex justify-content-end">
                <div class="doc-badge me-3"></div>
            </div>
        </div>
    </div>
    @if(session()->has('flash'))
        <x-alert>{{ session('flash')['message'] }}</x-alert>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __('hospital.doctor.unavailability_schedule_timings')  }}</h5>
                </div>
                <div class="card-body">
                    @php
                        $availability = $offer->unavailailities->first();
                    @endphp
                    <form method="POST" action="{{ route('hospital.offer-schedule.unavailability.update',['offer'=> $offer, 'date' => $date]) }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="date" class="col-form-label ">{{ __('hospital.doctor.date')  }}</label>
                                <input type="date" class="form-control" name="date"
                                id="schedule_date" value="{{old('date', $date)}}">
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="hospital_id" value="{{ $hospital->hospital_id }}">
                        <div class="submit-section text-center">
                            <button type="submit" class="btn btn-primary submit-btn">{{ __('hospital.doctor.save_changes')  }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- </div>

    </div>

    </div> --}}
    {{-- /Page Content  --}}
    {{-- </div> --}}
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    $('#schedule_date').datepicker({
        minDate: 0,
        dateFormat: "dd-mm-yy"
    });
});
</script>
@endpush
