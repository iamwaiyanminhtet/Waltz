@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">
             {{-- password change success --}}
            @if (session('changeSuccess'))
            <div class="col-12">
                <div class="alert alert-success border border-dark alert-dismissible" role="alert">
                    {{ session('changeSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            {{-- not match --}}
            @if (session('notMatch'))
            <div class="col-12">
                <div class="alert alert-danger border border-dark alert-dismissible" role="alert">
                    {{ session('notMatch') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
          <div class="card mb-4">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form  class="mb-3" action="{{ route('admin#account#changePassword') }}" method="POST">
                    @csrf
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="oldPassword">Old Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="password"
                          id="password"
                          class="form-control @error('oldPassword') is-invalid @enderror"
                          name="oldPassword"
                          placeholder="Enter old password"
                          aria-describedby="password"
                        />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                      @error('oldPassword')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="newPassword">New Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            class="form-control @error('newPassword') is-invalid @enderror"
                            name="newPassword"
                            placeholder="Enter new password"
                            aria-describedby="password"
                          />
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('newPassword')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input
                            type="password"
                            class="form-control @error('confirmPassword') is-invalid @enderror"
                            name="confirmPassword"
                            placeholder="Confirm password"
                            aria-describedby="password"
                            />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                       @error('confirmPassword')
                        <small class="text-danger">{{ $message }}</small>
                       @enderror
                    </div>
                    <input type="hidden" value="{{ Auth::user()->id }}" name="userId">
                    <button class="btn btn-primary d-grid w-100" type="submit">Change</button>
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
