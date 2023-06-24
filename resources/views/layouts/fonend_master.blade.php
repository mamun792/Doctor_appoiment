<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Favicons -->
    <link type="image/x-icon" href="{{ asset('frontend_assets/img/favicon.png') }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/fontawesome/css/fontawesome.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/fontawesome/css/all.min.css') }} ">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg header-nav">
                <div class="navbar-header">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                        <a href="index-2.html" class="navbar-brand logo">
                            {{-- <img src="assets/img/logo.png" class="img-fluid" alt="Logo"> --}}
                            <h1 class="text-success">DLPCMS</h1>
                        </a>
                    </div>

                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="index-2.html" class="menu-logo">
                            {{-- <img src="{{ asset('frontend_assets/img/logo.png') }}" class="img-fluid" alt="Logo"> --}}
                            <h1 class="text-blue p-5">DLPCMS</h1>
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        <li class="active">
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#">Doctors <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="{{ route('doctor.dash') }}">Doctor Dashboard</a></li>

                                <li><a href="{{ route('doctor.time.schedules') }}">Schedule Timing</a></li>
                                <li><a href="{{ route('doctor.patient.list') }}">Patients List</a></li>


                                <li><a href="{{ route('doctor.patient.invoices.list') }}">Invoices</a></li>

                                <li><a href="{{ route('doctor.patient.review') }}">Reviews</a></li>

                            </ul>
                        </li>
                        <li class="has-submenu ">
                            <a href="#">Patients <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">





                                <li><a href="{{ route('patient.dashboard') }}">Patient Dashboard</a></li>
                                <li><a href="{{ route('favourit.details') }}">Favourites</a></li>


                                <li><a href="{{ route('profile.change.password') }}">Change Password</a></li>
                            </ul>
                        </li>




                        <li class="has-submenu">
                            <a href="{{ route('dashboard') }}">Admin <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                {{-- <a href="{{ route('dashboard') }}" target="_blank">Admin</a> --}}
                                <ul class="submenu">
                                    <li> <a href="{{ route('dashboard') }}" target="_blank">Admin</a></li>
                                    <li><a href="{{ route('vendor.dashboard') }}" target="_blank">Vendore</a>
                                    </li>
                                    <li><a href="{{ route('Appointment.Assistance.dashboard') }}"
                                            target="_blank">Report generator</a>
                                    </li>
                                </ul>
                            </ul>
                        </li>
                        <li class="login-link">
                            <a href="{{ route('login') }}">Login / Signup</a>
                        </li>
                    </ul>
                </div>
                @if (auth()->check())



                    <div class="header-contact-detail">
                        <p class="contact-header"><i class="far fa-hospital p-2">Contact </i></p>
                        <p class="contact-info-header"> 017450103632</p>
                    </div>

                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            @if (auth()->user()->profile_photo)
                                <img class="rounded-circle "
                                    src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                    height="45" width="45" alt="user">
                            @else
                                <img class="rounded-circle "
                                    src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" height="45"
                                    width="45">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    @if (auth()->user()->profile_photo)
                                        <img class="rounded"
                                            src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                            height="120" width="120" alt="user">
                                    @else
                                        <img class="rounded-circle "
                                            src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                            height="80" width="45" height="45">
                                    @endif
                                </div>
                                <div class="user-text">
                                    <h6>
                                        {{ auth()->user()->name }}
                                    </h6>
                                    <p class="text-muted mb-0">{{ auth()->user()->role }}</p>
                                </div>
                            </div>
                            @if (auth()->user()->role == 'patient')
                                <a class="dropdown-item" href="{{ route('patient.dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                this.closest('form').submit();">
                                        <i data-feather="log-out"></i>
                                        <span>Log out</span></a>
                                </form>
                            @else
                                <a class="dropdown-item" href="{{ route('doctor.dash') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('doctorDetailes.index') }}">Profile
                                    Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Log out</span></a>
                                </form>
                            @endif


                        </div>
                    </li>
                @else
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item contact-item">
                            <div class="header-contact-img">
                                <i class="far fa-hospital"></i>
                            </div>
                            <div class="header-contact-detail">
                                <p class="contact-header">Contact</p>
                                <p class="contact-info-header"> 017450103632</p>
                            </div>
                        </li>
                        <li class="nav-item">

                        <li class="register-btn">
                            <a href="{{ route('register') }}" class="reg-btn"><i
                                    class="feather-user "></i>Register</a>
                        </li>
                        <li class="register-btn">
                            <a class="btn btn-primary log-btn" href="{{ route('login') }}"><i
                                    class="feather-lock">Login
                                </i> </a>
                        </li>
                        </li>
                    </ul>
                @endif

            </nav>
        </header>


        @yield('content')


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
                                    {{-- <img src="{{ asset('frontend_assets/img/footer-logo.png') }}" alt="logo"> --}}
                                    <h1 class="text-white lg-100">DLPCMS</h1>
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
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
                                                <a href="#" target="_blank"><i
                                                        class="fab fa-linkedin-in"></i></a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank"><i
                                                        class="fab fa-instagram"></i></a>
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
                                    <li><a href="search.html"><i class="fas fa-angle-double-right"></i> Search for
                                            Doctors</a></li>
                                    <li><a href="{{ route('login') }}"><i class="fas fa-angle-double-right"></i>
                                            Login</a></li>

                                    <li><a href="booking.html"><i class="fas fa-angle-double-right"></i> Booking</a>
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
                                    <li><a href="chat.html"><i class="fas fa-angle-double-right"></i> Chat</a></li>
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

            <!-- Footer Bottom -->
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


                </div>
            </div>
            <!-- /Footer Bottom -->

        </footer>
        <!-- /Footer -->

    </div>
    <!-- /Main Wrapper -->


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
        < /> <
        script src = "{{ asset('frontend_assets/js/jquery-3.6.0.min.js') }}" >
    </script>


    <script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js') }}"></script>





    <script src="{{ asset('frontend_assets/js/script.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('frontend_assets/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>

    <!-- Slick JS -->
    <script src="{{ asset('frontend_assets/js/slick.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('frontend_assets/js/script.js') }}  "></script>

    @yield('footer_scpritss')
</body>

</html>
