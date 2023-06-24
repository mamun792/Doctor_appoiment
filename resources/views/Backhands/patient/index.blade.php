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

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="patient_id" class="display " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>


                                        <th>Phone</th>
                                        <th>Visit</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient_list as $patient_lists)
                                    <tr>

                                            <td>{{ $patient_lists->relationInvoiceList->p_id}}</td>
                                            <td>


                                                    <a href="profile.html" class="avatar avatar-sm mr-2">
                                                        @if ($patient_lists->relationInvoiceList->profile_photo)
                                                        <img class="rounded-circle"
                                                            src="{{ asset('uploads/profile_photo/') }}/{{ $patient_lists->relationInvoiceList->profile_photo }}"
                                                            width="50" alt="user">
                                                        @else
                                                        <img class="rounded-circle" src="{{ Avatar::create($patient_lists->relationInvoiceList->name)->toBase64() }}"
                                                            width="45" alt="{{ $patient_lists->relationInvoiceList->name }}">
                                                        @endif
                                                    </a>
                                                    <a href="{{route('profile.details',$patient_lists->id)}}">{{ $patient_lists->relationInvoiceList->name }}
                                                      </a>

                                            </td>



                                            <td>{{ $patient_lists->relationInvoiceList->phone_number }}</td>

                                            <td>{{ $patient_lists->relationInvoiceList->created_at->format('d F Y') }}</td>

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
@endsection
@section('footer_scprit')
<script>
$(document).ready(function() {
    $('#patient_id').DataTable();
});
</script>

@endsection
