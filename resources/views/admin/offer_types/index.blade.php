@extends('layout.mainlayout_admin')
@section('title', 'Offer Types')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Offer Types<span
                                class="ms-1">{{ count($offer_types) }}</span>
                            {{-- <span class="ms-1">{{ count(\App\Models\User::query()->where('user_type', 'U')->get()) }}</span> --}}
                        </div>
                        <a href="{{ route('offer-types.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i> {{ __('admin.speciality.add_new') }}</a>
                    </div>
                </div>
            </div>
            <style>
                .switch {
                    position: relative;
                    display: inline-block;
                    width: 50px;
                    height: 25px;
                }

                .switch input {
                    opacity: 0;
                    width: 0;
                    height: 0;
                }

                .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    transition: 0.4s;
                    border-radius: 25px;
                }

                .slider:before {
                    position: absolute;
                    content: "";
                    height: 19px;
                    width: 19px;
                    left: 3px;
                    bottom: 3px;
                    background-color: white;
                    transition: 0.4s;
                    border-radius: 50%;
                }

                input:checked+.slider {
                    background-color: #4caf50;
                }

                input:checked+.slider:before {
                    transform: translateX(24px);
                }
            </style>
            <!-- Hospitals -->
            <div id="flash-message" style="display: none" class="alert alert-success mt-2">
                {{ session()->has('flash') ? session('flash')['message'] : '' }}
            </div>
            <!-- offer-types List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Offer Types</h5>
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
                                            <th>{{ __('admin.hospital.image') }}</th>
                                            <th>Name (AR)</th>
                                            <th>Name (EN)</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>{{ __('admin.patient.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($offer_types as $type)
                                            <tr>
                                                <td>{{ $type->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ route('offer-types.edit', $type) }}" class="spl-img">
                                                            <img src="{{ asset('images/offer_types/'.$type->image) }}" class="img-fluid" alt="User Image">
                                                            </a>
                                                    </h2>
                                                </td>
                                                <td>{{ $type->name_ar ?? '' }}</td>
                                                <td>{{ $type->name_en }}</td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" {{ $type->status ? 'checked' : '' }}
                                                            data-id="{{ $type->id }}">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>{{ $type->created_at->format('Y-m-d H:i A') }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black" href="{{ route('offer-types.edit', $type) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        <a class="text-danger" href="javascript:void(0);"
                                                            onclick="if (window.confirm('Are you sure you want to delete this offer type <{{ $type->name }} >')){ document.getElementById( 'delete{{ $type->id }}').submit(); }">
                                                            <i class="feather-trash-2 me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                                <form method="POST" id="delete{{ $type->id }}"
                                                    action="{{ route('offer-types.destroy', $type) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
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
    <script>
        document.querySelectorAll('.switch input').forEach((toggle) => {
            toggle.addEventListener('change', function() {
                let offerTypeId = this.dataset.id;
                let status = this.checked ? 1 : 0;

                fetch(`/offer-types/${offerTypeId}/toggle-status`, {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Show flash message
                        let flash = document.getElementById("flash-message");
                        flash.innerText = data.message;
                        flash.style.display = "block";

                        // Auto-hide after 3s
                        setTimeout(() => {
                            flash.style.display = "none";
                        }, 3000);
                    })
                    .catch(err => console.error(err));
            });
        });
    </script>
@endsection
