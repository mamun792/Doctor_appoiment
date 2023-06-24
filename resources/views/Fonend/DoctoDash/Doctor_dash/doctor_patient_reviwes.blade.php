@extends('layouts.doctor_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Reviews</h2>
                </div>
            </div>
        </div>
    </div>


    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                @if (auth()->user()->profile_photo)
                                    <img class="rounded-circle "
                                        src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                        height="120" width="120" alt="user">
                                @else
                                    <img class="rounded-circle "
                                        src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" height="80"
                                        width="120" height="120">
                                @endif
                                <div class="profile-det-info">
                                    <h3>{{ auth()->user()->name }}</h3>

                                    <div class="patient-details">
                                        <h5 class="mb-0">
                                            {{ auth()->user()->email }}

                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    <li class="active">
                                        <a href="{{ route('doctor.dash') }}">
                                            <i class="fas fa-columns"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctor.patient.list') }}">
                                            <i class="fas fa-user-injured"></i>
                                            <span>My Patients</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doctor.time.schedules') }}">
                                            <i class="fas fa-hourglass-start"></i>
                                            <span>Schedule Timings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doctor.patient.invoices.list') }}">
                                            <i class="fas fa-file-invoice"></i>
                                            <span>Invoices</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('doctor.patient.review') }}">
                                            <i class="fas fa-star"></i>
                                            <span>Reviews</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctorDetailes.index') }}">
                                            <i class="fas fa-user-cog "></i>
                                            <span>Profile Settings</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('doctor.change.password') }}">
                                            <i class="fas fa-lock"></i>
                                            <span>Change Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <span>.</span>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Log out</span></a>
                                        </form>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /Profile Sidebar -->

                </div>


                @if ($d_list== '0')
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <h4 class="d-flex justify-content-center mt-5">No Reviews</h4>
                    </div>

                @else
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="doc-review review-listing">

                            <!-- Review Listing -->
                            <ul class="comments-list">

                                @foreach ($review as $reviewss)
                                    @if ($reviewss->doctor_id == $doctor_ids)
                                        <li>

                                            <div class="comment">
                                                @if (auth()->user()->profile_photo)
                                                    <img class="rounded-circle "
                                                        src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                                        height="40" width="40" alt="user">
                                                @else
                                                    <img class="rounded-circle"
                                                        src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                                        height="40" width="40" alt="{{ auth()->user()->name }}">
                                                @endif
                                                <div class="comment-body">
                                                    <div class="meta-data">
                                                        <span class="comment-author">
                                                            {{ auth()->user()->name }}
                                                        </span>
                                                        <span class="comment-date">Reviewed
                                                            {{ $reviewss->created_at->diffForHumans() }}
                                                        </span>

                                                        <div class="review-count rating">


                                                            @if ($reviewss->pluck('rating')->isEmpty())
                                                                <div class="rating">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        <i class="fas fa-star"></i>
                                                                    @endfor
                                                                    <span class="d-inline-block average-rating">(0)</span>
                                                                </div>
                                                            @else
                                                                <div class="rating">
                                                                    @for ($i = 0; $i < round($reviewss->avg('rating')); $i++)
                                                                        <i class="fas fa-star filled"></i>
                                                                    @endfor
                                                                    <span
                                                                        class="d-inline-block average-rating">({{ count($review) }})</span>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <p class="recommended"><i class="far fa-thumbs-up"></i>
                                                        {{ $reviewss->title }}
                                                    </p>
                                                    <p class="comment-content">
                                                        {{ $reviewss->comment }}
                                                    </p>
                                                    <div class="comment-reply">


                                                        <a class="comment-btn"
                                                            href="{{ route('patient.review.replay', $reviewss->id) }}">
                                                            <i class="fas fa-reply"></i> Reply
                                                        </a>
                                                        <p class="recommend-btn">
                                                            <span>Recommend?</span>
                                                            <a href="#" class="like-btn">
                                                                <i class="far fa-thumbs-up"></i> Yes
                                                            </a>
                                                            <a href="#" class="dislike-btn">
                                                                <i class="far fa-thumbs-down"></i> No
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (empty($reviewss->relationWithReplay->comment))
                                            @else
                                                <ul class="comments-reply">


                                                    <li>

                                                        <div class="comment">
                                                            @if (auth()->user()->profile_photo)
                                                                <img class="rounded-circle "
                                                                    src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                                                    height="40" width="40" alt="user">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                                                    height="40" width="40"
                                                                    alt="{{ auth()->user()->name }}">
                                                            @endif
                                                            <div class="comment-body">
                                                                <div class="meta-data">
                                                                    <span
                                                                        class="comment-author">{{ auth()->user()->name }}</span>
                                                                    <span
                                                                        class="comment-date">{{ $reviewss->relationWithReplay->created_at ?? 'None' }}</span>
                                                                </div>
                                                                <p class="comment-content">



                                                                    {{ $reviewss->relationWithReplay->comment ?? 'None' }}

                                                                </p>

                                                            </div>
                                                        </div>
                                                    </li>


                                                </ul>
                                            @endif


                                        </li>
                                    @endif
                                @endforeach

                            </ul>


                        </div>
                    </div>
                @endif




            </div>
        </div>

    </div>


    </div>
@endsection
