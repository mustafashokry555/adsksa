    @if(!Route::is(['pharmacy-search','search']))
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                @if(!Route::is(['calendar']))
                <div class="col-md-12 col-12">
                    @endif
                    @if(Route::is(['calendar']))
                    <div class="col">
                     @endif
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('index')}}">{{ $li_1 }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $li_2 }}</li>
                        </ol>
                    </nav>
                    @if(!Route::is(['product-all','product-healthcare']))
                    <h2 class="breadcrumb-title">{{ $title }}</h2>
                    @endif
                    @if(Route::is(['product-all','product-healthcare']))
                    <h2 class="breadcrumb-title">{{ $title }} <span class="text-small text-white ms-2"> <b>70 Products</b></span></h2>
                    @endif
                </div>
                @if(Route::is(['calendar']))
                <div class="col-auto text-end float-end ms-auto">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_event">Create Event</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    @endif
    @if(Route::is(['pharmacy-search','search']))
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8 col-12">
                            <nav aria-label="breadcrumb" class="page-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Search</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">2245 matches found for : {{ $title }}</h2>
                        </div>
                        <div class="col-md-4 col-12 d-md-block d-none">
                            <div class="sort-by">
                                <span class="sort-title">Sort by</span>
                                <span class="sortby-fliter">
                                    <select class="select">
                                        <option>Select</option>
                                        <option class="sorting">Rating</option>
                                        <option class="sorting">Popular</option>
                                        <option class="sorting">Latest</option>
                                        <option class="sorting">Free</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->
             @endif