@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-9">
                <div class="card mb-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab" aria-selected="true">
                                <i class="ri-shield-user-line font-size-20"></i>
                                <span class="d-none d-sm-block">About</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab" aria-selected="false">
                                <i class="ri-clipboard-line font-size-20"></i>
                                <span class="d-none d-sm-block">Tasks</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false">
                                <i class="ri-mail-line font-size-20"></i>
                                <span class="d-none d-sm-block">Messages</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content p-4">
                        <div class="tab-pane active" id="about" role="tabpanel">
                            <div>
                                <div>
                                    <h5 class="font-size-16 mb-4">Experience</h5>

                                    <ul class="activity-feed mb-0 ps-2">
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">2020 - 2022</p>
                                                <h5 class="font-size-15">UI/UX Designer</h5>
                                                <p>Abc Company</p>
                                                <p class="text-muted">To achieve this, it would be necessary to have uniform
                                                    grammar, pronunciation and more common words. If several languages
                                                    coalesce, the grammar of the resulting language is more simple and
                                                    regular than that of the individual</p>
                                            </div>
                                        </li>
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">2019 - 2020</p>
                                                <h5 class="font-size-15">Graphic Designer</h5>
                                                <p>xyz Company</p>
                                                <p class="text-muted mb-1">It will be as simple as occidental in fact, it
                                                    will be Occidental. To an English person, it will seem like simplified
                                                    English, as a skeptical Cambridge friend of mine told me what Occidental
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <h5 class="font-size-16 mb-2 pt-1">Projects</h5>

                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Projects</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row">01</td>
                                                    <td><a href="#" class="text-dark">Brand Logo Design</a></td>
                                                    <td>
                                                        18 Jun, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-primary font-size-12">Open</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">02</td>
                                                    <td><a href="#" class="text-dark">Minible Admin</a></td>
                                                    <td>
                                                        06 Jun, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-primary font-size-12">Open</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">03</td>
                                                    <td><a href="#" class="text-dark">Chat app Design</a></td>
                                                    <td>
                                                        28 May, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-success font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">04</td>
                                                    <td><a href="#" class="text-dark">Minible Landing</a></td>
                                                    <td>
                                                        13 May, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-success font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">05</td>
                                                    <td><a href="#" class="text-dark">Authentication Pages</a></td>
                                                    <td>
                                                        06 May, 2020
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-success font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tasks" role="tabpanel">
                            <div>
                                <h5 class="font-size-16 mb-3">Active</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60px;">
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-activeCheck2">
                                                        <label class="form-check-label" for="tasks-activeCheck2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">Ecommerce Product Detail</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        3
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>27 May, 2020</td>
                                                <td style="width: 160px;"><span
                                                        class="badge badge-soft-primary font-size-12">Active</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-activeCheck1">
                                                        <label class="form-check-label" for="tasks-activeCheck1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">Ecommerce Product</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        7
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Web Development</p>
                                                </td>

                                                <td>26 May, 2020</td>
                                                <td><span class="badge badge-soft-primary font-size-12">Active</span></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h5 class="font-size-16 my-3">Upcoming</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60px;">
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-upcomingCheck3">
                                                        <label class="form-check-label"
                                                            for="tasks-upcomingCheck3"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">Chat app Page</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        2
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Web Development</p>
                                                </td>

                                                <td>-</td>
                                                <td style="width: 160px;"><span
                                                        class="badge badge-soft-secondary font-size-12">Waiting</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-upcomingCheck2">
                                                        <label class="form-check-label"
                                                            for="tasks-upcomingCheck2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">Email Pages</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        1
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Illustration</p>
                                                </td>

                                                <td>04 June, 2020</td>
                                                <td><span class="badge badge-soft-primary font-size-12">Approved</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-upcomingCheck1">
                                                        <label class="form-check-label"
                                                            for="tasks-upcomingCheck1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">Contacts Profile Page</a>
                                                </td>
                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        6
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>-</td>
                                                <td><span class="badge badge-soft-secondary font-size-12">Waiting</span>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h5 class="font-size-16 my-3">Complete</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60px;">
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-completeCheck3">
                                                        <label class="form-check-label"
                                                            for="tasks-completeCheck3"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">UI Elements</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        6
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>27 May, 2020</td>
                                                <td style="width: 160px;"><span
                                                        class="badge badge-soft-success font-size-12">Complete</span></td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-completeCheck2">
                                                        <label class="form-check-label"
                                                            for="tasks-completeCheck2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">Authentication Pages</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        2
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Illustration</p>
                                                </td>

                                                <td>27 May, 2020</td>
                                                <td><span class="badge badge-soft-success font-size-12">Complete</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16 text-center">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tasks-completeCheck1">
                                                        <label class="form-check-label"
                                                            for="tasks-completeCheck1"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-dark">Admin Layout</a>
                                                </td>

                                                <td>
                                                    <p class="ml-4 text-muted mb-0">
                                                        <i
                                                            class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i>
                                                        3
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="ml-4 mb-0">Product Design</p>
                                                </td>

                                                <td>26 May, 2020</td>
                                                <td><span class="badge badge-soft-success font-size-12">Complete</span>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="messages" role="tabpanel">
                            <div>
                                <div data-simplebar="init" style="max-height: 500px;">
                                    <div class="d-flex align-items-start border-bottom py-4">
                                        <div class="flex-shrink-0 me-2">
                                            <img class="rounded-circle avatar-sm" src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                alt="avatar-3 images">
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-1">Marion Walker <small
                                                    class="text-muted float-end">1 hr ago</small></h5>
                                            <p class="text-muted">If several languages coalesce, the grammar of the
                                                resulting .</p>

                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                    class="mdi mdi-reply"></i> Reply</a>

                                            <div class="d-flex align-items-start mt-4">
                                                <div class="flex-shrink-0 me-2">
                                                    <img class="rounded-circle avatar-sm"
                                                        src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="avatar-4 images">
                                                </div>

                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-15 mb-1">Shanon Marvin <small
                                                            class="text-muted float-end">1 hr ago</small></h5>
                                                    <p class="text-muted">It will be as simple as in fact, it will be
                                                        Occidental. To it will seem like simplified .</p>


                                                    <a href="javascript: void(0);"
                                                        class="text-muted font-13 d-inline-block">
                                                        <i class="mdi mdi-reply"></i> Reply
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-bottom py-4">
                                        <div class="flex-shrink-0 me-2">
                                            <img class="rounded-circle avatar-sm" src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                alt="avatar-5 images">
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-1">Janice Morgan <small
                                                    class="text-muted float-end">2 hrs ago</small></h5>
                                            <p class="text-muted">To achieve this, it would be necessary to have uniform
                                                pronunciation.</p>

                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                    class="mdi mdi-reply"></i> Reply</a>

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start border-bottom py-4">
                                        <div class="flex-shrink-0 me-2">
                                            <img class="rounded-circle avatar-sm" src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                alt="avatar-7 images">
                                        </div>

                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-1">Patrick Petty <small
                                                    class="text-muted float-end">3 hrs ago</small></h5>
                                            <p class="text-muted">Sed ut perspiciatis unde omnis iste natus error sit </p>

                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                    class="mdi mdi-reply"></i> Reply</a>

                                        </div>
                                    </div>
                                </div>

                                <div class="border rounded mt-4">
                                    <form action="#">
                                        <div class="px-2 py-1 bg-light">

                                            <div class="btn-group" role="group">
                                                <button type="button"
                                                    class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                        class="ri-links-line"></i></button>
                                                <button type="button"
                                                    class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                        class="ri-user-smile-line"></i></button>
                                                <button type="button"
                                                    class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                        class="ri-at-line"></i></button>
                                            </div>

                                        </div>
                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>

                                    </form>
                                </div> <!-- end .border-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Skills</h5>
                        <div class="d-flex flex-wrap gap-2 font-size-16">
                            <a href="#" class="badge badge-soft-primary">Photoshop</a>
                            <a href="#" class="badge badge-soft-primary">illustrator</a>
                            <a href="#" class="badge badge-soft-primary">HTML</a>
                            <a href="#" class="badge badge-soft-primary">CSS</a>
                            <a href="#" class="badge badge-soft-primary">Javascript</a>
                            <a href="#" class="badge badge-soft-primary">Php</a>
                            <a href="#" class="badge badge-soft-primary">Python</a>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Similar Profiles</h5>

                        <div class="mb-2">
                            <div class="d-flex align-items-center border-bottom pb-3 pt-2">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                        class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <a href="pages-profile" class="text-dark">
                                            <h5 class="font-size-15 mb-1">
                                                Esther James</h5>
                                        </a>
                                        <p class="font-size-13 text-muted mb-0">Frontend Developer</p>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <div class="dropdown">
                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                            <i class="mdi mdi-dots-vertical font-size-16"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center border-bottom py-3">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                        class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <a href="pages-profile" class="text-dark">
                                            <h5 class="font-size-15 mb-1">
                                                Jacqueline Steve</h5>
                                        </a>
                                        <p class="font-size-13 text-muted mb-0">UI/UX Designer</p>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <div class="dropdown">
                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                            <i class="mdi mdi-dots-vertical font-size-16"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center pt-3">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                        class="img-fluid rounded-circle">
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <a href="pages-profile" class="text-dark">
                                            <h5 class="font-size-15 mb-1">
                                                George Whalen</h5>
                                        </a>
                                        <p class="font-size-13 text-muted mb-0">Backend Developer</p>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-end">
                                    <div class="dropdown">
                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                            <i class="mdi mdi-dots-vertical font-size-16"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2">Blog</h5>
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-3 px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div>
                                                <img src="{{ URL::asset('build/images/small/img-4.jpg') }}" alt="blog img"
                                                    class="avatar-lg h-auto rounded">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate"><a href="ui-cards"
                                                    class="text-dark">Beautiful Day with Friends</a></h5>
                                            <ul class="list-inline font-size-14 text-muted">
                                                <li class="list-inline-item">
                                                    <a href="ui-cards" class="text-muted">
                                                        <i class="ri-user-line me-1 align-middle"></i> Steven
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="ri-calendar-line me-1 align-middle"></i> 12 May
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="dropdown">
                                                <a class="btn btn-link text-dark font-size-16 p-1 dropdown-toggle shadow-none"
                                                    href="" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-16"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item py-3 px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div>
                                                <img src="{{ URL::asset('build/images/small/img-3.jpg') }}" alt="blog img"
                                                    class="avatar-lg h-auto rounded">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate"><a href="ui-cards"
                                                    class="text-dark">Morning skating with friends</a></h5>
                                            <ul class="list-inline font-size-14 text-muted">
                                                <li class="list-inline-item">
                                                    <a href="ui-cards" class="text-muted">
                                                        <i class="ri-user-line me-1 align-middle"></i> Steven
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="ri-calendar-line me-1 align-middle"></i> 24 Apr
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="dropdown">
                                                <a class="btn btn-link text-dark font-size-16 p-1 dropdown-toggle shadow-none"
                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-16"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item py-3 px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div>
                                                <img src="{{ URL::asset('build/images/small/img-2.jpg') }}" alt="blog img"
                                                    class="avatar-lg h-auto rounded">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate"><a href="ui-cards"
                                                    class="text-dark">Project Discussion with Team</a></h5>
                                            <ul class="list-inline font-size-14 text-muted">
                                                <li class="list-inline-item">
                                                    <a href="ui-cards" class="text-muted">
                                                        <i class="ri-user-line me-1 align-middle"></i> Steven
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="ri-calendar-line me-1 align-middle"></i> 12 Apr
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="dropdown">
                                                <a class="btn btn-link text-dark font-size-16 p-1 dropdown-toggle shadow-none"
                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-16"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item pt-3 pb-0 px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div>
                                                <img src="{{ URL::asset('build/images/small/img-6.jpg') }}" alt="blog img"
                                                    class="avatar-lg h-auto rounded">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="font-size-15 mb-1 text-truncate"><a href="#"
                                                    class="text-dark">Reading book</a></h5>
                                            <ul class="list-inline font-size-14 text-muted">
                                                <li class="list-inline-item">
                                                    <a href="#" class="text-muted">
                                                        <i class="ri-user-line me-1 align-middle"></i> Steven
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="ri-calendar-line me-1 align-middle"></i> 01 Apr
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="dropdown">
                                                <a class="btn btn-link text-dark font-size-16 p-1 dropdown-toggle shadow-none"
                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-16"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
