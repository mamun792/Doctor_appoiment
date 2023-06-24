@extends('layouts.dashboard_master')
@section('contant')
    <div class="row">
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-primary border-primary">
                            <i class="fe fe-users"></i>
                        </span>
                        <div class="dash-count">
                            <h3>

                                {{ $doctor->count() }}
                            </h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Doctors</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $doctor->count() }}%;"
                                aria-valuenow="{{ $doctor->count() }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>
                                {{ $invices->count() }}
                            </h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Patients</h6>
                        @php
                        $totalPatients = 100;
                        @endphp

                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($invices->count() / $totalPatients) * 100 }}%;"
                                aria-valuenow="{{ $invices->count() }}" aria-valuemin="0" aria-valuemax="{{ $totalPatients }}"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-danger border-danger">
                            <i class="fe fe-money"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ count($invices) }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Appointment</h6>
                        @php
                        $totalPatients = 100; // Replace this with the actual total number of patients
                        @endphp

                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($invices->count() / $totalPatients) * 100 }}%;"
                                aria-valuenow="{{ $invices->count() }}" aria-valuemin="0" aria-valuemax="{{ $totalPatients }}"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6">

            <!-- Sales Chart -->
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="card-title">Revenue</h4>
                </div>

                <div>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>


        </div>

        <div class="col-md-12 col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="card-title">Patients and Doctors </h4>
                </div>

                <div>
                    <canvas id="lineChart"></canvas>
                </div>


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 d-flex">

            <!-- Recent Orders -->
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title">Doctors List</h4>
                </div>

                <div class="card-body">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Speciality</th>
                                    <th>Earned</th>
                                    <th>Reviews</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($doctor && count($doctor) != 0)
                                    @foreach ($doctor as $doctors)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{ route('doctor.profile', $doctors->id) }}"
                                                        class="avatar avatar-sm mr-2">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $doctors->doctor_themble_photo }}"
                                                            width="50" alt="user">
                                                    </a>
                                                    <a href="{{ route('doctor.profile', $doctors->id) }}">{{ $doctors->fname }}
                                                        {{ $doctors->lname }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $doctors->relationwithspeclist->special }}</td>
                                            <td>526</td>
                                            <td>
                                                @php
                                                    $rr = $doctors->relationwithReviewDoctor
                                                        ->pluck('rating')
                                                        ->filter()
                                                        ->avg();
                                                @endphp
                                                @if ($doctors->relationwithReviewDoctor->pluck('rating')->isEmpty())
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i class="fe fe-star-o text-secondary"></i>
                                                    @endfor
                                                @else
                                                    @for ($i = 0; $i < round($rr); $i++)
                                                        <i class="fe fe-star text-warning"></i>
                                                    @endfor
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No doctors found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>


        </div>
        <div class="col-md-6 d-flex">


            <div class="card  card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title">Patients List</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive my-custom-scrollbar">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Phone</th>
                                    <th>Last Visit</th>
                                    <th>Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($doctor && count($doctor) != 0)
                                    @foreach ($invices as $patient_list)
                                        @if ($patient_list->relationInvoiceDoctor && $patient_list->relationInvoiceDoctor->vendor_id == auth()->user()->id)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html" class="avatar avatar-sm mr-2">
                                                            @if ($patient_list->relationInvoiceList && $patient_list->relationInvoiceList->profile_photo)
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('uploads/profile_photo/') }}/{{ $patient_list->relationInvoiceList->profile_photo }}"
                                                                    width="50" alt="user">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    src="{{ Avatar::create($patient_list->relationInvoiceList->name)->toBase64() }}"
                                                                    width="45"
                                                                    alt="{{ $patient_list->relationInvoiceList->name }}">
                                                            @endif
                                                        </a>
                                                        <a
                                                            href="profile.html">{{ $patient_list->relationInvoiceList->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $patient_list->relationInvoiceList->phone_number }}</td>
                                                <td>{{ $patient_list->relationInvoiceList->created_at->format('d F Y') }}
                                                </td>
                                                <td class="text-right">
                                                    {{ $patient_list->relationInvoiceList->relationInvoice->s_total }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No doctors found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-12">


            <div class="card">
                <div class="card-body">

                    <div class="table-responsive my-customs-scrollbar">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Speciality</th>
                                    <th>Patient Name</th>
                                    <th>Apointment Time</th>

                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($doctor && count($doctor) != 0)
                                    @foreach ($invices as $invices)
                                        @if (
                                            $invices->relationInvoiceDoctor->vendor_id == $invices->relationInvoiceDoctor->vendor_id &&
                                                $invices->relationInvoiceDoctor->vendor_id == auth()->user()->id)
                                            <tr>
                                                <td>
                                                    <h5 class="table-avatar">
                                                        <a href="profile.html" class="avatar avatar-sm mr-2">

                                                            <img class="rounded-circle"
                                                                src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $invices->relationInvoiceDoctor->doctor_themble_photo }}"
                                                                width="50" alt="user">

                                                        </a>
                                                        <a
                                                            href="{{ route('doctor.profile', $invices->relationInvoiceDoctor->id) }}">{{ $invices->relationInvoiceDoctor->fname }}
                                                            {{ $invices->relationInvoiceDoctor->lname }}
                                                        </a>
                                                    </h5>
                                                </td>
                                                <td>{{ $invices->relationInvoiceDoctor->relationwithspeclist->special }}
                                                </td>
                                                <td>
                                                    <h5 class="table-avatar">
                                                        <a href="profile.html" class="avatar avatar-sm mr-2">
                                                            @if ($invices->relationInvoiceList->profile_photo)
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('uploads/profile_photo/') }}/{{ $invices->relationInvoiceList->profile_photo }}"
                                                                    width="50" alt="user">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    src="{{ Avatar::create($invices->relationInvoiceList->name)->toBase64() }}"
                                                                    width="45"
                                                                    alt="{{ $invices->relationInvoiceList->name }}">
                                                            @endif
                                                        </a>
                                                        <a
                                                            href="profile.html">{{ $invices->relationInvoiceList->name }}</a>
                                                    </h5>
                                                </td>
                                                <td>{{ $invices->appioment_date }} <span
                                                        class="text-primary d-block">{{ $invices->appioment_time }}
                                                    </span>
                                                </td>

                                                <td class="text-right">
                                                    {{ $invices->relationInvoice->s_total }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr style="text-align: center;">
                                        <td colspan="4">No doctors found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->

        </div>
    </div>

    </div>
    </div>
    <!-- /Page Wrapper -->

@section('footer_scprit')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('#doctor').DataTable({
                scrollY: '50vh',
                scrollCollapse: true,
                paging: false,
            });
        });






        var salesData = @json($salesData);
        var months = @json($months);

        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Monthly Sales',
                    data: salesData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    {{-- <script>
    var doctorData = @json($doctorData);
    var patientData = @json($patientData);

    var ctx = document.getElementById('pieChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Doctors', 'Patients'],
            datasets: [{
                data: [doctorData, patientData],
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(192, 75, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(192, 75, 192, 1)'],
                borderWidth: 1
            }]
        },
        options: {}
    });
</script> --}}

    <script>
        var doctorData = @json($doctorData);
        var patientData = @json($patientData);
        var months = @json($months);

        var ctx = document.getElementById('lineChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: 'Doctors',
                        data: doctorData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        yAxisID: 'doctors-y-axis',
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: 'rgba(75, 192, 192, 1)',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointHoverBorderColor: 'rgba(75, 192, 192, 1)'
                    },
                    {
                        label: 'Patients',
                        data: patientData,
                        backgroundColor: 'rgba(192, 75, 192, 0.2)',
                        borderColor: 'rgba(192, 75, 192, 1)',
                        borderWidth: 1,
                        yAxisID: 'patients-y-axis',
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(192, 75, 192, 1)',
                        pointBorderColor: 'rgba(192, 75, 192, 1)',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: 'rgba(192, 75, 192, 1)',
                        pointHoverBorderColor: 'rgba(192, 75, 192, 1)'
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 1
                    },
                    'doctors-y-axis': {
                        position: 'left',
                        beginAtZero: true,
                        precision: 1
                    },
                    'patients-y-axis': {
                        position: 'right',
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>
@endsection
@endsection
