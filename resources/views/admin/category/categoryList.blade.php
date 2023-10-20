@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- create role --}}
        @if (session('createdCategory'))
        <div class="alert alert-success border border-dark alert-dismissible" role="alert">
            {{ session('createdCategory') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- update role --}}
        @if (session('updatedCategory'))
        <div class="alert alert-info border border-dark alert-dismissible" role="alert">
            {{ session('updatedCategory') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
         {{-- delete role --}}
         @if (session('deletedCategory'))
         <div class="alert alert-danger border border-dark alert-dismissible" role="alert">
             {{ session('deletedCategory') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
      <div class="row">

        <div class="col-12">
          <div class="card mb-4">
                <div class="card-header row">
                    <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-center text-sm-center">
                       <a href="{{ route('admin#category#categoryList') }}" class="text-dark">
                        Category List <span class="badge badge-center rounded-pill bg-label-primary">{{ $categories->total() }}</span>
                       </a>
                    </h5>
                   <form class="d-flex offset-lg-6 col-lg-3 col-md-12 col-sm-12 justify-content-center" style="max-height: 5vh !important;" method="get"
                   action="{{ route('admin#category#categoryList') }}">
                    <a href="{{ route('admin#category#createPage') }}" class="btn btn-sm btn-info me-1">
                        <i class='bx bx-message-alt-add'></i>
                    </a>
                        <div class="d-flex">
                            <input type="search" name="searchCategory" value="{{ request('searchCategory') }}" class="form-control form-control-sm">
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
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                           @foreach ($categories as $category)
                           <tr class="table-primary">
                                <td>{{ $category->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/admin/category/'.$category->image )}}" width="150px">
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item"
                                              href="{{ route('admin#category#update',$category->id) }}">
                                                  <i class="bx bx-edit-alt me-1"></i> Edit
                                              </a>
                                              <a class="dropdown-item"
                                              href="{{ route('admin#category#delete',$category->id) }}">
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
                    {{ $categories->links() }}
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
