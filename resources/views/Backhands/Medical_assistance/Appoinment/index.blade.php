@extends('layouts.dashboard_master')
@section('contant')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Appointments</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Appointments</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
@if ($con=='0')
<p class="m-5">no data</p>
@else
<div class="row">
    <div class="col-md-12">

        <!-- Recent Orders -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="special_id" class="display">
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
                            @foreach ($invice as $invices)
                                <tr>
                                    <td>
                                        <h5 class="table-avatar">
                                            <a href="profile.html" class="avatar avatar-sm mr-2">

                                                <img class="rounded-circle"
                                                    src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $invices->relationInvoiceDoctor->doctor_themble_photo }}"
                                                    width="50" alt="user">

                                            </a>
                                            <a href="{{ route('doctor.profile', $invices->relationInvoiceDoctor->id) }}">{{ $invices->relationInvoiceDoctor->fname }}
                                                {{ $invices->relationInvoiceDoctor->lname }}</a>
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
                                                        width="45" alt="{{ $invices->relationInvoiceList->name }}">
                                                @endif
                                            </a>
                                            <a href="{{route('profile.details', $invices->relationInvoiceList->id)}}">{{ $invices->relationInvoiceList->name }}</a>
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
        <!-- /Recent Orders -->

    </div>
</div>
@endif

@endsection

@section('footer_scprit')
    <script>
        $(document).ready(function() {
            $('#special_id').DataTable();



        });
    </script>
@endsection
