@extends('layouts.master')
@section('title')
    E Charts
@endsection
@section('page-title')
    E Charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Line Chart</h4>
                        <div id="line-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Mix Line-Bar</h4>
                        <div id="mix-line-bar" class="e-charts"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Doughnut Chart</h4>
                        <div id="doughnut-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pie Chart</h4>
                        <div id="pie-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Scatter Chart</h4>
                        <div id="scatter-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Bubble Chart</h4>
                        <div id="bubble-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Candlestick Chart</h4>
                        <div id="candlestick-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Gauge Chart</h4>
                        <div id="gauge-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- echarts js -->
        <script src="{{ URL::asset('build/libs/echarts/echarts.min.js') }}"></script>
        <!-- echarts init -->
        <script src="{{ URL::asset('build/js/pages/echarts.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
