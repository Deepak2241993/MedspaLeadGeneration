@extends('layouts.master-without-nav')
@section('title')
    Recover Password
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
                                    <a href="/" class="">
                                        <img src="{{ URL::asset('build/images/dark-logo.png') }}" alt="Forever Medspa"
                                            height="100%" width="25%" class="auth-logo logo-dark mx-auto">
                                        <img src="{{ URL::asset('build/images/light-logo.png') }}" alt="Forever Medspa"
                                            height="22" class="auth-logo logo-light mx-auto">
                                    </a>
                                    {{-- <p class="text-muted mt-2">User Experience & Interface Design Strategy Saas Solution</p> --}}
                                </div>

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="bg-overlay bg-primary"></div>
                                            <div class="h-100 bg-auth align-items-end">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">Reset Password</h4>
                                                        <p class="text-muted">Reset your password to Forever Medspa.</p>
                                                    </div>

                                                    <div class="alert alert-success mt-4 pt-2" role="alert">
                                                        Enter your Email and instructions will be sent to you!
                                                    </div>

                                                    @if (session('status'))
                                                        <div class="alert alert-success mt-4 pt-2 alert-dismissible"
                                                            role="alert">
                                                            {{ session('status') }}
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                                aria-label="Close"></button>
                                                        </div>
                                                    @endif

                                                    <form method="POST" action="{{ route('password.email') }}"
                                                        class="auth-input">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input id="email" type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email') }}" required
                                                                autocomplete="email" autofocus placeholder="Enter Email">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100"
                                                                type="submit">Reset</button>
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
                                                    <p class="mb-0">Don't have an account ? <a href="{{ route('login') }}"
                                                            class="fw-medium text-primary"> Log in </a> </p>
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
@endsection
