@extends('layout.mainlayout_admin')
@section('title', 'Edit Hospital Type')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Hospital Type</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hospital-types.update', $hospital_type) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">Name (EN)</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" value="{{ $hospital_type->name_en }}"
                                        class="form-control" placeholder="Name EN"
                                        required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar"
                                    class="col-form-label col-md-2">Name (AR)</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text" value="{{ $hospital_type->name_ar }}"
                                        class="form-control" placeholder="Name AR"
                                        required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image"
                                    class="col-form-label col-md-2">{{ __('admin.hospital.image') }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="image" class="form-control" type="file">
                                    @error('image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                Update Hospital Type
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
