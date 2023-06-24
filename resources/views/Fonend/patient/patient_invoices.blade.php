@extends('layouts.profile_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">



                            <li class="breadcrumb-item "><a href="{{ route('index') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                        </ol>
                    </nav>

                    <h2 class="breadcrumb-title">Invoice</h2>


                </div>
            </div>
        </div>
    </div>



    {{-- mam --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="#" class="booking-doc-img">
                                    @if (auth()->user()->profile_photo)
                                        <img class="rounded-circle "
                                            src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                            height="80" width="80" alt="user">
                                    @else
                                        <img class="rounded-circle "
                                            src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" height="80"
                                            width="80">
                                    @endif
                                </a>
                                <div class="profile-det-info">

                                    <h3>{{ auth()->user()->name }}</h3>

                                    <div class="patient-details">
                                        <h5><i class="fas fa-envelope"></i> {{ auth()->user()->email }}
                                        </h5>
                                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>
                                            {{ auth()->user()->phone_number }}</h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            @if (auth()->user()->role == 'patient')
                                <nav class="dashboard-menu">
                                    <ul>
                                        <li >
                                            <a href="{{ route('patient.dashboard') }}">
                                                <i class="fas fa-columns"></i>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('favourit.details') }}">
                                                <i class="fas fa-bookmark"></i>
                                                <span>Favourites</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.record',auth()->user()->id)}}">
                                                <i class="fas fa-clipboard"></i>
                                                <span>Add Medical Records</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.deatiles',auth()->user()->id) }}">
                                                <i class="fas fa-file-medical-alt"></i>
                                                <span>Medical Details</span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{ route('patient.invoice') }}">
                                                <i class="fas fa-file-invoice"></i>
                                                <span>Invoices</span>

                                            </a>
                                        </li>


                                        <li>
                                            <a href="{{ route('profile.details',auth()->user()->id) }}">
                                                <i class="fas fa-user-cog"></i>
                                                <span>Profile Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            {{-- {{route('profile.edit')}} --}}
                                            <a href="{{ route('profile.change.password') }}">
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
                            @endif

                        </div>

                    </div>
                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card card-table">
                        <div class="card-body">

                            <!-- Invoice Table -->
                            <div class="table-responsive"  style="overflow: auto; max-height: 400px;">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Doctor</th>
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
                                                    <a
                                                        href="invoice-view.html">{{ $doctor_ids->relationInvoiceList->p_id }}</a>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">


                                                        <img class="rounded-circle "
                                                            src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $doctor_ids->relationInvoiceDoctor->doctor_themble_photo }}"
                                                            height="40" width="40" alt="user">



                                                        <a href="patient-profile.html">
                                                            {{ $doctor_ids->relationInvoiceDoctor->fname }}
                                                            {{ $doctor_ids->relationInvoiceDoctor->lname }}
                                                            <span>{{ $doctor_ids->relationInvoiceDoctor->relationwithspeclist->special }}
                                                            </span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $doctor_ids->relationInvoice->s_total }}</td>
                                                <td>{{ $doctor_ids->relationInvoice->created_at }}</td>
                                                <td>{{ $doctor_ids->relationInvoice->payment_status }}</td>

                                                <td class="text-right">
                                                    <div class="table-action">
                                                        @if ($doctor_ids->relationInvoice->payment_status == 'paid')
                                                            <a href="{{ route('patient.review', $doctor_ids->id) }}"
                                                                class="btn btn-sm bg-info-light">
                                                                <i class="fas fa-comments"></i> Review
                                                            </a>
                                                        @endif

                                                        <a href="{{ route('Doctor.patient.invoices.download', auth()->user()->id) }}"
                                                            class="btn btn-sm bg-primary-light">
                                                            <i class="fas fa-print"></i> Print
                                                        </a>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /Invoice Table -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            @endsection
