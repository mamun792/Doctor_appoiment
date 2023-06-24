@extends('layouts.fonend_master')
@section('content')


    <div class="col-md-7 col-lg-8 col-xl-8 m-5">


        <div class="row row-grid">
            @if ($tab->count() == 0)
            <div class="container mt-5">
                <div id="data-not-found" class="container text-center bg-light p-4">
                    <h3 class="text-danger">Data Not Found</h3>
                    <p class="text-muted">Sorry, the requested data could not be found.</p>

                    <a href="{{route('index')}}" class="btn btn-primary">Go back</a>
                  </div>
              </div>
            @else
                @foreach ($tab as $favs)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="profile-widget">
                            <div class="doc-img">
                                <a href="doctor-profile.html">
                                    <img class="img-fluid" alt="User Image"
                                        src="{{ asset('uploads/doctor_themble_photo') }}/{{ $favs->doctor_themble_photo }}">
                                </a>

                            </div>
                            <div class="pro-content">
                                <h3 class="title">
                                    <a href="doctor-profile.html">{{ $favs->fname }} {{ $favs->lname }}</a>
                                    <i class="fas fa-check-circle verified"></i>
                                </h3>
                                <h5>{{  $favs->hospital_name }}</h5>
                                <p class="speciality">
                                    {{ $favs->relationwithspeclist->special }}</p>

                                @php
                                    $rr = $favs->relationwithReviewDoctor
                                        ->pluck('rating')
                                        ->filter()
                                        ->avg();
                                @endphp
                                <div class="rating">


                                    @if ($favs->relationwithReviewDoctor->pluck('rating')->isEmpty())
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">(0)</span>
                                    @else
                                        @for ($i = 0; $i < round($rr); $i++)
                                            <i class="fas fa-star filled"> </i>
                                        @endfor
                                        <span class="d-inline-block average-rating">(4)</span>
                                        {{-- <span class="d-inline-block average-rating">({{ count($review) }})</span> --}}
                                    @endif

                                    <span class="d-inline-block average-rating">(4)</span>
                                </div>
                                <ul class="available-info">
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>{{ $favs->hospital_address }}
                                    </li>
                                    <li>
                                        <i class="far fa-clock"></i> Available on
                                        {{-- {{ $favs->relationwithUser->relationwithTime->day }} --}}
                                        {{-- @if ($review_count == '0') --}}
                                        {{-- @else --}}
                                            @if ($favs->relationwithUser && $favs->relationwithUser->relationwithTime)
                                                {{ $favs->relationwithUser->relationwithTime->day }}
                                            @endif
                                        {{-- @endif --}}
                                    </li>
                                    <li>
                                        <i class="far fa-money-bill-alt"></i> {{ $favs->price }} <i
                                            class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
                                    </li>
                                </ul>
                                <div class="row row-sm">
                                    <div class="col-6">
                                        <a href="{{ route('doctor.profile', $favs->id) }}" class="btn view-btn">View
                                            Profile</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('doctor.book.now', $favs->id) }}" class="btn book-btn">Book
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
        </div>
    </div>

@endsection
