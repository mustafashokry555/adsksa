@extends('layout.mainlayout_admin')
@section('title', 'Cities')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Cities <span class="ms-1">{{ count($cities) }}</span></div>
                        <a href="{{ route('cities.create') }}" class="btn btn-primary btn-add">
                            <i class="feather-plus-square me-1"></i>Add New City
                        </a>
                    </div>
                </div>
            </div>

            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif

            <!-- Area List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Cities</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name EN</th>
                                            <th>Name AR</th>
                                            <th>State</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($cities as $city)
                                            <tr>
                                                <td>{{ $city->id }}</td>
                                                <td>{{ $city->name_en }}</td>
                                                <td>{{ $city->name_ar }}</td>
                                                <td>{{ $city->state?->name_en }} < {{ $city->state?->name_ar }} ></td>
                                                <td>{{ $city->country?->name_en }} < {{ $city->country?->name_ar }} ></td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black"
                                                            href="{{ route('cities.edit', $city) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        
                                                        @if($city->deleted_at) <!-- Check if city is soft deleted -->
                                                            <!-- Show the Restore and Hard Delete buttons -->
                                                            <a class="text-success" href="{{ route('cities.restore', $city) }}">
                                                                <i class="feather-refresh-cw me-1"></i> Restore
                                                            </a>
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to permanently delete this City <{{ $city->name_en }}>?')){ 
                                                                    document.getElementById('force-delete{{ $city->id }}').submit(); 
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Hard Delete
                                                            </a>
                                                            <!-- Hard delete form -->
                                                            <form method="POST" id="force-delete{{ $city->id }}"
                                                                action="{{ route('cities.force-delete', $city) }}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @else
                                                            <!-- Show the Delete button only if not deleted -->
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to delete this City <{{ $city->name_en }}>?')){ 
                                                                    document.getElementById('delete{{ $city->id }}').submit(); 
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Delete
                                                            </a>
                                                
                                                            <!-- Soft delete form -->
                                                            <form method="POST" id="delete{{ $city->id }}"
                                                                action="{{ route('cities.destroy', $city) }}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{-- <tr>
                                                <td colspan="5">No Areas available</td>
                                            </tr> --}}
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
            <!-- /city List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
