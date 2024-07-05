@extends('layouts.master')
@section('title')
    Inbox
@endsection
@section('page-title')
    Inbox
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
                                <p class="text-muted text-truncate font-size-13">Yeah everything is fine</p>
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
                    <div class="p-3 pb-0">
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

                        <ul class="message-list mt-4">
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk19">
                                        <label class="form-label" for="chk19" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Peter, me (3)</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Software like Aldus PageMaker
                                        including versions </h6>
                                    <a href="#" class="subject">Hello – <span class="teaser">Trip home from Colombo
                                            has been arranged, then Jenna will come get me from Stockholm. :)</span>
                                    </a>
                                    <div class="date">Mar 6</div>
                                </div>
                            </li>

                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk20">
                                        <label class="form-label" for="chk20" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">me, Susanna (7)</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Sometimes on purpose </h6>
                                    <a href="#" class="subject"><span
                                            class="bg-warning badge me-2">Freelance</span>Since you asked... and i'm
                                        inconceivably bored at the train station –
                                        <span class="teaser">Alright thanks. I'll have to re-book that somehow, i'll get
                                            back to you.</span>
                                    </a>
                                    <div class="date">Mar. 6</div>
                                </div>
                            </li>

                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk6">
                                        <label class="form-label" for="chk6" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Web Support Dennis</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Similique sunt in culpa qui officia
                                        deserunt mollitia </h6>
                                    <a href="#" class="subject">Re: New mail settings –
                                        <span class="teaser">Will you answer him asap?</span>
                                    </a>
                                    <div class="date">Mar 7</div>
                                </div>
                            </li>
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk7">
                                        <label class="form-label" for="chk7" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">me, Peter (2)</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Business it will frequently occur that
                                        pleasures have </h6>
                                    <a href="#" class="subject"><span class="bg-info badge me-2">Support</span>Off
                                        on Thursday -
                                        <span class="teaser">Eff that place, you might as well stay here with us instead!
                                            Sent from my iPhone 4 4 mar 2014 at 5:55 pm</span>
                                    </a>
                                    <div class="date">Mar 4</div>
                                </div>
                            </li>
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk8">
                                        <label class="form-label" for="chk8" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Medium</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject">Bonorum et Malorum" (The Extremes of
                                        Good and Evil) by Cicero</h6>
                                    <a href="#" class="subject"><span
                                            class="bg-primary badge me-2">Social</span>This Week's Top Stories –
                                        <span class="teaser">Our top pick for you on Medium this week The Man Who Destroyed
                                            America’s Ego</span>
                                    </a>
                                    <div class="date">Feb 28</div>
                                </div>
                            </li>
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk9">
                                        <label class="form-label" for="chk9" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-8.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Death to Stock</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Non-characteristic words etc.</h6>
                                    <a href="#" class="subject">Montly High-Res Photos –
                                        <span class="teaser">To create this month's pack, we hosted a party with local
                                            musician Jared Mahone here in Columbus, Ohio.</span>
                                    </a>
                                    <div class="date">Feb 28</div>
                                </div>
                            </li>

                            <li class="unread">
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk3">
                                        <label class="form-label" for="chk3" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-1.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Randy, me (5)</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Consequuntur magni dolores ratione
                                        voluptatem </h6>
                                    <a href="#" class="subject"><span
                                            class="bg-success badge me-2">Family</span>Last pic over my village –
                                        <span class="teaser">Yeah i'd like that! Do you remember the video you showed me of
                                            your train ride between Colombo and Kandy? The one with the mountain view? I
                                            would love to see that one again!</span>
                                    </a>
                                    <div class="date">5:01 am</div>
                                </div>
                            </li>
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk4">
                                        <label class="form-label" for="chk4" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Andrew Zimmer</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Curabitur varius tellus sollicitudin
                                        ultricies. </h6>
                                    <a href="#" class="subject">Mochila Beta: Subscription Confirmed
                                        – <span class="teaser">You've been confirmed! Welcome to the ruling class of the
                                            inbox. For your records, here is a copy of the information you submitted to
                                            us...</span>
                                    </a>
                                    <div class="date">Mar 8</div>
                                </div>
                            </li>
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk5">
                                        <label class="form-label" for="chk5" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Infinity HR</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Aliquam commodo quis sem vitae
                                        sollicitudin. Morbi in dolor quam.</h6>
                                    <a href="#" class="subject">Sveriges Hetaste sommarjobb –
                                        <span class="teaser">Hej Nicklas Sandell! Vi vill bjuda in dig till "First tour
                                            2014", ett rekryteringsevent som erbjuder jobb på 16 semesterorter
                                            iSverige.</span>
                                    </a>
                                    <div class="date">Mar 8</div>
                                </div>
                            </li>
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="checkbox-wrapper-mail">
                                        <input type="checkbox" id="chk10">
                                        <label class="form-label" for="chk10" class="toggle"></label>
                                    </div>
                                    <span class="star-toggle far fa-star"></span>
                                    <div class="d-flex ps-4">
                                        <div class="flex-grow-1">
                                            <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="title">Revibe</a>
                                    </div>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <h6 class="mb-0 font-size-15 mt-2 pt-1 subject"> Praesent ut faucibus Fusce eu nulla
                                        magna. </h6>
                                    <a href="#" class="subject"><span
                                            class="bg-danger badge me-2">Friends</span>Weekend on Revibe –
                                        <span class="teaser">Today's Friday and we thought maybe you want some music
                                            inspiration for the weekend. Here are some trending tracks and playlists we
                                            think you should give a listen!</span>
                                    </a>
                                    <div class="date">Feb 27</div>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- card -->

                    <div class="p-3 pt-0">
                        <div class="row">
                            <div class="col-7">
                                Showing 1 - 20 of 1,524
                            </div>
                            <div class="col-5">
                                <div class="btn-group float-end">
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                            class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                            class="fa fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end Col-9 -->

            </div>

        </div><!-- End row -->
        </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

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
                                class="fab fa-telegram-plane ms-1"></i></button>
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
