
@extends('user.layouts.master')

@section('mainContent')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ asset('storage/admin/category/'.$category->image) }})">
        <div class="container">
            <h1 class="page-title" style="color: black">{{ $category->name }}</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">
                <div class="col-lg-6 col-md-7 col-sm-8 text-start">
                    <h2 class="title text-lg-start text-md-center text-sm-center mb-3">{{ $category->name }}'s Sub Categories</h2><!-- End .title mb-2 -->
                    <input type="hidden" value="{{ $category->id }}" id="categoryId">
                </div>
                <div class="col-lg-6 col-md-8 col-sm-10 ">
                    <div class="row justify-content-lg-end justify-content-md-center justify-content-sm-center">
                        <select name="subcategorySorting" id="subcategorySorting" class="form-control border-primary col-5">
                            <option value="all" selected>All</option>
                            @foreach ($sorting_words as $sorting_word)
                                <option value="{{ $sorting_word }}">{{ $sorting_word}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center justify-content-sm-center" id="subcategories">
               @foreach ($subcategories as $subcategory)
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="banner banner-cat">
                        <a href="{{ route('customer#productBySubcategory',$subcategory->id) }}">
                            <img src="{{ asset('storage/admin/subcategory/'.$subcategory->image) }}" alt="Banner" >
                        </a>

                        <div class="banner-content banner-content-static text-center">
                            <h3 class="banner-title my-3">{{ $subcategory->name }}</h3><!-- End .banner-title -->
                            <h4 class="banner-subtitle">Show Products</h4><!-- End .banner-subtitle -->
                            <a href="{{ route('customer#productBySubcategory',$subcategory->id) }}" class="banner-link">Shop Now</a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-md-6 -->
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

        // subcategory sorting ajax
        $('#subcategorySorting').change(function () {
            $.ajax({
                type : 'get',
                url : '/customer/subcategories/sorting/ajax',
                dataType : 'json',
                data : {
                    'sorting_word' : $('#subcategorySorting').val(),
                    'categoryId' : $('#categoryId').val()
                },
                success : function (response) {
                    $htmlAddition = ``;
                    for($i = 0; $i < response.length; $i++) {
                        $id = response[$i].id;
                        $name = response[$i].name;
                        $image = response[$i].image;

                        $routeUrl = `/customer/subcategories/products/${$id}`;

                        $htmlAddition += `
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="banner banner-cat">
                                <a href="${$routeUrl}">
                                    <img src="{{ asset('storage/admin/subcategory/${$image}') }}" alt="Banner" >
                                </a>

                                <div class="banner-content banner-content-static text-center">
                                    <h3 class="banner-title my-3">${$name}</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">Show Products</h4><!-- End .banner-subtitle -->
                                    <a href="${$routeUrl}" class="banner-link">Shop Now</a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-6 -->
                        `;
                    }
                    $('#subcategories').html($htmlAddition);
                }
            });
        });
    });
</script>
@endsection
