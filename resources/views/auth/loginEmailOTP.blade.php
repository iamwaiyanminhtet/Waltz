@extends('user.layouts.master')

@section('mainContent')
<main class="main">

    <div class="login-page bg-image pt-2 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17 bg-dark" style="padding-top: 5rem !important;">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <h3>Two Factor Authentication</h3>
                        </li>
                    </ul>
                    @if (session('incorrect'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        <span class="text-white">{{ session('incorrect') }}</span>
                        <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close">x</i></button>
                    </div>
                    @endif
                    @if (session('expired'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        <span class="text-white">{{ session('expired') }}</span>
                        <button type="button" class="btn-close btn  text-white btn-dark" style="max-width: 10px !important;min-width: 10px !important" data-bs-dismiss="alert" aria-label="Close">x</i></button>
                    </div>
                    @endif

                    <div class="tab-content my-3">
                        <form action="{{ route('auth#emailOtp',$loginOtp->id) }}" method="POST">
                            @csrf
                            <p>We have sent the code to {{ $loginOtp->user_email }}</p>
                            <div class="form-group">
                                <label for="singin-password-2">Your OTP *</label>
                                <input type="number" class="form-control text-dark @error('otp')
                                    is-invalid
                                @enderror" id="otp" name="otp" >
                                <input type="hidden" id="loginOtpId" value="{{ $loginOtp->id }}">
                                @error('otp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div><!-- End .form-group -->

                            <div class="form-footer justify-content-between">
                                <button type="submit" class="btn btn-outline-primary-2 d-block">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                               <div>

                                    <a href="{{ route('auth#loginPage') }}" class="forgot-link">go back</a>
                               </div>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .tab-content -->
                    {{-- <form action="{{ route('auth#emailOtpResend',$loginOtp->id) }}" method="POST" class="row bg-dark text-white p-1 d-flex justify-content-between align-items-center ms-3">
                        @csrf
                       <small id="expire" class=""></small>
                       <button type="submit" class="btn btn-danger btn-sm  text-white" style="max-width: 70px !important;min-width:70px !important;" id="resendBtn">Resend</button>
                    </form> --}}
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->
@endsection

@section('script')
{{-- <script>
    $(document).ready(function() {
       // Function to initialize or resume the countdown timer
        function startCountdown() {
            // Check if a countdown is already running
            if (localStorage.getItem("countdownDate")) {
                // Retrieve the target date from localStorage
                let targetDate = new Date(localStorage.getItem("countdownDate"));
                let now = new Date().getTime();

                // Check if the countdown has already expired
                if (targetDate <= now) {
                    document.getElementById("expire").innerHTML = "EXPIRED";
                    localStorage.removeItem("countdownDate"); // Remove the countdown date from storage
                    $('#resendBtn').removeClass('invisible');
                } else {
                    // Call the function to update the countdown
                    updateCountdown(targetDate);
                }
            } else {
                // If no countdown is running, set a new target date
                let countDownDate = new Date();
                countDownDate.setMinutes(countDownDate.getMinutes() + 1);

                // Store the target date in localStorage
                localStorage.setItem("countdownDate", countDownDate);

                // Call the function to start the countdown
                updateCountdown(countDownDate);

                // Set a flag in localStorage to indicate that the countdown has started
                localStorage.setItem("countdownStarted", "true");
            }
        }

        // Function to update the countdown
        function updateCountdown(targetDate) {
            let x = setInterval(function() {
                let now = new Date().getTime();
                let distance = targetDate - now;
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (distance > 0) {
                    $('#expire').text(`Expire in ${minutes} m ${seconds} s`);
                } else {
                    clearInterval(x);
                    document.getElementById("expire").innerHTML = "EXPIRED";
                    localStorage.removeItem("countdownDate"); // Remove the countdown date from storage
                    $('#resendBtn').removeClass('invisible');
                }
            }, 1000);
        }

        // Check if the countdown has already started before calling startCountdown
        if (!localStorage.getItem("countdownStarted")) {
            startCountdown();
        }

    })
</script> --}}
{{-- I'll come back later to fix the otp resend timer --}}
@endsection
