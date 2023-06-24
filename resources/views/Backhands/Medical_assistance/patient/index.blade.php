@extends('layouts.dashboard_master')
@section('contant')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">List of Patient</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
                    <li class="breadcrumb-item active">Patient</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
@if ($con=='0')
<p class="m-5">No Data</p>
@else
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="datatable table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Patient ID</th>
                                    <th>Patient Name</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Phone</th>


                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($p_id as $p_ids)


                                    <tr>

                                        <td>{{ $p_ids->relationInvoiceList->p_id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar avatar-sm mr-2">
                                                        @if ($p_ids->relationInvoiceList->profile_photo)
                                                            <img class="rounded-circle"
                                                                src="{{ asset('uploads/profile_photo/') }}/{{ $p_ids->relationInvoiceList->profile_photo }}"
                                                                width="50" alt="user">
                                                        @else
                                                            <img class="rounded-circle"
                                                                src="{{ Avatar::create($p_ids->relationInvoiceList->name)->toBase64() }}"
                                                                width="45"
                                                                alt="{{ $p_ids->relationInvoiceList->name }}">
                                                        @endif
                                                    </a>
                                                <a href="{{route('profile.details',$p_ids->relationInvoiceList->id)}}">{{ $p_ids->relationInvoiceList->name }} </a>
                                            </h2>
                                        </td>
                                        <td>

                                            {{ \Carbon\Carbon::parse($p_ids->relationInvoiceList->relationWithProfiledetial?->date_of_birth)->age ?? 'N/A' }}


                                        </td>
                                        <td>
                                            {{$p_ids->relationInvoiceList->relationWithProfiledetial->adderss ?? 'N/A'}}

                                        </td>
                                        <td>
                                            {{ $p_ids->relationInvoiceList->phone_number ?? 'N/A' }}

                                        </td>


                                        <td>
                                            <button type="button" class="btn btn-primary position-relative">
                                                <a href="{{ route('vendor.patient.medical.report', $p_ids->relationInvoiceList->id) }}"
                                                    class="btn-primary">
                                                    Add Medical Records
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
</div>
@endif

@endsection
