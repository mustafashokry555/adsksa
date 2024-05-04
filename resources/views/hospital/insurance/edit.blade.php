@extends('layout.mainlayout_hospital')
@section('title', 'Insurance')
@section('content')


    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h5 class="card-title">Add Insurance</h5>
                    </div> -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('insurances.update',$insurance->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2"> {{ __('hospital.insurance.name')  }}</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                           placeholder="{{ __('hospital.insurance.enter_name')  }}" required value="{{$insurance->name}}">
                                    @error('name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('hospital.insurance.email')  }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="email" class="form-control" placeholder="{{ __('hospital.insurance.enter_email')  }}" type="email" required value="{{$insurance->email}}">
                                    @error('email')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('hospital.insurance.phone1_no')  }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="phone1" class="form-control" placeholder="{{ __('hospital.insurance.enter_phone1_no')  }}" type="number" required value="{{$insurance->phone1}}">
                                    @error('phone1')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('hospital.insurance.phone2_no')  }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="phone2" class="form-control" placeholder="{{ __('hospital.insurance.enter_phone2_no')  }}" type="number" required value="{{$insurance->phone2}}">
                                    @error('phone2')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('hospital.insurance.fax')  }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="fax" class="form-control" placeholder="{{ __('hospital.insurance.enter_fax')  }}" type="text" required value="{{$insurance->fax}}">
                                    @error('fax')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('hospital.insurance.city')  }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="city" class="form-control" placeholder="{{ __('hospital.insurance.enter_city')  }}" type="text" required value="{{$insurance->city}}">
                                    @error('city')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('hospital.insurance.state')  }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="state" class="form-control" placeholder="{{ __('hospital.insurance.enter_state')  }}" type="text" required value="{{$insurance->state}}">
                                    @error('state')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('hospital.insurance.address')  }}</label>
                                <div class="col-md-10">
                                    <textarea id="image" name="address" class="form-control" type="number" required>{{$insurance->address}}</textarea>
                                    @error('address')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Profile Image -->

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> {{ __('hospital.insurance.update_insurance')  }}
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







