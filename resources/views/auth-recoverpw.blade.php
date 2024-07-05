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
                                    <a href="index" class="">
                                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="22"
                                            class="auth-logo logo-dark mx-auto">
                                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="22"
                                            class="auth-logo logo-light mx-auto">
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
                                                        <h4 class="font-size-18">Reset Password</h4>
                                                        <p class="text-muted">Reset your password to Tocly.</p>
                                                    </div>

                                                    <div class="alert alert-success mt-4 pt-2" role="alert">
                                                        Enter your Email and instructions will be sent to you!
                                                    </div>

                                                    <form action="index" class="auth-input">
                                                        <div class="mb-2">
                                                            <label for="useremail" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="useremail"
                                                                placeholder="Enter email">
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
                                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                                        class="ri-facebook-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm"><i
                                                                        class="ri-google-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-dark btn-sm"><i
                                                                        class="ri-github-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-info btn-sm"><i
                                                                        class="ri-twitter-fill font-size-16"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Don't have an account ? <a href="auth-login"
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
