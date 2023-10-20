@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <h3 class="card-header">Create New Product</h5>
            <div class="card-body">
                <form  class="mb-3" action="{{ route('admin#product#create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class=" row mb-3">
                        <div class="col-lg-6 col-md-8 col-sm-10">
                             <label class="form-label" for="image">Product Image</label>
                             <input type="file" id="inputImage" name="image" class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)"/>
                             @error('image')
                             <div class="invalid-feedback">
                                 {{ $message }}
                             </div>
                             @enderror
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-10 d-flex justify-content-center align-items-center">
                             <img src="" alt="" id="uploadedImage" style="max-width: 15% !important"/>
                        </div>
                     </div>

                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="name">Product Name</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          class="form-control @error('name') is-invalid @enderror"
                          name="name"
                          placeholder="Enter Product Name"
                        />
                      </div>
                      @error('name')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="description">Description</label>
                        <div class="input-group input-group-merge">
                          <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5" placeholder="Enter Description"></textarea>
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
                            placeholder="Enter Product Price"
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
                            placeholder="The year when product produced"
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
                            placeholder="A word to sort product"
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
                            <option value="" disabled selected>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('subCategoryId')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                    <button class="btn btn-primary d-grid w-100" type="submit">Create</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
  </div>
@endsection
@section('script')
<script>
    let loadFile = function(event) {
        let image = document.getElementById('uploadedImage');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection
