@extends('layouts.doctor_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Dashboard</h2>
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
                                        <a href="{{ route('doctor.patient.invoices.list') }}">
                                            <i class="fas fa-file-invoice"></i>
                                            <span>Invoices</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doctor.patient.review') }}">
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


                </div>



                <div class="col-md-7 col-lg-8 col-xl-9">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card dash-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar1">
                                                    <div class="circle-graph1" data-percent="75">
                                                        <img src="{{ asset('frontend_assets/img/icon-01.png') }}"
                                                            class="img-fluid" alt="patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6 class="icon-title"><i class="fas fa-users fa-3x"></i> Total Patient
                                                    </h6>
                                                    <h3>{{ $totalPatients }}</h3>
                                                    <p class="text-muted">Till Today</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar2">
                                                    <div class="circle-graph2" data-percent="65">
                                                        <img src="assets/img/icon-02.png" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6 class="icon-title"><i class="fas fa-user fa-3x"></i> Today Patient
                                                    </h6>
                                                    <h3>{{ $todayPatients }}</h3>
                                                    <p class="text-muted">{{ $todayDate }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="50">
                                                        <img src="assets/img/icon-03.png" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6 class="icon-title"><i class="fas fa-calendar-alt fa-3x"></i>
                                                        Appointments</h6>
                                                    <h3>{{ $todayAppointmentss }}</h3>
                                                    <p class="text-muted">{{ $todayDate }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    @if ($count == '0')
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4">Patient Appoinment</h4>
                                <div class="appointment-tab">


                                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#upcoming-appointments"
                                                data-toggle="tab">Total Patient</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#today-appointments" data-toggle="tab">Today</a>
                                        </li>
                                    </ul>




                                    <div class="tab-content">


                                        <div class="tab-pane show active" id="upcoming-appointments">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive " style="max-height: 300px; overflow-y: auto;">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Patient Name</th>
                                                                    <th>Appt Date</th>

                                                                    <th>Type</th>
                                                                    <th class="text-center">Paid Amount</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($patient as $patients)
                                                                    <tr>
                                                                        <td>
                                                                            <h2 class="table-avatar">
                                                                                @if ($patients->relationInvoiceList->profile_photo)
                                                                                    <img class="rounded-circle "
                                                                                        src="{{ asset('uploads/profile_photo/') }}/{{ $patients->relationInvoiceList->profile_photo }}"
                                                                                        height="40" width="40"
                                                                                        alt="user">
                                                                                @else
                                                                                    <img class="rounded-circle"
                                                                                        src="{{ Avatar::create($patients->relationInvoiceList->name)->toBase64() }}"
                                                                                        width="45"
                                                                                        alt="{{ $patients->relationInvoiceList->name }}">
                                                                                @endif
                                                                                <a
                                                                                    href="{{ route('profile.details', $patients->relationInvoiceList->id) }}">{{ $patients->relationInvoiceList->name }}
                                                                                    <span>{{ $patients->relationInvoiceList->p_id }}</span></a>
                                                                            </h2>

                                                                        </td>
                                                                        <td>{{ $patients->appioment_date }} <span
                                                                                class="d-block text-info">
                                                                                {{ $patients->appioment_time }}</span></td>



                                                                        <td>
                                                                            @php
                                                                            $invoiceCount = App\Models\Invoice_Deatiels::where('patient_id', $patients->patient_id)->count();
                                                                        @endphp
                                                                        @if ($invoiceCount > 2)
                                                                            Old Patient
                                                                        @else
                                                                            New Patient
                                                                        @endif

                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $patients->relationInvoice->s_total }}

                                                                        </td>
                                                                        <td class="text-right">
                                                                            <div class="table-action">
                                                                                <a href="{{route('doctor.patient.prescription.view',$patients->relationInvoiceList->id)}}"
                                                                                    class="btn btn-sm bg-info-light">
                                                                                    <i class="far fa-eye"></i> View

                                                                                </a>

                                                                                <a href="{{ route('doctor.patient.prescription', $patients->patient_id) }}"
                                                                                    class="btn btn-sm bg-success-light">
                                                                                    <i class="fas fa-plus"></i> Add
                                                                                    prescription
                                                                                </a>








                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Upcoming Appointment Tab -->

                                        <!-- Today Appointment Tab -->

                                        <div class="tab-pane" id="today-appointments">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Patient Name</th>
                                                                    <th>Appt Date</th>

                                                                    <th>Type</th>
                                                                    <th class="text-center">Paid Amount</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($todayAppointments as $appointment)
                                                                    <tr>
                                                                        <td>
                                                                            <h2 class="table-avatar">


                                                                                @if ($appointment->relationInvoiceList->profile_photo)
                                                                                    <img class="rounded-circle "
                                                                                        src="{{ asset('uploads/profile_photo/') }}/{{ $appointment->relationInvoiceList->profile_photo }}"
                                                                                        height="40" width="40"
                                                                                        alt="user">
                                                                                @else
                                                                                    <img class="rounded-circle"
                                                                                        src="{{ Avatar::create($appointment->relationInvoiceList->name)->toBase64() }}"
                                                                                        width="45"
                                                                                        alt="{{ $appointment->relationInvoiceList->name }}">
                                                                                @endif
                                                                                <a
                                                                                    href="{{ route('profile.details', $appointment->relationInvoiceList->id) }}">{{ $appointment->relationInvoiceList->name }}
                                                                                    <span>{{ $appointment->relationInvoiceList->p_id }}</span></a>



                                                                            </h2>
                                                                        </td>
                                                                        <td>{{ $appointment->appioment_date }} <span
                                                                                class="d-block text-info">{{ $appointment->appt_time }}</span>
                                                                        </td>


                                                                        <td>
                                                                            @php
                                                                                $invoiceCount = App\Models\Invoice_Deatiels::where('patient_id', $appointment->patient_id)->count();
                                                                            @endphp
                                                                            @if ($invoiceCount == 2)
                                                                                Old Patient
                                                                            @else
                                                                                New Patient
                                                                            @endif


                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $appointment->paid_amount }}</td>
                                                                        <td class="text-right">

                                                                            <a href="{{route('doctor.patient.prescription.view',$appointment->relationInvoiceList->id)}}"
                                                                                class="btn btn-sm bg-info-light">
                                                                                <i class="far fa-eye"></i> View

                                                                            </a>






                                                                <a href="{{ route('doctor.patient.prescription', $appointment->patient_id) }}"
                                                                    class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-plus"></i>Add prescription
                                                                </a>


                                                    </div>
                                                    </td>
                                                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- /Today Appointment Tab -->

    </div>

    </div>
    </div>
    </div>
    @endif
    </div>


    </div>
    </div>

    </div>
@endsection
