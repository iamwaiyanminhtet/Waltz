@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-12">
        {{-- update category --}}
        @if (session('updatedCategory'))
         <div class="alert alert-success border border-dark alert-dismissible" role="alert">
             {{ session('updatedCategory') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
        @endif
        <div class="card mb-4">
            <div class="bg-white p-2 mb-1">
                <a href="{{ route('admin#category#categoryList') }}">
                    <i class='bx bx-arrow-from-right fs-3 text-dark'></i>
                </a>
            </div>
          <div class="card-header d-flex justify-content-center align-items-center">
            <h5 class="mb-0">Update Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin#category#createCategory') }}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ asset('storage/admin/category/'.$category->image) }}" class="img-thumbnail">
                </div>
                <div class="m-3 col-lg-5 col-md-12 col-sm-12">
                    <label class="form-label" for="basic-default-fullname">Category Name</label>
                    <input type="text" name="categoryName" class="form-control @error('categoryName') is-invalid @enderror" placeholder="Enter Category Name..." value="{{ old('categoryName',$category->name) }}" />
                    @error('categoryName')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="mb-3 mt-2">
                        <label class="form-label" for="basic-default-fullname">Category Image</label>
                        <input type="file" name="categoryImage" class="form-control @error('categoryImage') is-invalid @enderror"/>
                        @error('categoryImage')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <div>
                    <input type="hidden" name="id" value="{{ $category->id }}">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
