@extends('layouts.master')
@section('title')
    Pie charts
@endsection
@section('page-title')
    Pie charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Simple Pie Chart</h4>
                        <div id="simple_pie_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Simple Donut Chart</h4>
                        <div id="simple_dount_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Updating Donut Chart</h4>
                        <div id="updating_donut_chart" class="apex-charts" dir="ltr"></div>

                        <div class="d-flex align-items-start flex-wrap gap-2 justify-content-center mt-4">
                            <button id="add" class="btn btn-light btn-sm">
                                + ADD
                            </button>

                            <button id="remove" class="btn btn-light btn-sm">
                                - REMOVE
                            </button>

                            <button id="randomize" class="btn btn-light btn-sm">
                                RANDOMIZE
                            </button>

                            <button id="reset" class="btn btn-light btn-sm">
                                RESET
                            </button>
                        </div>
                    </div>

                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Monochrome Pie Chart</h4>
                        <div id="monochrome_pie_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Gradient Donut Chart</h4>
                        <div id="gradient_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Patterned Donut Chart</h4>
                        <div id="pattern_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pie Chart with Image Fill</h4>
                        <div id="image_pie_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div>
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- piecharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-pie.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
