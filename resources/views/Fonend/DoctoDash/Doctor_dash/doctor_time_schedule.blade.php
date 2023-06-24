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
    ->

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
                                    <li>
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
                                    <li class="active">
                                        <a href="{{ route('doctor.time.schedules') }}">
                                            <i class="fas fa-hourglass-start"></i>
                                            <span>Schedule Timings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doctor.patient.invoices.list') }}">
                                            <i class="fas fa-file-invoice"></i>
                                            <span>Invoices</span>
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


                <div class="col-md-7 col-lg-8 col-xl-9">


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('suc'))
                                        <div class="alert alert-success">
                                            {{ session('suc') }}
                                        </div>
                                    @endif

                                    @if (session('det'))
                                        <div class="alert alert-danger">
                                            {{ session('det') }}
                                        </div>
                                    @endif


                                    @if (session('suc_add'))
                                        <div class="alert alert-success">
                                            {{ session('suc_add') }}
                                        </div>
                                    @endif

                                    <h4 class="card-title">Schedule Timings</h4>
                                    <div class="profile-box">
                                        <form action="{{ route('doctor.time.schedules.duartion') }}" method="POST">
                                            @csrf
                                            <div class="hours-info">
                                                <div class="row form-row hours-cont">
                                                    <div class="col-12 col-md-10">
                                                        <div class="row form-row">
                                                            <div class="row">

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Timing Slot Duration


                                                                        </label>
                                                                        <select class="select form-control" name="step">
                                                                            <option>-</option>
                                                                            <option>15</option>
                                                                            <option selected="selected">30</option>
                                                                            <option>45 </option>
                                                                            <option>60</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Select Day</label>
                                                                        <select class="form-control" name="day">
                                                                            <option>-</option>
                                                                            <option selected>Saturday</option>
                                                                            <option>Sunday</option>
                                                                            <option>Monday</option>
                                                                            <option>Thursday</option>
                                                                            <option>Wednesday</option>
                                                                            <option>Tuesday</option>
                                                                            <option>Friday</option>
                                                                        </select>


                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <h2 class="">Avavial time</h2>
                                                            </div>




                                                            @foreach ($doctor_table as $doctor_tables)
                                                                <input type="hidden" name="doctor_id" class="form-control"
                                                                    value="{{ $doctor_tables->id }}">
                                                            @endforeach
                                                            <div class="col-12 col-md-12">
                                                                <div class="row form-row">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Start Time</label>
                                                                                <div class="input-group">
                                                                                    <input type="text"
                                                                                        class="form-control timepicker"
                                                                                        name="sart_time">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text"><i
                                                                                                class="fas fa-clock"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                                @error('sart_time')
                                                                                    <h6 class="text-danger">
                                                                                        {{ $message }}</h6>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label>End Time</label>
                                                                                <div class="input-group">
                                                                                    <input type="text"
                                                                                        class="form-control timepicker"
                                                                                        name="end_time">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text"><i
                                                                                                class="fas fa-clock"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                                @error('end_time')
                                                                                    <h6 class="text-danger">
                                                                                        {{ $message }}</h6>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>

                                                    <div class="submit-section text-center">
                                                        <button type="submit" class="btn btn-primary submit-btn">Save
                                                        </button>
                                                    </div>

                                        </form>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card schedule-widget mb-0">

                                                <!-- Schedule Header -->
                                                <div class="schedule-header">

                                                    <!-- Schedule Nav -->
                                                    <div class="schedule-nav">
                                                        <ul class="nav nav-tabs nav-justified">
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#slot_sunday">Sunday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab"
                                                                    href="#slot_monday">Monday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#slot_tuesday">Tuesday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#slot_wednesday">Wednesday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#slot_thursday">Thursday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#slot_friday">Friday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#slot_saturday">Saturday</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /Schedule Nav -->

                                                </div>
                                                <!-- /Schedule Header -->

                                                <!-- Schedule Content -->
                                                <div class="tab-content schedule-cont">

                                                    <!-- Sunday Slot -->
                                                    <div id="slot_sunday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            @if (Schema::hasColumn('time_schedules', 'day'))
                                                                @foreach ($time as $times)
                                                                    @if ($times->day == 'Sunday')
                                                                        <div class="doc-times">
                                                                            <div class="doc-slot-list">
                                                                                {{ $times->sart_time }} -
                                                                                {{ $times->end_time }}
                                                                                <a class="text-white"
                                                                                    href="{{ route('doctor.time.schedules.edit', $times->id) }}"><i
                                                                                        class="fa fa-edit mr-1 text-white"></i>Edit</a>
                                                                                <button
                                                                                    value="{{ route('doctor.delete.schedules', $times->id) }}"
                                                                                    class="btn btn-sm btn bg-#d9534f; time_shedul_delete">
                                                                                    <i
                                                                                        class="fa fa-times text-white">Remove</i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </h4>
                                                    </div>
                                                    <!-- /Sunday Slot -->

                                                    <!-- Monday Slot -->

                                                    <div id="slot_monday" class="tab-pane fade show active">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            @if (Schema::hasColumn('time_schedules', 'day'))
                                                                @foreach ($time as $times)
                                                                    @if ($times->day == 'Monday')
                                                                        <div class="doc-times">
                                                                            <div class="doc-slot-list">
                                                                                {{ $times->sart_time }} -
                                                                                {{ $times->end_time }}
                                                                                <a class="text-white"
                                                                                    href="{{ route('doctor.time.schedules.edit', $times->id) }}"><i
                                                                                        class="fa fa-edit mr-1 text-white"></i>Edit</a>
                                                                                <button
                                                                                    value="{{ route('doctor.delete.schedules', $times->id) }}"
                                                                                    class="btn btn-sm btn bg-#d9534f; time_shedul_delete">
                                                                                    <i
                                                                                        class="fa fa-times text-white">Remove</i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </h4>
                                                    </div>
                                                    <!-- /Monday Slot -->

                                                    <!-- Tuesday Slot -->
                                                    <div id="slot_tuesday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            @if (Schema::hasColumn('time_schedules', 'day'))
                                                                @foreach ($time as $times)
                                                                    @if ($times->day == 'Tuesday')
                                                                        <div class="doc-times">
                                                                            <div class="doc-slot-list">
                                                                                {{ $times->sart_time }} -
                                                                                {{ $times->end_time }}
                                                                                <a class="text-white"
                                                                                    href="{{ route('doctor.time.schedules.edit', $times->id) }}"><i
                                                                                        class="fa fa-edit mr-1 text-white"></i>Edit</a>
                                                                                <button
                                                                                    value="{{ route('doctor.delete.schedules', $times->id) }}"
                                                                                    class="btn btn-sm btn bg-#d9534f; time_shedul_delete">
                                                                                    <i
                                                                                        class="fa fa-times text-white">Remove</i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </h4>
                                                    </div>

                                                    <!-- /Tuesday Slot -->

                                                    <!-- Wednesday Slot -->

                                                    <div id="slot_wednesday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            @if (Schema::hasColumn('time_schedules', 'day'))
                                                                @foreach ($time as $times)
                                                                    @if ($times->day == 'Wednesday')
                                                                        <div class="doc-times">
                                                                            <div class="doc-slot-list">
                                                                                {{ $times->sart_time }} -
                                                                                {{ $times->end_time }}
                                                                                <a class="text-white"
                                                                                    href="{{ route('doctor.time.schedules.edit', $times->id) }}"><i
                                                                                        class="fa fa-edit mr-1 text-white"></i>Edit</a>
                                                                                <button
                                                                                    value="{{ route('doctor.delete.schedules', $times->id) }}"
                                                                                    class="btn btn-sm btn bg-#d9534f; time_shedul_delete">
                                                                                    <i
                                                                                        class="fa fa-times text-white">Remove</i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </h4>
                                                    </div>

                                                    <!-- /Wednesday Slot -->

                                                    <!-- Thursday Slot -->
                                                    <div id="slot_thursday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            @if (Schema::hasColumn('time_schedules', 'day'))
                                                                @foreach ($time as $times)
                                                                    @if ($times->day == 'Thursday')
                                                                        <div class="doc-times">
                                                                            <div class="doc-slot-list">
                                                                                {{ $times->sart_time }} -
                                                                                {{ $times->end_time }}
                                                                                <a class="text-white"
                                                                                    href="{{ route('doctor.time.schedules.edit', $times->id) }}"><i
                                                                                        class="fa fa-edit mr-1 text-white"></i>Edit</a>
                                                                                <button
                                                                                    value="{{ route('doctor.delete.schedules', $times->id) }}"
                                                                                    class="btn btn-sm btn bg-#d9534f; time_shedul_delete">
                                                                                    <i
                                                                                        class="fa fa-times text-white">Remove</i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </h4>
                                                    </div>

                                                    <!-- /Thursday Slot -->

                                                    <!-- Friday Slot -->
                                                    <div id="slot_friday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            @if (Schema::hasColumn('time_schedules', 'day'))
                                                                @foreach ($time as $times)
                                                                    @if ($times->day == 'Friday')
                                                                        <div class="doc-times">
                                                                            <div class="doc-slot-list">
                                                                                {{ $times->sart_time }} -
                                                                                {{ $times->end_time }}
                                                                                <a class="text-white"
                                                                                    href="{{ route('doctor.time.schedules.edit', $times->id) }}"><i
                                                                                        class="fa fa-edit mr-1 text-white"></i>Edit</a>
                                                                                <button
                                                                                    value="{{ route('doctor.delete.schedules', $times->id) }}"
                                                                                    class="btn btn-sm btn bg-#d9534f; time_shedul_delete">
                                                                                    <i
                                                                                        class="fa fa-times text-white">Remove</i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </h4>
                                                    </div>

                                                    <!-- /Friday Slot -->

                                                    <!-- Saturday Slot -->
                                                    <div id="slot_saturday" class="tab-pane fade">
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            @if (Schema::hasColumn('time_schedules', 'day'))
                                                                @foreach ($time as $times)
                                                                    @if ($times->day == 'Saturday')
                                                                        <div class="doc-times">
                                                                            <div class="doc-slot-list">
                                                                                {{ $times->sart_time }} -
                                                                                {{ $times->end_time }}
                                                                                <a class="text-white"
                                                                                    href="{{ route('doctor.time.schedules.edit', $times->id) }}"><i
                                                                                        class="fa fa-edit mr-1 text-white"></i>Edit</a>
                                                                                <button
                                                                                    value="{{ route('doctor.delete.schedules', $times->id) }}"
                                                                                    class="btn btn-sm btn bg-#d9534f; time_shedul_delete">
                                                                                    <i
                                                                                        class="fa fa-times text-white">Remove</i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </h4>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Add Time Slot Modal -->

@section('footer_scprits')
    <!-- Include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include jQuery Timepicker JS library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.timepicker').timepicker({
                // Set the desired time format here
                interval: 1, // Specify the interval between each time option
                minTime: '00:00', // Set the minimum selectable time
                maxTime: '11:59 PM', // Set the maximum selectable time
                dynamic: false, // Set to true for dynamic updates of the timepicker options
                dropdown: true, // Show the dropdown to select time
                scrollbar: true // Enable the scrollbar for scrolling through time options
            });
        });



        $(document).ready(function() {

            $('.time_shedul_delete').click(function() {

                var link = $(this).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                })
            });

        });
    </script>
@endsection
