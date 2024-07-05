@extends('layouts.master')
@section('title')
    Radar charts
@endsection
@section('page-title')
    Radar charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Radar Chart</h4>
                        <div id="basic_radar" class="apex-charts" dir="ltr"></div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Radar Chart - Multiple series</h4>
                        <div id="multi_radar" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Radar Chart - Polygon Fill</h4>
                        <div id="polygon_radar" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- radarcharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-radar.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
