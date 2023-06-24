@extends('layouts.doctor_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Invoices</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Invoices</h2>
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


@if ($invoice_c=='0')
<div class="col-md-7 col-lg-8 col-xl-9">
<h4 class="d-flex justify-content-center mt-5">No Invoice </h4>
</div>
@else
<div class="col-md-7 col-lg-8 col-xl-9">
    <div class="card card-table">
        <div class="card-body">

            <!-- Invoice Table -->
            <div class="table-responsive">
                <table class="table table-hover table-center mb-0">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Patient</th>
                            <th>Amount</th>
                            <th>Paid On</th>
                            <th>Paid Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctor_id as $doctor_ids)
                            <tr>


                                <td>
                                    <a href="invoice-view.html">{{ $doctor_ids->relationInvoiceList->p_id }}</a>
                                </td>
                                <td>
                                    <h2 class="table-avatar">

                                        @if ($doctor_ids->relationInvoiceList->profile_photo)
                                            <img class="rounded-circle "
                                                src="{{ asset('uploads/profile_photo/') }}/{{ $doctor_ids->relationInvoiceList->profile_photo }}"
                                                height="40" width="40" alt="user">
                                        @else
                                            <img class="rounded-circle"
                                                src="{{ Avatar::create($doctor_ids->relationInvoiceList->name)->toBase64() }}"
                                                width="45"
                                                alt="{{ $doctor_ids->relationInvoiceList->name }}">
                                        @endif


                                        <a href="patient-profile.html">
                                            {{ $doctor_ids->relationInvoiceList->name }}
                                            <span>{{ $doctor_ids->relationInvoice->invoices_on }}
                                            </span></a>
                                    </h2>
                                </td>
                                <td>{{ $doctor_ids->relationInvoice->s_total }}</td>
                                <td>{{ $doctor_ids->relationInvoice->created_at }}</td>
                                <td>{{ $doctor_ids->relationInvoice->payment_status }}</td>

                                <td class="text-right">
                                    <div class="table-action">
                                        <a href="{{ route('patient.invoices', $doctor_ids->relationInvoice->id) }}"
                                            class="btn btn-sm bg-info-light">
                                            <i class="far fa-eye"></i> View
                                        </a>
                                        <a href="{{route('Doctor.patient.invoices.download', $doctor_ids->relationInvoice->id)}}" class="btn btn-sm bg-primary-light">
                                            <i class="fas fa-print"></i> Print
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
@endif




            </div>
        </div>
    </div>
@endsection
