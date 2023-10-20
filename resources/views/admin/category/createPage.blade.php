@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-center align-items-center">
            <h5 class="mb-0">Create Category</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin#category#createCategory') }}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Category Name</label>
                <input type="text" name="categoryName" class="form-control @error('categoryName') is-invalid @enderror" placeholder="Enter Category Name..." value="{{ old('categoryName') }}" />
                @error('categoryName')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Category Image</label>
                <input type="file" name="categoryImage" class="form-control @error('categoryImage') is-invalid @enderror"/>
                @error('categoryImage')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-center align-items-center">
              <h5 class="mb-0">Create Sub Category</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('admin#category#createSubCategory') }}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Sub-Category Name</label>
                  <input type="text" name="subCategoryName" class="form-control @error('subCategoryName') is-invalid @enderror" placeholder="Enter Sub Category Name..." value="{{ old('subCategoryName') }}" />
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
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categoryId')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
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
                    <input type="text" name="subCategorySortingWord" class="form-control @error('subCategorySortingWord') is-invalid @enderror" placeholder="Enter Sub Category Name..." value="{{ old('subCategorySortingWord') }}" />
                    @error('subCategorySortingWord')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
