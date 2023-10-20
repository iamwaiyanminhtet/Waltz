@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <h3 class="card-header">Create New Blog</h5>
            <div class="card-body">
                <form  class="mb-3" action="{{ route('admin#blog#create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class=" row mb-3">
                        <div class="col-lg-6 col-md-8 col-sm-10">
                             <label class="form-label" for="image">Offer Image</label>
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
                      <label class="form-label" for="title">Title</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          class="form-control @error('title') is-invalid @enderror"
                          name="title"
                          placeholder="Enter Blog Title"
                        />
                      </div>
                      @error('title')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="description">Description</label>
                        <div class="input-group input-group-merge">
                          <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5" placeholder="Enter Blog Text"></textarea>
                        </div>
                        @error('description')
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
                        <label class="form-label" for="adminId">Admin Name</label>
                        <div class="input-group input-group-merge">
                          <select name="adminId" class="form-select @error('adminId') is-invalid @enderror" >
                            <option value="" disabled selected>Choose Admin</option>
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('adminId')
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
