@extends('layout.mainlayout_admin')
@section('title', 'Countries')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Countries <span class="ms-1">{{ count($countries) }}</span></div>
                        <a href="{{ route('countries.create') }}" class="btn btn-primary btn-add">
                            <i class="feather-plus-square me-1"></i>Add New
                        </a>
                    </div>
                </div>
            </div>

            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif

            <!-- Country List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Countries</h5>
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
                                            <th>Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($countries as $country)
                                            <tr>
                                                <td>{{ $country->id }}</td>
                                                <td>{{ $country->name_en }}</td>
                                                <td>{{ $country->name_ar }}</td>
                                                <td>{{ $country->code }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black"
                                                            href="{{ route('countries.edit', $country) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        
                                                        @if($country->deleted_at) <!-- Check if country is soft deleted -->
                                                            <!-- Show the Restore and Hard Delete buttons -->
                                                            <a class="text-success" href="{{ route('countries.restore', $country) }}">
                                                                <i class="feather-refresh-cw me-1"></i> Restore
                                                            </a>
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to permanently delete this country <{{ $country->name_en }}>?')){ 
                                                                    document.getElementById('force-delete{{ $country->id }}').submit(); 
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Hard Delete
                                                            </a>
                                                            <!-- Hard delete form -->
                                                            <form method="POST" id="force-delete{{ $country->id }}"
                                                                action="{{ route('countries.force-delete', $country) }}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @else
                                                            <!-- Show the Delete button only if not deleted -->
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to delete this country <{{ $country->name_en }}>?')){ 
                                                                    document.getElementById('delete{{ $country->id }}').submit(); 
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Delete
                                                            </a>
                                                
                                                            <!-- Soft delete form -->
                                                            <form method="POST" id="delete{{ $country->id }}"
                                                                action="{{ route('countries.destroy', $country) }}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No Countries available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
            <!-- /Country List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
