@extends('user.layouts.master')

@section('mainContent')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ asset('storage/admin/category/' ) }})">
        <div class="container">
            <h1 class="page-title" style="color: black">{{ $categoryAndSubcategoryName->subcategory_name }}</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer#subcategories', $categoryAndSubcategoryName->category_id ) }}">{{ $categoryAndSubcategoryName->category_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $categoryAndSubcategoryName->subcategory_name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <h2 class="title text-center mb-3"></h2><!-- End .title mb-2 -->
            <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">
                <div class="col-lg-6 col-md-7 col-sm-8 text-start">
                    <h2 class="title text-lg-start text-md-center text-sm-center mb-3">
                        {{ $categoryAndSubcategoryName->subcategory_name }}'s Sub Categories
                    </h2><!-- End .title mb-2 -->
                    <input type="hidden" name="subcategoryId" id="subcategoryId" value="{{ $categoryAndSubcategoryName->subcategory_id }}">
                </div>
                <div class="col-lg-6 col-md-8 col-sm-10 ">
                    <div class="row justify-content-lg-end justify-content-md-center justify-content-sm-center">
                        <select name="subcategoryProductsSorting" id="subcategoryProductsSorting" class="form-control border-primary col-5">
                            <option value="all" selected>All</option>
                            @foreach ($sorting_words as $sorting_word)
                                <option value="{{ $sorting_word }}">{{ $sorting_word}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="subcategoryProducts">
                @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="product product-5 text-center">
                        <figure class="product-media">
                            {{-- <span class="product-label label-new">New</span> --}}
                            <a href="{{ route('customer#product',$product->id) }}">
                                <img src="{{ asset('storage/admin/product/'.$product->image) }}" alt="Product image" class="product-image">
                            </a>

                            <div class="product-action product-action-dark">
                                <a href="{{ route('customer#product',$product->id) }}" class="btn bg-dark text-white"><span>view</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title">
                                <a href="{{ route('customer#product',$product->id) }}">{{ $product->name }}</a>
                            </h3><!-- End .product-title -->
                            <div class="product-price">
                                {{ $product->price }}
                            </div><!-- End .product-price -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 col-xl-2 -->
                @endforeach
            </div><!-- End .row -->
            <hr class="mb-4">
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#subcategoryProductsSorting').change(function () {
            // subcategory products sorting ajax
            $.ajax({
                type : 'get',
                url : '/customer/subcategories/products/sorting/ajax',
                dataType : 'json',
                data : {
                    'year' : $('#subcategoryProductsSorting').val(),
                    'sub_category_id' : $('#subcategoryId').val()
                },
                success : function (response) {
                    $htmlAddition = ``;
                    for($i = 0; $i < response.length; $i++) {

                        $id = response[$i].id;
                        $name = response[$i].name;
                        $image = response[$i].image;
                        $price = response[$i].price;

                        $routeUrl = `/customer/products/${$id}`;
                        $htmlAddition +=
                        `
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                            <div class="product product-5 text-center">
                                <figure class="product-media">
                                    <a href="${$routeUrl}">
                                        <img src="{{ asset('storage/admin/product/${$image}') }}" alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action product-action-dark">
                                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title">
                                        <a href="${$routeUrl}">${$name}</a>
                                    </h3><!-- End .product-title -->
                                    <div class="product-price">
                                        ${$price}
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 col-xl-2 -->
                        `;

                        $('#subcategoryProducts').html($htmlAddition);
                    };
                }
            });
        });
    });
</script>
@endsection
