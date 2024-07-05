@extends('layouts.master')
@section('title')
    Line charts
@endsection
@section('page-title')
    Line charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Line Chart</h4>
                        <div id="line_chart_basic" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Zoomable Timeseries</h4>
                        <div id="line_chart_zoomable" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Line with Data Labels</h4>
                        <div id="line_chart_datalabel" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Dashed Line</h4>
                        <div id="line_chart_dashed" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Line with Annotations</h4>
                        <div id="line_chart_annotations" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Syncing Charts</h4>
                        <div class="apex-charts" dir="ltr">
                            <div id="syncingchart-line"></div>
                            <div id="syncingchart-area"></div>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Brush Charts</h4>
                        <div>
                            <div id="brushchart_line2" class="apex-charts" dir="ltr"></div>
                            <div id="brushchart_line" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Stepline Charts</h4>
                        <div id="line_chart_stepline" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Gradient Charts</h4>
                        <div id="line_chart_gradient" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Missing Data/ Null Value Charts</h4>
                        <div id="line_chart_missing_data" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Realtimes Charts</h4>
                        <div id="line_chart_realtime" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

        <!-- linecharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-line.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
