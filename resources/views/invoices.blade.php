@extends('layouts.master')
@section('title')
    Invoices
@endsection
@section('page-title')
    Invoices
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-hover table-nowrap align-middle mb-0">
                                <thead class="bg-light">
                                    <tr class="text-muted text-uppercase">
                                        <th style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th scope="col">Invoice ID</th>
                                        <th scope="col">Client</th>
                                        <th scope="col" style="width: 20%;">Email</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Billed</th>
                                        <th scope="col" style="width: 8%;">Status</th>
                                        <th scope="col" style="width: 12%;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check1"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2152</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Donald
                                                Risher</a>
                                        </td>
                                        <td>morbi.quis@protonmail.org</td>
                                        <td>USA</td>
                                        <td>20 Sep, 2022</td>
                                        <td>$240.00</td>
                                        <td><span class="badge badge-soft-success p-2">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check2"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2153</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Brody
                                                Holman</a>
                                        </td>
                                        <td>metus@protonmail.org</td>
                                        <td>USA</td>
                                        <td>12 Arl, 2022</td>
                                        <td>$390.00</td>
                                        <td><span class="badge badge-soft-warning p-2">Unpaid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check3"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2154</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Jolie
                                                Hood</a>
                                        </td>
                                        <td>morbi.quis@protonmail.org</td>
                                        <td>USA</td>
                                        <td>28 Mar, 2022</td>
                                        <td>$440.00</td>
                                        <td><span class="badge badge-soft-success p-2">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check4"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2155</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);"
                                                class="text-body align-middle fw-medium">Buckminster Wong</a>
                                        </td>
                                        <td>morbi.quis@protonmail.org</td>
                                        <td>USA</td>
                                        <td>23 Aug, 2022</td>
                                        <td>$520.00</td>
                                        <td><span class="badge badge-soft-success p-2">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check5"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2156</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);"
                                                class="text-body align-middle fw-medium">Howard Lyons</a>
                                        </td>
                                        <td>neque.sed.dictum@icloud.org</td>
                                        <td>USA</td>
                                        <td>18 Sep, 2022</td>
                                        <td>$480.00</td>
                                        <td><span class="badge badge-soft-info p-2">Refund</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check6"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2157</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);"
                                                class="text-body align-middle fw-medium">Howard Oneal</a>
                                        </td>
                                        <td>metus@protonmail.org</td>
                                        <td>USA</td>
                                        <td>12 Feb, 2022</td>
                                        <td>$550.00</td>
                                        <td><span class="badge badge-soft-success p-2">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check7"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2158</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Jena
                                                Hall</a>
                                        </td>
                                        <td>morbi.quis@protonmail.org</td>
                                        <td>USA</td>
                                        <td>30 Nov, 2022</td>
                                        <td>$170.00</td>
                                        <td><span class="badge badge-soft-danger p-2">Cancel</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check8"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2159</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Paki
                                                Edwards</a>
                                        </td>
                                        <td>dictum.phasellus.in@hotmail.org</td>
                                        <td>USA</td>
                                        <td>23 Sep, 2022</td>
                                        <td>$720.00</td>
                                        <td><span class="badge badge-soft-success p-2">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check2"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2153</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Brody
                                                Holman</a>
                                        </td>
                                        <td>metus@protonmail.org</td>
                                        <td>USA</td>
                                        <td>12 Arl, 2022</td>
                                        <td>$390.00</td>
                                        <td><span class="badge badge-soft-warning p-2">Unpaid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check3"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2154</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);" class="text-body align-middle fw-medium">Jolie
                                                Hood</a>
                                        </td>
                                        <td>morbi.quis@protonmail.org</td>
                                        <td>USA</td>
                                        <td>28 Mar, 2022</td>
                                        <td>$440.00</td>
                                        <td><span class="badge badge-soft-success p-2">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check4"
                                                    value="option">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-0">Lec-2155</p>
                                        </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle me-2">
                                            <a href="#javascript: void(0);"
                                                class="text-body align-middle fw-medium">Buckminster Wong</a>
                                        </td>
                                        <td>morbi.quis@protonmail.org</td>
                                        <td>USA</td>
                                        <td>23 Aug, 2022</td>
                                        <td>$520.00</td>
                                        <td><span class="badge badge-soft-success p-2">Paid</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical align-middle font-size-16"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-eye-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            View</button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-pencil-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Edit</button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="mdi mdi-file-download-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" href="#">
                                                            <i
                                                                class="mdi mdi-trash-can-outline font-size-16 align-middle me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-4 gy-3">
            <div class="col-md-5">
                <p class="mb-0 text-muted">Showing <b>1</b> to <b>5</b> of <b>10</b> results</p>
            </div>
            <div class="col-sm-auto ms-auto">
                <nav aria-label="...">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item" aria-current="page">
                            <span class="page-link">2</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
