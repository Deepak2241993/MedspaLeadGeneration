@extends('layouts.master-without-nav')
@section('title')
    Register
@endsection
@section('css')
    <style>
        .bg-authh {
            background-image: url('build/images/register.jpg');
            background-position: bottom;
            background-size: cover;
            background-repeat: no-repeat; /* Uncommented for no repeat */
            position: relative;
        }
        .iti {
            position: relative;
            display: block !important;
        }

    </style>
@endsection
@section('content')

    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                <div class="text-center mb-4">
                                    <a href="index" class="">
                                        <img src="{{ URL::asset('build/images/dark-logo.png') }}" alt=""
                                            height="100%" width="25%" class="auth-logo logo-dark mx-auto">
                                        <img src="{{ URL::asset('build/images/light-logo.png') }}" alt=""
                                            height="22" class="auth-logo logo-light mx-auto">
                                    </a>
                                    {{-- <p class="text-muted mt-2">User Experience & Interface Design Strategy Saas Solution</p> --}}
                                </div>

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            
                                           <div class="">
                                            <img src="{{ URL::asset('build/images/register.jpg') }}" alt="description of image" width="120%" height="150%" style="margin-top: 30px;">
                                        </div>


                                        </div>

                                        <div class="col-lg-6">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">Register account</h4>
                                                        <p class="text-muted">Get Your Medspa New Account Now.</p>
                                                    </div>

                                                    <form method="POST" action="{{ route('register') }}"
                                                        class="auth-input" id="registerForm">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input id="name" type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name"  required
                                                                autocomplete="name" autofocus placeholder="Enter name">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-2">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input id="email" type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email"  required
                                                                autocomplete="email" placeholder="Enter email">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                       <!-- Phone Number Field -->
                                                        <div class="mb-2">
                                                            <label for="phone" class="form-label">Phone Number</label>
                                                            <input type="hidden" id="countryCode" name="country_code">
                                                            <div class="iti iti--allow-dropdown iti--separate-dial-code form-control">
                                                                <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" name="phone" placeholder="Enter phone number" required>
                                                            </div>
                                                            
                                                            <!-- Validation feedback -->
                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>



                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-input">Password</label>
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password" required id="password-input"
                                                                placeholder="Enter password">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-confirm">Confirm
                                                                Password</label>
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password_confirmation" required id="password-confirm"
                                                                placeholder="Enter confirm password">
                                                        </div>

                                                        <div>
                                                            <p class="mb-0">By registering you agree to the Reactly <a
                                                                    href="#" class="text-primary">Terms of Use</a></p>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100"
                                                                type="submit">Register</button>
                                                        </div>

                                                        <div class="mt-4 pt-2 text-center">
                                                            <div class="signin-other-title">
                                                                <h5 class="font-size-14 mb-4 title">Sign In with</h5>
                                                            </div>
                                                            <div class="pt-2 hstack gap-2 justify-content-center">
                                                                <a href="https://www.facebook.com/ForeverMedSpaNJ" target="_blank" class="btn btn-primary btn-sm">
                                                                    <i class="fab fa-facebook-f"></i>
                                                                </a>
                                                                <a href="https://www.instagram.com/forevermedspa/" target="_blank" class="btn btn-info btn-sm">
                                                                    <i class="fab fa-instagram"></i>
                                                                </a>
                                                                <a href="https://x.com/ForeverMedSpaNJ" target="_blank" class="btn btn-info btn-sm">
                                                                    <i class="fab fa-twitter"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                                            class="fw-medium text-primary"> Login</a> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="mt-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>Medspa. Crafted with <i class="fas fa-heart"></i> by <a target="_blank" href="https://www.thetemz.com/">Temz</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        (function() {

            var input = document.getElementById('phone');
            var pattern = /^[6-9][0-9]{0,9}$/;
            var value = input.value;
            !pattern.test(value) && (input.value = value = '');
            input.addEventListener('input', function() {
                var currentValue = this.value;
                if (currentValue && !pattern.test(currentValue)) this.value = value;
                else value = currentValue;
            });
        })();
    </script>
    <script>
        // Ensure the script executes after the page is fully loaded
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.querySelector("#phone");
            const countryCodeInput = document.querySelector("#countryCode");
    
            // Initialize intl-tel-input
            const iti = window.intlTelInput(input, {
                initialCountry: "us",  // Auto-detect country based on IP
                preferredCountries: ["us", "gb", "in"],  // Preferred countries at top
                separateDialCode: true,  // Show separate country code
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"  // Enable formatting/validation
            });
    
            // Form submit validation
            document.querySelector("#registerForm").addEventListener("submit", function (event) {
                event.preventDefault();
                
                // Check if the entered phone number is valid
                if (iti.isValidNumber()) {
                    // Get the country code (with +)
                    const countryCode = `+${iti.getSelectedCountryData().dialCode}`;
                    
                    // Get the national phone number without the country code
                    let nationalNumber = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
    
                    // Clean the national number by removing spaces or other formatting
                    nationalNumber = nationalNumber.replace(/\s+/g, '');  // Remove spaces
                    
                    // Remove leading 0 from the national number if present
                    if (nationalNumber.startsWith('0')) {
                        nationalNumber = nationalNumber.substring(1);
                    }
    
                    // Update the hidden input with the country code
                    countryCodeInput.value = countryCode;
    
                    // Update the phone input value with the cleaned-up national number
                    input.value = nationalNumber;
    
                    // Now submit the form
                    this.submit();
                } else {
                    alert("Please enter a valid phone number.");
                }
            });
        });
    </script>
@endsection
