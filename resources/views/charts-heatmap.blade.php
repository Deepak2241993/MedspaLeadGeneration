@extends('layouts.master')
@section('title')
    Heatmap charts
@endsection
@section('page-title')
    Heatmap charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Heatmap Chart</h4>
                        <div id="basic_heatmap" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Heatmap - Multiple Series</h4>
                        <div id="multiple_heatmap" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Heatmap Color Range</h4>
                        <div id="color_heatmap" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Heatmap - Range Without Shades</h4>
                        <div id="shades_heatmap" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- heatmapscharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-heatmap.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
