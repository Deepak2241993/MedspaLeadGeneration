@extends('layouts.master')
@section('title')
    Area charts
@endsection
@section('page-title')
    Area charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Area Chart</h4>
                        <div id="area_chart_basic" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Spline Area Chart</h4>
                        <div id="area_chart_spline" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Area Chart - Datetime X - Axis Chart</h4>
                        <div class="toolbar d-flex align-items-start justify-content-center flex-wrap gap-2">
                            <button type="button" class="btn btn-soft-primary timeline-btn btn-sm" id="one_month">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-primary timeline-btn btn-sm" id="six_months">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-primary timeline-btn btn-sm active" id="one_year">
                                1Y
                            </button>
                            <button type="button" class="btn btn-soft-primary timeline-btn btn-sm" id="all">
                                ALL
                            </button>
                        </div>
                        <div id="area_chart_datetime" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Area with Negative Values Chart</h4>
                        <div id="area_chart_negative" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Area Chart - Github Style</h4>
                        <div class="bg-light">
                            <div id="area_chart-months" class="apex-charts" dir="ltr"></div>
                        </div>

                        <div class="github-style d-flex align-items-center my-2">
                            <div class="flex-shrink-0 me-2">
                                <img class="avatar-sm rounded" src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                    data-hovercard-user-id="634573" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <a class="font-size-14 text-dark fw-medium">coder</a>
                                <div class="cmeta text-muted font-size-11">
                                    <span class="commits text-dark fw-medium"></span> commits
                                </div>
                            </div>
                        </div>

                        <div class="bg-light">
                            <div id="area_chart-years" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Stacked Area Chart</h4>
                        <div id="area_chart_stacked" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Irregular Timeseries Chart</h4>
                        <div id="area_chart_irregular" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Area Chart With Null Values Chart</h4>
                        <div id="area-missing-null-value" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- for basic area chart -->
        <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
        <!-- for github style chart -->
        <script src="https://apexcharts.com/samples/assets/github-data.js"></script>
        <!-- for irregular timeseries chart -->
        <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
        <script src="{{ URL::asset('build/libs/moment/min/moment.min.js') }}"></script>

        <!-- areacharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-area.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
