@extends('layout.mainlayout_admin')
@section('title', 'Add New Patient')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.patient.add_new_patient')  }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('patient.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">{{ __('admin.patient.patient_name')  }}/label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                           placeholder="{{ __('admin.patient.enter_patient_name')  }}" required>
                                    @error('name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.patient.patient_email')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="text" class="form-control"
                                           placeholder="{{ __('admin.patient.enter_patient_email')  }}" required>
                                    @error('email')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.patient.patient_mobile')  }}</label>
                                <div class="col-md-10">
                                    <input  name="mobile" type="number" class="form-control"
                                           placeholder="9766443322" required>
                                    @error('mobile')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- type -->
                            <input type="hidden" name="user_type" id="user_type" value="U">
                            <!-- Gender -->
                            <div class="form-group row">
                                <label for="gender" class="col-form-label col-md-2">{{ __('admin.patient.gender')  }}</label>
                                <div class="col-md-10">
                                    <select id="gender" name="gender" class="form-select select" required>
                                        <option>-- Select Gender --</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Others</option>
                                    </select>
                                    @error('gender')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- status --}}
                            <!-- <div class="form-group row">
                                <label for="status" class="col-form-label col-md-2">Status</label>
                                <div class="col-md-10">
                                    <select id="status" name="status" class="form-select select" required>
                                        <option>-- Select Status --</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div> -->
                            <input type="hidden" name="status" id="user_type" value="Active">

                            <!-- Pricing -->
                            <!-- <div class="form-group row">
                                <label for="pricing" class="col-form-label col-md-2">Total Income</label>
                                <div class="col-md-10">
                                    <input id="pricing" name="pricing" type="text" class="form-control"
                                           placeholder="Enter patient total income" required>
                                    @error('pricing')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.patient.password')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="password" type="password" class="form-control"
                                           placeholder="*********">
                                           @error('password')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.patient.confirm_password')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="password_confirmation" type="password" class="form-control"
                                           placeholder="*********">
                                           @error('password_confirmation')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="profile_image" class="col-form-label col-md-2">{{ __('admin.patient.image')  }}</label>
                                <div class="col-md-10">
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                    @error('profile_image')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> {{ __('admin.patient.add_patient')  }}
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
