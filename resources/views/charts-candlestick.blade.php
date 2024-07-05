@extends('layouts.master')
@section('title')
    Candlestick charts
@endsection
@section('page-title')
    Candlestick charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Candlestick Chart</h4>
                        <div id="basic_candlestick" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Candlestick Synced with Brush Chart (Combo)</h4>
                        <div id="combo_candlestick" class="apex-charts" dir="ltr"></div>
                        <div id="combo_candlestick_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Category X-Axis</h4>
                        <div id="category_candlestick" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->

        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
        <!-- for Category x-axis chart -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.8.17/dayjs.min.js"></script>

        <!-- candlestick charts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-candlestick.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
