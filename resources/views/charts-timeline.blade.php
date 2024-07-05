@extends('layouts.master')
@section('title')
    Timeline charts
@endsection
@section('page-title')
    Timeline charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic TimeLine Charts</h4>
                        <div id="basic_timeline" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Different Color For Each Bar</h4>
                        <div id="color_timeline" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Multi Series Timeline</h4>
                        <div id="multi_series" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Advanced Timeline (Multiple Range)</h4>
                        <div id="advanced_timeline" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/libs/moment/min/moment.min.js') }}"></script>
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
        <!-- timeline charts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-timeline.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
