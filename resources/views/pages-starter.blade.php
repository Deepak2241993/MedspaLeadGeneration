@extends('layouts.master')
@section('title')
    Starter page
@endsection
@section('page-title')
    Starter page
@endsection
@section('body')
    <body data-sidebar="colored">
@endsection
@section('content')
    <!--  Start your content -->
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection