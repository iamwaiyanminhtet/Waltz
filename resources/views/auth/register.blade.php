@extends('user.layouts.master')

@section('mainContent')
<main class="main">

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17 bg-dark">
        <div class="container ">
            <div class="form-box text-white">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <h3>Register</h3>
                        </li>
                    </ul>
                    <div class="tab-content my-3">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group text-dark">
                                <label for="name" class="text-dark">Username</label>
                                <input type="text" class="form-control text-dark @error('name') is-invalid @enderror"  name="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group text-dark">
                                <label for="email" class="text-dark">Email Address</label>
                                <input type="text" class="form-control text-dark @error('email') is-invalid @enderror"  name="email">
                                 @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="password" class="text-dark">Password</label>
                                <input type="password" class="form-control text-dark @error('password') is-invalid @enderror" id="singin-password-2" name="password">
                                 @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group text-dark">
                                <label for="phone" class="text-dark">Phone</label>
                                <input type="text" class="form-control text-dark @error('phone') is-invalid @enderror"  name="phone">
                                 @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group text-dark">
                                <label for="address" class="text-dark">Address</label>
                                <input type="text" class="form-control text-dark @error('address') is-invalid @enderror"  name="address">
                                 @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group text-dark">
                                <label for="gender" class="text-dark">Gender</label>
                                <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="" disabled selected>Choose your gender...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                 @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group text-dark">
                                <label for="date_of_birth" class="text-dark">Date of Birth</label>
                                <input type="datetime-local" class="form-control text-dark @error('date_of_birth') is-invalid @enderror"  name="date_of_birth">
                                 @error('date_of_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-footer justify-content-between">
                                <button type="submit" class="btn btn-outline-primary-2 d-block">
                                    <span>Register</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                               <div>
                                    <a href="{{ route('auth#loginPage') }}" class="forgot-link">Already have an account?</a>
                               </div>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->
@endsection
