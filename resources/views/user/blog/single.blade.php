@extends('user.layouts.master')

@section('mainContent')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer#blog#list') }}">Blog List</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer#blog#list') }}">{{ $blog->category_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content ">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <img src="{{ asset('Storage/admin/blog/'.$blog->image) }}" alt="image desc">
            </div>
        </div>
        <div class="container mt-3">
            <article class="entry single-entry entry-fullwidth">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="">{{ $blog->username }}</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="">{{ $blog->created_at }}</a>
                                <span class="meta-separator">|</span>
                                <a href="">{{ count($currentBlogComments) }} Comments</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title entry-title-big">
                                {{ $blog->title }}
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <span>{{ $blog->category_name }}</span>
                            </div><!-- End .entry-cats -->

                            <div class="entry-content editor-content text-wrap">
                                <p class="text-wrap">{{ $blog->description }}</p>
                            </div>
                        </div><!-- End .entry-body -->
                    </div><!-- End .col-lg-11 -->

                    <div class="col-lg-1 order-lg-first mb-2 mb-lg-0">
                        <div class="sticky-content">
                            <div class="social-icons social-icons-colored social-icons-vertical">
                                <span class="social-label">SHARE:</span>
                                <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                            </div><!-- End .soial-icons -->
                        </div><!-- End .sticky-content -->
                    </div><!-- End .col-lg-1 -->
                </div><!-- End .row -->

                <div class="entry-author-details">
                    <figure class="author-media">
                        <div href="">
                            <img
                                @if ($blog->user_image === null)
                                    @if ($blog->gender === 'male')
                                        src="{{ asset('user_male_default.png') }}"
                                    @elseif ($blog->gender === 'female')
                                        src="{{ asset('default_user_female.svg') }}"
                                    @endif
                                @else
                                    src="{{ asset('storage/admin/account/'.$blog->user_image )}}"
                                @endif
                        >
                        </div>
                    </figure><!-- End .author-media -->

                    <div class="author-body">
                        <div class="author-header row no-gutters flex-column flex-md-row">
                            <div class="col">
                                <h4><a href="">{{ $blog->username }}</a></h4>
                            </div><!-- End .col -->
                        </div><!-- End .row -->
                        <div class="author-content">
                            <p>One of the best author in our admin team</p>
                        </div><!-- End .author-content -->
                    </div><!-- End .author-body -->
                </div><!-- End .entry-author-details-->
            </article><!-- End .entry -->

            <div class="related-posts">
                <h3 class="title">Related Blogs</h3><!-- End .title -->

                <div class="owl-carousel owl-simple" data-toggle="owl"
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
                            }
                        }
                    }'>
                    @foreach ($relatedBlogs as $relatedBlog)
                    <article class="entry entry-grid">
                        <figure class="entry-media">
                            <a href="{{ route('customer#blog#single',$relatedBlog->id) }}">
                                <img src="{{ asset('Storage/admin/blog/'.$relatedBlog->image) }}" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <a href="{{ route('customer#blog#single',$relatedBlog->id) }}">{{ $relatedBlog->created_at }}</a>
                                <span class="meta-separator">|</span>
                                <a href="{{ route('customer#blog#single',$relatedBlog->id) }}">{{ $comments->where('blog_id',$relatedBlog->id)->count() }} Comments</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="{{ route('customer#blog#single',$relatedBlog->id) }}">{{ $relatedBlog->title }}</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <a href="">{{ $relatedBlog->category_name }}</a>,
                            </div><!-- End .entry-cats -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                    @endforeach
                </div><!-- End .owl-carousel -->
            </div><!-- End .related-posts -->

            <div class="comments">
                <h3 class="title">3 Comments</h3><!-- End .title -->

                <ul>
                   @foreach ($currentBlogComments as $currentBlogComment)
                    <li>
                        <div class="comment">
                            <figure class="comment-media">
                                <a href="#">
                                    <img
                                    @if ($currentBlogComment->user_image === null)
                                        @if ($currentBlogComment->gender === 'male')
                                            src="{{ asset('user_male_default.png') }}"
                                        @elseif ($currentBlogComment->gender === 'female')
                                            src="{{ asset('default_user_female.svg') }}"
                                        @endif
                                    @else
                                        src="{{ asset('storage/admin/account/'.$currentBlogComment->user_image )}}"
                                    @endif

                                     alt="User name">
                                </a>
                            </figure>

                            <div class="comment-body">
                                <div class="comment-user">
                                    <h4><a href="">{{ $currentBlogComment->username }}</a></h4>
                                    <span class="comment-date">{{ $currentBlogComment->created_at }}</span>
                                </div><!-- End .comment-user -->

                                <div class="comment-content">
                                    <p>{{ $currentBlogComment->description }}</p>
                                </div><!-- End .comment-content -->
                            </div><!-- End .comment-body -->
                        </div><!-- End .comment -->
                    </li>
                   @endforeach
                </ul>
            </div><!-- End .comments -->
            <div class="reply">
                <div class="heading">
                    <h3 class="title">Leave A Reply</h3><!-- End .title -->
                    <p class="text-muted">The email and name you have typed will not be published. Required fields are marked *</p>
                    <small class="text-danger d-block invisible" id="needToLogin">You need to login to comment</small>
                    <small class="text-success d-block invisible" id="savedComment">Your comment has been saved</small>
                </div><!-- End .heading -->

                <form action="#">
                    <div class="row mb-2">
                        <label for="reply-message" class="sr-only">Comment</label>
                        <textarea name="commentDescription" id="commentDescription" cols="30" rows="4" class="form-control shadow-sm mb-0" required placeholder="Comment *"></textarea>
                        <small class="text-danger invisible" id="commentValidation">Comment field is required</small>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="reply-name" class="sr-only">Name</label>
                            <input type="text" class="form-control shadow-sm mb-0" id="commentName" name="commentName" required placeholder="Name *">
                            <small class="text-danger invisible" id="nameValidation">Name field is required</small>
                            <input type="hidden" id="userId" @if (Auth::user())
                                    value="{{ Auth::user()->id }}"
                                    @else
                                        value="null"
                                    @endif>
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <label for="reply-email" class="sr-only">Email</label>
                            <input type="email" class="form-control shadow-sm mb-0" id="commentEmail" name="commentEmail" required placeholder="Email *">
                            <small class="text-danger invisible" id="emailValidation">Email field is required</small>
                            <input type="hidden" id="blogId" value="{{ $blog->id }}">
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->

                    <button type="button" class="btn btn-outline-primary-2" id="commentBtn">
                        <span>POST COMMENT</span>
                        <i class="icon-long-arrow-right"></i>
                    </button>

                </form>
            </div><!-- End .reply -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
<script>

    $(document).ready(function() {
        $('#commentBtn').click(function () {
            // if not logged in
            if ($('#userId').val() === 'null') {
                $('#needToLogin').removeClass('invisible')
                setTimeout(function(){
                    window.location.href = '/loginPage'
                },3000);
            }else {
                // logged in
                // if fields are required
                if($('#commentDescription').val().length === 0) {
                    $('#commentValidation').removeClass('invisible')
                }else{
                    $('#commentValidation').addClass('invisible')
                }
                if($('#commentName').val().length === 0) {
                    $('#nameValidation').removeClass('invisible')
                }else{
                    $('#nameValidation').addClass('invisible')
                }
                if($('#commentEmail').val().length === 0) {
                    $('#emailValidation').removeClass('invisible')
                }else{
                    $('#emailValidation').addClass('invisible')
                }

                // if has data, create new comment
                if ($('#commentDescription').val().length > 0 && $('#commentName').val().length > 0 && $('#commentEmail').val().length > 0) {
                    // remove validation status
                    $('#commentValidation').addClass('invisible')
                    $('#nameValidation').addClass('invisible')
                    $('#emailValidation').addClass('invisible')
                    // get the data
                    $commentData = {
                        'description' : $('#commentDescription').val(),
                        'blog_id' : $('#blogId').val(),
                        'user_id' : $('#userId').val()
                    };
                    // call ajax to create new comment
                    $.ajax({
                        type : 'get',
                        url : '/customer/comment/create/ajax',
                        data : $commentData,
                        dataType : 'json',
                        success : function (response) {
                            if(response.status == 'success') {
                                $('#commentDescription').val('');
                                $('#commentName').val('');
                                $('#commentEmail').val('');

                                $('#savedComment').removeClass('invisible');
                                setTimeout(function(){
                                    $('#savedComment').addClass('invisible');
                                },3000);
                                return;
                            }
                        }
                    });
                }
            }
        });
    })
</script>
{{-- <script>
    $htmlAddition = ``;
                    for($i = 0; $i < response.data.length; $i++) {

                        $image = response.data[$i].image;
                        $title = response.data[$i].title;
                        $created_at = response.data[$i].created_at;
                        $category_name = response.data[$i].category_name;

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
                                        <a href="#">0 Comments</a>
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
                    };
                    $('#blogList').html($htmlAddition);
</script> --}}
@endsection
