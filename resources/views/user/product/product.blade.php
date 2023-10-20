@extends('user.layouts.master')

@section('mainContent')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('user#home')}}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('customer#subcategories',$product->category_id) }}">{{ $product->category_name }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('customer#productBySubcategory',$product->sub_category_id) }}">{{ $product->sub_category_name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{ asset('storage/admin/product/'.$product->image) }}" data-zoom-image="{{ asset('storage/admin/product/'.$product->image) }}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->

                            {{-- other images div --}}
                            {{-- <div id="product-zoom-gallery" class="product-image-gallery">
                                <a class="product-gallery-item" href="#" data-image="assets/images/products/single/extended/1.jpg" data-zoom-image="assets/images/products/single/extended/1-big.jpg">
                                    <img src="assets/images/products/single/extended/1-small.jpg" alt="product side">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="assets/images/products/single/extended/2.jpg" data-zoom-image="assets/images/products/single/extended/2-big.jpg">
                                    <img src="assets/images/products/single/extended/2-small.jpg" alt="product cross">
                                </a>

                                <a class="product-gallery-item active" href="#" data-image="assets/images/products/single/extended/3.jpg" data-zoom-image="assets/images/products/single/extended/3-big.jpg">
                                    <img src="assets/images/products/single/extended/3-small.jpg" alt="product with model">
                                </a>

                                <a class="product-gallery-item" href="#" data-image="assets/images/products/single/extended/4.jpg" data-zoom-image="assets/images/products/single/extended/4-big.jpg">
                                    <img src="assets/images/products/single/extended/4-small.jpg" alt="product back">
                                </a>

                            </div><!-- End .product-image-gallery --> --}}
                            {{-- other images div --}}

                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                            {{-- rating div --}}
                            {{-- <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                            </div><!-- End .rating-container --> --}}
                            {{-- rating div --}}

                            <div class="product-price">
                                {{ $product->price }} kyats
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>{{ $product->description }}</p>
                            </div><!-- End .product-content -->

                            {{-- different product size --}}
                            {{-- <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom">
                                    <select name="size" id="size" class="form-control">
                                        <option value="#" selected="selected">Select a size</option>
                                        <option value="s">Small</option>
                                        <option value="m">Medium</option>
                                        <option value="l">Large</option>
                                        <option value="xl">Extra Large</option>
                                    </select>
                                </div><!-- End .select-custom -->

                                <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                            </div><!-- End .details-filter-row --> --}}
                            {{-- different product size --}}

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" class="form-control" value="1" min="1" max="10" step="1" id="productQuantity" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <button type="button" class="btn-product btn-cart text-dark" id="addToCartBtn">add to cart</button>
                                <input type="hidden" id="userId"
                                @if (Auth::check())
                                value="{{ Auth::user()->id }}"
                                @else
                                value="null"
                                @endif>
                                <input type="hidden" id="productId" value="{{ $product->id }}">
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="{{ route('customer#subcategories',$product->category_id) }}">{{ $product->category_name }}</a>
                                    <br>
                                    <span>Sub Category:</span>
                                    <a href="{{ route('customer#productBySubcategory',$product->sub_category_id) }}">{{ $product->sub_category_name }}</a>
                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f text-dark"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter text-dark"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram text-dark"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest text-dark"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="container">
            <h2 class="title text-center mb-4">Related Products</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                @foreach ($relatedProducts as $rp)
                <div class="product product-7">
                    <figure class="product-media">
                        {{-- <span class="product-label label-new">New</span> --}}
                        <a href="{{ route('customer#product',$rp->id) }}">
                            <img src="{{ asset('storage/admin/product/'.$rp->image) }}" alt="Product image" class="product-image">
                        </a>

                        {{-- <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical --> --}}

                        <div class="product-action">
                            <a href="{{ route('customer#product',$rp->id) }}" class="btn bg-dark text-white w-100"><span>view</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="{{ route('customer#subcategories',$product->category_id) }}">{{ $product->category_name }}</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{ route('customer#product',$rp->id) }}">{{ $rp->name }}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            {{ $rp->price }} kyats
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @endforeach
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $('#addToCartBtn').click(function () {
            // if the user isnt logged in, redirect to loginPage
           if($('#userId').val() === 'null' || $('#userId').val() === null) {
            window.location.href = '/loginPage';
           }

           // if the user logged in, save the progress
           $addToCartInfo = {
            userId : $('#userId').val(),
            productId : $('#productId').val(),
            quantity : $('#productQuantity').val()
           };

           // ajax call to save the progress
           $.ajax({
                type : 'get',
                url : '/customer/cart/addToCart/ajax',
                dataType : 'json',
                data : $addToCartInfo,
                success : function (response) {
                    window.location.href = '/customer/cart/cartList';
                }
            });

        });
    });
</script>
@endsection
