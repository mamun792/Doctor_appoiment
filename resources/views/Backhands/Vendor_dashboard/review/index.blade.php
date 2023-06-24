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
                                @if ($invoice && count($invoice) > 0)
                                @foreach ($invoice as $review)
                                    @if ($review->relationInvoiceDoctor && $review->relationInvoiceDoctor->vendor_id == auth()->user()->id)
                                        <tr>
                                            <td>
                                                <h5 class="table-avatar">
                                                    @if ($review->relationInvoiceList->profile_photo)
                                                        <img class="rounded-circle"
                                                            src="{{ asset('uploads/profile_photo/') }}/{{ $review->relationInvoiceList->profile_photo }}"
                                                            width="50" alt="user">
                                                    @else
                                                        <img class="rounded-circle"
                                                            src="{{ Avatar::create($review->relationInvoiceList->name)->toBase64() }}"
                                                            width="45" alt="{{ $review->relationInvoiceList->name }}">
                                                    @endif
                                                    <a href="profile.html"> {{ $review->relationInvoiceList->name }}</a>
                                                </h5>
                                            </td>
                                            <td>
                                                <h5 class="table-avatar">
                                                    <a href="profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $review->relationInvoiceDoctor->doctor_themble_photo }}"
                                                            width="50" alt="user">
                                                    </a>
                                                    <a href="profile.html">
                                                        {{ $review->relationInvoiceDoctor->fname }}
                                                        {{ $review->relationInvoiceDoctor->lname }} </a>
                                                </h5>
                                            </td>
                                            <td>
                                                @php
                                                    $comment = DB::connection('mysql')
                                                        ->table('reviews')
                                                        ->join('users', 'users.id', '=', 'reviews.user_id')
                                                        ->where('user_id', $review->patient_id)
                                                        ->get();
                                                    $rating = $comment
                                                        ->pluck('rating')
                                                        ->filter()
                                                        ->avg();
                                                @endphp
                                                @for ($i = 0; $i < round($rating); $i++)
                                                    <i class="fe fe-star text-warning"></i>
                                                @endfor
                                            </td>
                                            <td>
                                                {{ $comment->pluck('comment')->first() }}
                                            </td>
                                            <td>
                                                {{ $comment->pluck('created_at')->first() }}<br><small></small>
                                            </td>
                                            <td class="text-right">
                                                <div class="actions">
                                                    <button value="b" class="btn btn-sm btn-danger speical_sweetalert">
                                                        <i class="fe fe-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">No data found.</td>
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
    </div>
    <!-- /Page Wrapper -->
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
