@extends('layouts.master')
@section('title')
    Invoice Detail
@endsection
@section('page-title')
    Invoice Detail
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Invoice #DS0204 <span
                                    class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                            <div class="mb-4">
                                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="logo" height="28" />
                            </div>
                            <div class="text-muted">
                                <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                                <p class="mb-1"><i class="mdi mdi-email-outline me-1"></i> xyz@987.com</p>
                                <p><i class="mdi mdi-phone-outline me-1"></i> 012-345-6789</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                    <h5 class="font-size-15 mb-1">Steven Deese</h5>
                                    <p class="mb-0">4068 Post Avenue Newfolden, MN 56738</p>
                                    <p class="mb-0">stevendeese@armyspy.com</p>
                                    <p class="mb-0">001-234-5678</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p class="mb-0">#DZ0112</p>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p class="mb-0">12 Feb, 2023</p>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="font-size-15 mb-1">Order No:</h5>
                                        <p class="mb-0">#1123456</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div>
                            <h5 class="font-size-15 mb-3">Order Summary</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1">Black Strap A012</h5>
                                                    <p class="text-muted mb-0">Watch, Black</p>
                                                </div>
                                            </td>
                                            <td>$ 245.50</td>
                                            <td>1</td>
                                            <td class="text-end">$ 245.50</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row">02</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1">Stainless Steel S010</h5>
                                                    <p class="text-muted mb-0">Watch, Gold</p>
                                                </div>
                                            </td>
                                            <td>$ 245.50</td>
                                            <td>2</td>
                                            <td class="text-end">$491.00</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                            <td class="text-end">$732.50</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Discount :</th>
                                            <td class="border-0 text-end">- $25.50</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Shipping Charge :</th>
                                            <td class="border-0 text-end">$20.00</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Tax</th>
                                            <td class="border-0 text-end">$12.00</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0 fw-semibold">$739.00</h4>
                                            </td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                            class="fa fa-print"></i></a>
                                    <a href="#" class="btn btn-primary w-md">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
