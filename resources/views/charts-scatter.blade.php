@extends('layouts.master')
@section('title')
    Scatter charts
@endsection
@section('page-title')
    Scatter charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Scatter Chart</h4>
                        <div id="basic_scatter" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Scatter - Datetime Chart</h4>
                        <div id="datetime_scatter" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Scatter Images Chart</h4>
                        <div id="images_scatter" data-colors='["--bs-primary", "--bs-danger"]' class="apex-charts"
                            dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- scatter charts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-scatter.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
