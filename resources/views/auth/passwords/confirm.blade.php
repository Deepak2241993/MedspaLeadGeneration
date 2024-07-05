@extends('layouts.master-without-nav')
@section('title')
    Confirm Password
@endsection
@section('content')
    {{-- <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-sm-12">
                    <div>
                        <div class="text-center mb-4">
                            <a href="index" class="">
                                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="25"
                                    class="auth-logo logo-dark mx-auto">
                                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="25"
                                    class="auth-logo logo-light mx-auto">
                            </a>
                        </div>
                        <div class="row justify-content-center align-items-center pt-4">
                            <div class="col-lg-6 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-3">
                                            <div class="text-center mt-2">
                                                <h5 class="text-primary fs-20">Confirm Password?</h5>
                                                <div class="display-5 mb-2 text-danger mt-5">
                                                    <i class="bi bi-envelope"></i>
                                                </div>
                                            </div>

                                            <div class="alert alert-borderless alert-warning text-center mb-2 mx-2"
                                                role="alert">
                                                Please confirm your password before continuing!
                                            </div>

                                            <div class="p-2 mt-4">
                                                <form method="POST" action="{{ route('password.confirm') }}"
                                                    class="auth-input">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label class="form-label">Password</label>
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="current-password"
                                                            placeholder="Confirm your password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="text-center mt-4">
                                                        <button class="btn btn-primary w-100" type="submit">Confirm
                                                            Password</button>
                                                    </div>
                                                </form>

                                                <div class="text-center mt-5">
                                                    <p class="mb-0">Forgot Your Password <a href="{{ route('password.request') }}" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">Confirm Password</h4>
                                                        <p class="text-muted">Get your free Tocly account now.</p>
                                                    </div>

                                                    <div class="alert alert-borderless alert-warning text-center mb-2 mx-2"
                                                        role="alert">
                                                        Please confirm your password before continuing!
                                                    </div>

                                                    <form method="POST" action="{{ route('password.confirm') }}"
                                                        class="auth-input">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label class="form-label">Password</label>
                                                            <input id="password" type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password" required autocomplete="current-password"
                                                                placeholder="Confirm your password">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="text-center mt-4">
                                                            <button class="btn btn-primary w-100" type="submit">Confirm
                                                                Password</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Forget your password ? <a href="{{ route('password.update') }}"
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
    <!-- swiper.init js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
