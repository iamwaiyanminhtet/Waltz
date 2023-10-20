@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">

            <div class="bg-white p-1 mb-1">
                <a href="{{ route('admin#account#userList') }}">
                    <i class='bx bx-arrow-from-right fs-3 text-dark'></i>
                </a>
            </div>
            <div class="card mb-4">
                <h5 class="card-header">User Details</h5>
                <!-- Account -->
                <div class="card-body">
                  <div class="d-flex align-items-start align-items-sm-center justify-content-center gap-4">
                    <img
                      @if ($user->image === null)
                        @if ($user->gender === 'male')
                            src="{{ asset('user_male_default.png') }}"
                        @elseif ($user->gender === 'female')
                            src="{{ asset('default_user_female.svg') }}"
                        @endif
                      @else
                        src="{{ asset('storage/admin/account/'.$user->image)}}"
                      @endif
                      alt="admin-avatar"
                      class="d-block rounded"
                      height="100"
                      width="100"
                      id="uploadedAvatar"
                    />
                  </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl">
                            <form>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon11">
                                                <i class="bx bx-user"></i>
                                            </span>
                                            <input
                                              type="text"
                                              id="name"
                                              class="form-control"
                                              placeholder="{{ $user->name }}"
                                              aria-describedby="basic-addon11"
                                              disabled
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon11">
                                                <i class="bx bx-envelope"></i>
                                            </span>
                                            <input
                                              type="email"
                                              id="email"
                                              class="form-control"
                                              placeholder="{{ $user->email }}"
                                              aria-describedby="basic-addon11"
                                              disabled
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon11">
                                                <i class="bx bx-phone"></i>
                                            </span>
                                            <input
                                              type="number"
                                              id="phone"
                                              class="form-control"
                                              placeholder="{{ $user->phone }}"
                                              aria-describedby="basic-addon11"
                                              disabled
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="address">Address</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon11">
                                                <i class="bx bx-location-plus"></i>
                                            </span>
                                            <input
                                              type="text"
                                              id="address"
                                              class="form-control"
                                              placeholder="{{ $user->address }}"
                                              aria-describedby="basic-addon11"
                                              disabled
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="address">Gender</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class="bx bx-male"></i>
                                                <i class="bx bx-female ms-0"></i>
                                            </span>
                                            <select name="gender" id="gender" class="form-control" disabled>
                                                <option value="male" @if ($user->gender === 'male') selected @endif disabled>Male</option>
                                                <option value="female" @if ($user->gender === 'female') selected @endif disabled>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="dateOfBirth">Date of Birth</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon11">
                                                <i class="bx bx-time"></i>
                                            </span>
                                            <input
                                              type="text"
                                              id="dateOfBirth"
                                              class="form-control"
                                              placeholder="{{ $user->date_of_birth }}"
                                              aria-describedby="basic-addon11"
                                              disabled
                                            />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Account -->
              </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
  </div>
@endsection
