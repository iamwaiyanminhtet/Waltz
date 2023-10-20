@extends('user.layouts.master')

@section('mainContent')
<main class="main">

    <div class="login-page bg-image pt-2 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17 bg-dark" style="padding-top: 5rem !important;">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <h3>Sign in</h3>
                        </li>
                    </ul>
                    @if (session('not found'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        <span class="text-white">{{ session('not found') }}</span>
                        <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close">x</i></button>
                    </div>
                    @endif
                    @if (session('passwordIncorrect'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        <span class="text-white">{{ session('passwordIncorrect') }}</span>
                        <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close">x</i></button>
                    </div>
                    @endif
                    <div class="tab-content my-3">
                        <form action="{{ route('auth#manualLogin') }}" method="POST">
                            @csrf
                            <div class="form-group text-dark">
                                <label for="singin-email-2">Email address *</label>
                                <input type="email" class="form-control text-dark @error('email') is-invalid @enderror" id="singin-email-2" name="email" required>
                                @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="singin-password-2">Password *</label>
                                <input type="password" class="form-control text-dark" id="singin-password-2" name="password" required>
                            </div><!-- End .form-group -->

                            <div class="form-footer justify-content-between">
                                <button type="submit" class="btn btn-outline-primary-2 d-block">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                               <div>
                                    {{-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                                        <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                    </div><!-- End .custom-checkbox --> --}}

                                    <a href="{{ route('auth#registerPage') }}" class="forgot-link">Create an account</a>
                               </div>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
                <div class="row justify-content-center">
                    <div class="">
                        <a href="{{ route('auth#google#redirect') }}" class="btn btn-login me-3 border border-dark" >
                            <img src="{{ asset('google-logo.jpg') }}" alt="" width='10%' style="margin-right: 20px !important;">
                            Login With Google
                        </a>
                    </div><!-- End .col-6 -->
                </div>
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->
@endsection
