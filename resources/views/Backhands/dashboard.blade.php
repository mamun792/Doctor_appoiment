@extends('layouts.dashboard_master')
@section('contant')
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-primary border-primary">
                            <i class="fe fe-users"></i>
                        </span>
                        <div class="dash-count">
                            <h3>
                                @php
                                    $user_collect = collect($users);
                                    $doctorCount = $user_collect->where('role', 'doctor')->count();
                                    echo $doctorCount;
                                @endphp
                            </h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Doctors</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary"
                                style="width: {{ ($doctorCount / $users->count()) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>
                                @php
                                    $user_collect = collect($users);
                                    $patientCount = $user_collect->where('role', 'patient')->count();
                                    echo $patientCount;
                                @endphp
                            </h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Patients</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success"
                                style="width: {{ ($patientCount / $users->count()) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-sm-6 col-12">
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
                    <h6 class="text-muted">Appointments</h6>
                    <div class="progress progress-sm">
                        @php
                            $totalInvoices = 100;
                            $progress = $totalInvoices > 0 ? (count($invices) / $totalInvoices) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-danger" style="width: {{ $progress }}%"></div>
                    </div>
                </div>
            </div>



        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-warning border-warning">
                            <i class="fe fe-folder"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $users->count() }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Total Users</h6>
                        <div class="progress progress-sm">
                            @php
                                $totalUsers =100 ;
                                $progress = $totalUsers > 0 ? ($users->count() / $totalUsers) * 100 : 0;
                            @endphp
                            <div class="progress-bar bg-warning" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6">


            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="card-title">Revenue</h4>
                </div>
                <div class="card-body">





                </div>

                <div>
                    <canvas id="revenueByMonthChart"></canvas>
                </div>
            </div>


        </div>
        <div class="col-md-12 col-lg-6">

            <!-- Invoice Chart -->
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="card-title">Status</h4>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="userRoleChart"></canvas>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-6 d-flex">


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

                                @foreach ($doctor as $doctors)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar avatar-sm mr-2">

                                                    <img class="rounded-circle"
                                                        src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $doctors->doctor_themble_photo }}"
                                                        width="50" alt="user">

                                                </a>
                                                <a href="{{ route('doctor.profile', $doctors->id) }}">{{ $doctors->fname }}
                                                    {{ $doctors->lname }}</a>
                                            </h2>

                                        </td>
                                        <td> {{ $doctors->relationwithspeclist->special }}</td>
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
                    <div class="table-responsive" style="height: 400px; overflow: auto;">
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
                                @foreach ($invices as $patient_lists)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar avatar-sm mr-2">
                                                    @if ($patient_lists->relationInvoiceList->profile_photo)
                                                        <img class="rounded-circle"
                                                            src="{{ asset('uploads/profile_photo/') }}/{{ $patient_lists->relationInvoiceList->profile_photo }}"
                                                            width="50" alt="user">
                                                    @else
                                                        <img class="rounded-circle"
                                                            src="{{ Avatar::create($patient_lists->relationInvoiceList->name)->toBase64() }}"
                                                            width="45"
                                                            alt="{{ $patient_lists->relationInvoiceList->name }}">
                                                    @endif
                                                </a>
                                                <a
                                                    href="{{ route('profile.details', $patient_lists->relationInvoiceList->id) }}">
                                                    {{ $patient_lists->relationInvoiceList->name }} </a>
                                            </h2>
                                        </td>
                                        <td>{{ $patient_lists->relationInvoiceList->phone_number }}</td>
                                        <td>{{ $patient_lists->created_at->format('d F Y') }}</td>
                                        {{--  --}}
                                    </tr>
                                @endforeach

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
                                @foreach ($invices as $invices)
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
                                        <td>{{ $invices->relationInvoiceDoctor->relationwithspeclist->special }}</td>
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
                                                    href="{{ route('profile.details', $invices->relationInvoiceList->id) }}">{{ $invices->relationInvoiceList->name }}</a>
                                            </h5>
                                        </td>
                                        <td>{{ $invices->appioment_date }} <span
                                                class="text-primary d-block">{{ $invices->appioment_time }} </span></td>

                                        <td class="text-right">
                                            {{ $invices->relationInvoice->s_total }}
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

    </div>
    </div>


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


        var userCounts = @json($userCounts);

        var labels = Object.keys(userCounts);
        var counts = Object.values(userCounts);

        var ctx = document.getElementById('userRoleChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',

                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });



        var revenueByMonth = @json($revenueByMonth);

        var labels = Object.keys(revenueByMonth);
        var revenues = Object.values(revenueByMonth);

        var ctx = document.getElementById('revenueByMonthChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: revenues,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.1)',
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                if (value >= 1000) {
                                    return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                } else {
                                    return '$' + value;
                                }
                            }
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.1)',
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection
@endsection
