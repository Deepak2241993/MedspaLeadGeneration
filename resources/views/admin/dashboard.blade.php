@extends('admin.layouts.app')

@php
    $pageTitle="Dashboard"
@endphp

@push('styles')
    {{-- @if ((!is_null($viewEventPermission) && $viewEventPermission != 'none')
        || (!is_null($viewHolidayPermission) && $viewHolidayPermission != 'none')
        || (!is_null($viewTaskPermission) && $viewTaskPermission != 'none')
        || (!is_null($viewTicketsPermission) && $viewTicketsPermission != 'none')
        || (!is_null($viewLeavePermission) && $viewLeavePermission != 'none')
        )
        <link rel="stylesheet" href="{{ asset('vendor/full-calendar/main.min.css') }}" defer="defer">
    @endif --}}
    <style>
        .h-200 {
            max-height: 340px;
            overflow-y: auto;
        }

        .dashboard-settings {
            width: 600px;
        }

        @media (max-width: 768px) {
            .dashboard-settings {
                width: 300px;
            }
        }

        .fc-list-event-graphic{
            display: none;
        }

        .fc .fc-list-event:hover td{
            background-color: #fff !important;
            color:#000 !important;
        }
        .left-3{
            margin-right: -22px;
        }
        .clockin-right{
            margin-right: -10px;
        }

        .week-pagination li {
            margin-right: 5px;
            z-index: 1;
        }
        .week-pagination li a {
            border-radius: 50%;
            padding: 2px 6px !important;
            font-size: 11px !important;
        }

        .week-pagination li.page-item:first-child .page-link {
            border-top-left-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        .week-pagination li.page-item:last-child .page-link {
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;
        }
    </style>
@endpush

@section('content')
<div class="px-4 py-2 border-top-0 emp-dashboard">
    <!-- WELOCOME START -->
    <div class="d-lg-flex d-md-flex d-block py-2 pb-2 align-items-center">

        <!-- WELOCOME NAME START -->
        <div>
            <h3 class="heading-h3 mb-0 f-21 font-weight-bold">Welcome Forever Medspa & Wellness Center</h3>
        </div>
        <!-- WELOCOME NAME END -->

        <!-- CLOCK IN CLOCK OUT START -->
        <div
            class="ml-auto d-flex clock-in-out mb-3 mb-lg-0 mb-md-0 m mt-4 mt-lg-0 mt-md-0 justify-content-between">
            <p
                class="mb-0 text-lg-right text-md-right f-18 font-weight-bold text-dark-grey d-grid align-items-center">
                <input type="hidden" id="current-latitude" name="current_latitude">
                <input type="hidden" id="current-longitude" name="current_longitude">

                {{-- <span id="dashboard-clock">{!! now()->timezone(company()->timezone)->translatedFormat(company()->time_format) . '</span><span class="f-10 font-weight-normal">' . now()->timezone(company()->timezone)->translatedFormat('l') . '</span>' !!} --}}

                {{-- @if (!is_null($currentClockIn))
                    <span class="f-11 font-weight-normal text-lightest">
                        @lang('app.clockInAt') -
                        {{ $currentClockIn->clock_in_time->timezone(company()->timezone)->translatedFormat(company()->time_format) }}
                    </span>
                @endif --}}
            </p>
        </div>
        <!-- CLOCK IN CLOCK OUT END -->
    </div>
    <!-- WELOCOME END -->
     <!-- EMPLOYEE DASHBOARD DETAIL START -->
     <div class="row emp-dash-detail">
        <!-- EMP DASHBOARD INFO NOTICES START -->
            <div class="col-xl-5 col-lg-12 col-md-12 e-d-info-notices">
                <div class="row">
                    {{-- @if (in_array('profile', $activeWidgets)) --}}
                    <!-- EMP DASHBOARD INFO START -->
                    <div class="col-md-12">
                        <div class="card border-0 b-shadow-4 mb-3 e-d-info">
                            <a>
                                <div class="card-horizontal align-items-center">
                                    <div class="card-img">
                                        <img class="" src="{{ asset ('boy.png')}}" alt="Card image">
                                    </div>
                                    <div class="card-body border-0 pl-0">
                                        <h4 class="card-title text-dark f-18 f-w-500 mb-0">Forever Medspa & Wellness Center</h4>
                                        <p class="f-14 font-weight-normal text-dark-grey mb-2">--</p>
                                        <p class="card-text f-12 text-lightest"> Employee Id : {{ $admin_number}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- EMP DASHBOARD INFO END -->
                    {{-- @endif --}}
                </div>
            </div>
        <!-- EMP DASHBOARD TASKS PROJECTS EVENTS END -->
    </div>
    <!-- EMPLOYEE DASHBOARD DETAIL END -->

</div>
<div class="card shadow mb-4 dashboard-page">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dashboard Criteria</h6>
    </div>
    <div class="card-body">
    <div class="row">
          <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Leads</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$lead_data_number}} Leads</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="col-xl-4 col-md-6 mb-4">-->
            <!--    <div class="card border-left-primary shadow h-100 py-2">-->
            <!--        <div class="card-body">-->
            <!--            <div class="row no-gutters align-items-center">-->
            <!--                <div class="col mr-2">-->
            <!--                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Lead Status</div>-->
            <!--                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$lead_status_number}} Leads</div>-->
            <!--                </div>-->
            <!--                <div class="col-auto">-->
            <!--                    <i class="fas fa-calendar fa-2x text-gray-300"></i>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Email Template</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$email_template_number}} Email Template</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Visitors</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$visitor_number}} Visitor</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






    </div>
    </div>

</div>

@endsection
