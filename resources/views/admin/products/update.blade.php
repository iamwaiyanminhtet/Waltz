@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="bg-white p-2 mb-1">
                <a href="{{ route('admin#product#list') }}">
                    <i class='bx bx-arrow-from-right fs-3 text-dark'></i>
                </a>
            </div>
          <div class="card-header d-flex justify-content-center align-items-center">
            <h3 class="mb-0">Update Product</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('admin#product#create') }}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ asset('storage/admin/product/'.$product->image) }}" class="img-thumbnail">
                </div>

                <div class="m-3 col-lg-5 col-md-12 col-sm-12">
                    <div>
                        <label class="form-label" for="name">Product Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$product->name) }}" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 mt-2">
                        <label class="form-label" for="image">Category Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"/>
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="description">Description</label>
                        <div class="input-group input-group-merge">
                          <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5">{{ $product->description }}</textarea>
                        </div>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="price">Price</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            class="form-control @error('price') is-invalid @enderror"
                            name="price"
                            value="{{ old('price',$product->price) }}"
                          />
                        </div>
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="year">Year</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            class="form-control @error('year') is-invalid @enderror"
                            name="year"
                            value="{{ old('year',$product->year) }}"
                          />
                        </div>
                        @error('year')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="sorting_word">Sorting Word</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            class="form-control @error('sorting_word') is-invalid @enderror"
                            name="sorting_word"
                            value="{{ old('sorting_word',$product->sorting_word) }}"
                          />
                        </div>
                        @error('sorting_word')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="categoryId">Category</label>
                        <div class="input-group input-group-merge">
                          <select name="categoryId" class="form-select @error('categoryId') is-invalid @enderror" id="">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id === $product->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('categoryId')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="subCategoryId">Sub Category</label>
                        <div class="input-group input-group-merge">
                          <select name="subCategoryId" class="form-select @error('subCategoryId') is-invalid @enderror" id="">
                            <option value="" disabled selected>Choose Sub Category</option>
                            @foreach ($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" @if ($subCategory->id === $product->sub_category_id) selected @endif>{{ $subCategory->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('subCategoryId')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
                <input type="hidden" name="id" value="{{ $product->id }}">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
