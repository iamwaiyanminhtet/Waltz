@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- create role --}}
        @if (session('createdProduct'))
        <div class="alert alert-success border border-dark alert-dismissible" role="alert">
            {{ session('createdProduct') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- update role --}}
        @if (session('updatedProduct'))
        <div class="alert alert-info border border-dark alert-dismissible" role="alert">
            {{ session('updatedProduct') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- featured role --}}
        @if (session('featured'))
        <div class="alert alert-warning border border-dark alert-dismissible" role="alert">
            {{ session('featured') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
         {{-- delete role --}}
         @if (session('deletedProduct'))
         <div class="alert alert-danger border border-dark alert-dismissible" role="alert">
             {{ session('deletedProduct') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
      <div class="row">

        <div class="col-12">
          <div class="card mb-4">
                <div class="card-header row">
                    <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-center text-sm-center">
                        <a href="{{ route('admin#product#list') }}" class="text-dark">
                            Product List <span class="badge badge-center rounded-pill bg-label-primary">{{ $products->total() }}</span>
                        </a>
                    </h5>

                   <form class="d-flex offset-lg-3 col-lg-6 col-md-12 col-sm-12 justify-content-end" style="max-height: 5vh !important;" action="{{ route('admin#product#list') }}" method="get">
                    <a href="{{ route('admin#product#createPage') }}" class="btn btn-sm btn-info me-1">
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
                        <input type="search" name="searchProduct" value="{{ request('searchProduct') }}" class="form-control form-control-sm">
                        <button type="submit" class="btn btn-sm btn-info ms">
                            <i class='bx bx-search-alt-2'></i>
                        </button>
                    </div>
               </form>
                </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Featured</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                           @foreach ($products as $product)
                           <tr class="table-primary">
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/admin/product/'.$product->image )}}" width="150px">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ Str::limit($product->description, 10, '...') }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->sub_category_name }}</td>
                                <td>{{ $product->featured }}</td>
                                <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item"
                                              href="{{ route('admin#product#update',$product->id) }}">
                                                  <i class="bx bx-edit-alt me-1"></i> Edit
                                              </a>
                                              @if ($product->featured === 0)
                                                <a class="dropdown-item"
                                                href="{{ route('admin#product#featured',$product->id) }}">
                                                    <i class="bx bx-right-arrow me-1"></i>Featured
                                                </a>
                                              @endif
                                              @if ($product->featured === 1)
                                                <a class="dropdown-item"
                                                href="{{ route('admin#product#featured',$product->id) }}">
                                                    <i class="bx bx-right-arrow me-1"></i>Un-Featured
                                                </a>
                                              @endif
                                              <a class="dropdown-item"
                                              href="{{ route('admin#product#delete',$product->id) }}">
                                                  <i class="bx bx-trash me-1"></i> Delete
                                              </a>
                                          </div>
                                    </div>
                                </td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-black p-4">
                    {{ $products->links() }}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
@endsection
