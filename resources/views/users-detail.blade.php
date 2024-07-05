@extends('layouts.master')
@section('title')
    Users Detail
@endsection
@section('css')
@endsection
@section('page-title')
    Users Detail
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-8">
                <div class="card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="userpage-content"></div>
                        <div class="p-4">
                            <div class="userpage-user-img">
                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                    class="avatar-lg rounded-circle img-thumbnail">
                            </div>
                            <h5 class="mt-3 mb-1">Steven Deese</h5>
                            <p class="text-muted">UI/UX Designer</p>
                            <p class="text-muted mb-1">
                                It will be as simple as occidental in fact, it will be Occidental. To an English person, it
                                will seem like simplified English, as a skeptical
                                Cambridge friend of mine told me what Occidental is. The European languages are members of
                                the same family. Their separate existence is a myth.
                                For science, music, sport, etc, Europe uses the same vocabulary.
                                The languages only differ in their grammar, their pronunciation and their most common words.
                            </p>

                            <ul class="ps-4 gapx-2 py-2 mt-3">
                                <li>Product Design, Figma (Software), Prototype</li>
                                <li>Four Dashboards : Ecommerce, Analytics, Project,etc.</li>
                                <li>Create calendar, chat and email app pages.</li>
                                <li>Add authentication pages.</li>
                                <li>Content listing.</li>
                            </ul>

                            <div>
                                <button type="button" class="btn btn-link link-primary p-0">Read more</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Comments</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="mx-n3">
                            <div class="px-3" data-simplebar style="max-height: 396px;">
                                <div class="d-flex align-items-start border-bottom py-4">
                                    <div class="flex-shrink-0 me-3">
                                        <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                            alt="avatar-3 images">
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">Marion Walker <small class="text-muted float-end">1 hr
                                                ago</small></h5>
                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting .
                                        </p>

                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                class="mdi mdi-reply"></i> Reply</a>

                                        <div class="d-flex align-items-start mt-4">
                                            <div class="flex-shrink-0 me-3">
                                                <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                    alt="avatar-4 images">
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-15 mb-1">Shanon Marvin <small
                                                        class="text-muted float-end">1 hr ago</small></h5>
                                                <p class="text-muted">It will be as simple as in fact, it will be
                                                    Occidental. To it will seem like simplified .</p>


                                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block">
                                                    <i class="mdi mdi-reply"></i> Reply
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start border-bottom py-4">
                                    <div class="flex-shrink-0 me-3">
                                        <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                            alt="avatar-5 images">
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">Janice Morgan <small class="text-muted float-end">2
                                                hrs ago</small></h5>
                                        <p class="text-muted">To achieve this, it would be necessary to have uniform
                                            pronunciation.</p>

                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                class="mdi mdi-reply"></i> Reply</a>

                                    </div>
                                </div>

                                <div class="d-flex align-items-start border-bottom py-4">
                                    <div class="flex-shrink-0 me-3">
                                        <img class="rounded-circle avatar-xs" src="{{ URL::asset('build/images/users/avatar-7.jpg') }}"
                                            alt="avatar-7 images">
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">Patrick Petty <small class="text-muted float-end">3
                                                hrs ago</small></h5>
                                        <p class="text-muted">Sed ut perspiciatis unde omnis iste natus error sit </p>
                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                class="mdi mdi-reply"></i> Reply</a>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded mx-3 mt-4">
                                <form action="#">
                                    <div class="px-2 py-1 bg-light">

                                        <div class="btn-group" role="group">
                                            <button type="button"
                                                class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                    class="ri-links-line"></i></button>
                                            <button type="button"
                                                class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                    class="ri-emotion-happy-line"></i></button>
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

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Skill</h5>
                    </div>
                    <div class="card-body">

                        <div class="row align-items-center g-0">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Photoshop </p>
                            </div>

                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 72%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    illustrator </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    HTML </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 68%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    CSS </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Javascript </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 63%" aria-valuenow="63" aria-valuemin="0" aria-valuemax="63">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Php </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-3">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>
                                    Python </p>
                            </div>
                            <div class="col-sm-9">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Members</h5>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 50px;"><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="rounded-circle avatar-sm" alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Daniel Canales</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary font-size-11">Frontend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-success align-middle"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-sm"
                                                alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Jennifer Walker</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);" class="badge bg-primary font-size-11">UI /
                                                    UX</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-warning align-middle"></i>
                                            Buzy
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                    C
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Carl Mackay</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-success align-middle"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-sm"
                                                alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Janice Cole</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary font-size-11">Frontend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-success align-middle"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                    T
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Tony Brafford</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-circle-medium font-size-18 text-secondary align-middle"></i>
                                            Offline
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Attachments</h5>
                    </div>
                    <div class="card-body pt-1">
                        <div class="border-bottom px-2 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light text-secondary rounded font-size-20">
                                            <i class="ri-folder-zip-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1"><a href="#"
                                            class="text-body text-truncate d-block">App-pages.zip</a></h5>
                                    <div class="text-muted">2.2MB</div>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <button type="button" class="btn btn-icon text-muted btn-sm font-size-18"><i
                                            class="ri-download-2-line"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom px-2 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light text-secondary rounded font-size-20">
                                            <i class="ri-file-ppt-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1"><a href="#"
                                            class="text-body text-truncate d-block">Velzon-admin.ppt</a></h5>
                                    <div class="text-muted">2.4MB</div>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <button type="button" class="btn btn-icon text-muted btn-sm font-size-18"><i
                                            class="ri-download-2-line"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom px-2 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light text-secondary rounded font-size-20">
                                            <i class="ri-folder-zip-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1"><a href="#"
                                            class="text-body text-truncate d-block">Images.zip</a></h5>
                                    <div class="text-muted">1.2MB</div>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <button type="button" class="btn btn-icon text-muted btn-sm font-size-18"><i
                                            class="ri-download-2-line"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom px-2 py-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light text-secondary rounded font-size-20">
                                            <i class="ri-image-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-15 mb-1"><a href="#"
                                            class="text-body text-truncate d-block">bg-pattern.png</a></h5>
                                    <div class="text-muted">1.1MB</div>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <button type="button" class="btn btn-icon text-muted btn-sm font-size-18"><i
                                            class="ri-download-2-line"></i></button>
                                </div>
                            </div>
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
