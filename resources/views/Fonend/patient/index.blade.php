@extends('layouts.profile_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">



                            <li class="breadcrumb-item "><a href="{{ route('index') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>

                    <h2 class="breadcrumb-title">Dashboard</h2>


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
                                        <li class="active">
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
                                            <a href="{{ route('patient.medical.record', auth()->user()->id) }}">
                                                <i class="fas fa-clipboard"></i>
                                                <span>Add Medical Records</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.deatiles', auth()->user()->id) }}">
                                                <i class="fas fa-file-medical-alt"></i>
                                                <span>Medical Details</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.invoice') }}">
                                                <i class="fas fa-file-invoice"></i>
                                                <span>Invoices</span>

                                            </a>
                                        </li>



                                        <li>
                                            <a href="{{ route('profile.details', auth()->user()->id) }}">
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
                {{-- nh --}}

                <div class="col-md-7 col-lg-8 col-xl-8">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend_assets/img/specialities/pt-dashboard-01.png') }}">
                                    </div>
                                    <h5>Heart Rate</h5>
                                    <h6>12 <sub>bpm</sub></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend_assets/img/specialities/pt-dashboard-02.png') }}" alt
                                            width="55">
                                    </div>
                                    <h5>Body Temperature</h5>
                                    <h6>18 <sub>C</sub></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend_assets/img/specialities/pt-dashboard-03.png') }}" alt
                                            width="55">
                                    </div>
                                    <h5>Glucose Level</h5>
                                    <h6>70 - 90</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-dashboard-top">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('frontend_assets/img/specialities/pt-dashboard-04.png') }}" alt
                                            width="55">
                                    </div>
                                    <h5>Blood Pressure</h5>
                                    <h6>202/90 <sub>mg/dl</sub></h6>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="row patient-graph-col">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Graph Status</h4>
                                </div>
                                <div class="card-body pt-2 pb-2 mt-1 mb-1">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
                                            <a href="#" class="graph-box" data-bs-toggle="modal"
                                                data-bs-target="#graph1">
                                                <div>
                                                    <h4>BMI Status</h4>
                                                </div>
                                                <div class="graph-img">
                                                    <img src={{ asset('frontend_assets/img/specialities/shapes/graph-01.png') }}"
                                                        alt>
                                                </div>
                                                <div class="graph-status-result mt-3">
                                                    <span class="graph-update-date">
                                                        @if ($recoed_count == '0')
                                                        @else
                                                            {{ $medical_detailes[0]->created_at->diffForHumans() }}
                                                        @endif

                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
                                            <a href="#" class="graph-box pink-graph" data-bs-toggle="modal"
                                                data-bs-target="#graph2">
                                                <div>
                                                    <h4>Heart Rate Status</h4>
                                                </div>
                                                <div class="graph-img">
                                                    <img src="{{ asset('frontend_assets/img/specialities/shapes/graph-02.png') }}"
                                                        alt>
                                                </div>
                                                <div class="graph-status-result mt-3">
                                                    <span class="graph-update-date">
                                                        @if ($recoed_count == '0')
                                                        @else
                                                            {{ $medical_detailes[0]->created_at->diffForHumans() }}
                                                        @endif
                                                        {{--  --}}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
                                            <a href="#" class="graph-box sky-blue-graph" data-bs-toggle="modal"
                                                data-bs-target="#graph3">
                                                <div>
                                                    <h4>FBC Status</h4>
                                                </div>
                                                <div class="graph-img">
                                                    <img src="{{ asset('frontend_assets/img/specialities/shapes/graph-03.png') }}"
                                                        alt>
                                                </div>
                                                <div class="graph-status-result mt-3">
                                                    <span class="graph-update-date">
                                                        @if ($recoed_count == '0')
                                                        @else
                                                            {{ $medical_detailes[0]->created_at->diffForHumans() }}
                                                        @endif
                                                        {{--  --}}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 patient-graph-box">
                                            <a href="#" class="graph-box orange-graph" data-bs-toggle="modal"
                                                data-bs-target="#graph4">
                                                <div>
                                                    <h4>Weight Status</h4>
                                                </div>
                                                <div class="graph-img">
                                                    <img src="{{ asset('frontend_assets/img/specialities/shapes/graph-04.png') }}"
                                                        alt>
                                                </div>
                                                <div class="graph-status-result mt-3">
                                                    <span class="graph-update-date">
                                                        @if ($recoed_count == '0')
                                                        @else
                                                            {{ $medical_detailes[0]->created_at->diffForHumans() }}
                                                        @endif

                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-6 col-lg-8 col-xl-12 patient-dashboard-top">
                        <div class="card">
                            <nav class="user-tabs mb-4">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pat_appointments"
                                            data-toggle="tab">Appointments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Prescriptions</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" href="#pat_medical_records" data-toggle="tab"><span
                                                class="med-records">Medical Records</span></a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pat_billing" data-toggle="tab">Billing</a>
                                    </li>
                                </ul>
                            </nav>

                            <div class="tab-content pt-0">


                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive" style="overflow: auto; max-height: 300px;">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Doctor</th>
                                                            <th>Appt Date</th>
                                                            <th>Booking Date</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($recoed_count == '0')
                                                        @else
                                                            @foreach ($appoipent as $appoipents)
                                                                <tr>
                                                                    <td>
                                                                        <h2 class="table-avatar">
                                                                            <a href="doctor-profile.html"
                                                                                class="avatar avatar-sm mr-2">


                                                                                <img class="rounded-circle "
                                                                                    src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $appoipents->relationInvoiceDoctor->doctor_themble_photo }}"
                                                                                    height="40" width="40"
                                                                                    alt="user">


                                                                            </a>
                                                                            <a
                                                                                href="{{ route('doctorDetailes.index', $appoipents->relationInvoiceDoctor->id) }}">{{ $appoipents->relationInvoiceDoctor->fname }}
                                                                                {{ $appoipents->relationInvoiceDoctor->lname }}<span>{{ $appoipents->relationInvoiceDoctor->relationwithspeclist->special }}</span></a>
                                                                        </h2>
                                                                    </td>
                                                                    <td>{{ $appoipents->appioment_date }} <span
                                                                            class="d-block text-info">{{ $appoipents->appioment_time }}</span>
                                                                    </td>

                                                                    <td>{{ $appoipents->created_at->format('d-M-Y') }}</td>
                                                                    <td>{{ $appoipents->relationInvoice->s_total }}</td>
                                                                    <td><span
                                                                            class="badge badge-pill bg-success-light">{{ $appoipents->relationInvoice->payment_status }}</span>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="table-action">
                                                                            <a href="{{ route('Doctor.patient.invoices.download', $appoipents->relationInvoice->id) }}"
                                                                                class="btn btn-sm bg-primary-light">
                                                                                <i class="fas fa-print"></i> Print
                                                                            </a>
                                                                            <a href="{{ route('patient.invoices', $appoipents->relationInvoice->id) }}"
                                                                                class="btn btn-sm bg-info-light">
                                                                                <i class="far fa-eye"></i> View
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Prescription Tab -->
                                <div class="tab-pane fade" id="pat_prescriptions">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive" style="overflow: auto; max-height: 300px;">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Date </th>
                                                            <th>Name</th>
                                                            <th>Created by </th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($prescprition as $prescpritions)
                                                            <tr>
                                                                <td>{{ $prescpritions->created_at->format('j F Y') }}</td>
                                                                <td>{{ $prescpritions->Symptoms }}</td>
                                                                <td>


                                                                    @if (
                                                                        $prescpritions &&
                                                                            $prescpritions->relationwithPatientTest &&
                                                                            $prescpritions->relationwithPatientTest->relationwithDoctor)
                                                                        <h2 class="table-avatar">
                                                                            <a href="doctor-profile.html"
                                                                                class="avatar avatar-sm mr-2">
                                                                                <img class="rounded-circle"
                                                                                    src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $prescpritions->relationwithPatientTest->relationwithDoctor->doctor_themble_photo }}"
                                                                                    height="40" width="40"
                                                                                    alt="user">
                                                                            </a>
                                                                            <a href="doctor-profile.html">
                                                                                {{ $prescpritions->relationwithPatientTest->relationwithDoctor->fname }}
                                                                                {{ $prescpritions->relationwithPatientTest->relationwithDoctor->lname }}
                                                                                <span>{{ $prescpritions->relationwithPatientTest->relationwithDoctor->relationwithspeclist->special }}</span>
                                                                            </a>
                                                                        </h2>
                                                                    @else

                                                                        <p>Doctor information not available.</p>
                                                                    @endif

                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="table-action">
                                                                        <a href="{{ route('patient.prescription.download', $prescpritions->id) }}"
                                                                            class="btn btn-sm bg-primary-light">
                                                                            <i class="fas fa-print"></i> Print
                                                                        </a>
                                                                        <a href="{{ route('patient.prescription', $prescpritions->id) }}"
                                                                            class="btn btn-sm bg-info-light">
                                                                            <i class="far fa-eye"></i> View
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


                                <!-- Medical Records Tab -->
                                {{-- <div id="pat_medical_records" class="tab-pane fade">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive" style="overflow: auto; max-height: 300px;">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Date </th>
                                                            <th>Description</th>
                                                            <th>Attachment</th>
                                                            <th>Created</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td><a href="javascript:void(0);">#MR-0010</a></td>
                                                            <td>14 Nov 2019</td>
                                                            <td>Dental Filling</td>
                                                            <td><a href="#">dental-test.pdf</a></td>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="doctor-profile.html"
                                                                        class="avatar avatar-sm mr-2">
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                            alt="User Image">
                                                                    </a>
                                                                    <a href="doctor-profile.html">Dr. Ruby Perrin
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}


                                <!-- Billing Tab -->
                                <div id="pat_billing" class="tab-pane fade">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive" style="overflow: auto; max-height: 300px;">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Invoice No</th>
                                                            <th>Doctor</th>
                                                            <th>Amount</th>
                                                            <th>Paid On</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($appoiment_count == '0')
                                                        @else
                                                            @foreach ($appoipent as $appoipents)
                                                                <tr>
                                                                    <td>
                                                                        <a
                                                                            href="invoice-view.html">{{ $appoipents->relationInvoice->invoices_on }}</a>
                                                                    </td>
                                                                    <td>
                                                                        <h2 class="table-avatar">
                                                                            <a href="doctor-profile.html"
                                                                                class="avatar avatar-sm mr-2">
                                                                                <img class="rounded-circle "
                                                                                    src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $appoipents->relationInvoiceDoctor->doctor_themble_photo }}"
                                                                                    height="40" width="40"
                                                                                    alt="user">


                                                                            </a>
                                                                            <a href="doctor-profile.html">{{ $appoipents->relationInvoiceDoctor->fname }}
                                                                                {{ $appoipents->relationInvoiceDoctor->lname }}<span>Dental</span></a>
                                                                        </h2>
                                                                    </td>
                                                                    <td>{{ $appoipents->relationInvoice->s_total }}</td>
                                                                    <td>{{ $appoipents->relationInvoice->created_at->format('d M Y') }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="table-action">
                                                                            <a href="{{route('patient.invoices' ,$appoipents->id)}}"
                                                                                class="btn btn-sm bg-info-light">
                                                                                <i class="far fa-eye"></i> View
                                                                            </a>
                                                                            <a href="{{ route('Doctor.patient.invoices.download', $appoipents->relationInvoice->id) }}"
                                                                                class="btn btn-sm bg-primary-light">
                                                                                <i class="fas fa-print"></i> Print
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Billing Tab -->
                            </div>
                        </div>
                    </div>
                    <!-- Tab Content -->
                </div>
                <br><br>
            </div>

        </div>


    </div>
    </div>
    </div>


    </div>

    </div>
@endsection
