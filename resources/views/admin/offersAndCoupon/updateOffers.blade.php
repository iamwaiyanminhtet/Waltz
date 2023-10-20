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
                <a href="{{ route('admin#offers#list') }}">
                    <i class='bx bx-arrow-from-right fs-3 text-dark'></i>
                </a>
            </div>
          <div class="card-header d-flex justify-content-center align-items-center">
            <h5 class="mb-0">Update Offers</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin#offers#create') }}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ asset('storage/admin/offers/'.$offer->image) }}" class="img-thumbnail">
                </div>
                <div class="m-3 col-lg-5 col-md-12 col-sm-12">
                    <div class="mb-3 mt-2">
                        <label class="form-label" for="basic-default-fullname">Offers Image</label>
                        <input type="file" name="offersImage" class="form-control @error('offersImage') is-invalid @enderror"/>
                        @error('offersImage')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="labelName">Label Name</label>
                        <input type="text" name="labelName" class="form-control @error('labelName') is-invalid @enderror" placeholder="Enter Category Name..." value="{{ old('labelName',$offer->label_name) }}" />
                        @error('labelName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="description">Description</label>
                        <div class="input-group input-group-merge">
                          <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5" placeholder="Enter Description">{{ $offer->description }}</textarea>
                        </div>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="couponCode">Coupon Code *(optional)</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="text"
                            class="form-control"
                            name="couponCode"
                            placeholder="Enter Coupon Code"
                            value="@if ($offer->coupon_code !== null)
                            $offer->coupon_code
                            @endif"
                          />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <div>
                    <input type="hidden" name="id" value="{{ $offer->id }}">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
