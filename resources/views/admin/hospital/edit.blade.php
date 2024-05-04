@extends('layout.mainlayout_admin')
@section('title', 'Edit Hospital')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.hospital.edit_hospital')  }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hospital.update', $hospital) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="hospital_name" class="col-form-label col-md-2">{{ __('admin.hospital.insurance')  }}</label>
                                <div class="col-md-10">
                                <select id="insurance" name="insurance[]" type="text" class="form-control js-example-basic-multiple"
                                           placeholder="Enter Hospital name" multiple="multiple" required>

                                          
                                           @forelse($insurances as $item)
                                           <option value="{{$item->id}}" {{ in_array($item->id, $selectedInsuranceIds) ? 'selected' : '' }}>{{$item->name}}</option>
                                           @empty
                                           @endforelse

                                    </select>
                                    @error('hospital_name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hospital_name" class="col-form-label col-md-2">{{ __('admin.hospital.hospital_name')  }}</label>
                                <div class="col-md-10">
                                    <input id="hospital_name" name="hospital_name"
                                           value="{{ $hospital->hospital_name }}" type="text" class="form-control"
                                           placeholder="{{ __('admin.hospital.enter_hospital_name')  }}" required>
                                    @error('hospital_name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-form-label col-md-2">{{ __('admin.hospital.location')  }}</label>
                                <div class="col-md-10">
                                    <input id="address" name="address" value="{{ $hospital->address }}" type="text"
                                           class="form-control" placeholder="{{ __('admin.hospital.enter_location')  }}" required>
                                    @error('address')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-form-label col-md-2">{{ __('admin.hospital.city')  }}</label>
                                <div class="col-md-10">
                                    <input id="city" name="city" type="text" value="{{ $hospital->city }}"
                                           class="form-control" placeholder="{{ __('admin.hospital.enter_city')  }}" required>
                                    @error('city')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-form-label col-md-2">{{ __('admin.hospital.country')  }}</label>
                                <div class="col-md-10">
                                    <input id="country" name="country" value="{{ $hospital->country }}" type="text"
                                           class="form-control" placeholder="{{ __('admin.hospital.enter_country')  }}" required>
                                    @error('country')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state" class="col-form-label col-md-2">{{ __('admin.hospital.state')  }}</label>
                                <div class="col-md-10">
                                    <input id="state" name="state" type="text" value="{{ $hospital->state }}"
                                           class="form-control" placeholder="{{ __('admin.hospital.enter_state')  }}" required>
                                    @error('state')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zip" class="col-form-label col-md-2">{{ __('admin.hospital.hospital_zip')  }}</label>
                                <div class="col-md-10">
                                    <input id="zip" name="zip" type="text" value="{{ $hospital->zip }}"
                                           class="form-control" placeholder="{{ __('admin.hospital.enter_hospital_zip')  }}" required>
                                    @error('zip')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">{{ __('admin.hospital.image')  }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="image" class="form-control" type="file">
                                    @error('image')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">{{ __('admin.hospital.hospital_administrator_name')  }}</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="{{ __('admin.hospital.enter_hospital_administrator_name')  }}"
                                           value="{{ $admin->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.hospital.hospital_administrator_email')  }}</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" class="form-control"
                                           value="{{ $admin->email }}" placeholder="{{ __('admin.hospital.enter_hospital_administrator_email')  }}">
                                           @error('image')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.hospital.password')  }}</label>
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
                                <label for="email" class="col-form-label col-md-2">{{ __('admin.hospital.confirm_password')  }}</label>
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
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                            {{ __('admin.hospital.update_hospital')  }}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>