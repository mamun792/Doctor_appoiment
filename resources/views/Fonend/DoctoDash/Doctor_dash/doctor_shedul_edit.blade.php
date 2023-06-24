@extends('layouts.doctor_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Schedule Timings</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Schedule Timings</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                @if (auth()->user()->profile_photo)
                                    <img class="rounded-circle "
                                        src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                        height="120" width="120" alt="user">
                                @else
                                    <img class="rounded-circle "
                                        src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" height="80"
                                        width="120" height="120">
                                @endif
                                <div class="profile-det-info">
                                    <h3>{{ auth()->user()->name }}</h3>

                                    <div class="patient-details">
                                        <h5 class="mb-0">
                                            {{ auth()->user()->email }}

                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    <li class="active">
                                        <a href="{{ route('doctor.dash') }}">
                                            <i class="fas fa-columns"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctor.patient.list') }}">
                                            <i class="fas fa-user-injured"></i>
                                            <span>My Patients</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doctor.time.schedules') }}">
                                            <i class="fas fa-hourglass-start"></i>
                                            <span>Schedule Timings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('doctor.patient.invoices.list')}}">
                                            <i class="fas fa-file-invoice"></i>
                                            <span>Invoices</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('doctor.patient.review')}}">
                                            <i class="fas fa-star"></i>
                                            <span>Reviews</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctorDetailes.index') }}">
                                            <i class="fas fa-user-cog "></i>
                                            <span>Profile Settings</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctor.change.password') }}">
                                            <i class="fas fa-lock"></i>
                                            <span>Change Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <span>.</span>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Log out</span></a>
                                        </form>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /Profile Sidebar -->

                </div>
                <!-- bvfv -->
                {{-- @yield('contents') --}}




                <div class="col-md-7 col-lg-8 col-xl-9">
                    @if (session('upd'))
                        <div class="alert alert-success">
                            {{ session('upd') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Edit Slot</h4>



                            <form method="POST" action="{{ route('doctor.time.schedules.changes', $indi->id) }}">
                                @csrf

                                <div class="row form-row">

                                    {{-- <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="text" class="form-control" name="sart_time"
                                                value="{{ $indi->sart_time }}">
                                            @error('sart_time')
                                                <h6 class="text-danger">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="text" class="form-control" name="end_time"
                                                value="{{ $indi->end_time }}">
                                            @error('end_time')
                                                <h6 class="text-danger">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input type="text" class="form-control timepicker" name="start_time" value="{{ $indi->start_time }}">
                                            @error('start_time')
                                                <h6 class="text-danger">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input type="text" class="form-control timepicker" name="end_time" value="{{ $indi->end_time }}">
                                            @error('end_time')
                                                <h6 class="text-danger">{{ $message }}</h6>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Day</label>
                                            <input type="text" class="form-control" name="day"
                                                value="{{ $indi->day }}">
                                        </div>
                                    </div>





                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_scpritss')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include timepicker library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize timepicker on the elements with "timepicker" class
            $('.timepicker').timepicker();
        });
    </script>
@endsection
