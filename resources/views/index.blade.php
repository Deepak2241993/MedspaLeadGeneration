@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    Dashboard
@endsection

@section('body')
    <body data-sidebar="colored">
    @endsection

@section('content')
    <h1>Welcome, {{ Auth::user()->name }}!</h1>

    @if(Auth::user()->getRoleNames()->isEmpty())
        <!-- If the user has no roles assigned, display this message -->
        <div class="alert alert-warning">
            Your role will be assigned soon. Please contact the administrator for more details.
        </div>
    @else
     @can('lead_view')
        <!-- If the user has roles assigned, display the dashboard -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card" style="border: 1px solid #47484A;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                    <i class="ri-database-2-fill"></i>
                                </span>
                            </div>
                            <a href="{{ route('leads.index') }}">
                                <div class="flex-grow-1 overflow-hidden ms-4">
                                    <p class="text-muted text-truncate font-size-15 mb-2"> Total Leads</p>
                                    <h4 class="mb-0">{{ $leadCount }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($leadCountsByStatus as $statusName => $statusData)
            <div class="col-xl-3 col-md-6">
                <div class="card" style="border: 1px solid #47484A;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title rounded fs-2" 
                                      style="background-color: #{{ $statusData['label_color'] }}; color: #fff;">
                                    <i class="ri-database-2-fill"></i>
                                </span>
                            </div>
                            <a href="{{ route('leads.index', ['status_id' => $statusData['status_id']]) }}">
                                <div class="flex-grow-1 overflow-hidden ms-4">
                                    <p class="text-muted text-truncate font-size-15 mb-2">
                                        {{ $statusName }} 
                                    </p>
                                    <h4 class="mb-0">{{ $statusData['count'] }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-xl-3 col-md-6">
            <div class="card" style="border: 1px solid #47484A;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-md flex-shrink-0">
                            <span class="avatar-title rounded fs-2" 
                                  style="background-color: #ff0000; color: #fff; display: inline-flex; align-items: center; justify-content: center;">
                                <i class="ri-database-2-fill"></i>
                            </span>
                        </div>
                        
                        <a href="{{ route('leads.archived') }}">
                            <div class="flex-grow-1 overflow-hidden ms-4">
                                <p class="text-muted text-truncate font-size-15 mb-2"> Archived Leads</p>
                                <h4 class="mb-0">{{ $archivedLeadCount }}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endcan
            
        @can('	email-template_view')              
        <div class="col-xl-3 col-md-6">
            <div class="card" style="border: 1px solid #47484A;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-md flex-shrink-0">
                            <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                <i class=" ri-mail-send-line"></i>
                            </span>
                        </div>
                        <a href="{{ route('email.index') }}">
                            <div class="flex-grow-1 overflow-hidden ms-4">
                                <p class="text-muted text-truncate font-size-15 mb-2">Email Templates</p>
                                <h4 class="mb-0">{{ $emailTemplateCount }}</h4> <!-- Display the count here -->
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        
        </div>
    @endif

@endsection

@section('scripts')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Vector map-->
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <!-- Remix icon js-->
    <script src="http://127.0.0.1:8000/build/js/pages/remix-icons-list.js"></script>
@endsection
