@extends('layout.mainlayout_admin')
@section('title', 'Blogs')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Blog Edit -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('admin.blogs.add_blog') }}</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/store-blog') }}" enctype="multipart/form-data">

                                @csrf
                                <!-- blog_title -->
                                <div class="form-group row">
                                    <label for="blog_title_en"
                                        class="col-form-label col-md-2">{{ __('admin.blogs.title') }} EN</label>
                                    <div class="col-md-10">
                                        <input id="blog_title_en" name="blog_title_en" type="text" class="form-control" required>
                                        @error('blog_title_en')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="blog_title_ar"
                                        class="col-form-label col-md-2">{{ __('admin.blogs.title') }} AR</label>
                                    <div class="col-md-10">
                                        <input id="blog_title_ar" name="blog_title_ar" type="text" class="form-control" required>
                                        @error('blog_title_ar')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- blog_body -->
                                <div class="form-group row">
                                    <label for="blog_body_en"
                                        class="col-form-label col-md-2">{{ __('admin.blogs.body') }} EN</label>
                                    <div class="col-md-10">
                                        <textarea id="blog_body_en" name="blog_body_en" type="text" class="form-control" required></textarea>
                                        @error('blog_body_en')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="blog_body_ar"
                                        class="col-form-label col-md-2">{{ __('admin.blogs.body') }} AR</label>
                                    <div class="col-md-10">
                                        <textarea id="blog_body_ar" name="blog_body_ar" type="text" class="form-control" required></textarea>
                                        @error('blog_body_ar')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Profile Image -->
                                <div class="form-group row">
                                    <label for="blog_image"
                                        class="col-form-label col-md-2">{{ __('admin.blogs.image') }}</label>
                                    <div class="col-md-10">
                                        <input id="blog_image" name="blog_image" class="form-control" type="file">
                                        @error('blog_image')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                    {{ __('admin.blogs.blogs') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Blog Edit -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
