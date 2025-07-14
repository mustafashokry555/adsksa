@extends('layout.mainlayout_admin')
@section('title', 'Add Currency')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Currency</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('currency.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en" class="col-form-label col-md-2">Currency Name
                                    EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" class="form-control"
                                        placeholder="Currency Name EN" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar" class="col-form-label col-md-2">Currency Name
                                    AR</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text" class="form-control"
                                        placeholder="Currency Name AR" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Currancy code --}}
                            <div class="form-group row">
                                <label for="code_en" class="col-form-label col-md-2">Currency Code
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
                                <label for="code_ar" class="col-form-label col-md-2">Currency Code
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

                            <!--  Image -->
                            <div class="form-group row">
                                <label for="icon"
                                    class="col-form-label col-md-2">Icon</label>
                                <div class="col-md-10">
                                    <input id="icon" name="icon" class="form-control" type="file"
                                        >
                                    @error('icon')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                Add Currency
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
