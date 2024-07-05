<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('build/images/logo-sm-dark.png') }}" alt="logo-sm-dark" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="logo-dark" height="22">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('build/images/logo-sm-light.png') }}" alt="logo-sm-light"
                            height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="logo-light" height="22">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse"
                data-bs-target="#topnav-menu-content">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- start page title -->
            <div class="page-title-box align-self-center d-none d-md-block">
                <h4 class="page-title mb-0">@yield('page-title')</h4>
            </div>
            <!-- end page title -->
        </div>

        <div class="d-flex">
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="" src="{{ URL::asset('build/images/flags/us.jpg') }}" alt="Header Language"
                        height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/images/flags/spain.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/images/flags/germany.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/images/flags/italy.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/images/flags/russia.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ri-apps-2-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="px-lg-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('build/images/brands/github.png') }}" alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('build/images/brands/bitbucket.png') }}" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('build/images/brands/dribbble.png') }}" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('build/images/brands/dropbox.png') }}" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('build/images/brands/mail_chimp.png') }}"
                                        alt="mail_chimp">
                                    <span>Mail Chimp</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('build/images/brands/slack.png') }}" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="ri-shopping-cart-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">Your order is placed</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">Your item is shipped</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user avatar-sm"
                        src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">Steven</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="pages-profile"><i
                            class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Profile</span></a>
                    <a class="dropdown-item" href="apps-chat"><i
                            class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Messages</span></a>
                    <a class="dropdown-item" href="pages-faq"><i
                            class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Help</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages-profile"><i
                            class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Balance : <b>$5971.67</b></span></a>
                    <a class="dropdown-item" href="#"><span
                            class="badge bg-primary mt-1 float-end">New</span><i
                            class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Settings</span></a>
                    <a class="dropdown-item" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="ri-settings-2-line"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="index">
                            <i class="uim uim-airplay"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement"
                            role="button">
                            <i class="uim uim-layer-group"></i> UI Elements <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                            aria-labelledby="topnav-uielement">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-alerts" class="dropdown-item">Alerts</a>
                                        <a href="ui-buttons" class="dropdown-item">Buttons</a>
                                        <a href="ui-cards" class="dropdown-item">Cards</a>
                                        <a href="ui-carousel" class="dropdown-item">Carousel</a>
                                        <a href="ui-dropdowns" class="dropdown-item">Dropdowns</a>
                                        <a href="ui-grid" class="dropdown-item">Grid</a>
                                        <a href="ui-images" class="dropdown-item">Images</a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-lightbox" class="dropdown-item">Lightbox</a>
                                        <a href="ui-modals" class="dropdown-item">Modals</a>
                                        <a href="ui-offcanvas" class="dropdown-item">Offcanvas</a>
                                        <a href="ui-rangeslider" class="dropdown-item">Range Slider</a>
                                        <a href="ui-roundslider" class="dropdown-item">Round slider</a>
                                        <a href="ui-session-timeout" class="dropdown-item">Session Timeout</a>
                                        <a href="ui-progressbars" class="dropdown-item">Progress Bars</a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <a href="ui-sweet-alert" class="dropdown-item">Sweetalert 2</a>
                                        <a href="ui-tabs-accordions" class="dropdown-item">Tabs & Accordions</a>
                                        <a href="ui-typography" class="dropdown-item">Typography</a>
                                        <a href="ui-video" class="dropdown-item">Video</a>
                                        <a href="ui-general" class="dropdown-item">General</a>
                                        <a href="ui-rating" class="dropdown-item">Rating</a>
                                        <a href="ui-notifications" class="dropdown-item">Notifications</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps"
                            role="button">
                            <i class="uim uim-comment-message"></i> Apps <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    Email <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="email-inbox" class="dropdown-item">Inbox</a>
                                    <a href="email-read" class="dropdown-item">Read Email</a>
                                </div>
                            </div>

                            <a href="calendar" class="dropdown-item">Calendar</a>
                            <a href="apps-chat" class="dropdown-item">Chat</a>
                            <a href="apps-file-manager" class="dropdown-item">File Manager</a>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-invoice" role="button">
                                    Invoice <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                    <a href="invoices" class="dropdown-item">Invoices</a>
                                    <a href="invoice-detail" class="dropdown-item">Invoice Detail</a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-users"
                                    role="button">
                                    Users <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-users">
                                    <a href="users-list" class="dropdown-item">Users List</a>
                                    <a href="users-detail" class="dropdown-item">Users Detail</a>
                                </div>
                            </div>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components"
                            role="button">
                            <i class="uim uim-layer-group"></i> Components <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                    role="button">
                                    Forms <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-form">
                                    <a href="form-elements" class="dropdown-item">Basic Elements</a>
                                    <a href="form-validation" class="dropdown-item">Validation</a>
                                    <a href="form-plugins" class="dropdown-item">Plugins</a>
                                    <a href="form-editors" class="dropdown-item">Editors</a>
                                    <a href="form-uploads" class="dropdown-item">File Upload</a>
                                    <a href="form-wizard" class="dropdown-item">Wizard</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                    role="button">
                                    Tables <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-table">
                                    <a href="tables-bootstrap" class="dropdown-item">Bootstrap Tables</a>
                                    <a href="tables-datatable" class="dropdown-item">Data Tables</a>
                                    <a href="tables-editable" class="dropdown-item">Editable Table</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                    role="button">
                                    Charts <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-chart-1" role="button">
                                            Apexcharts Part 1 <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-chart-1">
                                            <a href="charts-line" class="dropdown-item">Line</a>
                                            <a href="charts-area" class="dropdown-item">Area</a>
                                            <a href="charts-column" class="dropdown-item">Column</a>
                                            <a href="charts-bar" class="dropdown-item">Bar</a>
                                            <a href="charts-mixed" class="dropdown-item">Mixed</a>
                                            <a href="charts-timeline" class="dropdown-item">Timeline</a>
                                            <a href="charts-candlestick" class="dropdown-item">Candlestick</a>
                                            <a href="charts-boxplot" class="dropdown-item">Boxplot</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                            id="topnav-chart-2" role="button">
                                            Apexcharts Part 2 <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-chart-2">
                                            <a href="charts-bubble" class="dropdown-item">Bubble</a>
                                            <a href="charts-scatter" class="dropdown-item">Scatter</a>
                                            <a href="charts-heatmap" class="dropdown-item">Heatmap</a>
                                            <a href="charts-treemap" class="dropdown-item">Treemap</a>
                                            <a href="charts-pie" class="dropdown-item">Pie</a>
                                            <a href="charts-radialbar" class="dropdown-item">Radialbar</a>
                                            <a href="charts-radar" class="dropdown-item">Radar</a>
                                            <a href="charts-polararea" class="dropdown-item">Polararea</a>
                                        </div>
                                    </div>

                                    <a href="charts-echart" class="dropdown-item">E Charts</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                    role="button">
                                    Icons <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                    <a href="icons-remix" class="dropdown-item">Remix Icons</a>
                                    <a href="icons-materialdesign" class="dropdown-item">Material Design</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                    role="button">
                                    Maps <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-map">
                                    <a href="maps-google" class="dropdown-item">Google Maps</a>
                                    <a href="maps-vector" class="dropdown-item">Vector Maps</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more"
                            role="button">
                            <i class="uim uim-box"></i> Extra Pages <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-more">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                    role="button">
                                    Authentication <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="auth-login" class="dropdown-item">Login</a>
                                    <a href="auth-register" class="dropdown-item">Register</a>
                                    <a href="auth-recoverpw" class="dropdown-item">Recover Password</a>
                                    <a href="auth-lock-screen" class="dropdown-item">Lock Screen</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-extra-pages" role="button">
                                    Extra Pages <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-extra-pages">
                                    <a href="pages-starter" class="dropdown-item">Starter Page</a>
                                    <a href="pages-maintenance" class="dropdown-item">Maintenance</a>
                                    <a href="pages-comingsoon" class="dropdown-item">Coming Soon</a>
                                    <a href="pages-faqs" class="dropdown-item">FAQs</a>
                                    <a href="pages-profile" class="dropdown-item">Profile</a>
                                    <a href="pages-pricing" class="dropdown-item">Pricing</a>
                                    <a href="pages-404" class="dropdown-item">Error 404</a>
                                    <a href="pages-500" class="dropdown-item">Error 500</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                            role="button">
                            <i class="uim uim-window-grid"></i> <span>Layouts</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-layout-verti" role="button">
                                    <span key="t-vertical">Vertical</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-layout-verti">
                                    <a href="layouts-dark-sidebar" class="dropdown-item">Dark Sidebar</a>
                                    <a href="layouts-light-sidebar" class="dropdown-item">Light Sidebar</a>
                                    <a href="layouts-compact-sidebar" class="dropdown-item">Compact Sidebar</a>
                                    <a href="layouts-icon-sidebar" class="dropdown-item">Icon Sidebar</a>
                                    <a href="layouts-boxed" class="dropdown-item">Boxed Width</a>
                                    <a href="layouts-preloader" class="dropdown-item">Preloader</a>
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#"
                                    id="topnav-layout-hori" role="button">
                                    <span key="t-horizontal">Horizontal</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-layout-hori">
                                    <a href="layouts-horizontal" class="dropdown-item">Horizontal</a>
                                    <a href="layouts-hori-topbar-dark" class="dropdown-item">Topbar Dark</a>
                                    <a href="layouts-hori-light-header" class="dropdown-item">Light Header</a>
                                    <a href="layouts-hori-boxed-width" class="dropdown-item">Boxed width</a>
                                    <a href="layouts-hori-preloader" class="dropdown-item">Preloader</a>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
