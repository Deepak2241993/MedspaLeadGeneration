@extends('layouts.master')
@section('title')
    Remix Icons
@endsection
@section('page-title')
    Remix Icons
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12" id="icons"></div> <!-- end col-->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- Remix icon js-->
        <script src="{{ URL::asset('build/js/pages/remix-icons-list.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
