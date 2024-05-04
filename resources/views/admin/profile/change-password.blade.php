@extends('layout.mainlayout_admin')
@section('title', 'Edit Profile')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">

                        <!-- Change Password Form -->
                        <form method="POST" action="{{ route('store_new_password') }}">
                            @csrf
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save New Password</button>
                            </div>
                        </form>
                        <!-- /Change Password Form -->

                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

@endsection
