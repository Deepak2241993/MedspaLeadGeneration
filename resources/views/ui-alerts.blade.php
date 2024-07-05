@extends('layouts.master')
@section('title')
    Alerts
@endsection
@section('page-title')
    Alerts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Default Alerts</h4>
                        <p class="card-title-desc">Alerts are available for any length of
                            text, as well as an optional dismiss button. For proper styling, use one
                            of the four <strong>required</strong> contextual classes (e.g., <code
                                class="highlighter-rouge">.alert-success</code>). For inline
                            dismissal, use the alerts jQuery plugin.</p>

                        <div class="">
                            <div class="alert alert-primary" role="alert">
                                A simple primary alert—check it out!
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                A simple secondary alert—check it out!
                            </div>
                            <div class="alert alert-success" role="alert">
                                A simple success alert—check it out!
                            </div>
                            <div class="alert alert-danger" role="alert">
                                A simple danger alert—check it out!
                            </div>
                            <div class="alert alert-warning" role="alert">
                                A simple warning alert—check it out!
                            </div>
                            <div class="alert alert-info mb-0" role="alert">
                                A simple info alert—check it out!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Link color</h4>
                        <p class="card-title-desc">Use the <code class="highlighter-rouge">.alert-link</code> utility class
                            to
                            quickly provide matching colored links within any alert.</p>

                        <div class="">
                            <div class="alert alert-primary" role="alert">
                                A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give
                                it a click if you like.
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                A simple secondary alert with <a href="#" class="alert-link">an example link</a>. Give
                                it a click if you like.
                            </div>
                            <div class="alert alert-success" role="alert">
                                A simple success alert with <a href="#" class="alert-link">an example link</a>. Give
                                it a click if you like.
                            </div>
                            <div class="alert alert-danger" role="alert">
                                A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it
                                a click if you like.
                            </div>
                            <div class="alert alert-warning" role="alert">
                                A simple warning alert with <a href="#" class="alert-link">an example link</a>. Give
                                it a click if you like.
                            </div>
                            <div class="alert alert-info mb-0" role="alert">
                                A simple info alert with <a href="#" class="alert-link">an example link</a>. Give it a
                                click if you like.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Dismissing</h4>
                        <p class="card-title-desc">
                            Add a dismiss button and the <code>.alert-dismissible</code> class, which adds extra padding
                            to the right of the alert and positions the <code>.close</code> button.
                        </p>

                        <div class="">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                A simple primary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                A simple secondary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                A simple success alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                A simple danger alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                A simple warning alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                A simple info alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">With Icon</h4>


                        <div class="">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-bullseye-arrow me-2"></i>
                                A simple primary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-grease-pencil me-2"></i>
                                A simple secondary alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all me-2"></i>
                                A simple success alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-block-helper me-2"></i>
                                A simple danger alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-outline me-2"></i>
                                A simple warning alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                <i class="mdi mdi-alert-circle-outline me-2"></i>
                                A simple info alert—check it out!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Top Border with Outline Alerts</h4>
                        <p class="card-title-desc">Use the <code>alert-top-border</code> class to set an alert with the top
                            border and outline.</p>
                        <div class="">
                            <div class="alert alert-primary alert-top-border alert-dismissible fade show" role="alert">
                                <i class="ri-user-smile-line me-3 align-middle fs-16 text-primary"></i><span
                                    class="fw-medium">Primary</span>
                                - Top border alert
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-secondary alert-top-border alert-dismissible fade show"
                                role="alert">
                                <i class="ri-check-double-line me-3 align-middle fs-16 text-secondary"></i><span
                                    class="fw-medium">Secondary</span>
                                - Top border alert
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            <div class="alert alert-success alert-top-border alert-dismissible fade show" role="alert">
                                <i class="ri-notification-off-line me-3 align-middle fs-16 text-success"></i><span
                                    class="fw-medium">Success</span>
                                - Top border alert
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            <div class="alert alert-danger alert-top-border alert-dismissible fade show" role="alert">
                                <i class="ri-error-warning-line me-3 align-middle fs-16 text-danger "></i><span
                                    class="fw-medium">Danger</span>
                                - Top border alert
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            <div class="alert alert-warning alert-top-border alert-dismissible fade show" role="alert">
                                <i class="ri-alert-line me-3 align-middle fs-16 text-warning"></i><span
                                    class="fw-medium">Warning</span>
                                - Top border alert
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            <div class="alert alert-info alert-top-border alert-dismissible fade show mb-0"
                                role="alert">
                                <i class="ri-airplay-line me-3 align-middle fs-16 text-info"></i><span
                                    class="fw-medium">Info</span>
                                - Top border alert
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>


            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Solid Alerts</h4>
                        <p class="card-title-desc">Use the <code>alert-solid</code> class to set an alert with solid style.
                        </p>
                        <div class="">
                            <div class="alert alert-primary alert-solid" role="alert">
                                <span class="fw-medium">Hi!</span> - Solid <span class="fw-medium">primary alert</span>
                                example
                            </div>

                            <div class="alert alert-secondary alert-solid" role="alert">
                                <span class="fw-medium">How are you!</span> - Solid <span class="fw-medium">secondary
                                    alert</span> example
                            </div>

                            <div class="alert alert-success alert-solid" role="alert">
                                <span class="fw-medium">Yey! Everything worked! </span> - Solid <span
                                    class="fw-medium">success alert</span> example
                            </div>

                            <div class="alert alert-danger alert-solid" role="alert">
                                <span class="fw-medium">Something is very wrong!</span> - Solid <span
                                    class="fw-medium">danger alert</span> example
                            </div>

                            <div class="alert alert-warning alert-solid" role="alert">
                                <span class="fw-medium">Uh oh, something went wrong!</span> - Solid <span
                                    class="fw-medium">warning alert</span> example
                            </div>
                            <div class="alert alert-info alert-solid mb-0" role="alert">
                                <span class="fw-medium">Don't forget' it !</span> - Solid <span class="fw-medium">info
                                    alert</span> example
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>


        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Card Alerts</h4>
                        <p class="card-title-desc">Alerts can also contain additional HTML elements like icons, headings
                            and paragraphs in card.</p>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card alert border p-0 mb-0">
                                    <div class="card-header bg-soft-success">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h5 class="font-size-16 text-success my-1">Success Alert</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <i
                                                    class="mdi mdi-checkbox-marked-circle-outline display-4 text-success"></i>
                                            </div>
                                            <h4 class="alert-heading">Well done!</h4>
                                            <p class="mb-0">Placed your Order successfully</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card alert border mt-4 mt-lg-0 p-0 mb-0">
                                    <div class="card-header bg-soft-danger">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h5 class="font-size-16 text-danger my-1">Danger Alert</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <i class="mdi mdi-alert-outline display-4 text-danger"></i>
                                            </div>
                                            <h4 class="alert-heading">Something went wrong</h4>
                                            <p class="mb-0">Sorry ! Product not available</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Additional content</h4>
                        <p class="card-title-desc">Alerts can also contain additional HTML elements like headings,
                            paragraphs and dividers.</p>

                        <div class="">
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p>Aww yeah, you successfully read this important alert message. This example text is going
                                    to run a bit longer so
                                    that you can see how spacing within an alert works with this kind of content.</p>
                                <hr>
                                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice
                                    and tidy.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
