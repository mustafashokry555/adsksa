@extends('layout.mainlayout_admin')
@section('title', 'Add Degree')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Degree</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('docotr-degree.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en" class="col-form-label col-md-2">Degree Name
                                    EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" class="form-control"
                                        placeholder="Degree Name EN" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar" class="col-form-label col-md-2">Degree Name
                                    AR</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text" class="form-control"
                                        placeholder="Degree Name AR" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Currancy code --}}
                            <div class="form-group row">
                                <label for="code_en" class="col-form-label col-md-2">Degree Code
                                    EN</label>
                                <div class="col-md-10">
                                    <input id="code_en" name="code_en" type="text" class="form-control"
                                        placeholder="Code EN" required>
                                    @error('code_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code_ar" class="col-form-label col-md-2">Degree Code
                                    AR</label>
                                <div class="col-md-10">
                                    <input id="code_ar" name="code_ar" type="text" class="form-control"
                                        placeholder="Code AR" required>
                                    @error('code_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                Add Degree
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
