@extends('layouts.fonend_master')
@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Checkout</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <!-- Checkout Form -->
                            <form method="POST" action="{{ route('add.adderess') }}">
                                @csrf
                                <!-- Personal Information -->



                                <div class="info-widget">
                                    <h4 class="card-title">Personal Information</h4>
                                    <div class="row">
                                        @if ($profile_adde == 0)
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>First Name</label>
                                                    <input class="form-control" type="text" name="fname">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>Last Name</label>
                                                    <input class="form-control" type="text" name="lname">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>Email</label>
                                                    <input class="form-control" type="email" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>Phone</label>
                                                    <input class="form-control" type="text" name="phone_number">
                                                </div>
                                            </div>
                                    </div>
                                @else
                                    @foreach ($address as $addres)
                                        <input class="form-control" type="hidden" value="{{ $addres->id }}"
                                            name="p_id">


                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>First Name</label>
                                                <input class="form-control" type="text" value="{{ $addres->fname }}"
                                                    name="fname">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Last Name</label>
                                                <input class="form-control" type="text" value="{{ $addres->lname }}"
                                                    name="lname">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Email</label>
                                                <input class="form-control" type="email" value="{{ $addres->email }}"
                                                    name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Phone</label>
                                                <input class="form-control" type="text"
                                                    value="{{ $addres->phone_number }}" name="phone_number">
                                            </div>
                                        </div>
                                </div>
                                @endforeach
                                @endif

                        </div>

                        <!-- /Personal Information -->




                        {{-- <!-- Terms Accept -->
                        <div class="terms-accept">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="terms_accept">
                                <label for="terms_accept">I have read and accept <a href="#">Terms &amp;
                                        Conditions</a></label>
                            </div>
                        </div>
                        <!-- /Terms Accept --> --}}





                        <div class="submit-section mt-4">
                            <button type="submit" class="btn btn-primary submit-btn">Confirm Adderss</button>
                        </div>

                        <!-- /Submit Section -->


                        </form>
                        <!-- /Checkout Form -->

                    </div>
                </div>

            </div>

            <div class="col-md-5 col-lg-4 theiaStickySidebar">

                <!-- Booking Summary -->
                <div class="card booking-card">
                    <div class="card-header">
                        <h4 class="card-title">Booking Summary</h4>
                    </div>
                    <div class="card-body">

                        <!-- Booking Doctor Info -->
                        <div class="booking-doc-info">
                            <a href="doctor-profile.html" class="booking-doc-img">
                                <img src="{{ asset('uploads/doctor_themble_photo') }}/{{ $doctor->doctor_themble_photo }}"
                                    alt="User Image">
                            </a>
                            <div class="booking-info">
                                <h4><a href="doctor-profile.html">{{ $doctor->fname }}{{ $doctor->lname }}</a></h4>
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating">35</span>
                                </div>
                                <div class="clinic-details">
                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i>{{ $doctor->city }},
                                        {{ $doctor->locations }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Booking Doctor Info -->

                        <div class="booking-summary">
                            <div class="booking-item-wrap">
                                <ul class="booking-date">
                                    <li>Date <span>{{ $date }}</span>
                                        {{ session()->put('datess', $date) }}
                                        {{ session()->put('d_id', $doctor->id) }}
                                    </li>

                                    <li>Time <span>{{ $datapase }}</span>
                                        {{ session()->put('time', $datapase) }}
                                    </li>
                                </ul>
                                <ul class="booking-fee">
                                    <li>Consulting Fee <span>{{ $doctor->price }}

                                        </span></li>
                                    <li>Booking Fee <span>50</span></li>
                                    {{-- <li>Video Call <span>$50</span></li> --}}
                                </ul>
                                <div class="booking-total">
                                    <ul class="booking-total-list">
                                        <li>
                                            <span>Total</span>
                                            <span class="total-cost">{{ $doctor->price + 50 }}
                                                {{ session()->put('price', $doctor->price + 50) }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Booking Summary -->

            </div>
        </div>

    </div>

    </div>
@endsection
