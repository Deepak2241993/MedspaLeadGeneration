@extends('layouts.master')
@section('title')
    Radialbar charts
@endsection
@section('page-title')
    Radialbar charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Radialbar Chart</h4>
                        <div id="basic_radialbar" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Multiple Radialbar</h4>
                        <div id="multiple_radialbar" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Circle Chart - Custom Angle</h4>
                        <div id="circle_radialbar" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Gradient Circle Chart</h4>
                        <div id="gradient_radialbar" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card h-100 mb-xl-0">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Stroked Circular Gauge</h4>
                        <div id="stroked_radialbar" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card h-100 mb-xl-0">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Semi Circular Gauge</h4>
                        <div id="semi_radialbar" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- radialbar charts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-radialbar.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
