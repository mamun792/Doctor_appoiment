@extends('layouts.dashboard_master')
@section('contant')
    {{-- <div class="content container-fluid"> --}}

    <!-- Page Header -->
    @if (session('delete'))
        <div class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif

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

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">


                    <div class="table-responsive">
                        <table id="special_id" class="display   " style="width:100% ">
                            <thead>
                                <tr>
                                    <th>SI ON</th>
                                    <th>Doctor Photo</th>
                                    <th>Doctor Name</th>
                                    <th>Create at</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                    @if ($users->vendor_id == $users->vendor_id && $users->vendor_id == auth()->user()->id)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>


                                                <img class="rounded-circle"
                                                    src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $users->relationwithUser->profile_photo }}"
                                                    width="50" alt="user">

                                            </td>
                                            <td>


                                                <a href="{{ route('doctorDetailes.index', $users->id) }}">
                                                    {{ $users->fname }} {{ $users->lname }}</a>
                                            </td>
                                            <td>{{ $users->created_at->format('d-m-y') }}</td>
                                            <td>

                                                <button value="{{ route('user.role.doctor.delete', $users->id) }}"
                                                    class="btn btn-sm btn-danger speical_sweetalert">
                                                    <i class="fe fe-trash"></i> Delete
                                                </button>
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- </div> --}}
@endsection
@section('footer_scprit')
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


        $(document).ready(function() {
            $('#user_id').DataTable();
        });



        // Select all buttons with the "speical_sweetalert" class
        const buttons = document.querySelectorAll('.speical_sweetalert');

        // Loop through each button and attach an event listener
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.userId; // Get the user ID from the data attribute

                // Display the SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the delete action here
                        const url = this.value; // Get the URL from the button's value attribute
                        const deleteUrl = url.replace(':id',
                            userId); // Replace ":id" in the URL with the user ID
                        window.location.href = deleteUrl; // Redirect to the delete URL
                    }
                });
            });
        });
    </script>
@endsection
