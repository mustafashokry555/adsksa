@extends('layout.mainlayout_admin')
@section('title', 'Unavailability Settings')
@section('content')
<div class="page-wrapper">
    <!-- offer -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Unavailability Schedule Timings</h5>
                </div>
                <div class="card-body">
                    @if(session()->has('flash'))
                        <x-alert>{{ session('flash')['message'] }}</x-alert>
                    @endif
                    <form method="POST" action="{{ route('hospital.offer-schedule.unavailability',['offer'=> $offer]) }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="date" class="col-form-label ">Date</label>
                                <input type="date" class="form-control" name="date" id="schedule_date" value="{{old('date')}}">
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <input type="hidden" name="hospital_id" value="{{ $hospital->hospital_id }}"> --}}
                        <div class="submit-section text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /offer -->
</div>
</div>
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
