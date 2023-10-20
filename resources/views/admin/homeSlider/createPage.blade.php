@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">
             {{-- password change success --}}
            @if (session('createdSlider'))
            <div class="col-12">
                <div class="alert alert-success border border-dark alert-dismissible" role="alert">
                    {{ session('createdSlider') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
          <div class="card mb-4">
            <h3 class="card-header">Create Home Sliders</h3>
            <div class="card-body">
                <form  class="mb-3" action="{{ route('admin#homeSliders#create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class=" row mb-3">
                       <div class="col-lg-6 col-md-8 col-sm-10">
                            <label class="form-label" for="image">Home Slidder Image</label>
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
                          placeholder="Enter Label Name"
                        />
                      </div>
                      @error('title')
                      <small class="text-danger">{{ $message }}</small>
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
