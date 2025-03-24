@extends('layout.mainlayout_admin')
@section('title', 'Areas')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Areas <span class="ms-1">{{ count($areas) }}</span></div>
                        <a href="{{ route('areas.create') }}" class="btn btn-primary btn-add">
                            <i class="feather-plus-square me-1"></i>Add New
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
                                    <h5 class="card-title">Areas</h5>
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
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($areas as $area)
                                            <tr>
                                                <td>{{ $area->id }}</td>
                                                <td>{{ $area->name_en }}</td>
                                                <td>{{ $area->name_ar }}</td>
                                                <td>{{ $area->city->name_en }} < {{ $area->city->name_ar }} ></td>
                                                <td>{{ $area->country->name_en }} < {{ $area->country->name_ar }} ></td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black"
                                                            href="{{ route('areas.edit', $area) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        
                                                        @if($area->deleted_at) <!-- Check if area is soft deleted -->
                                                            <!-- Show the Restore and Hard Delete buttons -->
                                                            <a class="text-success" href="{{ route('areas.restore', $area) }}">
                                                                <i class="feather-refresh-cw me-1"></i> Restore
                                                            </a>
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to permanently delete this area <{{ $area->name_en }}>?')){ 
                                                                    document.getElementById('force-delete{{ $area->id }}').submit(); 
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Hard Delete
                                                            </a>
                                                            <!-- Hard delete form -->
                                                            <form method="POST" id="force-delete{{ $area->id }}"
                                                                action="{{ route('areas.force-delete', $area) }}">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @else
                                                            <!-- Show the Delete button only if not deleted -->
                                                            <a class="text-danger" href="javascript:void(0);"
                                                                onclick="if (window.confirm('Are you sure you want to delete this area <{{ $area->name_en }}>?')){ 
                                                                    document.getElementById('delete{{ $area->id }}').submit(); 
                                                                }">
                                                                <i class="feather-trash-2 me-1"></i> Delete
                                                            </a>
                                                
                                                            <!-- Soft delete form -->
                                                            <form method="POST" id="delete{{ $area->id }}"
                                                                action="{{ route('areas.destroy', $area) }}">
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
            <!-- /area List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
