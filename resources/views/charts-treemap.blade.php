@extends('layouts.master')
@section('title')
    Treemap charts
@endsection
@section('page-title')
    Treemap charts
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Treemap Chart</h4>
                        <div id="basic_treemap" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Multi-Dimensional Treemap Chart</h4>
                        <div id="multi_treemap" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Distributed Treemap Chart (Different Color for each Cell)</h4>
                        <div id="distributed_treemap" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Treemap Chart with Color Ranges</h4>
                        <div id="color_range_treemap" class="apex-charts" dir="ltr"></div>
                    </div><!-- end cardbody -->
                </div>
                <!--end card-->
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- treecharts init -->
        <script src="{{ URL::asset('build/js/pages/apexcharts-treemap.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
