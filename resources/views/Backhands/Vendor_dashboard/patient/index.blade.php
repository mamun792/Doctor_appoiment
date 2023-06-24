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
                            <table class="datatable table table-hover table-center mb-0  display"  id="tranjection_id">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Last Visit</th>
                                        <th class="text-right">Paid</th>
                                        {{-- <th class="text-right"></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user && count($user) > 0)
                                    @foreach ($user as $users)
                                        @if ($users->relationInvoiceDoctor && $users->relationInvoiceDoctor->vendor_id == auth()->user()->id)
                                            <tr>
                                                <td>{{ $users->relationInvoiceList->p_id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html" class="avatar avatar-sm mr-2">
                                                            @if ($users->relationInvoiceList->profile_photo)
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('uploads/profile_photo/') }}/{{ $users->relationInvoiceList->profile_photo }}"
                                                                    width="50" alt="user">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    src="{{ Avatar::create($users->relationInvoiceList->name)->toBase64() }}"
                                                                    width="45"
                                                                    alt="{{ $users->relationInvoiceList->name }}">
                                                            @endif
                                                        </a>
                                                        <a href="profile.html">{{ $users->relationInvoiceList->name }} </a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    @php
                                                        $userDetails = DB::connection('mysql')
                                                            ->table('invoice__deatiels')
                                                            ->join('profile_detiels', 'user_id', '=', 'invoice__deatiels.patient_id')
                                                            ->where('user_id', $users->patient_id)
                                                            ->get();
                                                        $age = $userDetails->pluck('date_of_birth')->first();
                                                    @endphp
                                                    {{ \Carbon\Carbon::parse($age)->age }}
                                                </td>
                                                <td>{{ $userDetails->pluck('adderss')->first() }}</td>
                                                <td>{{ $users->relationInvoiceList->phone_number }}</td>
                                                <td>{{ $users->created_at->format('d F Y') }}</td>
                                                <td class="text-right">{{ $users->relationInvoice->s_total }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">No data found.</td>
                                    </tr>
                                @endif



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
            $('#tranjection_id').DataTable();


        });
    </script>
@endsection
