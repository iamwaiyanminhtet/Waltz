@extends('user.layouts.master')

@section('mainContent')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container-fluid">
            <h1 class="page-title">All Products</h1>
        </div><!-- End .container-fluid -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Products</li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center mb-5">
                <div class="col-lg-6 col-md-7 col-sm-8 text-start ">
                    <span>Showing {{ count($products) }} products</span>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-10 ">
                    <form action="{{ route('customer#allProducts') }}" method="GET" class="row justify-content-lg-end justify-content-md-center justify-content-sm-center">
                        @csrf
                        <input type="search" name="allProductsSearchKey" class="form-control w-50" placeholder="search..." value="{{ request('allProductsSearchKey') }}">
                        <button type="submit" class="btn btn-primary btn-sm" style="min-width: 5rem !important;max-width: 6rem !important;padding:0 !important; max-height:4rem !important"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>

            <div class="products">
                <div class="row gx-1 gy-1">
                    @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2">
                        <div class="product product-5 text-center">
                            <figure class="product-media">
                                {{-- <span class="product-label label-new">New</span> --}}
                                <a href="{{ route('customer#product',$product->id) }}">
                                    <img src="{{ asset('storage/admin/product/'.$product->image) }}" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action product-action-dark">
                                    <a href="{{ route('customer#product',$product->id) }}" class="btn bg-dark text-white w-100"><span>view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title">
                                    <a href="">{{ $product->name }}</a>
                                </h3><!-- End .product-title -->
                                <div class="product-price">
                                    {{ $product->price }}
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .products -->

            <div class="sidebar-filter-overlay"></div><!-- End .sidebar-filter-overlay -->

        </div><!-- End .container-fluid -->
    </div><!-- End .page-content -->

    <div class="text-black p-4">
        {{ $products->links() }}
    </div>
</main><!-- End .main -->

@endsection

