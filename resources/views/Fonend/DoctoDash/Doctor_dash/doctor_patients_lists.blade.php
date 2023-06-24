@extends('layouts.doctor_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Patients</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">My Patients</h2>
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
                    <!-- /Profile Sidebar -->

                </div>


                @if ($p_list_count == '0')
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="row ">
                            <h4 class="d-flex justify-content-center mt-5">No Patient </h4>
                        </div>
                    </div>
                @else
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="row ">

                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="special_id" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Patient ID</th>
                                                    <th>Patient Name</th>
                                                    <th>phone Number</th>
                                                    <th>Email</th>
                                                    <th>Medical Details</th>


                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($doctor_ids as $patient_list)
                                                    <tr>

                                                        <td>{{ $patient_list->relationInvoiceList->p_id }}</td>
                                                        <td>

                                                            @if ($patient_list->relationInvoiceList->profile_photo)
                                                                <img class="rounded-circle "
                                                                    src="{{ asset('uploads/profile_photo/') }}/{{ $patient_list->relationInvoiceList->profile_photo }}"
                                                                    height="40" width="40" alt="user">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    src="{{ Avatar::create($patient_list->relationInvoiceList->name)->toBase64() }}"
                                                                    width="45"
                                                                    alt="{{ $patient_list->relationInvoiceList->name }}">
                                                            @endif
                                                            <a
                                                                href="{{ route('profile.details', $patient_list->relationInvoiceList->id) }}">{{ $patient_list->relationInvoiceList->name }}</a>

                                                        </td>

                                                        <td>{{ $patient_list->relationInvoiceList->phone_number }}</td>



                                                        <td> {{ $patient_list->relationInvoiceList->email }}</td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-primary position-relative">
                                                                <a href="{{ route('patient.medical.record', $patient_list->relationInvoiceList->id) }}"
                                                                    class="btn-primary">
                                                                    Medical Records
                                                                </a>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                @endif



            </div>
        </div>
    </div>
@endsection


@section('footer_scprits')
    <script>
        $(document).ready(function() {
            $('#special_id').DataTable();

            $('#special_id').on('click', '.speical_sweetalert', function() {

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
