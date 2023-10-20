@extends('user.layouts.master')

@section('mainContent')
<main class="main">

    <div class="login-page bg-image pt-2 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17 bg-dark" style="padding-top: 5rem !important;">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <h3>Set Password</h3>
                        </li>
                    </ul>
                    @if (session('expired'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        <span class="text-white">{{ session('expired') }}</span>
                        <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close">x</i></button>
                    </div>
                    @endif
                    <div class="tab-content my-3">
                        <form action="{{ route('auth#setPassword') }}" method="POST">
                            @csrf
                            <h5>Hello - {{ $user->name }} , Welcome </h5>
                            <div class="form-group">
                                <label for="singin-password-2">Password *</label>
                                <input type="password" class="form-control text-dark @error('password')
                                    is-invalid
                                @enderror" id="password" name="password" >
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-footer justify-content-between">
                                <button type="submit" class="btn btn-outline-primary-2 d-block">
                                    <span>Save</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->
@endsection
