@extends('admin.layout.master')

@section('content')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-start g-5">
            <a href="{{ route('admin#account#userList') }}" class="col-lg-3 col-md-4 col-sm-6 ">
                <button type="button" class="btn btn-outline-primary">
                    User
                    <span class="badge rounded-pill">{{ $users->count() }}</span>
                </button>
            </a>
            <a href="{{ route('admin#category#categoryList') }}" class="col-lg-3 col-md-4 col-sm-6 ">
                <button type="button" class="btn btn-outline-secondary">
                    Categories
                    <span class="badge rounded-pill">{{ $categories->count() }}</span>
                </button>
            </a>
            <a href="{{ route('admin#category#subCategoryList') }}" class="col-lg-3 col-md-4 col-sm-6 ">
                <button type="button" class="btn btn-outline-info">
                    Sub-Categories
                    <span class="badge rounded-pill">{{ $subcategories->count() }}</span>
                </button>
            </a>
            <a href="{{ route('admin#product#list') }}" class="col-lg-3 col-md-4 col-sm-6 ">
                <button type="button" class="btn btn-outline-warning">
                    Products
                    <span class="badge rounded-pill">{{ $products->count() }}</span>
                </button>
            </a>
            <a href="{{ route('admin#offers#list') }}" class="col-lg-3 col-md-4 col-sm-6 ">
                <button type="button" class="btn btn-outline-danger">
                    Offers
                    <span class="badge rounded-pill">{{ $offers->count() }}</span>
                </button>
            </a>
            <a href="{{ route('admin#blog#list') }}" class="col-lg-3 col-md-4 col-sm-6 ">
                <button type="button" class="btn btn-outline-success">
                    Blogs
                    <span class="badge rounded-pill">{{ $blogs->count() }}</span>
                </button>
            </a>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection
@endsection
