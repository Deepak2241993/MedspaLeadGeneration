@extends('layouts.master-without-nav')
@section('title')
    Create New Password
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
                                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt=""
                                            height="22" class="auth-logo logo-dark mx-auto">
                                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt=""
                                            height="22" class="auth-logo logo-light mx-auto">
                                    </a>
                                    <p class="text-muted mt-2">User Experience & Interface Design Strategy Saas Solution</p>
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
                                                    <div class="text-center mt-2">
                                                        <h5 class="text-primary fs-20">Create new password</h5>
                                                        <p class="text-muted">Your new password must be different from
                                                            previous used
                                                            password.</p>
                                                    </div>

                                                    <form method="POST" action="{{ route('password.update') }}"
                                                        class="auth-input">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email Address</label>
                                                            <input id="email" type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ $email ?? old('email') }}" required
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
                                                                name="password" placeholder="Enter password"
                                                                id="password-input" aria-describedby="passwordInput"
                                                                required="">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <div id="passwordInput" class="form-text">Your password must be
                                                                8-20
                                                                characters long.</div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="confirm-password-input">Confirm
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                name="password_confirmation" placeholder="Confirm password"
                                                                id="confirm-password-input" required="">
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100" type="submit">Reset
                                                                Password</button>
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
                                        </script> Tocly. Crafted with <i
                                            class="mdi mdi-heart text-danger"></i> by Themesdesign
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
