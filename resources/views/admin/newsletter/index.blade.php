@extends('layout.mainlayout_admin')
@section('title', 'newsletters')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">{{ __('admin.newsletters.newsletters_subscribers')  }}<span class="ms-1">{{count($newsletters)}}</span>
                            {{-- <span class="ms-1">{{ count(\App\Models\User::query()->where('user_type', 'U')->get()) }}</span> --}}
                        </div>

                    </div>
                </div>
            </div>
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Patients List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.newsletters.newsletters_subscribers')  }}</h5>
                                </div>

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('admin.newsletters.id')  }}</th>
                                        <th>{{ __('admin.newsletters.email')  }}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($newsletters as $newsletter)
                                        <tr>
                                            <td>{{$newsletter->id}}</td>


                                            <td>{{ $newsletter->email }}</td>
                                            {{--                                <td><span class="user-name">26 November 2022 </span><span class="d-block">12/20/2022</span></td>--}}





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
            <!-- /Patient List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
