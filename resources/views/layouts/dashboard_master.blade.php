<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>



    <link rel="stylesheet" href="https://opensource.propeller.in/components/typography/css/typography.css">
    <link rel="stylesheet" href="https://opensource.propeller.in/components/textfield/css/textfield.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://opensource.propeller.in/components/icons/css/google-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />


    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboard_assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/bootstrap.min.css') }}">



    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/font-awesome.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/feathericon.min.css') }}">

    <!-- Datatables CSS -->
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/morris/morris.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/style.css') }}">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">


            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="{{ asset('dashboard_assets/img/logo.png') }}" alt="Logo">
                </a>
                <a href="index.html" class="logo logo-small">
                    <img src="{{ asset('dashboard_assets/img/logo-small.png') }}" alt="Logo" width="30"
                        height="30">
                </a>
            </div>


            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>

            <div class="top-nav-search">
                <form method="GET" action="{{route('search')}}">
                    <input type="text" class="form-control" placeholder="Search here" id="searchs" name="search">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>


            <script type="text/javascript">
                var path = "{{ route('autocomplete') }}";

                $('#searchs').typeahead({
                    source: function(query, process) {
                        return $.get(path, {
                            query: query
                        }, function(data) {
                            return process(data);
                            console.log(data);
                        });
                    }
                });
            </script>


            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>



            <ul class="nav user-menu">


                {{-- <li class="nav-item dropdown noti-dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="{{ asset('dashboard_assets/img/doctors/doctor-thumb-01.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Dr.Milon
                                                        Talakdur</span> Schedule <span class="noti-title">her
                                                        appointment</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="{{ asset('dashboard_assets/img/patients/patient1.jpg') }}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Mim Akter</span> has
                                                    booked her appointment to <span class="noti-title">Dr. Sadiya</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li> --}}

                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img  ">
                            @if (auth()->user()->profile_photo)
                                <img class="rounded-circle "
                                    src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                    height="40" width="40" alt="user">
                            @else
                                <img class="rounded-circle "
                                    src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" width="45">
                            @endif

                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">


                            </div>
                            <div class="user-text">
                                <h6>{{ auth()->user()->name }}
                                </h6>
                                <p class="text-muted mb-0">{{ auth()->user()->role }}</p>
                            </div>
                        </div>

                        <a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                <i data-feather="log-out"></i>
                                <span>Log out</span></a>
                        </form>

                    </div>
                </li>


            </ul>


        </div>
        <!-- /Header -->

        @if (auth()->user()->role == 'vendor')

            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="menu-title">
                                <span>Main</span>
                            </li>
                            <li class="{{ Request::is('vendor.dashboard') ? 'active' : '' }}">
                                <a href="{{ route('vendor.dashboard') }}"><i class="fe fe-home {{ Request::is('vendor.dashboard') ? 'active' : '' }}"></i> <span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="{{route('vendor.patient.appointment.list')}}"><i class="fe fe-layout"></i>
                                    <span>Appointments</span></a>
                            </li>

                            <li class="submenu">
                                <a href="{{url('user/role')}}"><i class="fe fe-user-plus"></i> <span> Doctor</span> <span
                                    class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <a href="{{route('doctor.regi')}}"></i> <span>-- Register Doctor</span></a>
                                    <a href="{{route('vendor.doctor.list')}}"></i> <span>-- Doctors List</span></a>
                                    <a href="{{route('doctor.create')}}"></i> <span>-- Add New Doctor</span></a>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('vendor.patient.list')}}"><i class="fe fe-user"></i> <span>Patients</span></a>
                            </li>

                            <li>
                                <a href="{{route('vendor.patient.reviews.list')}}"><i class="fe fe-star-o"></i> <span>Reviews</span></a>
                            </li>
                            <li>
                                <a href="{{route('vendor.tranjection.list')}}"><i class="fe fe-activity"></i>
                                    <span>Transactions</span></a>
                            </li>



                            <li>
                                <a href="{{ route('profile.edit') }}"><i class="fe fe-user-plus"></i> <span>Profile</span></a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>

@elseif (auth()->user()->role == 'appointment_assistance')
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ Request::is('Appointment.Assistance.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('Appointment.Assistance.dashboard') }}"><i class="fe fe-home {{ Request::is('Appointment.Assistance.dashboard') ? 'active' : '' }}"></i> <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{route('Appointment.Assistance.Appointment')}}"><i class="fe fe-layout"></i>
                        <span>Appointments</span></a>
                </li>
                <li>
                    <a href="{{route('Appointment.Assistance.doctor')}}"><i class="fe fe-user-plus"></i> <span>Doctors</span></a>
                </li>

                <li>
                    <a href="{{route('Appointment.Assistance.patient')}}"><i class="fe fe-user"></i> <span>Patients</span></a>
                </li>

                <li>
                    <a href="{{route('Appointment.Assistance.Review')}}"><i class="fe fe-star-o"></i> <span>Reviews</span></a>
                </li>




                <li>
                    <a href="{{ route('profile.edit') }}"><i class="fe fe-user-plus"></i> <span>Profile</span></a>
                </li>


            </ul>
        </div>
    </div>
</div>

        @else


            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title">
								<span>Main</span>
							</li>
							<li class=" {{ Request::is('dashboard') ? 'active' : '' }}">
								<a href="{{route('dashboard')}}"><i class="fe fe-home  {{ Request::is('dashboard') ? 'active' : '' }}"></i> <span>Dashboard</span></a>
							</li>
							<li class="{{ Request::is('Appointments') ? 'active' : '' }}">
								<a href="{{route('admin.appointment_list')}}"><i class="fe fe-layout"></i> <span>Appointments</span></a>
							</li>
							<li class="{{ Request::is('specialitie') ? 'active' : '' }}">
                                <a href="{{ route('specialitie') }}"><i class="fe fe-users "></i>
                                    <span>Specialities</span></a>
							</li>
							<li>
								<a href="{{route('user.role')}}"><i class="fe fe-user-plus"></i> <span>Vendors</span></a>
							</li>
							<li>
                                <a href="{{ route('admin.patient_list') }}"><i class="fe fe-user"></i>
                                    <span>Patients</span></a>
							</li>
                            <li class="submenu">
								 <a href="{{ url('user/role') }}"><i class="fe fe-users"></i> <span> Users</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
                                    <a href="{{route('user.role')}}"></i> <span>-- All User</span></a>
                                    <a href="{{route('add.user')}}"></i> <span>-- Add New User</span></a>
								</ul>
							</li>
							<li>
								<a href="{{route('admin.patient.reviews')}}"><i class="fe fe-star-o"></i> <span>Reviews</span></a>
							</li>
							<li>
								<a href="{{ route('admin.tranjection') }}"><i class="fe fe-activity"></i> <span>Transactions</span></a>
							</li>

							<li class="submenu">

                                <a href="{{ route('about.index') }}">
                                    <i class="fe fe-document"></i>
                                    <span>About</span>
                                    <span class="menu-arrow"></span>
                                </a>
								<ul style="display: none;">
									<li><a href="{{ route('about.index') }}">
                                        <i class="fe fe-document"></i>
                                        <span> Add About</span></a></li>
                                        <li><a href="{{ route('about.show')}}"> <i class="fe fe-document"></i>About Show</a></li>
								</ul>



							</li>

							<li>
								<a href="{{ route('profile.edit') }}"><i class="fe fe-user-plus"></i> <span>Profile</span></a>
							</li>



						</ul>
					</div>
                </div>
            </div>
        @endif


        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">



                @yield('contant')
            </div>




            <!-- Bootstrap Core JS -->
            <script src="{{ asset('dashboard_assets/js/popper.min.js') }}"></script>
            <script src="{{ asset('dashboard_assets/js/bootstrap.min.js') }}"></script>

            <!-- Slimscroll JS -->
            <script src="{{ asset('dashboard_assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

            <script src="{{ asset('dashboard_assets/plugins/raphael/raphael.min.js') }}"></script>
            <script src="{{ asset('dashboard_assets/plugins/morris/morris.min.js') }}"></script>
            <script src="{{ asset('dashboard_assets/js/chart.morris.js') }}"></script>

            <!-- Custom JS -->
            <script src="{{ asset('dashboard_assets/js/script.js') }}"></script>
            {{-- sweetalert --}}
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>
            <!-- Datatables JS -->

            <script src="{{ asset('dashboard_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('dashboard_assets/plugins/datatables/datatables.min.js') }}"></script>
            <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

            @yield('footer_scprit')
</body>


</html>
