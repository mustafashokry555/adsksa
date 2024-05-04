@extends('layout.mainlayout_hospital')
@section('title', 'Edit Profile')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">

                        <!-- Change Password Form -->
                        <form method="POST" action="{{ route('store_new_password') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('hospital.profile.old_password')  }}</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ __('hospital.profile.new_password')  }}</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ __('hospital.profile.update_profile')  }}</label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">{{ __('hospital.profile.save_new_password')  }}</button>
                            </div>
                        </form>
                        <!-- /Change Password Form -->

                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
