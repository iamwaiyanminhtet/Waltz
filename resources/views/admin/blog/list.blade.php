@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('createdBlog'))
        <div class="alert alert-success border border-dark alert-dismissible" role="alert">
            {{ session('createdBlog') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('updatedBlog'))
        <div class="alert alert-info border border-dark alert-dismissible" role="alert">
            {{ session('updatedBlog') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('deletedBlog'))
        <div class="alert alert-danger border border-dark alert-dismissible" role="alert">
            {{ session('deletedBlog') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
                <div class="card-header row">
                    <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-center text-sm-center">
                        Blog List <span class="badge badge-center rounded-pill bg-label-primary">
                            {{ $blogs->total() }}
                        </span>
                    </h5>
                   <form class="d-flex offset-lg-3 col-lg-6 col-md-12 col-sm-12 justify-content-end" style="max-height: 5vh !important;" action="{{ route('admin#blog#list') }}" method="get">
                    <a href="{{ route('admin#blog#createPage') }}" class="btn btn-sm btn-info me-1">
                        <i class='bx bx-message-alt-add'></i>
                    </a>
                    <div class="d-flex me-1" >
                        <select name="sortByCategory" class="form-control form-control-sm">
                            <option value="all" selected >Default</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (request('sortByCategory') == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-info" type="submit">
                            <i class='bx bx-sort'></i>
                        </button>
                    </div>
                    <div class="d-flex">
                        <input type="search" name="searchBlog" value="{{ request('searchBlog') }}" class="form-control form-control-sm">
                        <button type="submit" class="btn btn-sm btn-info ms">
                            <i class='bx bx-search-alt-2'></i>
                        </button>
                    </div>
               </form>
                </div>
            <div class="row row-cols-1 row-cols-md-4 g-4 mb-5 p-3">
                @foreach ($blogs as $blog)
                <div class="col">
                    <a href="{{ route('admin#blog#updatePage',$blog->id) }}" >
                        <div class="card border border-dark shadow h-100">
                            <img class="card-img-top border-bottom border-dark" src="{{ asset('storage/admin/blog/'.$blog->image )}}" alt="Card image cap" />
                            <div class="card-body pb-3">
                                <h5 class="card-title mb-0">{{$blog->title}}</h5>
                                <div class="card-subtitle text-muted text-sm-end">By {{ $blog->admin_name }}</div>
                              <p class="card-text">
                                {{ Str::limit($blog->description, 30, '...') }}
                              </p>
                              <div class="d-flex mt-2">
                                <a href="{{ route('admin#blog#updatePage',$blog->id) }}" class="btn btn-sm btn-info text-sm-end text-dark me-2">Update</a>
                                <a href="{{ route('admin#blog#delete',$blog->id) }}" class="btn btn-sm btn-danger text-sm-end text-dark">Delete</a>
                              </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
@endsection
