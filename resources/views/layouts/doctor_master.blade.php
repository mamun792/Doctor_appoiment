<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Include CSS file for typography -->
    <link rel="stylesheet" href="https://opensource.propeller.in/components/typography/css/typography.css">

    <!-- Include CSS file for textfield -->
    <link rel="stylesheet" href="https://opensource.propeller.in/components/textfield/css/textfield.css">

    <!-- Include CSS file for Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Include CSS file for Google Icons -->
    <link rel="stylesheet" href="https://opensource.propeller.in/components/icons/css/google-icons.css">

    <!-- Include CSS file for datetimepicker -->
    <link rel="stylesheet" href="https://opensource.propeller.in/components/datetimepicker/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="https://opensource.propeller.in/components/datetimepicker/css/pmd-datetimepicker.css">

    <!-- Favicons -->
    <link href="{{ asset('frontend_assets/img/favicon.png') }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/select2/css/select2.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">

<!-- Include CSS file for Bootstrap Timepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

 <!-- Include CSS file for jQuery Timepicker -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

 <!-- Include Font Awesome CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>



</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg header-nav">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:void(0);">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="index-2.html" class="navbar-brand logo">

                        <h1 class="text-success">DLPCMS</h1>
                    </a>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="index-2.html" class="menu-logo">
                            <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        <li>
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Doctors <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="{{ route('doctor.dash') }}">Doctor Dashboard</a></li>

                                <li><a href="{{ route('doctor.time.schedules') }}">Schedule Timing</a></li>
                                <li><a href="{{ route('doctor.patient.list') }}">Patients List</a></li>


                                <li><a href="{{ route('doctor.patient.invoices.list') }}">Invoices</a></li>
                                <li><a href="{{ route('doctorDetailes.index') }}">Profile Settings</a></li>
                                <li><a href="{{ route('doctor.patient.review') }}">Reviews</a></li>

                            </ul>
                        </li>
                        <li class="has-submenu active">
                            <a href="#">Patients <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">





                                <li><a href="{{ route('patient.dashboard') }}">Patient Dashboard</a></li>
                                <li><a href="{{ route('favourit.details') }}">Favourites</a></li>


                                <li><a href="{{ route('profile.change.password') }}">Change Password</a></li>
                            </ul>
                        </li>




                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    <li class="nav-item contact-item">
                        <div class="header-contact-img">
                            <i class="far fa-hospital"></i>
                        </div>
                        <div class="header-contact-detail">
                            <p class="contact-header">Contact</p>
                            <p class="contact-info-header"> 01745010925</p>
                        </div>
                    </li>

                    <!-- User Menu -->
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            @if (auth()->user()->profile_photo)
                            <img class="rounded-circle "
                                src="{{asset('uploads/profile_photo/')}}/{{auth()->user()->profile_photo}}" height="45"
                                width="45" alt="user">
                            @else
                            <img class="rounded-circle " src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                height="45" width="45">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    @if (auth()->user()->profile_photo)
                                    <img class="rounded"
                                        src="{{asset('uploads/profile_photo/')}}/{{auth()->user()->profile_photo}}"
                                        height="120" width="120" alt="user">
                                    @else
                                    <img class="rounded-circle "
                                        src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" height="80"
                                        width="45" height="45">
                                    @endif
                                </div>
                                <div class="user-text">
                                    <h6>
                                        {{auth()->user()->name}}
                                    </h6>
                                    <p class="text-muted mb-0">{{auth()->user()->role}}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('doctor.dash') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{route('doctorDetailes.index')}}">Profile Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Log out</span></a>
                            </form>

                        </div>
                    </li>


                </ul>
            </nav>
        </header>



        @yield('contents')
        <!-- Footer -->
        <footer class="footer">

            <!-- Footer Top -->
            <div class="footer-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">

                                    <h1 class="text-white lg-100">DLPCMS</h1>
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <div class="social-icon">
                                        <ul>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i class="fab fa-dribbble"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">For Patients</h2>
                                <ul>
                                    <li><a href="search.html"><i class="fas fa-angle-double-right"></i> Search
                                            for
                                            Doctors</a></li>
                                    <li><a href="{{ route('login') }}"><i class="fas fa-angle-double-right"></i>
                                            Login</a></li>
                                    <li><a href="{{ route('register') }}"><i class="fas fa-angle-double-right"></i>
                                            Register</a>
                                    </li>
                                    <li><a href="booking.html"><i class="fas fa-angle-double-right"></i>
                                            Booking</a>
                                    </li>
                                    <li><a href="patient-dashboard.html"><i class="fas fa-angle-double-right"></i>
                                            Patient Dashboard</a></li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">For Doctors</h2>
                                <ul>
                                    <li><a href="appointments.html"><i class="fas fa-angle-double-right"></i>
                                            Appointments</a></li>
                                    <li><a href="chat.html"><i class="fas fa-angle-double-right"></i> Chat</a>
                                    </li>
                                    <li><a href="{{ route('login') }}"><i class="fas fa-angle-double-right"></i>
                                            Login</a></li>
                                    <li><a href="#"><i class="fas fa-angle-double-right"></i>
                                            Register</a></li>
                                    <li><a href="doctor-dashboard.html"><i class="fas fa-angle-double-right"></i>
                                            Doctor Dashboard</a></li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                        <div class="col-lg-3 col-md-6">

                            <!-- Footer Widget -->
                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact Us</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <span><i class="fas fa-map-marker-alt"></i></span>
                                        <p> 3556 Dhaka, Senpara Parbata,<br> Mirpur -10, CA 94108 </p>
                                    </div>
                                    <p>
                                        <i class="fas fa-phone-alt"></i>
                                        0174501036
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-envelope"></i>
                                        dlpcm@.com
                                    </p>
                                </div>
                            </div>
                            <!-- /Footer Widget -->

                        </div>

                    </div>
                </div>
            </div>
            <!-- /Footer Top -->


            <div class="footer-bottom">
                <div class="container-fluid">

                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0"><a href="http://127.0.0.1:8000/">Copyright
                                            2022--{{ date('Y') }} {{ env('APP_NAME') }}©</a></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <!-- Copyright Menu -->
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="http://127.0.0.1:8000/">Terms and Conditions</a></li>
                                        <li><a href="privacy-policy.html">Policy</a></li>
                                    </ul>
                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->

                </div>
            </div>


        </footer>
        <!-- /Footer -->
    </div>

    <script src="{{ asset('frontend_assets/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src=" {{ asset('frontend_assets/js/popper.min.js') }}"></script>
    <script src=" {{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>

    <!-- Sticky Sidebar JS -->
    <script src=" {{ asset('frontend_assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src=" {{ asset('frontend_assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('frontend_assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('frontend_assets/js/script.js') }}assets/"></script>

 {{-- sweetalert --}}
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>
 <!-- Datatables JS -->

 <script src="{{ asset('frontend_assets/plugins/datatables/datatables.min.css') }}"></script>
 <script src="{{ asset('frontend_assets/plugins/datatables/datatables.min.js') }}"></script>
 <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>


    @yield('footer_scprits')



</body>


</html>
