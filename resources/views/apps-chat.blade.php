@extends('layouts.master')
@section('title')
    Chat
@endsection
@section('page-title')
    Chat
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="d-lg-flex mb-4">
            <div class="chat-leftsidebar me-4">
                <div class="card mb-0">
                    <div class="card-body pt-0">
                        <div class="py-3 border-bottom">
                            <div class="d-flex">
                                <div class="align-self-center me-3">
                                    <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" class="avatar-xs rounded-circle"
                                        alt="avatar-2">
                                </div>
                                <div class="flex-1">
                                    <h5 class="font-size-15 mb-1">Michael Gamble</h5>
                                    <p class="text-muted mb-0"><i
                                            class="mdi mdi-circle text-primary font-size-10 align-middle me-1"></i> Active
                                    </p>
                                </div>

                                <div>
                                    <div class="dropdown chat-noti-dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal font-size-20"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-2 mt-3">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control border" placeholder="Search...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-leftsidebar-nav">
                        <ul class="nav nav-pills nav-justified bg-light-subtle">
                            <li class="nav-item">
                                <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                    <i class="ri-message-2-line font-size-20"></i>
                                    <span class="mt-2 d-none d-sm-block">Chat</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#group" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="ri-group-line font-size-20"></i>
                                    <span class="mt-2 d-none d-sm-block">Group</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#contact" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="ri-contacts-book-2-line font-size-20"></i>
                                    <span class="mt-2 d-none d-sm-block">Contacts</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content pt-4">
                    <div class="tab-pane show active" id="chat">
                        <div>
                            <h5 class="font-size-14 mb-3">Recent</h5>
                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 500px;">
                                <li class="active">
                                    <a href="#" class="mt-0">
                                        <div class="d-flex">

                                            <div class="user-img online align-self-center me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-xs"
                                                    alt="avatar-2">
                                                <span class="user-status"></span>
                                            </div>

                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Frank Vickery</h5>
                                                <p class="text-truncate mb-0">Hey! there I'm available</p>
                                            </div>
                                            <div class="font-size-11">04 min</div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <div class="d-flex">
                                            <div class="user-img away align-self-center me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" class="rounded-circle avatar-xs"
                                                    alt="avatar-3">
                                                <span class="user-status"></span>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Robert Winter</h5>
                                                <p class="text-truncate mb-0">I've finished it! See you so</p>
                                            </div>
                                            <div class="font-size-11">09 min</div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <div class="d-flex">
                                            <div class="user-img online me-3">
                                                <div class="avatar-xs align-self-center">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        C
                                                    </span>
                                                </div>
                                                <span class="user-status mb-2"></span>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Crystal Elliott</h5>
                                                <p class="text-truncate mb-0">This theme is awesome!</p>
                                            </div>
                                            <div class="font-size-11">21 min</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="d-flex">
                                            <div class="user-img align-self-center me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                    class="rounded-circle avatar-xs" alt="avatar-4">
                                                <span class="user-status"></span>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Kristen Steele</h5>
                                                <p class="text-truncate mb-0">Nice to meet you</p>
                                            </div>
                                            <div class="font-size-11">1 hr</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="d-flex">
                                            <div class="user-img away me-3">
                                                <div class="avatar-xs align-self-center">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        M
                                                    </span>
                                                </div>
                                                <span class="user-status mb-2"></span>
                                            </div>

                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Mitchel Givens</h5>
                                                <p class="text-truncate mb-0">Hey! there I'm available</p>
                                            </div>
                                            <div class="font-size-11">3 hrs</div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <div class="d-flex">
                                            <div class="user-img online align-self-center me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                    class="rounded-circle avatar-xs" alt="avatar-6">
                                                <span class="user-status"></span>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Stephen Hadley</h5>
                                                <p class="text-truncate mb-0">I've finished it! See you so</p>
                                            </div>
                                            <div class="font-size-11">5hrs</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="mb-0">
                                        <div class="d-flex">
                                            <div class="user-img online me-3">
                                                <div class="avatar-xs align-self-center">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        K
                                                    </span>
                                                </div>
                                                <span class="user-status mb-2"></span>
                                            </div>

                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Tracy Penley</h5>
                                                <p class="text-truncate mb-0">This theme is awesome!</p>
                                            </div>
                                            <div class="font-size-11">24/03</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane" id="group">
                        <h5 class="font-size-14 mb-2">Group</h5>
                        <ul class="list-unstyled chat-list" data-simplebar style="max-height: 380px;">
                            <li>
                                <a href="#" class="mt-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                G
                                            </span>
                                        </div>

                                        <div class="flex-1">
                                            <h5 class="font-size-14 mb-0">General</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                R
                                            </span>
                                        </div>

                                        <div class="flex-1">
                                            <h5 class="font-size-14 mb-0">Reporting</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                M
                                            </span>
                                        </div>

                                        <div class="flex-1">
                                            <h5 class="font-size-14 mb-0">Meeting</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                A
                                            </span>
                                        </div>

                                        <div class="flex-1">
                                            <h5 class="font-size-14 mb-0">Project A</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="mb-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                B
                                            </span>
                                        </div>

                                        <div class="flex-1">
                                            <h5 class="font-size-14 mb-0">Project B</h5>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-pane" id="contact">
                        <h5 class="font-size-14 mb-2">Contact</h5>

                        <div data-simplebar style="max-height: 490px;">
                            <div>
                                <div class="py-1">
                                    A
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">Adam Miller</h5>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">Alfonso Fisher</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-3">
                                <div class="py-1">
                                    B
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">Bonnie Harney</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-3">
                                <div class="py-1">
                                    C
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">Charles Brown</h5>
                                        </a>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">Carmella Jones</h5>
                                        </a>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">Carrie Williams</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-3">
                                <div class="py-1">
                                    D
                                </div>

                                <ul class="list-unstyled chat-list">
                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">Dolores Minter</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-100 user-chat mt-4 mt-sm-0 card mb-0">
                <div class="card-body">
                    <div class="pb-3 user-chat-border">
                        <div class="row">
                            <div class="col-md-4 col-6">
                                <h5 class="font-size-15 mb-1 text-truncate">Frank Vickery</h5>
                                <p class="text-muted text-truncate mb-0"><i
                                        class="mdi mdi-circle text-primary font-size-10 align-middle me-1"></i> Active now
                                </p>
                            </div>
                            <div class="col-md-8 col-6">
                                <ul class="list-inline user-chat-nav text-end mb-0">
                                    <li class="list-inline-item d-inline-block d-sm-none">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ri-search-line"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                                <form class="p-2">
                                                    <div class="search-box">
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control rounded"
                                                                placeholder="Search...">
                                                            <i class="ri-search-line search-icon"></i>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-none d-sm-inline-block">
                                        <div class="search-box me-2">
                                            <div class="position-relative">
                                                <input type="text" class="form-control border"
                                                    placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item m-0 d-none d-sm-inline-block">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-cog"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">View Profile</a>
                                                <a class="dropdown-item" href="#">Clear chat</a>
                                                <a class="dropdown-item" href="#">Muted</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else</a>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="chat-conversation py-3">
                        <ul class="list-unstyled mb-0 pe-3" data-simplebar style="max-height: 630px;">
                            <li>
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="avatar-2">
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Hi Jordan! <br>
                                                        Feels like it's been a while! Home are you? Do you
                                                        have ant time for the remainder of the week to help me with an
                                                        ongoing project?
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-shrink-0 ps-2">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="right">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 pe-2">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-0">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Hi Martin, Glad to hear from you, I'm fine,what about you? and how
                                                        it's going with the velocity website?
                                                        Of course I will help with this project
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar-2">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="chat-day-title">
                                    <span class="title font-size-13">Today</span>
                                </div>
                            </li>

                            <li>
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="avatar-2">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Super, I will get you the new brief for our own site over to you
                                                        this evening,
                                                        so you have time to read over I'm good thank you!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ps-2">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="right">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 pe-2">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-grow-0">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Of course I can, just catching up with Steve on it and i'll write it
                                                        out.
                                                        Speak tomorrow! Let me know if you have any questions!
                                                    </p>
                                                    <ul class="list-inline message-img mt-2 mb-0">
                                                        <li class="list-inline-item message-img-list">
                                                            <a class="d-inline-block" href="">
                                                                <img src="{{ URL::asset('build/images/small/img-1.jpg') }}" alt=""
                                                                    style="width: 80px;" class="rounded img-thumbnail">
                                                            </a>
                                                        </li>

                                                        <li class="list-inline-item message-img-list">
                                                            <a class="d-inline-block" href="">
                                                                <img src="{{ URL::asset('build/images/small/img-2.jpg') }}" alt=""
                                                                    style="width: 80px;" class="rounded img-thumbnail">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar-2">
                                        </div>
                                    </div>

                                </div>
                            </li>

                            <li>
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="avatar-2">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Thank You very much, I am waiting Project
                                                    </p>
                                                </div>
                                                <p class="chat-time mb-0"><i class="mdi mdi-clock-outline me-1"></i> 10:06
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ps-2">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="right">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 pe-2">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Copy</a>
                                                    <a class="dropdown-item" href="#">Save</a>
                                                    <a class="dropdown-item" href="#">Forward</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-0">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        When someone thanks us, our automatic response is to say, “You’re
                                                        welcome.” This is something that we have
                                                        learned from our parents and family and have been doing for a long
                                                        time.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar-2">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="px-lg-3">
                        <div class="pt-3">
                            <div class="row">
                                <div class="col">
                                    <div class="position-relative">
                                        <input type="text" class="form-control chat-input"
                                            placeholder="Enter Message...">

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit"
                                        class="btn btn-primary chat-send w-md waves-effect waves-light"><span
                                            class="d-none d-sm-inline-block me-2">Send</span> <i
                                            class="mdi mdi-send"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
