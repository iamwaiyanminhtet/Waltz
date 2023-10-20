{{-- @extends('user.layouts.master',['categories' => $categories ]) --}}
@extends('user.layouts.master')


@section('mainContent')
     <!-- main -->
 <main class="main">
    @if (count($homeSliders) > 0)
    <div class="intro-slider-container">
        <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false}'>
            @foreach ($homeSliders as $homeSlider)
            <div class="intro-slide" style="background-image: url({{ asset('storage/admin/homeSliders/'.$homeSlider->image) }});">
                <div class="container intro-content">
                    <h1 class="intro-title w-50" style="color: rgb(8, 126, 244)">
                       {{ $homeSlider->title }}
                    </h1><!-- End .intro-title -->

                    <a href="{{ route('customer#allProducts') }}" class="btn btn-info mt-2">
                        <span>Shop Now</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div><!-- End .container intro-content -->
            </div><!-- End .intro-slide -->
            @endforeach
        </div><!-- End .owl-carousel owl-simple -->

        <span class="slider-loader text-white"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->
    @else
    <div class="intro-slide" style="background-image: url({{ asset('cover5.jpg') }});">
        <div class="container intro-content">

            <h1 class="intro-title" style="color: black">Find Comfort <br>That Suits You.</h1><!-- End .intro-title -->

            <a href="category.html" class="btn btn-info">
                <span>Shop Now</span>
                <i class="icon-long-arrow-right"></i>
            </a>
        </div><!-- End .container intro-content -->
    </div><!-- End .intro-slide -->
    @endif
 </main><!-- End .main -->

<section class="mt-5 mx-3">
    <div class="d-flex justify-content-center">
        <h2 class="title mb-3 bg-dark w-50 text-white p-3 rounded text-center">Categories</h2><!-- End .title mb-2 -->
    </div>

    <div class="row d-flex justify-content-center">
        @foreach ($categories as $category)
        <div class="col-md-6 col-lg-4">
            <div class="banner banner-cat">
                <a href="{{ route('customer#subcategories', $category->id) }}">
                    <img src="{{ asset('storage/admin/category/'.$category->image) }}" alt="Banner">
                </a>

                <div class="banner-content banner-content-overlay text-center bg-dark pt-2" style="width:fit-content !important ;">
                    <h3 class="banner-title">{{ $category->name }}</h3><!-- End .banner-title -->
                    {{-- <h4 class="banner-subtitle">18 Products</h4><!-- End .banner-subtitle --> --}}
                    <a href="#{{ route('customer#subcategories', $category->id) }}" class="banner-link">Shop Now</a>
                </div><!-- End .banner-content -->
            </div><!-- End .banner -->
        </div><!-- End .col-md-6 -->
        @endforeach
    </div><!-- End .row -->
</section>

<div class="container-fluid mt-5">
    <div class="d-flex justify-content-center">
        <h2 class="title mb-3 bg-dark w-50 text-white p-3 rounded text-center">Featured Products</h2><!-- End .title mb-2 -->
    </div>
    <div class="row justify-content-center">
        @foreach ($featuredProducts as $fp)
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="product product-5 text-center">
                <figure class="product-media">
                    {{-- <span class="product-label label-new">New</span> --}}
                    <a href="{{ route('customer#product',$fp->id) }}">
                        <img src="{{ asset('storage/admin/product/'.$fp->image) }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action product-action-dark">
                        <a href="{{ route('customer#product',$fp->id) }}" class="btn bg-dark text-white w-100"><span>view</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <h3 class="product-title">
                        <a href="">{{ $fp->name }}</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        {{ $fp->price }}
                    </div><!-- End .product-price -->
                </div><!-- End .product-body -->
                {{-- <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 0 Reviews )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-footer --> --}}
            </div><!-- End .product -->
        </div><!-- End .col-sm-6 col-md-4 col-lg-3 col-xl-2 -->
        @endforeach
    </div><!-- End .row -->
</div><!-- End .container-fluid -->

<section style="margin: 5rem 0 5rem 0 !important;">
    <div class="container">
        <div class="d-flex justify-content-center">
            <h2 class="title mb-3 bg-dark w-50 text-white p-3 rounded text-center">
                Offers
            </h2><!-- End .title mb-2 -->
        </div>
        <div class="row justify-content-center">
            @foreach ($offers as $offer)
            <div class="col-md-6 col-lg-4">
                <div class="banner banner-overlay banner-overlay-light">
                    <a href="#">
                        <img src="{{ asset('Storage/admin/offers/'.$offer->image) }}" style="height: 25vh !important">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle text-white text-muted">{{ $offer->description }}</h4><!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white">
                            {{ $offer->label_name }}
                        </h3><!-- End .banner-title -->
                        <a href="{{ route('customer#allProducts') }}" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-md-4 -->
            @endforeach

            {{-- <div class="col-md-6 col-lg-4">
                <div class="banner banner-overlay banner-overlay-light">
                    <a href="#">
                        <img src="{{ asset('user/assets/images/demos/demo-4/banners/banner-2.jpg') }}" alt="Banner">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle"><a href="#">Time Deals</a></h4><!-- End .banner-subtitle -->
                        <h3 class="banner-title"><a href="#"><strong>Bose SoundSport</strong> <br>Time Deal -30%</a></h3><!-- End .banner-title -->
                        <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-md-4 -->

            <div class="col-md-6 col-lg-4">
                <div class="banner banner-overlay banner-overlay-light">
                    <a href="#">
                        <img src="{{ asset('user/assets/images/demos/demo-4/banners/banner-3.png') }}" alt="Banner">
                    </a>

                    <div class="banner-content">
                        <h4 class="banner-subtitle"><a href="#">Clearance</a></h4><!-- End .banner-subtitle -->
                        <h3 class="banner-title"><a href="#"><strong>GoPro - Fusion 360</strong> <br>Save $70</a></h3><!-- End .banner-title -->
                        <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-lg-4 --> --}}
        </div><!-- End .row -->
    </div><!-- End .container -->
</section>

<div class="blog-posts">
    <div class="container">
        <h2 class="title-lg text-center mb-4">From Our Blog</h2><!-- End .title-lg text-center -->

        <div class="owl-carousel owl-simple mb-4" data-toggle="owl"
            data-owl-options='{
                "nav": false,
                "dots": true,
                "items": 3,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
                    },
                    "520": {
                        "items":2
                    },
                    "768": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    }
                }
            }'>
            @foreach ($blogs as $blog)
            <article class="entry shadow-sm">
                <figure class="entry-media">
                    <a href="{{ route('customer#blog#single',$blog->id) }}">
                        <img src="{{ asset('Storage/admin/blog/'.$blog->image) }}" alt="image desc">
                    </a>
                </figure><!-- End .entry-media -->

                <div class="entry-body text-center">
                    <div class="entry-meta">
                        <a href="{{ route('customer#blog#single',$blog->id) }}">{{ $blog->created_at }}</a>,
                        {{ $comments->where('blog_id',$blog->id)->count() }} comments
                    </div><!-- End .entry-meta -->

                    <h3 class="entry-title">
                        <a href="{{ route('customer#blog#single',$blog->id) }}">{{ $blog->title }}</a>
                    </h3><!-- End .entry-title -->

                    <div class="entry-content">
                        <a class="d-block" href="{{ route('customer#blog#single',$blog->id) }}">{{ Str::limit($blog->description, 20, '...') }}</a>
                        <a href="{{ route('customer#blog#single',$blog->id) }}" class="btn btn-sm btn-info">READ MORE</a>
                    </div><!-- End .entry-content -->
                </div><!-- End .entry-body -->
            </article><!-- End .entry -->
            @endforeach
        </div><!-- End .owl-carousel -->

        <div class="more-container text-center mt-1">
            <a href="{{ route('customer#blog#list') }}" class="btn btn-outline-lightgray btn-more btn-round"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
        </div><!-- End .more-container -->
    </div><!-- End .container -->
</div><!-- End .blog-posts -->
@endsection
