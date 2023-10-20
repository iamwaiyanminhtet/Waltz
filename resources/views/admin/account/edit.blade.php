@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <h5 class="card-header">Edit Profile</h5>

            <!-- Account -->
            <form action="{{ route('admin#account#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="d-flex align-items-start align-items-center gap-4">
                    <img
                    @if (Auth::user()->image === null)
                        @if (Auth::user()->gender === 'male')
                            src="{{ asset('user_male_default.png') }}"
                        @elseif (Auth::user()->gender === 'female')
                            src="{{ asset('default_user_female.svg') }}"
                        @endif
                    @else
                        src="{{ asset('storage/admin/account/'.Auth::user()->image)}}"
                    @endif
                    alt="admin-avatar"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="uploadedAvatar"
                    />
                    <div>
                        <input type="file" name="image" id="inputImage" onchange="loadFile(event)" class="form-control">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                          <span class="d-none d-sm-block">Upload new photo</span>
                          <i class="bx bx-upload d-block d-sm-none"></i>
                          <input
                            type="file"
                            id="inputImage"
                            name="image"
                            onchange="loadFile(event)"
                            class="account-file-input"
                            hidden
                          />

                        </label>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>

                    </div> --}}
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
                                        <div class="input-group @error('name') has-validation @enderror">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class="bx bx-user"></i>
                                            </span>
                                            <input
                                                type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name"
                                                name="name"
                                                value="{{ Auth::user()->name }}"
                                            />

                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        </div>
                                    </div>

                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group @error('email') has-validation @enderror">
                                            <span id="" class="input-group-text">
                                                <i class="bx bx-envelope"></i>
                                            </span>
                                            <input
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email"
                                                name="email"
                                                value="{{ Auth::user()->email }}"
                                            />
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                                    <div class="col-sm-10">
                                        <div class="input-group @error('phone') has-validation @enderror">
                                            <span id="" class="input-group-text">
                                                <i class="bx bx-envelope"></i>
                                            </span>
                                            <input
                                                type="number"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                id="phone"
                                                name="phone"
                                                value="{{ Auth::user()->phone }}"
                                            />
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="address">Address</label>
                                    <div class="col-sm-10">
                                        <div class="input-group @error('address') has-validation @enderror">
                                            <span id="" class="input-group-text">
                                                <i class="bx bx-envelope"></i>
                                            </span>
                                            <input
                                                type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                id="address"
                                                name="address"
                                                value="{{ Auth::user()->address }}"
                                            />
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="address">Gender</label>
                                    <div class="col-sm-10">
                                        <div class="input-group @error('gender') has-validation @enderror">
                                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                                <i class="bx bx-male"></i>
                                                <i class="bx bx-female ms-0"></i>
                                            </span>
                                            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" >
                                                <option value="male" @if (Auth::user()->gender === 'male') selected @endif >Male</option>
                                                <option value="female" @if (Auth::user()->gender === 'female') selected @endif >Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /Account -->
          </div>
          {{-- <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
              <div class="mb-3 col-12">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                  <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
              </div>
              <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check mb-3">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    name="accountActivation"
                    id="accountActivation"
                  />
                  <label class="form-check-label" for="accountActivation"
                    >I confirm my account deactivation</label
                  >
                </div>
                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
              </form>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
  </div>
@endsection

@section('script')
{{-- <script>
    var selDiv = "";
    var storedFiles = [];
    $(document).ready(function () {
      $("#img").on("change", handleFileSelect);
      selDiv = $("#selectedBanner");
    });

    function handleFileSelect(e) {
      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      filesArr.forEach(function (f) {
        if (!f.type.match("image.*")) {
          return;
        }
        storedFiles.push(f);

        var reader = new FileReader();
        reader.onload = function (e) {
          var html =
            '<img src="' +
            e.target.result +
            "\" data-file='" +
            f.name +
            "' class='avatar rounded lg' alt='Category Image' height='200px' width='200px'>";
          selDiv.html(html);
        };
        reader.readAsDataURL(f);
      });
    }
</script> --}}


<script>
    let loadFile = function(event) {
        let image = document.getElementById('uploadedAvatar');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

@endsection
