@extends('layouts.master-without-nav')
@section('title')
    Coming Soon
@endsection
@section('content')
    <div class="auth-body-bg">
        <div class="auth-maintenance d-flex align-items-center min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div>
                            <div class="text-center mb-4">
                                <a href="index" class="">
                                    <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="25"
                                        class="auth-logo logo-dark mx-auto">
                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="25"
                                        class="auth-logo logo-light mx-auto">
                                </a>
                                <h4 class="mt-4">Let's get started with Tocly</h4>
                                <p class="text-muted">It will be as simple as Occidental in fact it will be Occidental.</p>
                            </div>

                            <div class="row justify-content-center mt-5 pt-5">
                                <div class="col-md-9">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">
                                                <img src="{{ URL::asset('build/images/comingsoon.png') }}" alt="comingsoon-bg"
                                                    class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-5 pt-5">
                                        <div data-countdown="2023/08/04" class="counter-number"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Plugins js-->
    <script src="{{ URL::asset('build/libs/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- Countdown js -->
    <script src="{{ URL::asset('build/js/pages/coming-soon.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
