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
                <a href="{{ route('admin#homeSliders#list') }}">
                    <i class='bx bx-arrow-from-right fs-3 text-dark'></i>
                </a>
            </div>
          <div class="card-header d-flex justify-content-center align-items-center">
            <h5 class="mb-0">Update Slider</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin#homeSliders#create') }}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ asset('storage/admin/homeSliders/'.$slider->image) }}" class="img-thumbnail">
                </div>
                <div class="m-3 col-lg-5 col-md-12 col-sm-12">
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="title">Title</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            name="title"
                            placeholder="Enter Title"
                            value="{{ $slider->title }}"
                          />
                        </div>
                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="image">Slider Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"/>
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Category</label>
                        <select name="categoryId" class="form-select @error('categoryId') is-invalid @enderror">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($slider->category_id === $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categoryId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <div>
                    <input type="hidden" name="id" value="{{ $slider->id }}">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
