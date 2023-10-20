@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="bg-white p-2 mb-1">
                <a href="{{ route('admin#category#subCategoryList') }}">
                    <i class='bx bx-arrow-from-right fs-3 text-dark'></i>
                </a>
            </div>
          <div class="card-header d-flex justify-content-center align-items-center">
            <h5 class="mb-0">Update Sub Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin#category#createSubCategory') }}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ asset('storage/admin/subcategory/'.$subCategory->image) }}" class="img-thumbnail">
                </div>
                <div class="m-3 col-lg-5 col-md-12 col-sm-12">
                    <div class="mb-3 mt-2">
                        <label class="form-label" for="basic-default-fullname">Sub Category Name</label>
                    <input type="text" name="subCategoryName" class="form-control @error('subCategoryName') is-invalid @enderror" placeholder="Enter Category Name..." value="{{ old('subCategoryName',$subCategory->name) }}" />
                    @error('subCategoryName')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Category</label>
                        <select name="categoryId" class="form-select @error('categoryId') is-invalid @enderror">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($subCategory->category_id === $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categoryId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 mt-2">
                        <label class="form-label" for="basic-default-fullname">Sub Category Image</label>
                        <input type="file" name="subCategoryImage" class="form-control @error('subCategoryImage') is-invalid @enderror"/>
                        @error('subCategoryImage')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Sub-Category Sorting Word</label>
                        <input type="text" name="subCategorySortingWord" class="form-control @error('subCategorySortingWord') is-invalid @enderror" placeholder="Enter Sub Category Name..." value="{{ old('subCategoryName',$subCategory->sorting_word) }}" />
                        @error('subCategorySortingWord')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <div>
                    <input type="hidden" name="id" value="{{ $subCategory->id }}">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
