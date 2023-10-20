@extends('user.layouts.master')

@section('mainContent')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blog List<span>Blog</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer#blog#list') }}">Blog List</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <nav class="blog-nav">
                <ul class="menu-cat entry-filter justify-content-center">
                    <li class="active" id="allBlogsFilter"><a href="#" data-filter="*">All Blog Posts<span>12</span></a></li>
                    @foreach ($categories as $category)
                    <li class="categoryList" style="cursor: pointer"><a>{{ $category->name }}<span>{{ $blogs->where('category_id', $category->id)->count() }}</span></a>
                    <input type="hidden" value="{{ $category->id }}" class="categoryId"></li>
                    @endforeach
                </ul><!-- End .blog-menu -->
            </nav><!-- End .blog-nav -->

            <div class="entry-container max-col-4" id="blogList">
                @foreach ($blogList as $blog)
                <div class="entry-item lifestyle col-sm-6 col-md-4 col-lg-3">
                    <article class="entry entry-grid text-center">
                        <figure class="entry-media">
                            <a href="{{ route('customer#blog#single',$blog->id) }}">
                                <img src="{{ asset('Storage/admin/blog/'.$blog->image) }}" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <a href="{{ route('customer#blog#single',$blog->id) }}">{{ $blog->created_at }}</a>
                                <span class="meta-separator">|</span>
                                <a href="{{ route('customer#blog#single',$blog->id) }}" id="commentsCount">{{ $comments->where('blog_id',$blog->id)->count() }} Comments</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="{{ route('customer#blog#single',$blog->id) }}">{{ $blog->title }}</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <span>{{ $blog->category_name }}</span>
                            </div><!-- End .entry-cats -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .entry-item -->
                @endforeach
            </div><!-- End .entry-container -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.categoryList').click(function () {

            $data = {
                'categoryId' : $(this).find('.categoryId').val()
            };
            $.ajax({
                type : 'get',
                url : '/customer/blog/sortByCategory/ajax',
                data : $data,
                dataType : 'json',
                success : function (response) {
                    $htmlAddition = ``;
                    for($i = 0; $i < response.blogs.data.length; $i++) {
                        // render sorted blog
                        $image = response.blogs.data[$i].image;
                        $title = response.blogs.data[$i].title;
                        $created_at = response.blogs.data[$i].created_at;
                        $category_name = response.blogs.data[$i].category_name;

                        $htmlAddition +=
                        `
                        <div class="entry-item lifestyle col-sm-6 col-md-4 col-lg-3">
                            <article class="entry entry-grid text-center">
                                <figure class="entry-media">
                                    <a href="single.html">
                                        <img src="{{ asset('storage/admin/blog/${$image}') }}" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">${$created_at}</a>
                                        <span class="meta-separator">|</span>
                                        <a href="#" class="commentCount">${response.comments[$i]} Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="single.html">${$title}</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">${$category_name}</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        </div><!-- End .entry-item -->
                        `;

                    }
                    $('#blogList').html($htmlAddition);


                }
            });

            $('.categoryList').removeClass('active');
            $('#allBlogsFilter').removeClass('active');
            $(this).addClass('active');
        })
        $('#allBlogsFilter').click(function () {
            $data = {
                'categoryId' : 'all'
            };
            $.ajax({
                type : 'get',
                url : '/customer/blog/sortByCategory/ajax',
                data : $data,
                dataType : 'json',
                success : function (response) {
                   $htmlAddition = ``;
                    for($i = 0; $i < response.blogs.data.length; $i++) {
                        $id = response.blogs.data[$i].id;
                        $image = response.blogs.data[$i].image;
                        $title = response.blogs.data[$i].title;
                        $created_at = response.blogs.data[$i].created_at;
                        $category_name = response.blogs.data[$i].category_name;

                        $routeUrl = `/customer/blog/${$id}`;
                        $htmlAddition +=
                        `
                        <div class="entry-item lifestyle col-sm-6 col-md-4 col-lg-3">
                            <article class="entry entry-grid text-center">
                                <figure class="entry-media">
                                    <a href="${$routeUrl}">
                                        <img src="{{ asset('storage/admin/blog/${$image}') }}" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="${$routeUrl}">${$created_at}</a>
                                        <span class="meta-separator">|</span>
                                        <a href="${$routeUrl}">${response.comments[$i]}  Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="${$routeUrl}">${$title}</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">${$category_name}</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        </div><!-- End .entry-item -->
                        `;
                    };
                    $('#blogList').html($htmlAddition);
                }
            });
            $('.categoryList').removeClass('active');
            $('#allBlogsFilter').toggleClass('active');
        })
    });
</script>
@endsection
