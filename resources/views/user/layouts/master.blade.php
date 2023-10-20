<!DOCTYPE html>
<html lang="en">


<!-- molla/index-6.html  22 Nov 2019 09:56:18 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Waltz</title>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/plugins/jquery.countdown.css')}}">

     <!-- Plugins CSS File -->
     <link rel="stylesheet" href="{{ asset('user/assets/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/plugins/jquery.countdown.css')}}">
     <!-- Main CSS File -->
     <link rel="stylesheet" href="{{ asset('user/assets/css/style.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/skins/skin-demo-10.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/demos/demo-10.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/skins/skin-demo-2.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/demos/demo-2.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/skins/skin-demo-4.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/demos/demo-4.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/skins/skin-demo-24.css')}}">
     <link rel="stylesheet" href="{{ asset('user/assets/css/demos/demo-24.css')}}">

     {{-- font awesome --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-6 ">
            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="{{ route('customer#allProducts') }}" method="get">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="q" class="sr-only">Search</label>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                    <input type="search" class="form-control custom-form-control-css" name="allProductsSearchKey"
                                    value="{{ request('allProductsSearchKey') }}" id="q" placeholder="Search product ..." required>
                                    <input type="hidden" id="userId" @if (!empty(Auth::user()))
                                    value="{{ Auth::user()->id }}"
                                    @else
                                        value="null"
                                    @endif>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div>
                    <div class="header-center">
                        <a href="index.html" class="logo">
                            {{-- asset('user/assets/images/demos/demo-6/logo.png') --}}
                            <img src="{{ asset('logo3.png') }}" alt="Molla Logo" width="150" height="60">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        @if (!empty(Auth::user()))
                        <a href="{{ route('customer#account#profile') }}" class="wishlist-link">
                            <i class="icon-user"></i>
                            <span class="wishlist-txt">My Account</span>
                        </a>
                        @endif

                        <div class="dropdown cart-dropdown" id="cartBtn">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count" id="cartCount">0</span>
                                <span class="cart-txt cartTotal">00 Kyat</span>
                            </a>
                           @if (!empty(Auth::user()))
                            <div class="dropdown-menu dropdown-menu-right" >
                                <div class="dropdown-cart-products" id="cartProducts">
                                </div><!-- End .cart-product -->
                                <div class="dropdown-cart-total">
                                    <span>Total</span>

                                    <span class="cart-total-price cartTotal">00 Kyat</span>
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <a href="{{ route('customer#cart#cartList') }}" class="btn btn-outline-primary-2"><span>View Cart</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdown-menu -->
                           @endif
                        </div><!-- End .cart-dropdown -->
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container @if (url()->current() === route('user#home'))
                                    active @endif ">
                                    <a href="{{ route('user#home') }}" class="sf-with-ul">Home</a>
                                </li>
                                <li >
                                    <a href="#" class="sf-with-ul">Categories</a>
                                    <ul id="categories">
                                    </ul>
                                </li>
                                <li class="@if (url()->current() === route('customer#allProducts'))
                                    active @endif ">
                                    <a href="#" class="sf-with-ul">Products</a>
                                    <ul>
                                        <li><a href="{{ route('customer#allProducts') }}">All Products</a></li>

                                    </ul>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->

                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="flex ">
                           @if(!empty(Auth::user()))
                            <div class="dropdown">
                                <a class="btn btn-primary rounded-2xl dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                {{ Str::ucfirst(Auth::user()->name) }}
                                </a>

                                <div class="dropdown-menu">
                                <span>
                                    <form action="{{ route('logout') }}" class="dropdown-item" method="post" >
                                        @csrf

                                        @if (Auth::user()->role === 'admin')
                                        <a href="{{ route('admin#dashboard') }}" class="btn btn-dark btn-sm text-white rounded-lg d-block mb-2">Admin Dashboard</a>
                                        @endif
                                        <button type="submit" class="btn btn-dark btn-sm text-white rounded-lg mb-2">
                                            Logout
                                        </button>
                                    </form>
                                </span>
                                </div>
                            </div>

                           @else
                                <a href="{{ route('auth#loginPage') }}"  style="background-color: #4878ba !important; color: white; padding: 0.8rem 2rem; border-radius: 2px;">Login</a>
                                <a href="{{ route('auth#registerPage') }}"  style="background-color: #4878ba !important; color: white; padding: 0.8rem 2rem; border-radius: 2px;">Sign Up</a>
                           @endif
                        </div>
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="{{ route('customer#allProducts') }}" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control custom-form-control-css" name="allProductsSearchKey"
                value="{{ request('allProductsSearchKey') }}" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="megamenu-container @if (url()->current() === route('user#home'))
                        active @endif ">
                        <a href="{{ route('user#home') }}" class="sf-with-ul">Home</a>
                    </li>
                    <li >
                        <a href="#" class="sf-with-ul">Categories</a>
                        <ul id="mobileCategories">
                        </ul>
                    </li>
                    <li class="@if (url()->current() === route('customer#allProducts'))
                        active @endif ">
                        <a href="#" class="sf-with-ul">Products</a>
                        <ul>
                            <li><a href="{{ route('customer#allProducts') }}">All Products</a></li>

                        </ul>
                    </li>
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

   @yield('mainContent')


    <footer class="footer mt-3">
        <div class="container service">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-rocket"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Fast Delievery</h3><!-- End .icon-box-title -->
                            <p>Within one day in local</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-4 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-rotate-left"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Exchangeable</h3><!-- End .icon-box-title -->
                            <p>Within one week</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-4 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-info-circle"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Get 5% Off 1 Item</h3><!-- End .icon-box-title -->
                            <p>When you sign up</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-4 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon">
                            <i class="icon-life-ring"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                            <p>24/7 order</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-4 -->
            </div>
        </div>

        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="widget widget-about">
                            <img src="{{ asset('logo4.png') }}" class="footer-logo" alt="Footer Logo" width="110" height="25">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                            <div class="social-icons">
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div><!-- End .soial-icons -->
                        </div><!-- End .widget about-widget -->
                    </div><!-- End .col-sm-12 col-lg-3 -->

                    <div class="col-lg-3 col-sm-4 col-md-4">
                        <div class="widget">
                            <h4 class="widget-title">Main</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="{{ route('user#home') }}">Home</a></li>
                                <li><a href="{{ route('customer#allProducts') }}">All Products</a></li>
                                <li><a href="{{ route('customer#blog#list') }}">Bloglist</a></li>
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-4 col-lg-3 -->

                    @if (Auth::user())
                    <div class="col-lg-3 col-sm-4 col-md-4">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="{{ route('customer#account#profile') }}">Account Setting</a></li>
                                <li><a href="{{ route('customer#account#profile') }}">Change Password</a></li>
                                <li><a href="{{ route('customer#cart#cartList') }}">View Cart</a></li>
                                <li><a href="{{ route('customer#account#profile') }}">My Order</a></li>
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-64 col-lg-3 -->
                    @endif
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">Copyright © 2019 Molla Store. All Rights Reserved.</p><!-- End .footer-copyright -->

                    <figure class="footer-payments">
                        <img src="assets/images/payments.png" alt="Payment methods" width="272" height="20">
                    </figure><!-- End .footer-payments -->

            </div><!-- End .widget-about-info -->
        </div><!-- End .footer-bottom -->
    </footer>
    <!-- End .footer -->
    <!-- Plugins JS File -->
    <script src="{{ asset('user/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('user/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('user/assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{ asset('user/assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('user/assets/js/superfish.min.js')}}"></script>
    <script src="{{ asset('user/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('user/assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{ asset('user/assets/js/jquery.plugin.min.js')}}"></script>
    <!-- <script src="assets/js/jquery.magnific-popup.min.js')}}"></script> -->
    <script src="{{ asset('user/assets/js/jquery.countdown.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('user/assets/js/main.js')}}"></script>
    <script src="{{ asset('user/assets/js/demos/demo-6.js')}}"></script>
    {{-- popper js cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // retrieve categories nav bar data
            $.ajax({
                type : 'get',
                url : '/customer/categories/retrieveCategory/ajax',
                dataType : 'json',
                success : function (response) {
                    $htmlAddition = '';
                    for ($i = 0; $i < response.length; $i++) {
                        $htmlAddition += `
                        <li><a href="/customer/subcategories/${response[$i].id}">${response[$i].name}</a></li>
                        `;
                    }
                    // display data
                    $('#categories').html($htmlAddition);
                    $('#mobileCategories').html($htmlAddition);
                }
            });

            // show cart item if there is anything
            $('#cartBtn').click(function () {
                // if not login, go to login
                if($('#userId').val() === 'null' || $('#userId').val() === null) {
                    window.location.href = '/loginPage';
                }
            });
            // if login
            if($('#userId').val() !== 'null' || $('#userId').val() !== null) {
                $data = {
                    userId : $('#userId').val()
                };
                $.ajax({
                        type : 'get',
                        url : '/customer/cart/retrieveCartData/ajax',
                        data : $data,
                        dataType : 'json',
                        success : function (response) {
                            $htmlAddition = '';
                            for($i = 0; $i < response.cartItems.length;$i++) {
                                $htmlAddition += `
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/customer/products/${response.cartItems[$i].product_id}">${response.cartItems[$i].product_name}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">${response.cartItems[$i].quantity}</span>
                                                x ${response.cartItems[$i].product_price}
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="/customer/products/${response.cartItems[$i].product_id}" class="product-image">
                                                <img src="{{ asset('storage/admin/product/${response.cartItems[$i].product_image}') }}" alt="product">
                                            </a>
                                        </figure>
                                    </div><!-- End .product -->
                                `;
                            };
                            // display necesscary cart data
                            $('#cartProducts').html($htmlAddition);
                            $('#cartCount').text(response.cartItems.length);
                            $('.cartTotal').text(`${response.total} Kyats`)
                        }
                    });
            }
        })
    </script>
    @yield('script')
</body>


<!-- molla/index-6.html  22 Nov 2019 09:56:39 GMT -->
</html>
