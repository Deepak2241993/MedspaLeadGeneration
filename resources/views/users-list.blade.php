@extends('layouts.master')
@section('title')
    Users List
@endsection
@section('page-title')
    Users List
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-inline float-md-start mb-3">
                                    <div class="search-box me-2">
                                        <div class="position-relative">
                                            <input type="text" class="form-control border" placeholder="Search...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 float-end">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addUserModal">
                                        <i class="mdi mdi-plus me-1"></i> Add User
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="table-responsive mb-4">
                            <table class="table table-hover table-nowrap align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck">
                                                <label class="form-check-label" for="contacusercheck"></label>
                                            </div>
                                        </th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Projects</th>
                                        <th scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                                <label class="form-check-label" for="contacusercheck1"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#" class="text-body">Simon Ryles</a>
                                        </td>
                                        <td>Full Stack Developer</td>
                                        <td>SimonRyles@Tocly.com</td>
                                        <td>125</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck2">
                                                <label class="form-check-label" for="contacusercheck2"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#" class="text-body">Marion Walker</a>
                                        </td>
                                        <td>Frontend Developer</td>
                                        <td>MarionWalker@Tocly.com</td>
                                        <td>523</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck3">
                                                <label class="form-check-label" for="contacusercheck3"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="avatar-xs d-inline-block me-2">
                                                <div class="avatar-title bg-primary rounded-circle">
                                                    <i class="mdi mdi-account-circle"></i>
                                                </div>
                                            </div>
                                            <a href="#" class="text-body">Frederick White</a>
                                        </td>
                                        <td>UI/UX Designer</td>
                                        <td>FrederickWhite@Tocly.com</td>
                                        <td>234</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck4">
                                                <label class="form-check-label" for="contacusercheck4"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#" class="text-body">Shanon Marvin</a>
                                        </td>
                                        <td>Backend Developer</td>
                                        <td>ShanonMarvin@Tocly.com</td>
                                        <td>412</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck5">
                                                <label class="form-check-label" for="contacusercheck5"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="avatar-xs d-inline-block me-2">
                                                <div class="avatar-title bg-primary rounded-circle">
                                                    <i class="mdi mdi-account-circle"></i>
                                                </div>
                                            </div>
                                            <a href="#" class="text-body">Mark Jones</a>
                                        </td>
                                        <td>Frontend Developer</td>
                                        <td>MarkJones@Tocly.com</td>
                                        <td>852</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Remove</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck6">
                                                <label class="form-check-label" for="contacusercheck6"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#" class="text-body">Janice Morgan</a>
                                        </td>
                                        <td>Backend Developer</td>
                                        <td>JaniceMorgan@Tocly.com</td>
                                        <td>657</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck7">
                                                <label class="form-check-label" for="contacusercheck7"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#" class="text-body">Patrick Petty</a>
                                        </td>
                                        <td>UI/UX Designer</td>
                                        <td>PatrickPetty@Tocly.com</td>
                                        <td>756</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck8">
                                                <label class="form-check-label" for="contacusercheck8"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#" class="text-body">Marilyn Horton</a>
                                        </td>
                                        <td>Backend Developer</td>
                                        <td>MarilynHorton@Tocly.com</td>
                                        <td>425</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck9">
                                                <label class="form-check-label" for="contacusercheck9"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#" class="text-body">Neal Womack</a>
                                        </td>
                                        <td>Full Stack Developer</td>
                                        <td>NealWomack@Tocly.com</td>
                                        <td>524</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck10">
                                                <label class="form-check-label" for="contacusercheck10"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="avatar-xs d-inline-block me-2">
                                                <div class="avatar-title bg-primary rounded-circle">
                                                    <i class="mdi mdi-account-circle"></i>
                                                </div>
                                            </div>
                                            <a href="#" class="text-body">Steven Williams</a>
                                        </td>
                                        <td>Frontend Developer</td>
                                        <td>Steven Williams@Tocly.com</td>
                                        <td>762</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-primary"><i
                                                            class="ri-pencil-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0);" class="px-2 text-danger"><i
                                                            class="ri-delete-bin-line font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item dropdown">
                                                    <a class="dropdown-toggle font-size-18 px-2" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="ri-more-2-fill"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div>
                                    <p class="mb-sm-0">Showing 1 to 10 of 12 entries</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-sm-end">
                                    <ul class="pagination mb-sm-0">
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- end modalheader -->
                    <div class="modal-body p-4">
                        <div>
                            <div class="mb-3">
                                <label for="addcontact-name-input" class="form-label">Name</label>
                                <input type="text" class="form-control" id="addcontact-name-input"
                                    placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <label for="addcontact-designation-input" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="addcontact-designation-input"
                                    placeholder="Enter Designation">
                            </div>
                            <div class="mb-3">
                                <label for="addcontact-file-input" class="form-label">User Image</label>
                                <input type="file" class="form-control" id="addcontact-file-input">
                            </div>

                            <div class="mb-3">
                                <label for="addcontact-email-input" class="form-label">Email</label>
                                <input type="email" class="form-control" id="addcontact-email-input"
                                    placeholder="Enter Email">
                            </div>
                        </div>
                    </div>
                    <!-- end modalbody -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary w-sm">Add</button>
                    </div>
                    <!-- end modalfooter -->
                </div><!-- end content -->
            </div>
        </div>
        <!-- end modal -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
