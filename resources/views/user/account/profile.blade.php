@extends('user.layouts.master')
@section('mainContent')
<main class="main">
    <div class="page-header text-center" style="">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer#allProducts') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="true">Account Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-changePassword-link" data-toggle="tab" href="#tab-changePassword" role="tab" aria-controls="tab-changePassword" aria-selected="false">Change Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-twoFactor-link" data-toggle="tab" href="#tab-twoFactor" role="tab" aria-controls="tab-twoFactor" aria-selected="false">Two Factor Authentication</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sign Out</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                @if (session('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                    <span class="text-dark">{{ session('updateSuccess') }}</span>
                                    <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                @endif

                                <form action="{{ route('customer#account#update') }}" method="POST">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-6 d-flex justify-content-center align-items-center">
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
                                            class="d-block rounded w-50 "
                                            height="100"
                                            width="100"
                                            id="uploadedAvatar"
                                            />
                                        </div>
                                        <div class="col-6">
                                            <label>Name *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ $user->name }}" name="name">
                                            <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label>Profile Image *</label>
                                        <input type="file" name="image" class="form-control" >
                                    </div>


                                    <div>
                                        <label>Email address *</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $user->email }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label>Phone *</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"  value="{{ $user->phone }}">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label>Address *</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"  value="{{ $user->address }}">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label>Gender *</label>
                                        <select name="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" >
                                            <option value="male" @if (Auth::user()->gender === 'male') selected  @endif >Male</option>
                                            <option value="female" @if (Auth::user()->gender === 'female') selected  @endif >Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                   <div>
                                        <label>Date of Birth *</label>
                                        <input
                                            type="text" name="date_of_birth"
                                            class="form-control"
                                            placeholder="{{ Auth::user()->date_of_birth }}"
                                            disabled
                                        />
                                   </div>

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade " id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <table class="table table-cart table-mobile" id="productTableTag">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Order Code</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->order_code }}</td>
                                                <td>{{ $order->total_price }}</td>
                                                <td>
                                                    @if ($order->status === 0 || $order->status === '0')
                                                    <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                    @if ($order->status === 1 || $order->status === '1')
                                                    <span class="badge bg-success">Accepted</span>
                                                    @endif
                                                    @if ($order->status === 2 || $order->status === '2')
                                                    <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <th></th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-changePassword" role="tabpanel" aria-labelledby="tab-changePassword-link">
                                @if (session('changeSuccess'))
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                    <span class="text-dark">{{ session('changeSuccess') }}</span>
                                    <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                @endif

                                @if (session('notMatch'))
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                    <span class="text-dark">{{ session('notMatch') }}</span>
                                    <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                @endif

                                <form action="{{ route('customer#account#changePassword') }}" method="post">
                                    @csrf
                                    <div>
                                        <label>Old Password *</label>
                                        <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror"  >
                                        @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label>New Password *</label>
                                        <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror"  >
                                        @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label>Confirm Password *</label>
                                        <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror"  >
                                        @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-dark" style="max-width: fit-content !important;min-width: fit-content !important" >Change</button>
                                </form>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-twoFactor" role="tabpanel" aria-labelledby="tab-twoFactor-link">

                                @if (Auth::user()->two_factor_secret)
                                @else
                                    <form action="/user/two-factor-authentication" method="POST">
                                        @csrf
                                        <p>Two Factor Authentication is off.</p>
                                        <button type="submit" class="btn btn-dark">Enable</button>
                                    </form>
                                @endif
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
    <script>

        $(document).ready(function() {
            // Function to store the active tab's ID
            function storeActiveTab(tabId) {
                localStorage.setItem('activeTab', tabId);
            }


            // Function to retrieve and set the active tab
            function setActiveTab() {
                const activeTabLinkId = localStorage.getItem('activeTab');
                if(activeTabLinkId) {
                    const activeTabId = activeTabLinkId.replace('-link','');

                         // Remove the 'active' class from all tab links
                         $('.nav-link').removeClass('active');

                        // Add the 'active' class to the tab link with the stored ID

                        $('#' + activeTabLinkId).addClass('active');

                        // Show the corresponding tab content
                        $('.tab-pane').removeClass('show active');
                        $('#' + activeTabId).addClass('show active');
                }

            }


            // Call the function to set the active tab on page load
            setActiveTab();

            // Handle tab clicks to store the active tab
            $('.nav-link').click( function() {
                const tabId = $(this).attr('id');
                storeActiveTab(tabId);
            }
            );
        });
    </script>
@endsection
