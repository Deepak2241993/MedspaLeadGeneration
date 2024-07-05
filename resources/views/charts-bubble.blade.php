@extends('layouts.master')
@section('title')
    Bubble charts
@endsection
@section('page-title')
    Bubble charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Simple Bubble Chart</h4>
                        <div id="simple_bubble" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">3D Bubble Chart</h4>
                        <div id="bubble_chart" data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- bubblecharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-bubble.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
