
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-7 col-auto">
                    <h3 class="page-title">{{ $title }}</h3>
                </div>
                @if(Route::is(['categories']))
                <div class="col-sm-5 col">
                    <a href="{{url('#Add_Specialities_details')}}" data-bs-toggle="modal" class="btn btn-primary float-end d-flex justify-content-between align-items-center"><i class="feather-plus-square me-1"></i> {{ $li_1 }}</a>
                </div>
                @endif
                @if(Route::is(['product-list']))
                <div class="col-sm-5 col">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addproduct" class="btn btn-primary btn-add float-end d-flex justify-content-between align-items-center"><i class="feather-plus-square me-1"></i> Add New</a>
                </div>
                @endif
                @if(Route::is(['purchase']))
                <div class="col-sm-5 col">
                    <a href="{{url('pharmacy-admin/add-purchase')}}" class="btn btn-primary float-end d-flex justify-content-between align-items-center">
                    <i class="feather-plus-square me-1"></i> Add New</a>
                </div>
                @endif
                @if(Route::is(['supplier']))
                <div class="col-sm-5 col">
                    <a href="{{url('pharmacy-admin/add-supplier')}}" class="btn btn-primary float-end d-flex justify-content-between align-items-center"><i class="feather-plus-square me-1"></i>Add New</a>
                </div>
                 @endif
            </div>
        </div>
        <!-- /Page Header -->