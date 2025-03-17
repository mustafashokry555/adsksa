@extends('layout.mainlayout_admin')
@section('title', 'Add New Religion')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.patient.add_new_patient') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('religions.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en" class="col-form-label col-md-2">Name
                                    EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" class="form-control"
                                        placeholder="Type Name EN" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar" class="col-form-label col-md-2">Name
                                    AR</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text" class="form-control"
                                        placeholder="Type Name AR" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                Add Religion
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
