@extends('layouts.dashboard_master')
@section('contant')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">Doctors</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">All Doctors</li>
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
                        <table id="special_id" class="display   " style="width:100% ">
                            <thead>
                                <tr>

                                    <th>Doctor Name</th>
                                    <th>Doctor Phone Number</th>
                                    <th>Hospital Name</th>
                                    <th>Address</th>

                                    <th>Create at</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>


                                        <td>

                                            <img class="rounded-circle"
                                                src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $doctor->doctor_themble_photo }}"
                                                width="50" alt="user">
                                            <a href="{{ route('doctorDetailes.index', $doctor->id) }}">
                                                {{ $doctor->fname }}
                                                {{ $doctor->lname }}</a>
                                        </td>
                                        <td>
                                            {{ $doctor->phone_number }}


                                        </td>

                                        <td>

                                            {{ $doctor->hospital_name }}
                                        </td>
                                        <td>{{ $doctor->hospital_address}}</td>

                                        <td>
                                            {{ $doctor->created_at }}
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
@endsection
@section('footer_scprit')
    <script>
        $(document).ready(function() {
            $('#special_id').DataTable();



        });
    </script>
@endsection
