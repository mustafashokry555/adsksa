@extends('layout.mainlayout_admin')
@section('title', 'Insurances')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.insurance.edit_insurance')}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('insurances.update', $insurance) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2"> {{ __('admin.insurance.name')}}</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                           placeholder="{{ __('admin.insurance.enter_name')}}" required value="{{$insurance->name}}"> 
                                    @error('name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.insurance.email')}}</label>
                                <div class="col-md-10">
                                    <input id="image" name="email" class="form-control" placeholder="{{ __('admin.insurance.enter_email')}}" type="email" required value="{{$insurance->email}}">
                                    @error('email')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.insurance.phone1_no')}}</label>
                                <div class="col-md-10">
                                    <input id="image" name="phone1" class="form-control" placeholder="{{ __('admin.insurance.enter_phone1_no')}}" type="number" required value="{{$insurance->phone1}}">
                                    @error('phone1')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.insurance.phone2_no')}}</label>
                                <div class="col-md-10">
                                    <input id="image" name="phone2" class="form-control" placeholder="{{ __('admin.insurance.phone2_no')}}" type="number" required value="{{$insurance->phone2}}">
                                    @error('phone2')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.insurance.fax')}}</label>
                                <div class="col-md-10">
                                    <input id="image" name="fax" class="form-control" placeholder="{{ __('admin.insurance.enter_fax')}}" type="text" required value="{{$insurance->fax}}">
                                    @error('fax')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.insurance.city')}}</label>
                                <div class="col-md-10">
                                    <input id="image" name="city" class="form-control" placeholder="{{ __('admin.insurance.enter_city')}}" type="text" required value="{{$insurance->city}}">
                                    @error('city')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.insurance.state')}}</label>
                                <div class="col-md-10">
                                    <input id="image" name="state" class="form-control" placeholder="{{ __('admin.insurance.enter_state')}}" type="text" required value="{{$insurance->state}}">
                                    @error('state')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.insurance.address')}}</label>
                                <div class="col-md-10">
                                    <textarea id="image" name="address" class="form-control" type="number" required>{{$insurance->address}}</textarea>
                                    @error('address')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>{{ __('admin.insurance.update_insurance')}}
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
