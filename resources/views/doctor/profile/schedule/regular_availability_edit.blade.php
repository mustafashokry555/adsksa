@extends('layout.mainlayout_hospital')
@section('title', 'Schedule Settings')
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/libs/tempus-dominus/css/tempus-dominus.css')}}">
@endpush
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
                    <h5 class="card-title">{{ucfirst($weekDay)}} Schedule Timings</h5>
                </div>
                <div class="card-body">
                    @php
                        $availability = $doctor->regularAvailabilities->first();
                    @endphp
                    <form method="POST" action="{{ route('doctor.doctor-schedule.regular.update',['doctor'=> $doctor, 'week_day' => $weekDay]) }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="time_interval" class="col-form-label ">Time Interval <small>(mints)</small></label>
                                <input id="time_interval" name="time_interval" type="number" value="{{old('time_interval', $availability->time_interval)}}" class="form-control">
                                @error('time_interval')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="hours-info">
                                    @if ($errors->has('slots.*.start_time') || $errors->has('slots.*.end_time'))
                                    @foreach (old('slots') as $idx => $old)
                                    <div class="row form-row hours-cont">
                                        <div class="col-12 col-md-10">
                                                <div class="row form-row" data-idx="{{$idx}}">
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group" style="position: relative;">
                                                            <label>Start Time</label>
                                                            <input type="time" class="form-control time" id="start_time_{{$idx}}"
                                                            name="slots[{{$idx}}][start_time]" value="{{old('slots.'.$idx.'.start_time')}}">
                                                            @error('slots.'.$idx.'.start_time')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>End Time</label>
                                                            <input type="time" class="form-control time" id="end_time_{{$idx}}"
                                                            name="slots[{{$idx}}][end_time]" value="{{old('slots.'.$idx.'.end_time')}}">
                                                            @error('slots.'.$idx.'.end_time')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($idx > 0)
                                            <!-- <div class="col-12 col-md-2">
                                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>
                                            </div> -->
                                            @endif
                                        </div>
                                            @endforeach
                                            @else
                                            @foreach ( $availability->slots as $idx => $item)
                                            <div class="row form-row hours-cont">
                                                <div class="col-12 col-md-10">
                                                    <div class="row form-row" data-idx="{{$idx}}">
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group date">
                                                                <label>Start Time</label>
                                                                <input type="time" class="form-control time"
                                                                id="start_time_{{$idx}}" name="slots[{{$idx}}][start_time]" value="{{$item['start_time']}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group date">
                                                                <label>End Time</label>
                                                                <input type="time" class="form-control time" id="end_time_{{$idx}}"
                                                                name="slots[{{$idx}}][end_time]" value="{{$item['end_time']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($idx > 0)
                                            <!-- <div class="col-12 col-md-2">
                                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>
                                            </div> -->
                                            @endif
                                            </div>

                                            @endforeach
                                            @endif
                                </div>

                                <!-- <div class="add-more mb-3">
                                    <a href="javascript:void(0);" class="add-slots"><i class="fa fa-plus-circle"></i> Add More</a>
                                </div> -->
                            </div>
                        </div>
                        <input type="hidden" name="weekDay" value="{{ $weekDay }}">
                        <div class="submit-section text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
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
<script src="{{asset('assets/libs/tempus-dominus/js/tempus-dominus.min.js')}}"></script>
<script src="{{asset('assets/libs/tempus-dominus/js/jQuery-provider.min.js')}}"></script>
<script>
    var idx = $('.hours-cont').last().find(".row.form-row").first().data("idx");
    idx++;
</script>
<script>
$(".add-slots").on('click', function () {
    var hourscontent = '<div class="row form-row hours-cont">' +
    '<div class="col-12 col-md-10">' +
        '<div class="row form-row">' +
            '<div class="col-12 col-md-6">' +
                '<div class="form-group date">' +
                    '<label>Start Time</label>' +
                    '<input type="time" class="form-control time" id="start_time_'+idx+'" name="slots['+idx+'][start_time]">'+
                '</div>' +
            '</div>' +
            '<div class="col-12 col-md-6">' +
                '<div class="form-group date">' +
                    '<label>End Time</label>' +
                    '<input type="time" class="form-control time" id="end_time_'+idx+'" name="slots['+idx+'][end_time]">'+
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>' +
    '<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
'</div>';
    // $(hourscontent).find('.time').each(function(idx, obj){
    //     $(obj).tempusDominus({});
    // });
    $(".hours-info").append(hourscontent);
    idx++;
    return false;
});
$(".hours-info").on('click','.trash', function (e) {
    e.preventDefault();
	$(this).closest('.hours-cont').remove();
	// idx--;
    return false;
});
</script>
<script>
    $(document).ready(function(){
        // $(".time").tempusDominus({
            // display: {
            //     viewMode: 'clock',
            //     components: {
            //         calendar: false,
            //         date: false,
            //         month: false,
            //         year: false,
            //         decades: false,
            //         clock: true,
            //         hours: true,
            //         minutes: true,
            //         seconds: false,
            //         useTwentyfourHour: false
            //     }
            // }
        // });
    });
</script>
@endpush
