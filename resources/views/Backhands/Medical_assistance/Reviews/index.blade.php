@extends('layouts.dashboard_master')
@section('contant')
    @if (session('dele'))
        <div class="alert alert-danger">
            {{ session('dele') }}
        </div>
    @endif


    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Reviews</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Reviews</li>
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
                    <table id="special_id" class="display ">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Ratings</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invice as $review)
                                <tr>
                                    <td>
                                        <h5 class="table-avatar">
                                            @if ($review->relationwithReviewss->profile_photo)
                                                <img class="rounded-circle"
                                                    src="{{ asset('uploads/profile_photo/') }}/{{ $review->relationwithReviewss->profile_photo }}"
                                                    width="50" alt="user">
                                            @else
                                                <img class="rounded-circle"
                                                    src="{{ Avatar::create($review->relationwithReviewss->name)->toBase64() }}"
                                                    width="45" alt="{{ $review->relationwithReviewss->name }}">
                                            @endif

                                            <a href="profile.html">
                                                {{ $review->relationwithReviewss->name }}
                                            </a>
                                        </h5>
                                    </td>
                                    <td>
                                        <h5 class="table-avatar">

                                            <a href="profile.html" class="avatar avatar-sm mr-2">

                                                <img class="rounded-circle"
                                                    src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $review->relationwithReviewDoctor->doctor_themble_photo }}"
                                                    width="50" alt="user">

                                            </a>
                                            <a href="profile.html">
                                                {{ $review->relationwithReviewDoctor->fname }}
                                                {{ $review->relationwithReviewDoctor->lname }}
                                            </a>
                                        </h5>
                                    </td>

                                    <td>

                                        @for ($i = 0; $i < round($review->rating); $i++)
                                            <i class="fe fe-star text-warning"></i>
                                        @endfor


                                    </td>

                                    <td>
                                        {{ $review->comment }}
                                    </td>
                                    <td>{{ $review->created_at->format('d F Y') }}
                                        <br><small>{{ $review->created_at->format('H:i:s') }}</small></td>
                                    <td class="text-right">
                                        <div class="actions">

                                            <button value="{{ route('admin.patient.reviews.delete', $review->id) }}"
                                                class="btn btn-sm btn-danger speical_sweetalert">
                                                <i class="fe fe-trash"></i> Delete
                                            </button>
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
</div>
@endif


    </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="form-content p-2">
                        <h4 class="modal-title">Delete</h4>
                        <p class="mb-4">Are you sure want to delete?</p>
                        <button type="button" class="btn btn-primary">Save </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            {{-- </div>
</div> --}}
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
            </script>
        @endsection
