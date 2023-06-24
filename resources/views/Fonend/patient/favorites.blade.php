@extends('layouts.profile_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">



                            <li class="breadcrumb-item "><a href="{{ route('index') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Favourites</li>
                        </ol>
                    </nav>

                    <h2 class="breadcrumb-title">Favourites</h2>


                </div>
            </div>
        </div>
    </div>



    {{-- mam --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="#" class="booking-doc-img">
                                    @if (auth()->user()->profile_photo)
                                        <img class="rounded-circle "
                                            src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                            height="80" width="80" alt="user">
                                    @else
                                        <img class="rounded-circle "
                                            src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" height="80"
                                            width="80">
                                    @endif
                                </a>
                                <div class="profile-det-info">

                                    <h3>{{ auth()->user()->name }}</h3>

                                    <div class="patient-details">
                                        <h5><i class="fas fa-envelope"></i> {{ auth()->user()->email }}
                                        </h5>
                                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>
                                            {{ auth()->user()->phone_number }}</h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            @if (auth()->user()->role == 'patient')
                                <nav class="dashboard-menu">
                                    <ul>
                                        <li >
                                            <a href="{{ route('patient.dashboard') }}">
                                                <i class="fas fa-columns"></i>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{ route('favourit.details') }}">
                                                <i class="fas fa-bookmark"></i>
                                                <span>Favourites</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.record',auth()->user()->id)}}">
                                                <i class="fas fa-clipboard"></i>
                                                <span>Add Medical Records</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.deatiles',auth()->user()->id) }}">
                                                <i class="fas fa-file-medical-alt"></i>
                                                <span>Medical Details</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.invoice') }}">
                                                <i class="fas fa-file-invoice"></i>
                                                <span>Invoices</span>

                                            </a>
                                        </li>


                                        <li>
                                            <a href="{{ route('profile.details',auth()->user()->id) }}">
                                                <i class="fas fa-user-cog"></i>
                                                <span>Profile Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            {{-- {{route('profile.edit')}} --}}
                                            <a href="{{ route('profile.change.password') }}">
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
                            @endif

                        </div>

                    </div>
                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">



                    <div class="row row-grid">
                        @foreach ($fav as $favs)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="doctor-profile.html">
                                            <img class="img-fluid" alt="User Image"
                                                src="{{ asset('uploads/doctor_themble_photo') }}/{{ $favs->relationDoctor->doctor_themble_photo }}">
                                        </a>

                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title">
                                            <a href="doctor-profile.html">{{ $favs->relationDoctor->fname }}
                                                {{ $favs->relationDoctor->lname }}</a>
                                            <i class="fas fa-check-circle verified"></i>
                                        </h3>
                                        <p class="speciality">{{ $favs->relationDoctor->relationwithspeclist->special }}
                                        </p>
                                        @php
                                            $rating = $favs->relationDoctor->relationwithReviewDoctor
                                                ->pluck('rating')
                                                ->filter()
                                                ->avg();
                                        @endphp

                                        <div class="rating">
                                            @if ($favs->relationDoctor->relationwithReviewDoctor->pluck('rating')->isEmpty())
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(0)</span>
                                            @else
                                                @for ($i = 0; $i < round($rating); $i++)
                                                    <i class="fas fa-star filled"> </i>
                                                @endfor
                                                <span
                                                    class="d-inline-block average-rating">({{ count($review->pluck('doctor_id')) }})</span>
                                            @endif

                                        </div>
                                        <ul class="available-info">
                                            <li>
                                                <i
                                                    class="fas fa-map-marker-alt"></i>{{ $favs->relationDoctor->hospital_address }}
                                            </li>
                                            <li>
                                                <i class="far fa-clock"></i>Available on
                                                {{ $favs->relationDoctor->relationwithUser->relationwithTime->day }}
                                            </li>
                                            <li>
                                                <i class="far fa-money-bill-alt"></i> {{ $favs->relationDoctor->price }} <i
                                                    class="fas fa-info-circle" data-toggle="tooltip"
                                                    title="Lorem Ipsum"></i>
                                            </li>
                                        </ul>
                                        <div class="row row-sm">
                                            <div class="col-6">
                                                <a href="{{ route('doctor.profile', $favs->relationDoctor->id) }}"
                                                    class="btn view-btn">View Profile</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('doctor.book.now', $favs->relationDoctor->id) }}"
                                                    class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
            @endsection
