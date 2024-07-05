@extends('layouts.master')
@section('title')
    Pricing
@endsection
@section('page-title')
    Pricing
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="text-center mb-5">
                                    <h4 class="mt-2">Simple Pricing Plans</h4>
                                    <p class="text-muted mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                                        veritatis</p>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="pricing-box border mt-4 rounded">
                                    <div class="pricing-content">
                                        <i class="mdi mdi-account h1"></i>
                                        <h4 class="mt-3">Starter</h4>
                                        <p class="text-muted mt-3 mb-4">Semper urna veal tempus pharetra elit habisse platea
                                            dictumst.
                                        </p>
                                        <hr>
                                        <div class="pricing-plan mt-4 text-primary text-center">
                                            <h1><sup class="text-muted">$ </sup>239 <small
                                                    class="fw-normal font-size-16 text-muted">/ Month</small></h1>
                                        </div>
                                        <hr>
                                        <div class="pricing-features pt-3">
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">2</strong> Website</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">30 GB</strong> Storage</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">Unmetered</strong> Bandwidth</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-close-circle text-danger font-size-16 me-2"></i><strong
                                                    class="text-dark">Email</strong> 1 Year trail</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-close-circle text-danger font-size-16 me-2"></i><strong
                                                    class="text-dark">Free domain</strong> annual plan</p>
                                        </div>
                                        <div class="pricing-border mt-3"></div>
                                        <div class="mt-4 pt-2 text-center">
                                            <a href="" class="btn btn-primary btn-round">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="pricing-box border mt-4 rounded">
                                    <div class="pricing-content">
                                        <i class="mdi mdi-car h1"></i>
                                        <h4 class="mt-3">Professional</h4>
                                        <p class="text-muted mt-3 mb-4">Semper urna veal tempus pharetra elit habisse platea
                                            dictumst.
                                        </p>
                                        <hr>
                                        <div class="pricing-plan mt-4 text-primary text-center">
                                            <h1><sup class="text-muted">$ </sup>349 <small
                                                    class="fw-normal font-size-16 text-muted">/ Month</small></h1>
                                        </div>
                                        <hr>
                                        <div class="pricing-features pt-3">
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">2</strong> Website</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">30 GB</strong> Storage</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">Unmetered</strong> Bandwidth</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-close-circle text-danger font-size-16 me-2"></i><strong
                                                    class="text-dark">Email</strong> 1 Year trail</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-close-circle text-danger font-size-16 me-2"></i><strong
                                                    class="text-dark">Free domain</strong> annual plan</p>
                                        </div>
                                        <div class="pricing-border mt-3"></div>
                                        <div class="mt-4 pt-2 text-center">
                                            <a href="" class="btn btn-primary btn-round">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="pricing-box border bg-primary text-white mt-4 rounded">
                                    <div class="pricing-badge">
                                        <span class="badge">Featured</span>
                                    </div>
                                    <div class="pricing-content">
                                        <i class="mdi mdi-briefcase h1 text-white"></i>
                                        <h4 class="mt-3 text-white">Enterprise</h4>
                                        <p class="text-white-50 mt-3 mb-4">Semper urna veal tempus pharetra elit habisse
                                            platea dictumst.
                                        </p>
                                        <hr>
                                        <div class="pricing-plan mt-4 text-primary text-center">
                                            <h1 class="text-white"><sup class="text-white-50">$ </sup>489 <small
                                                    class="fw-normal font-size-16 text-white-50">/ Month</small></h1>
                                        </div>
                                        <hr>
                                        <div class="pricing-features pt-3">
                                            <p class="text-white-50 mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-white font-size-16 me-2"></i><strong
                                                    class="text-white">2</strong> Website</p>
                                            <p class="text-white-50 mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-white font-size-16 me-2"></i><strong
                                                    class="text-white">30 GB</strong> Storage</p>
                                            <p class="text-white-50 mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-white font-size-16 me-2"></i><strong
                                                    class="text-white">Unmetered</strong> Bandwidth</p>
                                            <p class="text-white-50 mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-white font-size-16 me-2"></i><strong
                                                    class="text-white">Email</strong> 1 Year trail</p>
                                            <p class="text-white-50 mb-2"><i
                                                    class="mdi mdi-close-circle text-danger font-size-16 me-2"></i><strong
                                                    class="text-white">Free domain</strong> annual plan</p>
                                        </div>
                                        <div class="pricing-border mt-3"></div>
                                        <div class="mt-4 pt-2 text-center">
                                            <a href="" class="btn btn-light btn-round">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">


                                <div class="pricing-box border mt-4 rounded">
                                    <div class="pricing-content">
                                        <i class="mdi mdi-book-variant h1"></i>
                                        <h4 class="mt-3">Unlimited</h4>
                                        <p class="text-muted mt-3 mb-4">Semper urna veal tempus pharetra elit habisse
                                            platea dictumst.
                                        </p>
                                        <hr>
                                        <div class="pricing-plan mt-4 text-primary text-center">
                                            <h1><sup class="text-muted">$ </sup>555 <small
                                                    class="fw-normal font-size-16 text-muted">/ Month</small></h1>
                                        </div>
                                        <hr>
                                        <div class="pricing-features pt-3">
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">2</strong> Website</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">30 GB</strong> Storage</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">Unmetered</strong> Bandwidth</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">Email</strong> 1 Year trail</p>
                                            <p class="text-muted mb-2"><i
                                                    class="mdi mdi-checkbox-marked-circle text-primary font-size-16 me-2"></i><strong
                                                    class="text-dark">Free domain</strong> annual plan</p>
                                        </div>
                                        <div class="pricing-border mt-3"></div>
                                        <div class="mt-4 pt-2 text-center">
                                            <a href="" class="btn btn-primary btn-round">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
