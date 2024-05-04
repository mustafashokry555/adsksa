@extends('layout.mainlayout_hospital')
@section('title', 'Schedule Settings')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="page-header p-8 m-2">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Time Interval
                            @if($setting->time_interval ?? '')
                            <span class="ms-1">{{ $setting->time_interval }} min</span>
                            @else
                            <span class="ms-1">No Record</span>
                            @endif
                        </div>
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
                        <h5 class="card-title">Add or Update Time Interval</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store_schedule_settings') }}">
                            @csrf
{{--                            @if($setting->time_interval ?? '')--}}
{{--                                @method('patch')--}}
{{--                            @endif--}}
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="time_interval" class="col-form-label col-md-2">Time Interval</label>
                                <div class="col-md-8">
                                    @if($setting->time_interval ?? '')
                                    <input id="time_interval" name="time_interval" type="number" value="{{ $setting->time_interval }}" class="form-control">
                                    @else
                                    <input id="time_interval" name="time_interval" type="number" class="form-control"
                                           placeholder="Enter time interval in minutes between appointments">
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="hospital_id" value="{{ auth()->user()->hospital_id }}">
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add Time interval
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
