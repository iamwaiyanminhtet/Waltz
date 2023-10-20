@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="bg-white p-2 mb-1">
                <a href="{{ route('admin#blog#list') }}">
                    <i class='bx bx-arrow-from-right fs-3 text-dark'></i>
                </a>
            </div>
          <div class="card-header d-flex justify-content-center align-items-center">
            <h3 class="mb-0">Update Blog</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('admin#blog#create') }}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ asset('storage/admin/blog/'.$blog->image) }}" class="img-thumbnail">
                </div>

                <div class="m-3 col-lg-5 col-md-12 col-sm-12">
                    <div>
                        <label class="form-label" for="title">Blog Name</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$blog->title) }}" />
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 mt-2">
                        <label class="form-label" for="image">Image</label>
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
                          <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5">{{ $blog->description }}</textarea>
                        </div>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="categoryId">Category</label>
                        <div class="input-group input-group-merge">
                          <select name="categoryId" class="form-select @error('categoryId') is-invalid @enderror" id="">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id === $blog->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('categoryId')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="adminId">Admin</label>
                        <div class="input-group input-group-merge">
                          <select name="adminId" class="form-select @error('adminId') is-invalid @enderror" id="">
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->id }}" @if ($admin->id === $blog->admin_id) selected @endif>{{ $admin->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('adminId')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
                <input type="hidden" name="id" value="{{ $blog->id }}">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
