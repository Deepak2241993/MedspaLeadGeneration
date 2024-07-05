@extends('layouts.master-without-nav')
@section('title')
    Login
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
                                            <div class="bg-overlay bg-primary"></div>
                                            <div class="h-100 bg-auth align-items-end">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">Welcome Back !</h4>
                                                        <p class="text-muted">Sign in to continue to Medspa.</p>
                                                    </div>

                                                    <form method="POST" action="{{ route('login') }}" class="auth-input">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input id="email" type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email', 'admin@themesbrand.com') }}" required
                                                                autocomplete="email" autofocus>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-input">Password</label>
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                placeholder="Enter password" id="password-input"
                                                                name="password" required autocomplete="current-password"
                                                                value="12345678">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-check d-flex justify-content-between">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="remember">Remember
                                                                    me</label>
                                                            </div>
                                                            <a href="{{ route('password.update') }}" class="text-end">Forget Password?</a>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100" type="submit">Sign
                                                                In</button>
                                                        </div>

                                                        <div class="mt-4 pt-2 text-center">
                                                            <div class="signin-other-title">
                                                                <h5 class="font-size-14 mb-4 title">Sign In with</h5>
                                                            </div>
                                                            <div class="pt-2 hstack gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-primary btn-sm"><i class="fab fa-facebook-f"></i></button>
                                                                <button type="button" class="btn btn-info btn-sm"><i class="fab fa-instagram"></i></button>
                                                                <button type="button" class="btn btn-info btn-sm"><i class="fab fa-twitter"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Don't have an account ? <a
                                                            href="{{ route('register') }}" class="fw-medium text-primary">
                                                            Register </a> </p>
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
                                        </script>Medspa. Crafted with <i class="fas fa-heart"></i> by Temz
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
