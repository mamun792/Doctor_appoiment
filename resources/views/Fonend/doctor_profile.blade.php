@extends('layouts.fonend_master')
@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor Profile</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Doctor Widget -->
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{ asset('uploads/doctor_themble_photo') }}/{{ $doctor->doctor_themble_photo }}"
                                    class="img-fluid" alt="User Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">{{ $doctor->fname }} {{ $doctor->lname }}</h4>

                                <p class="doc-speciality">{{ $doctor->degree }} </p>
                                <p>{{ $doctor->hospital_name  }}</p>
                                <p class="doc-department"><img
                                        src="{{ asset('uploads/special_photp/') }}/{{ $doctor->relationwithspeclist->category_photo }}"
                                        class="img-fluid" alt="Speciality">{{ $doctor->relationwithspeclist->special }}</p>

                                @if ($review->pluck('rating')->isEmpty())
                                <div class="rating">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    <span class="d-inline-block average-rating">(0)</span>
                                </div>
                                @else
                                    <div class="rating">
                                        @for ($i = 0; $i < round($review->avg('rating')); $i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                        <span class="d-inline-block average-rating">({{ count($review) }})</span>
                                    </div>
                                @endif



                                <div class="clinic-details">

                                            <div class="doc-location">
                                                <i class="fas fa-map-marker-alt"></i> {{ $doctor->hospital_name }} - <a href="https://www.google.com/maps?q={{ urlencode($doctor->hospital_address) }}">Get Directions</a>
                                            </div>
                                            <div class="clinic-gallery">
                                                <!-- Your clinic gallery content here -->
                                            </div>
                                            {{-- <div class="map-container">
                                                <iframe
                                                    width="100%"
                                                    height="400"
                                                    frameborder="0"
                                                    style="border:0"
                                                    src="https://www.google.com/maps/embed/v1/place?q={{ urlencode($doctor->hospital_address) }}&key=YOUR_API_KEY"
                                                    allowfullscreen
                                                ></iframe>
                                            </div> --}}


                                            <ul class="clinic-gallery">

                                    <ul class="clinic-gallery">
                                        @foreach ($fecture_photo as $fecture_photos)
                                            <li>
                                                <a href="#" data-fancybox="gallery">
                                                    <img
                                                        src="{{ asset('uploads/doctors_features_photos') }}/{{ $fecture_photos->featured_photos_name }}">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="clinic-services">
                                    <span>{{ $doctor->hospital_name }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>
                                    <li><i class="far fa-thumbs-up"></i> 99%</li>
                                    <li><i class="far fa-comment"></i> {{ count($review) }} Feedback</li>
                                    <li><i class="fas fa-map-marker-alt"></i> {{ $doctor->city }},
                                        {{ $doctor->locations }}</li>
                                    <li><i class="far fa-money-bill-alt"></i> {{ $doctor->price }} per appointment </li>
                                </ul>
                            </div>
                            <div class="doctor-action">
                                <a href="javascript:void(0)" class="btn btn-white fav-btn">
                                    <i class="far fa-bookmark"></i>
                                </a>
                                <a href="chat.html" class="btn btn-white msg-btn">
                                    <i class="far fa-comment-alt"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal"
                                    data-target="#voice_call">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal"
                                    data-target="#video_call">
                                    <i class="fas fa-video"></i>
                                </a>
                            </div>
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{ route('doctor.book.now', $doctor->id) }}">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <!-- Doctor Details Tab -->
            <div class="card">
                <div class="card-body pt-0">

                    <!-- Tab Menu -->
                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_locations" data-toggle="tab">Locations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /Tab Menu -->

                    <!-- Tab Content -->
                    <div class="tab-content pt-0">

                        <!-- Overview Content -->
                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">

                                    <!-- About Details -->
                                    <div class="widget about-widget">
                                        <h4 class="widget-title">About Me</h4>
                                        <p>{{ $doctor->about }}</p>
                                    </div>
                                    <!-- /About Details -->

                                    <!-- Education Details -->
                                    <div class="widget education-widget">
                                        <h4 class="widget-title">Education</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{ $doctor->college }}</a>
                                                            <div>{{ $doctor->degree }}</div>
                                                            <span class="time">{{ $doctor->year_of_completion }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{ $doctor->college }}</a>
                                                            <div>{{ $doctor->degree }}</div>
                                                            <span class="time">{{ $doctor->year_of_completion }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <!-- Awards Details -->
                                    <div class="widget awards-widget">
                                        <h4 class="widget-title">Awards</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">{{ $doctor->year }}</p>
                                                            <h4 class="exp-title">{{ $doctor->dwards }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">March 2011</p>
                                                            <h4 class="exp-title">Certificate for International Volunteer
                                                                Service</h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Proin a ipsum tellus. Interdum et malesuada fames ac ante
                                                                ipsum primis in faucibus.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">May 2008</p>
                                                            <h4 class="exp-title">The Dental Professional of The Year Award
                                                            </h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Proin a ipsum tellus. Interdum et malesuada fames ac ante
                                                                ipsum primis in faucibus.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->

                        <!-- Locations Content -->
                        <div role="tabpanel" id="doc_locations" class="tab-pane fade">

                            <!-- Location List -->
                            <div class="location-list">
                                <div class="row">

                                    <!-- Clinic Content -->
                                    <div class="col-md-6">
                                        <div class="clinic-content">
                                            <h4 class="clinic-name"><a href="#"> {{ $doctor->hospital_name }}</a>
                                            </h4>
                                            <p class="doc-speciality">{{ $doctor->relationwithspeclist->special }}</p>
                                            @if ($review->pluck('rating')->isEmpty())
                                            <div class="rating">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                                <span class="d-inline-block average-rating">(0)</span>
                                            </div>
                                            @else
                                                <div class="rating">
                                                    @for ($i = 0; $i < round($review->avg('rating')); $i++)
                                                        <i class="fas fa-star filled"></i>
                                                    @endfor
                                                    <span class="d-inline-block average-rating">({{ count($review) }})</span>
                                                </div>
                                            @endif

                                            <div class="clinic-details mb-0">


                                                    <div class="doc-location">
                                                        <i class="fas fa-map-marker-alt"></i>   {{ $doctor->hospital_address }} - <a href="https://www.google.com/maps?q={{ urlencode($doctor->hospital_address) }}">Get Directions</a>
                                                    </div>
                                                    <div class="clinic-gallery">
                                                        <!-- Your clinic gallery content here -->
                                                    </div>
                                                </h5>
                                                <ul>
                                                    @foreach ($fecture_photo as $fecture_photos)
                                                        <li>
                                                            <a href="#" data-fancybox="gallery">
                                                                <img
                                                                    src="{{ asset('uploads/doctors_features_photos') }}/{{ $fecture_photos->featured_photos_name }}">
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>
                        <!-- /Locations Content -->

                        <!-- Reviews Content -->
                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                            <!-- Review Listing -->
                            <div class="widget review-listing">

                                <div class="all-feedback text-center">
                                    <a href="#" class="btn btn-primary btn-sm">
                                        Show all feedback <strong>({{ count($review) }})</strong>
                                    </a>
                                </div>
                                <ul class="comments-list">
                                    @foreach ($review as $reviews)
                                        <!-- Comment List -->
                                        <li>
                                            <div class="comment">


                                                @if ($reviews->relationwithReview->profile_photo)
                                                    <img class="rounded-circle"
                                                        src="{{ asset('uploads/profile_photo/') }}/{{ $reviews->relationwithReview->profile_photo }}"
                                                        width="50" height="50" alt="user">
                                                @else
                                                    <img class="rounded-circle"
                                                        src="{{ Avatar::create($reviews->relationwithReview->name)->toBase64() }}"
                                                        width="50" height="50"
                                                        alt="{{ $reviews->relationwithReview->name }}">
                                                @endif


                                                <div class="comment-body">
                                                    <div class="meta-data">
                                                        <span
                                                            class="comment-author"></span>{{ $reviews->relationwithReview->name }}</span>
                                                        <span
                                                            class="comment-date">{{ $reviews->created_at->diffForHumans() }}</span>
                                                            @if ($review->pluck('rating')->isEmpty())
                                                            <div class="rating">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    <i class="fas fa-star"></i>
                                                                @endfor
                                                                <span class="d-inline-block average-rating">(0)</span>
                                                            </div>
                                                            @else
                                                                <div class="rating">
                                                                    @for ($i = 0; $i < round($review->avg('rating')); $i++)
                                                                        <i class="fas fa-star filled"></i>
                                                                    @endfor
                                                                    <span class="d-inline-block average-rating">({{ count($review) }})</span>
                                                                </div>
                                                            @endif
                                                    </div>
                                                    <p class="recommended"></i>{{ $reviews->title }}</p>
                                                    <p class="comment-content">
                                                        {{ $reviews->comment }}
                                                    </p>
                                                    {{-- <div class="comment-reply">
                                                        <a class="comment-btn" href="#">
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
                                                    </div> --}}
                                                </div>
                                            </div>



                                        </li>
                                    @endforeach

                                </ul>




                            </div>


                        </div>
                        <!-- /Reviews Content -->

                        <!-- Business Hours Content -->
                        <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">

                                    <!-- Business Hours Widget -->
                                    <div class="widget business-widget">
                                        <div class="widget-content">
                                            <div class="listing-hours">
                                                <div class="listing-day current">
                                                    <div class="day">Today <span>


                                                            {{ \Carbon\Carbon::now()->format('d M Y') }}

                                                        </span></div>




                                                    <div class="time-items">

                                                        <span class="open-status"><span
                                                                class="badge bg-success-light">Open Now</span></span>
                                                        <span
                                                            class="time">{{ $doctor->relationdoctor->first()->sart_time ?? 'No time select' }}
                                                            -
                                                            {{ $doctor->relationdoctor->first()->end_time ?? '' }}</span>


                                                    </div>
                                                </div>

                                                @foreach ($relationdoctor as $relationdoctors)
                                                    <div class="listing-day">
                                                        <div class="day">{{ $relationdoctors->day }} </div>
                                                        <div class="time-items">
                                                            <span class="time">{{ $relationdoctors->sart_time }} -
                                                                {{ $relationdoctors->end_time }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Business Hours Widget -->

                                </div>
                            </div>
                        </div>
                        <!-- /Business Hours Content -->

                    </div>
                </div>
            </div>
            <!-- /Doctor Details Tab -->





        </div>



    </div>
    <!-- /Page Content -->
    <section class="section section-specialities">
        <div class="container-fluid">
            <div class="row">
                <div class="section-header text-center">

                    <h2>Related Doctor ({{ $related_doctor->count() }})</h2>

                </div>

                <div class="col-lg-8">

                    <div class="doctor-slider slider">

                        @foreach ($related_doctor as $related_doctors)
                            <div class="profile-widget">

                                <div class="doc-img">
                                    <a href="{{ route('doctor.profile', $related_doctors->id) }}">
                                        <img class="img-fluid" alt="User Image"
                                            src="{{ asset('uploads/doctor_themble_photo') }}/{{ $related_doctors->doctor_themble_photo }}">

                                    </a>
                                    <a href="javascript:void(0)" class="fav-btn">
                                        <i class="far fa-bookmark"></i>
                                    </a>
                                </div>



                                <div class="pro-content">

                                    <h3 class="title">
                                        <a href="{{ route('doctor.profile', $related_doctors->id) }}">{{ $related_doctors->fname }}
                                            {{ $related_doctors->lname }}</a>
                                        <i class="fas fa-check-circle verified"></i>
                                    </h3>
                                    <p class="speciality">{{ $related_doctors->relationwithspeclist->special }}</p>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <span class="d-inline-block average-rating">(17)</span>
                                    </div>
                                    <ul class="available-info">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>{{ $related_doctors->city }}
                                        </li>
                                        <li>
                                            <i class="far fa-clock"></i> Available on Fri, 22 Mar
                                        </li>
                                        <li>
                                            <i class="far fa-money-bill-alt"></i>{{ $related_doctors->price }}
                                            <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
                                        </li>
                                    </ul>
                                    <div class="row row-sm">
                                        <div class="col-6">
                                            <a href="{{ route('doctor.profile', $related_doctors->id) }}"
                                                class="btn view-btn">View
                                                Profile</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="booking.html" class="btn book-btn">Book Now</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endforeach
                        <!-- /Doctor Widget -->



                        <!-- /Slider -->

                    </div>
                </div>
                {{--
        </div>

    </div> --}}
    </section>





    <!-- Doctor Widget -->
@endsection
