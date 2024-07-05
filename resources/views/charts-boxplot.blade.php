@extends('layouts.master')
@section('title')
    Boxplot charts
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/apexcharts/apexcharts.css') }}">
@endsection
@section('page-title')
    Boxplot charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Box Chart</h4>
                        <div id="basic_box" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Boxplot with Scatter Chart</h4>
                        <div id="box_plot" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- boxplotcharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-boxplot.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
