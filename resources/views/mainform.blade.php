<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Forever Medspa</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ env('APP_URL').'/landing_page/assets/img/favicons/apple-touch-icon.png' }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ env('APP_URL').'/landing_page/assets/img/favicons/favicon-32x32.png' }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ env('APP_URL').'/landing_page/assets/img/favicons/favicon-16x16.png' }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{  env('APP_URL').'/landing_page/assets/img/favicons/favicon.ico' }}">
    <link rel="manifest" href=" {{ env('APP_URL').'/landing_page/assets/img/favicons/mstile-150x150.png' }}">
    <meta name="msapplication-TileImage" content="{{  env('APP_URL').'/landing_page/assets/img/favicons/mstile-150x150.png' }}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{env('APP_URL').'/landing_page/assets/css/theme.css'}}" rel="stylesheet" />
    <style>
        .our-belief {
            padding-top: 4.5rem !important;
            padding-bottom: 3.5rem !important;
        }

        .py-5 {
            padding-top: 2rem !important;
            padding-bottom: 1rem !important;
        }

        h5,
        h2 {
            color: #ffffff !important;
        }

        .white {
            color: #ffffff !important;
        }

        .orange {
            color: #FCA52A !important;
        }

        .btn-outline-primary:active {
            background-color: #FCA52A !important;
            border-color: #FCA52A !important;
        }

        .border-colour {
            border-color: #EEEEEE !important;
        }

        @media (max-width: 768px) {
            .form-data {
                width: 80% !important;
                /* Adjust width for smaller screens */
                margin-left: 35px !important;
                /* Adjust margin-left for smaller screens */
                margin-bottom: 0% !important;
            }

            .book-now {
                width: 100%;
                margin: 5px;
            }

            .text-size {
                text-align: center;
            }

            .img-left {
                margin-left: 10%;
            }
        }

        .form-data {
            width: 40%;
            margin-left: 75px;
            margin-bottom: 380px;
        }

        .btn-orange {
            background-color: #FFFEFE !important;
            border-color: #FCA52A !important;
        }

        .btn-orange:hover {
            background-color: #FCA52A !important;
            color: #FFFEFE !important;
            border-color: #FFFEFE !important;
        }

        .text-size {
            font-size: x-large;

        }

        .contact-us {
            text-align: center !important;
            margin-block: auto !important;
        }

        .about {
            margin-top: 0%;
        }

        .error-message {
            color: red;
            margin-left: 15px;
        }

        .alert-success {
            background-color: unset !important;
            border-color: transparent !important;
            color: green;
        }

        .form-livedoc-control:focus {
            border: #FCA52A !important;
        }
    </style>

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block"
            data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="index.html"> <img id="logo"
                        src="{{ asset('/landing_page/assets/img/gallery/forever-white-1.png') }}" alt="Logo"
                        width="118" class="logo-space"></a>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">

                    </ul><a id="contactButton"
                        class="btn btn-sm btn-outline-primary rounded-pill order-1 order-lg-0 ms-lg-4 white border-colour"
                        href="#!">Contact Us</a>
                </div>
            </div>
        </nav>
        <section class="py-sm-8 pb-0" id="home">
            <div class="bg-holder bg-size"
                style="background-image: url('{{ asset('/landing_page/assets/img/gallery/orange.png') }}');
           background-position: top center;
           background-size: cover;">
            </div>
            <!--/.bg-holder-->

            <!--/.bg-holder-->

            <div class="container">
                <div class="row min-vh-xl-100 min-vh-xxl-25">

                    <!-- First Column -->
                    <div class="col-md-6 col-xl-6 col-xxl-6 text-md-start text-center py-6" style="color: #ffff;">
                        <h1 class="fw-light font-base fs-6 fs-xxl-7" style="color: #ffff;">We're
                            <strong>determined</strong> for
                            <br />your&nbsp;<strong>better life.</strong>
                        </h1>
                        <p class="fs-1 mb-5">You can get the care you need 24/7 – be it online or in person. You will be
                            treated by caring specialist doctors. </p>
                    </div>

                    <!-- Second Column - Form -->
                    <div class="col-md-6 col-xl-6 col-xxl-6 z-index-2 p-4 form-data"
                        style="background-color: #FFFF; border-radius: 10px; border: 1px solid #EEEEEE;">
                        <form id="myForm" action="{{ route('submit-form') }}" method="post"
                            onsubmit="return submitForm(event)">
                            @csrf
                            <div class="mb-3">
                                <label class="visually-hidden" for="inputfName">First Name</label>
                                <input class="form-control form-livedoc-control" type="text" id="fname"
                                    name="first_name" maxlength="50" placeholder="First Name">
                                <span id="fnameError" class="error-message" style="display: none;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="visually-hidden" for="inputlName">Last Name</label>
                                <input class="form-control form-livedoc-control" type="text" id="lname"
                                    name="last_name" maxlength="50" placeholder="Last Name">
                                <span id="lnameError" class="error-message" style="display: none;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label visually-hidden" for="inputEmail">Email</label>
                                <input class="form-control form-livedoc-control" type="email" id="email"
                                    name="email" placeholder="Email">
                                <span id="emailError" class="error-message" style="display: none;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="visually-hidden" for="inputPhone">Phone</label>
                                <input class="form-control form-livedoc-control" type="tel" id="phone"
                                    name="phone" placeholder="Phone Number">
                            </div>
                            {{-- <div class="mb-3">
                                <label class="visually-hidden" for="inputPhone">Phone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select class="form-select form-livedoc-control" id="countryCode" name="countryCode">
                                            <!-- Replace the option values and labels with actual country codes -->
                                            <option value="+1">+1 (USA)</option>
                                            <option value="+44">+44 (UK)</option>
                                            <option value="+91">+91 (UK)</option>
                                            <!-- Add more country codes as needed -->
                                        </select>
                                    </div>
                                    <input class="form-control form-livedoc-control" type="tel" id="phone" name="phone" placeholder="Phone Number">
                                </div>
                            </div> --}}
                            <span id="phoneError" class="error-message" style="display: none;"></span>
                            <div class="mb-3">
                                <label class="visually-hidden" for="inputMessage">Your Message</label>
                                <textarea class="form-control form-livedoc-control" id="message" name="message"
                                    placeholder="Your Message (minimum 20 words)" rows="4"></textarea>
                                <span id="messageError" class="error-message" style="display: none;"></span>
                            </div>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" value="1"
                                    id="receiveTextMessages" name="receiveTextMessages">
                                <label class="form-check-label" for="receiveTextMessages">
                                    I agree to receive text messages from Forever Medspa Wellness Center for appointment
                                    reminders and exclusive offers.
                                </label>
                            </div>
                            <!--  <div class="mb-3">-->
                            <!--  <label class="visually-hidden" for="inputMobile">Mobile</label>-->
                            <!--  <input class="form-control form-livedoc-control" type="tel" id="mobile" name="mobile" placeholder="Mobile (optional)">-->
                            <!--  <span id="mobileError" class="error-message" style="display: none;"></span>-->
                            <!--</div>-->
                            <input type="hidden" id="status_id" name="status_id" value="{{ $dynamicStatusId }}">

                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary rounded-pill orange btn-orange" type="submit"
                                        id="save-button">Submit</button>
                                </div>
                            </div>
                        </form>
                        @if ($message = Session::get('imperialheaders_success'))
                            <div class="alert alert-success alert-block">
                                {{-- <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button> --}}
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div id="success-message" style="display: none;"></div>
                        <div id="error-message" style="display: none;"></div>
                    </div>
                </div>
            </div>

        </section>
        <!-- ============================================-->
        <section class="py-xl-4 about" id="about">

            <div class="container">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="bg-holder bg-size"
                            style="background-image:url('{{ asset('/landing_page/assets/img/gallery/about-us.png') }}');background-position:top center;background-size:contain;">
                        </div>
                        <!--/.bg-holder-->

                        <h1 class="text-center orange">ABOUT US</h1>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <section class="py-5">
            <div class="bg-holder bg-size"
                style="background-image:url('{{ asset('/landing_page/assets/img/gallery/about-bg.png') }}');background-position:top center;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-lg-1 mb-5 mb-lg-0"><img class="fit-cover rounded-circle w-100"
                            src="{{ asset('/landing_page/assets/img/gallery/deepak.png') }}" alt="..." /></div>
                    <div class="col-md-6 text-center text-md-start">
                        <!-- <h2 class="fw-bold mb-4">Meet Dr. Deepak Keswani<br class="d-none d-sm-block" />
          </h2> -->
                        <p class="orange">Dr Deepak Keswani is a very calm, compassionate person who has served in the
                            field of Medicine and Aesthetics. He finished his Internal Medicine Residency from
                            Interfaith Medical Center, Brooklyn NY in 2007. Since then he has been Board Certified in
                            the field of Internal Medicine. He has provided his services in Hospitals in PA and Ohio and
                            currently actively provides services in NJ with CarePoint health system and has trained 500
                            residents pursuing medical training. He started his carrier in the field of Aesthetics since
                            2016 and Forever Medspa & Wellness Center was started in 2018. He has successfully performed
                            more than 5000 aesthetic procedures in this clinic. He strongly believes aesthetic care is
                            not one size fit all but rather unique and as unique as an individual. </p>
                        <div class="py-3">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-secondary our-belief" style="background-color: #FCA52A !important;">
            <div class="bg-holder"
                style="background-image:url(assets/img/gallery/bg-eye-care.png);background-position:center;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row align-items-center">
                    <!-- <div class="col-md-5 col-xxl-6"><img class="img-fluid" src="assets/img/gallery/eye-care.png" alt="..." />
        </div> -->
                    <div class="col-md-6 col-xxl-6 text-center text-md-start">
                        <h2 class="fw-bold text-light mb-4 mt-4 mt-lg-0" style="line-height: 1.6em; font-size: 28px;">
                            Our Belief
                            Aesthetic care of an individual is as unique as an individual.</h2>
                        <p class="text-light">
                            <class="d-none d-sm-block" />We use top-notch technology tackling
                            problem areas from both spa & medical perspective</p>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-primary rounded-pill orange book-now btn-orange" href="#!"
                            role="button">Book Now</a>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-primary rounded-pill orange book-now btn-orange" href="#!"
                            role="button">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section> begin ============================-->
        <section class="py-5" id="departments">

            <div class="container">
                <div class="row">
                    <div class="col-12 py-3">
                        <!--<div class="bg-holder bg-size"-->
                        <!--  style="background-image:url(assets/img/gallery/bg-departments.png);background-position:top center;background-size:contain;">-->
                        <!--</div>-->
                        <!--/.bg-holder-->

                        <h1 class="text-center orange">Products We Use</h1>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <section class="py-0">

            <div class="container">
                <div class="row py-5 align-items-center justify-content-center justify-content-lg-evenly">
                    <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box text-center"><a class="text-decoration-none" href="#!"><img
                                        class="mb-3 department-icon"
                                        src="{{ asset('/landing_page/assets/img/icons/logooo2.fw_.png') }}"
                                        alt="Logo" style="width: 100px; height: 100px;" />
                                </a></div>
                        </div>
                    </div>
                    <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box text-center"><a class="text-decoration-none" href="#!"><img
                                        class="mb-3 department-icon"
                                        src="{{ asset('/landing_page/assets/img/icons/logooo3.fw_.png') }}"
                                        alt="Logo" style="width: 100px; height: 100px;" />
                                </a></div>
                        </div>
                    </div>
                    <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box text-center"><a class="text-decoration-none" href="#!"><img
                                        class="mb-3 department-icon"
                                        src="{{ asset('/landing_page/assets/img/icons/logooo5.fw_.png') }}"
                                        alt="Logo" style="width: 100px; height: 100px;" />
                                </a></div>
                        </div>
                    </div>
                    <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box text-center"><a class="text-decoration-none" href="#!"><img
                                        class="mb-3 department-icon"
                                        src="{{ asset('/landing_page/assets/img/icons/logooo6.fw_.png') }}"
                                        alt="Logo" style="width: 100px; height: 100px;" />
                                </a></div>
                        </div>
                    </div>
                    <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box text-center"><a class="text-decoration-none" href="#!"><img
                                        class="mb-3 department-icon"
                                        src="{{ asset('/landing_page/assets/img/icons/logooo7.fw_.png') }}"
                                        alt="Logo" style="width: 100px; height: 100px;" />
                                </a></div>
                        </div>
                    </div>
                    <div class="col-auto col-md-4 col-lg-auto text-xl-start">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box text-center"><a class="text-decoration-none" href="#!"><img
                                        class="mb-3 department-icon"
                                        src="{{ asset('/landing_page/assets/img/icons/logooo11.fw_.png') }}"
                                        alt="Logo" style="width: 100px; height: 100px;" />
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-8" style="background-color: #FCA52A;">
            <!-- <div class="bg-holder bg-size"
        style="background-image:url(assets/img/gallery/people-bg-1.png);background-position:center;background-size:cover;">
      </div> -->
            <!--/.bg-holder-->

            <div class="container">
                <div class="row align-items-center offset-sm-1">
                    <div class="carousel slide" id="carouselPeople" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <div class="row h-100">
                                    <div class="col-sm-3 text-center"><img
                                            src="{{ asset('/landing_page/assets/img/gallery/people-who-loves.png') }}"
                                            width="100" alt="" />
                                        <h5 class="mt-3 fw-medium text-secondary white">Tarina D</h5>
                                        <p class="fw-normal mb-0 white">Forever MedSpa Customer</p>
                                    </div>
                                    <div class="col-sm-9 text-center text-sm-start pt-3 pt-sm-0">
                                        <h2>Testimonials</h2>
                                        <div class="my-2 white"><i class="fas fa-star me-2"></i><i
                                                class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i
                                                class="fas fa-star-half-alt me-2"></i><i class="far fa-star"></i>
                                        </div>
                                        <p class="white">Scheduled an aqua facial with Madeline. What a great
                                            experience! Beautiful place, relaxing environment, and amazing facial. My
                                            face has never felt so clean and hydrated!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <div class="row h-100">
                                    <div class="col-sm-3 text-center"><img
                                            src="{{ asset('/landing_page/assets/img/gallery/people-who-loves.png') }}"
                                            width="100" alt="" />
                                        <h5 class="mt-3 fw-medium text-secondary white">Anjali Vaswani</h5>
                                        <p class="fw-normal mb-0 white">Forever MedSpa Customer</p>
                                    </div>
                                    <div class="col-sm-9 text-center text-sm-start pt-3 pt-sm-0">
                                        <h2>Testimonials</h2>
                                        <div class="my-2 white"><i class="fas fa-star me-2"></i><i
                                                class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i
                                                class="fas fa-star-half-alt me-2"></i><i class="far fa-star"></i>
                                        </div>
                                        <p class="white">This is my new favorite place, I had never got my lips done I
                                            was super scared and Dr K and his staff guided me through it all, he
                                            explained every step while he was doing it and I love my new lips! See you
                                            guys soon</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row h-100">
                                    <div class="col-sm-3 text-center"><img
                                            src="{{ asset('/landing_page/assets/img/gallery/people-who-loves.png') }}"
                                            width="100" alt="" />
                                        <h5 class="mt-3 fw-medium text-secondary white">Jen Cocola</h5>
                                        <p class="fw-normal mb-0 white">Forever MedSpa Customer</p>
                                    </div>
                                    <div class="col-sm-9 text-center text-sm-start pt-3 pt-sm-0">
                                        <h2>Testimonials</h2>
                                        <div class="my-2 white"><i class="fas fa-star me-2"></i><i
                                                class="fas fa-star me-2"></i><i class="fas fa-star me-2"></i><i
                                                class="fas fa-star-half-alt me-2"></i><i class="far fa-star"></i>
                                        </div>
                                        <p class="white">This is my new favorite place, I had never got my lips done I
                                            was super scared and Dr K and his staff guided me through it all, he
                                            explained every step while he was doing it and I love my new lips! See you
                                            guys soon</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="position-relative z-index-2 mt-5">
                                <ol class="carousel-indicators">
                                    <li class="active" data-bs-target="#carouselPeople" data-bs-slide-to="0"></li>
                                    <li data-bs-target="#carouselPeople" data-bs-slide-to="1"></li>
                                    <li data-bs-target="#carouselPeople" data-bs-slide-to="2"> </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="py-0  ">
            <!-- <div class="bg-holder opacity-25"
        style="background-image:url(assets/img/gallery/dot-bg.png);background-position:top left;margin-top:-3.125rem;background-size:auto;">
      </div> -->
            <!--/.bg-holder-->

            <div class="container">
                <div class="row py-4">
                    <div class="col-12 col-sm-12 col-lg-6 mb-4 order-0 order-sm-0"><a
                            class="text-decoration-none img-left" href="#"><img
                                src="{{ asset('/landing_page/assets/img/gallery/forever-color.fw_.png') }}"
                                height="auto" width="auto" alt="" /></a>
                        <p class="text-light my-4 orange text-size">The world's most trusted <br />company.</p>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-6 mb-4 contact-us">
                        <h5 class="lh-lg fw-bold mb-4 text-light font-sans-serif orange">Contact Us</h5>
                        <ul class="list-unstyled mb-md-8 mb-lg-0">
                            <li class="lh-lg">
                                <i class="fas fa-map-marker-alt"></i>
                                <a class="footer-link orange" href="#!">468 Paterson Ave East Rutherford NJ,
                                    07073</a>
                            </li>

                            <li class="lh-lg">
                                <i class="fas fa-envelope"></i>
                                <a class="footer-link orange"
                                    href="mailto:info@forevermedspanj.com">info@forevermedspanj.com</a>
                            </li>
                            <li class="lh-lg">
                                <i class="fas fa-phone"></i>
                                <a class="footer-link orange" href="tel:(201) 340-4809">(201) 340-4809</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>




            <section class="py-0 white">

                <div class="container ">
                    <div class="row justify-content-md-between justify-content-evenly py-4">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                            <p class="fs--1 my-2 fw-bold text-200 orange">All Rights Reserved. © 2023 <a
                                    href="#" class="orange">FOREVER MEDSPA</a> Design By : <a
                                    href="https://www.thetemz.com/" class="orange">TEMZ Solution Pvt.Ltd</a></p>
                        </div>
                        <div class="col-12 col-sm-8 col-md-6">
                        </div>
                    </div>
                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->


        </section>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ env('APP_URL').'/landing_page/vendors/@popperjs/popper.min.js' }}"></script>
    <script src="{{ env('APP_URL').'/landing_page/vendors/bootstrap/bootstrap.min.js' }}"></script>
    <script src="{{ env('APP_URL').'/landing_page/vendors/is/is.min.js' }}"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ env('APP_URL').'/landing_page/vendors/fontawesome/all.min.js' }}"></script>
    <script src="{{ env('APP_URL').'/landing_page/assets/js/theme.js' }}"></script>
    <script src="jsfile.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="gulp/form-validator.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#receiveTextMessages').change(function() {
                if ($(this).is(':checked')) {
                    $('#save-button').prop('disabled', false);
                } else {
                    $('#save-button').prop('disabled', true);
                }
            });
        });

        function submitForm(event) {
            event.preventDefault(); // Prevents the default form submission behavior

            if ($('#receiveTextMessages').is(':checked')) { // Check if the checkbox is checked
                if (validateForm()) {
                    // Submit the form without AJAX (standard form submission)
                    document.getElementById("myForm").submit();
                }
            } else {
                alert("Please agree to receive text messages before submitting the form.");
            }
        }

        function validateForm() {
            // Add your form validation logic here
            return true; // Return true if form is valid, false otherwise
        }


        function validateForm() {
            let isValid = true;

            // Validation logic for first Name
            const fname = $('#fname').val();
            var regex = /^[a-zA-Z\s]+$/; // Regular expression to allow only letters and spaces
            if (!regex.test(fname)) {
                $("#fnameError").html("Please enter a valid First name (only letters and spaces allowed).").slideDown();
                isValid = false;

                setTimeout(function() {
                    $("#fnameError").empty().slideUp();
                }, 5000);
            } else if (fname.length === 0 || fname.length > 50) {
                $("#fnameError").html("First Name is required and should be less than 50 characters.").slideDown();
                isValid = false;

                setTimeout(function() {
                    $("#fnameError").empty().slideUp();
                }, 5000);
            } else {
                $("#fnameError").empty();
            }
            // Validation logic for Name
            const lname = $('#lname').val();
            var regex = /^[a-zA-Z\s]+$/; // Regular expression to allow only letters and spaces
            if (!regex.test(lname)) {
                $("#lnameError").html("Please enter a valid Last name (only letters and spaces allowed).").slideDown();
                isValid = false;

                setTimeout(function() {
                    $("#lnameError").empty().slideUp();
                }, 5000);
            } else if (lname.length === 0 || lname.length > 50) {
                $("#lnameError").html("Last Name is required and should be less than 50 characters.").slideDown();
                isValid = false;

                setTimeout(function() {
                    $("#lnameError").empty().slideUp();
                }, 5000);
            } else {
                $("#lnameError").empty();
            }

            // Validation logic for Email
            const email = $('#email').val();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                $("#emailError").html("Please enter a valid email address.").slideDown();
                isValid = false;

                setTimeout(function() {
                    $("#emailError").empty().slideUp();
                }, 5000);
            } else {
                $("#emailError").empty();
            }

            // Validation logic for Phone
            const phone = $('#phone').val();
            const phoneRegex = /^(9|8|7|6)\d{9}$/; // Matches a 10-digit number starting with 9, 8, or 6
            if (!phoneRegex.test(phone)) {
                $("#phoneError").html("Please enter a valid phone number").slideDown();
                isValid = false;

                setTimeout(function() {
                    $("#phoneError").empty().slideUp();
                }, 5000);
            } else {
                $("#phoneError").empty();
            }

            // Validation logic for Text Message
            const message = $('#message').val();
            const wordCount = message.split(/\s+/).filter(function(word) {
                return word.length > 0;
            }).length;

            if (wordCount < 2) {
                $("#messageError").html("Text message should contain at least 20 words.").slideDown();
                isValid = false;

                setTimeout(function() {
                    $("#messageError").empty().slideUp();
                }, 5000);
            } else {
                $("#messageError").empty();
            }

            // Validation logic for Mobile (optional)
            const mobile = $('#mobile').val();
            // Add your optional mobile validation logic here if needed

            return isValid;
        }
    </script>
    <script>
        // Add this script to send a request to store visitor information
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/store-visitor')
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        });
    </script>
    <script>
        (function() {

            var input = document.getElementById('phone');
            var pattern = /^[6-9][0-9]{0,9}$/;
            var value = input.value;
            !pattern.test(value) && (input.value = value = '');
            input.addEventListener('input', function() {
                var currentValue = this.value;
                if (currentValue && !pattern.test(currentValue)) this.value = value;
                else value = currentValue;
            });
        })();
    </script>
    <script>
        (function() {

            var input = document.getElementById('mobile');
            var pattern = /^[6-9][0-9]{0,9}$/;
            var value = input.value;
            !pattern.test(value) && (input.value = value = '');
            input.addEventListener('input', function() {
                var currentValue = this.value;
                if (currentValue && !pattern.test(currentValue)) this.value = value;
                else value = currentValue;
            });
        })();
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.getElementById('logo');

            window.addEventListener('scroll', function() {
                // Change the image source based on scroll position
                if (window.scrollY > 100) {
                    logo.src = "{{ asset('/landing_page/assets/img/gallery/forever-color.fw_.png') }}";
                } else {
                    logo.src = "{{ asset('/landing_page/assets/img/gallery/forever-white-1.png') }}"
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const contactButton = document.getElementById('contactButton');

            window.addEventListener('scroll', function() {
                // Change the button styles based on scroll position
                if (window.scrollY > 100) {
                    contactButton.style.color = '#EEEEEE';
                    contactButton.style.backgroundColor = '#FCA52A';
                    contactButton.classList.remove('white'); // Remove white text class if needed
                } else {
                    contactButton.style.borderColor = ''; // Revert to default border color
                    contactButton.style.backgroundColor = ''; // Revert to default background color
                    contactButton.classList.add('white'); // Add white text class if needed
                }
            });
        });
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap"
        rel="stylesheet">
</body>

</html>
