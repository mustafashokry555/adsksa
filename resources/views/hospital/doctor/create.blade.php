@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Doctors')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('hospital.doctor.add_new_doctor')  }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">{{ __('hospital.doctor.doctor_name')  }}</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                        placeholder="{{ __('hospital.doctor.enter_doctor_name')  }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('hospital.doctor.doctor_email')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="text" class="form-control"
                                        placeholder="{{ __('hospital.doctor.enter_doctor_email')  }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="D">
                            <!-- Speciality -->
                            <div class="form-group row">
                                <label for="speciality_id" class="col-form-label col-md-2">{{ __('hospital.doctor.speciality')  }}</label>
                                <div class="col-md-10">
                                    <select id="speciality_id" name="speciality_id" class="form-select select" required>
                                        <option>-- Select speciality --</option>
                                        @foreach ($specialities as $speciality)
                                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('speciality_id')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- gender -->
                            <div class="form-group row">
                                <label for="speciality_id" class="col-form-label col-md-2">{{ __('hospital.doctor.gender')  }}</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select" required>
                                        <option>-- Select Gender --</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Others</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="form-row row">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2" for="address">{{ __('hospital.doctor.address')  }}</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="{{ __('hospital.doctor.enter_address')  }}" required>
                                        @error('address')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="country">{{ __('hospital.doctor.country')  }}</label>
                                    <input type="text" class="form-control" id="country" placeholder="{{ __('hospital.doctor.country')  }}"
                                        name="country">
                                    @error('country')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">{{ __('hospital.doctor.state')  }}</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="{{ __('hospital.doctor.state')  }}">
                                    @error('state')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip_code">{{ __('hospital.doctor.zip_code')  }}</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        placeholder="{{ __('hospital.doctor.zip_code')  }}">
                                    @error('zip_code')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- hospital -->
                            <input type="hidden" name="hospital_id" value="{{ auth()->user()->hospital_id }}">
                            <!-- Pricing -->
                            <div class="form-group row">
                                <label for="pricing" class="col-form-label col-md-2">{{ __('hospital.doctor.pricing')  }}</label>
                                <div class="col-md-10">
                                <input type="number" class="form-control" id="zip_code" name="pricing"
                                        placeholder="{{ __('hospital.doctor.enter_price')  }}">
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="profile_image" class="col-form-label col-md-2">{{ __('hospital.doctor.doctor_image')  }}</label>
                                <div class="col-md-10">
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                </div>
                            </div>

                            {{-- password --}}
                            <div class="form-group row">
                                <label for="password" class="col-form-label col-md-2">{{ __('hospital.doctor.password')  }}</label>
                                <div class="col-md-10">
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="*********" required>
                                </div>
                            </div>

                            {{-- confirm password --}}
                            <div class="form-group row">
                                <label for="password" class="col-form-label col-md-2">{{ __('hospital.doctor.confirm_password')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="password_confirmation" type="password"
                                        class="form-control" placeholder="*********" required>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger pt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Doctor Schedule -->
                            <!-- <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h4>Add Doctor Schedule</h4>
                                </div>
                            </div>
                            @for ($i = 0; $i <= 6; $i++)
                                <div class="form-row row">
                                    <div class="col-md-6 mb-3">
                                        <label for="from">Day</label>
                                        <input type="text" class="form-control" value="{{ \App\Commons::Days[$i] }}"
                                            readonly>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    @if ($doctor->schedules[$i]->from ?? '')
                                        <div class="col-md-3 mb-3">
                                            <label for="from">From</label>
                                            <input type="time" class="form-control" id="from" name="from[]"
                                                value="{{ $doctor->schedules[$i]->from }}">
                                        </div>
                                    @else
                                        <div class="col-md-3 mb-3">
                                            <label for="from">From</label>
                                            <input type="time" class="form-control" id="from" name="from[]">
                                        </div>
                                    @endif
                                    @if ($doctor->schedules[$i]->to ?? '')
                                        <div class="col-md-3 mb-3">
                                            <label for="to">To</label>
                                            <input type="time" class="form-control" id="to" name="to[]"
                                                value="{{ $doctor->schedules[$i]->to }}">
                                        </div>
                                    @else
                                        <div class="col-md-3 mb-3">
                                            <label for="to">To</label>
                                            <input type="time" class="form-control" id="to" name="to[]">
                                        </div>
                                    @endif
                                </div>
                                <input type="hidden" name="days[]" value="{{ \App\Commons::Days[$i] }}">
                            @endfor -->
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> {{ __('hospital.doctor.add_doctor')  }}
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
