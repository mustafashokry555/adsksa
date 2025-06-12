@extends('layout.mainlayout_admin')
@section('title', 'Currency')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Currency<span
                                class="ms-1">{{ count($currancies) }}</span>
                            {{-- <span class="ms-1">{{ count(\App\Models\User::query()->where('user_type', 'U')->get()) }}</span> --}}
                        </div>
                        <a href="{{ route('currency.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i> {{ __('admin.speciality.add_new') }}</a>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Currency List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Currencies</h5>
                                </div>
                                <div class="col-auto custom-list d-flex">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                    {{-- <div class="multipleSelection">
                                        <div class="selectBox">
                                            <p class="mb-0"><i class="feather-filter me-1"></i> Filter </p>
                                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                        </div>
                                        @php
                                            $status = request()->status ?? [];
                                            $bloodGroup = request()->blood_group ?? [];

                                        @endphp
                                        <div id="checkBoxes">
                                            <form action="{{ route('patient.index') }}">
                                                <p class="lab-title">By Account status</p>
                                                <div class="selectBox-cont">
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="status[]" value="Active"
                                                            {{ in_array('Active', $status) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> Enabled
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="status[]" value="Inactive"
                                                            {{ in_array('Inactive', $status) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> Disabled
                                                    </label>
                                                    <p class="lab-title">By Blood Type</p>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="blood_group[]" value="AB+"
                                                            {{ in_array('AB+', $bloodGroup) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> AB+
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="blood_group[]" value="O-"
                                                            {{ in_array('O-', $bloodGroup) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> O-
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="blood_group[]" value="B-"
                                                            {{ in_array('B-', $bloodGroup) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> B-
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="blood_group[]" value="A+"
                                                            {{ in_array('A+', $bloodGroup) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> A+
                                                    </label>
                                                    <label class="custom_check w-100 mb-4">
                                                        <input type="checkbox" name="blood_group[]" value="B+"
                                                            {{ in_array('B+', $bloodGroup) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> B+
                                                    </label>

                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="blood_group[]" value="A-"
                                                            {{ in_array('A-', $bloodGroup) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> A-
                                                    </label>

                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="blood_group[]" value="AB-"
                                                            {{ in_array('AB-', $bloodGroup) ? 'checked' : '' }}>
                                                        <span class="checkmark"></span> AB-
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                            </form>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('admin.patient.id') }}</th>
                                            <th>Name (AR)</th>
                                            <th>Name (EN)</th>
                                            <th>Code</th>
                                            <th>Created At</th>
                                            <th>{{ __('admin.patient.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currancies as $type)
                                            <tr>
                                                <td>{{ $type->id }}</td>
                                                <td>{{ $type->name_ar ?? '' }}</td>
                                                <td>{{ $type->name_en }}</td>
                                                <td>{{ $type->code_en }}< {{ $type->code_ar }} ></td>
                                                <td>{{ $type->created_at->format('Y-m-d H:i A') }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black"
                                                            href="{{ route('currency.edit', $type) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>

                                                        @if($type->deleted_at) <!-- Check if type is soft deleted -->
                                                            <!-- Show the Restore and Hard Delete buttons -->
                                                            <a class="text-success" href="{{ route('currency.restore', $type) }}">
                                                                <i class="feather-refresh-cw me-1"></i> Restore
                                                            </a>
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to permanently delete this Currancy <{{ $type->name_en }}>?')){
                                                                    document.getElementById('force-delete{{ $type->id }}').submit();
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Hard Delete
                                                            </a>
                                                            <!-- Hard delete form -->
                                                            <form method="POST" id="force-delete{{ $type->id }}"
                                                                action="{{ route('currency.force-delete', $type) }}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @else
                                                            <!-- Show the Delete button only if not deleted -->
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to delete this Currancy <{{ $type->name_en }}>?')){
                                                                    document.getElementById('delete{{ $type->id }}').submit();
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Delete
                                                            </a>

                                                            <!-- Soft delete form -->
                                                            <form method="POST" id="delete{{ $type->id }}"
                                                                action="{{ route('currency.destroy', $type) }}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
