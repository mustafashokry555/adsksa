@extends('layout.mainlayout_admin')
@section('title', 'Edit Doctor')
@section('content')
    <div class="page-wrapper">
        <!-- Doctor -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Doctor</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hospitalDoctors.update', $doctor) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en" class="col-form-label col-md-2">Doctor Name EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" value="{{ $doctor->name_en }}"
                                        class="form-control" placeholder="Enter doctor name in EN" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar" class="col-form-label col-md-2">Doctor Name AR</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text" value="{{ $doctor->name_ar }}"
                                        class="form-control" placeholder="Enter doctor name in AR" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">Doctor Email</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" value="{{ $doctor->email }}"
                                        class="form-control" placeholder="Enter doctor email" required>
                                    @error('email')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="D">
                            <!-- Speciality -->
                            <div class="form-group row">
                                <label for="speciality_id" class="col-form-label col-md-2">Speciality</label>
                                <div class="col-md-10">
                                    <select id="speciality_id" name="speciality_id" class="form-select select" required>
                                        <option>-- Select speciality --</option>
                                        @foreach ($specialities as $speciality)
                                            <option value="{{ $speciality->id }}"
                                                {{ old('speciality_id', $doctor->speciality_id) == $speciality->id ? 'selected' : '' }}>
                                                {{ $speciality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('speciality_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- hospital -->
                            <div class="form-group row">
                                <label for="hospital_id" class="col-form-label col-md-2">Hospital</label>
                                <div class="col-md-10">
                                    <select id="hospital_id" name="hospital_id" class="form-select select" required>
                                        <option>-- Select Hospital --</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}"
                                                {{ old('hospital_id', $doctor->hospital_id) == $hospital->id ? 'selected' : '' }}>
                                                {{ $hospital->hospital_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('hospital_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Pricing -->
                            <div class="form-group row">
                                <label for="pricing" class="col-form-label col-md-2">Pricing</label>
                                <div class="col-md-10">
                                    <select id="pricing" name="pricing" class="form-select select" required>
                                        <option>-- Select Fee --</option>
                                        <option value="Free" {{ $doctor->pricing == 'Free' ? 'selected' : '' }}>Free
                                        </option>
                                        <option value="10" {{ $doctor->pricing == '10' ? 'selected' : '' }}>$10
                                        </option>
                                        <option value="20" {{ $doctor->pricing == '20' ? 'selected' : '' }}>$20
                                        </option>
                                        <option value="30" {{ $doctor->pricing == '30' ? 'selected' : '' }}>$30
                                        </option>
                                    </select>
                                    @error('pricing')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="profile_image" class="col-form-label col-md-2">Doctor Image</label>
                                <div class="col-md-10">
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                    @error('profile_image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Doctor Schedule -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h4>Update Doctor Schedule</h4>
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

                                <input type="hidden" name="days[]" value="{{ $i }}">
                            @endfor
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Update
                                Doctor Details
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Doctor -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
