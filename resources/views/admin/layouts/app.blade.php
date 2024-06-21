<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ env('APP_URL').'vendor/css/all.min.css' }}" defer="defer">

    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{ env('APP_URL').'vendor/css/simple-line-icons.css' }}" defer="defer">

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ env('APP_URL').'vendor/css/datepicker.min.css' }}" defer="defer">

    <!-- TimePicker -->
    <link rel="stylesheet" href="{{ env('APP_URL').'vendor/css/bootstrap-timepicker.min.css' }}" defer="defer">

    <!-- Select Plugin -->
    <link rel="stylesheet" href="{{ env('APP_URL').'vendor/css/select2.min.css' }}" defer="defer">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ env('APP_URL').'vendor/css/bootstrap-icons.css' }}" defer="defer">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">


    {{-- @stack('datatable-styles') --}}

    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ env('APP_URL').'css/main.css' }}">
     <!-- Styles -->
     <link rel="stylesheet" href="{{ env('APP_URL').'css/app.css' }}">
     <link href="{{ env('APP_URL').'node_modules/summernote/dist/summernote.css'}}" rel="stylesheet">
     <script src="{{ env('APP_URL').'node_modules/summernote/dist/summernote.js'}}"></script>


     <!-- Scripts -->
     <script src="{{ env('APP_URL').'js/app.js' }}" defer></script>

    <title>{{ $pageTitle}}</title>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {{-- @isset($activeSettingMenu)
        <style>
            .preloader-container {
                margin-left: 510px;
                width: calc(100% - 510px)
            }

            .blur-code {
                filter: blur(3px);

            }

            .purchase-code {
                transition: filter .2s ease-out;
                margin-right: 4px;
            }

        </style>
    @endisset --}}

    @stack('styles')

    <style>
        :root {
            --fc-border-color: #E8EEF3;
            --fc-button-text-color: #99A5B5;
            --fc-button-border-color: #99A5B5;
            --fc-button-bg-color: #ffffff;
            --fc-button-active-bg-color: #171f29;
            --fc-today-bg-color: #f2f4f7;
        }

        .fc a[data-navlink] {
            color: #99a5b5;
        }

        .ql-editor p {
            line-height: 1.42;
        }

        .ql-container .ql-tooltip {
            left: 8.5px !important;
            top: -17px !important;
        }

        .table [contenteditable="true"] {
            height: 55px;
        }

        .table [contenteditable="true"]:hover::after {
            content: "{{ __('app.clickEdit') }}" !important;
        }

        .table [contenteditable="true"]:focus::after {
            content: "{{ __('app.anywhereSave') }}" !important;
        }

        .table-bordered .displayName {
            padding: 17px;
        }
    </style>

    {{-- Custom theme styles --}}
    {{-- @if (!user()->dark_theme)
        @include('sections.theme_css')
    @endif --}}

    {{-- @if (file_exists(public_path() . '/css/app-custom.css'))
        <link href="{{ asset('css/app-custom.css') }}" rel="stylesheet">
    @endif --}}

    <script src="{{ env('APP_URL').'vendor/jquery/jquery.min.js' }}"></script>
    <script src="{{ env('APP_URL').'vendor/jquery/modernizr.min.js' }}"></script>

    {{-- Timepicker --}}
    <script src="{{ env('APP_URL').'vendor/jquery/bootstrap-timepicker.min.js' }}" defer="defer"></script>

    {{-- @includeif('sections.push-setting-include') --}}

    {{-- Include file for widgets if exist --}}
    {{-- @includeif('sections.custom_script') --}}


    <script>
        const checkMiniSidebar = localStorage.getItem("mini-sidebar");
    </script>

</head>


<body id="body">
{{-- <script>
    if (checkMiniSidebar == "yes" || checkMiniSidebar == "") {
        $('body').addClass('sidebar-toggled');
    }
</script> --}}
{{-- include topbar --}}
@include('admin.sections.topbar')

{{-- include sidebar menu --}}
@include('admin.sections.sidebar')

<!-- BODY WRAPPER START -->
<div class="body-wrapper clearfix">


    <!-- MAIN CONTAINER START -->
    <section class="main-container bg-additional-grey mb-5 mb-sm-0" id="fullscreen">

        {{-- <div class="preloader-container d-flex justify-content-center align-items-center">
            <div class="spinner-border" role="status" aria-hidden="true"></div>
        </div> --}}


        @yield('filter-section')

        {{-- <x-app-title class="d-block d-lg-none" :pageTitle="__($pageTitle)"></x-app-title> --}}

        @yield('content')


    </section>
    <!-- MAIN CONTAINER END -->
</div>
<!-- BODY WRAPPER END -->
{{-- @include('admin.sections.modals') --}}

<!-- Global Required Javascript -->
<script src="{{ env('APP_URL').'js/main.js' }}"></script>


<!-- Scripts -->
{{-- <script>
    window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    'user' => user(),
]) !!};
</script> --}}

@stack('scripts')

{{-- <script>
    $(window).on('load', function () {
        // Animate loader off screen
        init();
        $(".preloader-container").fadeOut("slow", function () {
            $(this).removeClass("d-flex");
        });
    });

</script> --}}
<script>
    $('#summernote').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
   

</body>

</html>
