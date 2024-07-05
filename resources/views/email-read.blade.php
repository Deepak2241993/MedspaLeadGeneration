@extends('layouts.master')
@section('title')
    Read Email
@endsection
@section('page-title')
    Read Email
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <!-- Left sidebar -->
                <div class="email-leftbar card">
                    <div class="d-grid">
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#composemodal">
                            Compose
                        </button>
                    </div>
                    <div class="mail-list mt-4">
                        <a href="#" class="active"><i class="mdi mdi-email-outline me-2 font-size-18"></i> Inbox <span
                                class="ms-1 float-end">(18)</span></a>
                        <a href="#"><i class="mdi mdi-star-outline me-2 font-size-18"></i>Starred</a>
                        <a href="#"><i class="mdi mdi-diamond-stone me-2 font-size-18"></i>Important</a>
                        <a href="#"><i class="mdi mdi-file-outline me-2 font-size-18"></i>Draft</a>
                        <a href="#"><i class="mdi mdi-email-check-outline me-2 font-size-18"></i>Sent Mail</a>
                        <a href="#"><i class="mdi mdi-trash-can-outline me-2 font-size-18"></i>Trash</a>
                    </div>


                    <h6 class="mt-4">Labels</h6>

                    <div class="mail-list mt-1">
                        <a href="#"><span class="mdi mdi-circle-outline text-info float-end"></span>Theme Support</a>
                        <a href="#"><span class="mdi mdi-circle-outline text-warning float-end"></span>Freelance</a>
                        <a href="#"><span class="mdi mdi-circle-outline text-primary float-end"></span>Social</a>
                    </div>

                    <h6 class="mt-4">Chat</h6>

                    <div class="mt-2">
                        <a href="#" class="d-flex">
                            <img class="d-flex me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                alt="Generic placeholder image" height="36">
                            <div class="flex-1 chat-user-box overflow-hidden">
                                <p class="user-title m-0">Scott Median</p>
                                <p class="text-muted text-truncate font-size-13">Hello</p>
                            </div>
                        </a>

                        <a href="#" class="d-flex">
                            <img class="d-flex me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                alt="Generic placeholder image" height="36">
                            <div class="flex-1 chat-user-box overflow-hidden">
                                <p class="user-title m-0">Julian Rosa</p>
                                <p class="text-muted text-truncate font-size-13">What about our next..</p>
                            </div>
                        </a>

                        <a href="#" class="d-flex">
                            <img class="d-flex me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                alt="Generic placeholder image" height="36">
                            <div class="flex-1 chat-user-box overflow-hidden">
                                <p class="user-title m-0">David Medina</p>
                                <p class="text-muted text-truncate font-size-13 mb-1">Yeah everything is fine</p>
                            </div>
                        </a>

                        <a href="#" class="d-flex">
                            <img class="d-flex me-3 rounded-circle" src="{{ URL::asset('build/images/users/avatar-8.jpg') }}"
                                alt="Generic placeholder image" height="36">
                            <div class="flex-1 chat-user-box overflow-hidden">
                                <p class="user-title m-0">Maxine Carter</p>
                                <p class="text-muted text-truncate font-size-13 mb-1">Last pic over my village</p>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- End Left sidebar -->

                <!-- Right Sidebar -->
                <div class="email-rightbar card mb-3">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-xl-3 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <form class="email-search">
                                        <div class="position-relative">
                                            <input type="text" class="form-control border" placeholder="Search...">
                                            <span class="bx bx-search font-size-18"></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-9 col-md-12">
                                <div class="btn-toolbar float-end" role="toolbar">
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                class="fa fa-inbox"></i></button>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                class="fa fa-exclamation-circle"></i></button>
                                        <button type="button" class="btn btn-primary waves-light waves-effect"><i
                                                class="far fa-trash-alt"></i></button>
                                    </div>
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Updates</a>
                                            <a class="dropdown-item" href="#">Social</a>
                                            <a class="dropdown-item" href="#">Team Manage</a>
                                        </div>
                                    </div>
                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Updates</a>
                                            <a class="dropdown-item" href="#">Social</a>
                                            <a class="dropdown-item" href="#">Team Manage</a>
                                        </div>
                                    </div>

                                    <div class="btn-group me-2 mb-2 mb-sm-0">
                                        <button type="button"
                                            class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            More <i class="mdi mdi-dots-vertical ms-2"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Mark as Unread</a>
                                            <a class="dropdown-item" href="#">Mark as Important</a>
                                            <a class="dropdown-item" href="#">Add to Tasks</a>
                                            <a class="dropdown-item" href="#">Add Star</a>
                                            <a class="dropdown-item" href="#">Mute</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <img class="me-3 rounded-circle avatar-sm" src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                    alt="Generic placeholder image">
                                <div class="flex-1">
                                    <h5 class="font-size-14 mt-1 mb-0">Steven Deese</h5>
                                    <small class="text-muted font-size-13">support@domain.com</small>
                                </div>
                            </div>

                            <h4 class="font-size-16">This Week's Top Stories</h4>

                            <p>Dear Lorem Ipsum,</p>
                            <p>Praesent dui ex, dapibus eget mauris ut, finibus vestibulum enim. Quisque arcu leo, facilisis
                                in fringilla id, luctus in tortor. Nunc vestibulum est quis orci varius viverra. Curabitur
                                dictum volutpat massa vulputate molestie. In at felis ac velit maximus convallis.
                            </p>
                            <p>Sed elementum turpis eu lorem interdum, sed porttitor eros commodo. Nam eu venenatis tortor,
                                id lacinia diam. Sed aliquam in dui et porta. Sed bibendum orci non tincidunt ultrices.
                                Vivamus fringilla, mi lacinia dapibus condimentum, ipsum urna lacinia lacus, vel tincidunt
                                mi nibh sit amet lorem.</p>
                            <p>Sincerly,</p>
                            <hr />

                            <div class="row">
                                <div class="col-xl-2 col-6">
                                    <div class="card">
                                        <img class="card-img-top img-fluid" src="{{ URL::asset('build/images/small/img-3.jpg') }}"
                                            alt="Card image cap">
                                        <div class="py-2 text-center">
                                            <a href="" class="fw-medium">Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-6">
                                    <div class="card">
                                        <img class="card-img-top img-fluid" src="{{ URL::asset('build/images/small/img-4.jpg') }}"
                                            alt="Card image cap">
                                        <div class="py-2 text-center">
                                            <a href="" class="fw-medium">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="javascript: void(0);" class="btn btn-secondary waves-effect mt-3"><i
                                    class="mdi mdi-reply"></i> Reply</a>
                        </div>

                    </div>
                </div>
                <!-- card -->

            </div>
            <!-- end Col-9 -->

        </div>
        <!-- end row -->

        <!-- Modal -->
        <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="composemodalTitle">New Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="To">
                            </div>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="mb-3">
                                <form method="post">
                                    <textarea id="elm1" name="area"></textarea>
                                </form>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send <i
                                class="fab fa-bs-telegram-plane ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!--tinymce js-->
        <script src="{{ URL::asset('build/libs/tinymce/tinymce.min.js') }}"></script>

        <!-- init js -->
        <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
