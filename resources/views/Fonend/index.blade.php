@extends('layouts.fonend_master')
@section('content')
    <div class="d-flex flex-row bd-highlight mb-2">
        <div class="p-2 bd-highlight">
            <div class="search-box">
                {{-- <div class="banner-img aos" data-aos="fade-up"> --}}
                <img src="{{ asset('frontend_assets/img/icons/banner-img.png') }}" class="img-fluid mamun" alt>


                <div class="banner-img1">
                    <img src="{{ asset('frontend_assets/img/icons/banner-img1.png') }}" class="img-fluid" alt>
                </div>

                <div class="banner-img3">
                    <img src="{{ asset('frontend_assets/img/icons/banner-img3.png') }}" class="img-fluid" alt>
                </div>





            </div>




        </div>
        <div class="p-5 bd-highlight mt-5">
            <h1>Search Doctor, Make an Appointment</h1>
            <p>Discover the best doctors, clinic & hospital the city nearest to you.</p>

            <form action="{{ route('searc') }}" method="GET">



                <div class="form-group">
                    <select id="specialist-select" class="form-select form-control">
                        <option value="">Specialist</option>
                        @foreach ($specilest as $specilests)
                            <option value="{{ $specilests->id }}">{{ $specilests->special }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group search-info ms-2">
                    <input type="text" class="form-control" name="search_m" id="searchs"
                        placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
                    @error('search_m')
                        <span class="text-danger ">{{ $message }}</span>
                    @enderror
                    <br>
                    <span class="form-text">Ex : Dental or Sugar Check up etc</span>

                </div>
                <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i>
                    <span>Search</span></button>


            </form>



            <div id="doctor-list">
                <!-- Doctors will be dynamically displayed here -->
            </div>




        </div>

    </div>




    <!-- Clinic and Specialities -->
    <section class="section section-specialities">
        <div class="container-fluid">
            <div class="section-header text-center">

                <h2>Clinic and Specialities</h2>
                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">

                    <div class="specialities-slider slider">
                        @foreach ($specilest as $specilests)

                            <div class="speicality-item text-center">
                                <div class="speicality-img">
                                    <img src="{{ asset('uploads/special_photp/') }}/{{ $specilests->category_photo }}"
                                        class="img-fluid" alt="Speciality">
                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                </div>
                                <p>{{ $specilests->special }}</p>
                            </div>

                        @endforeach


                    </div>


                </div>
            </div>
        </div>
    </section>



    <section class="section section-doctor">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header ">
                        <h2>Book Our Doctor</h2>
                        <p>Lorem Ipsum is simply dummy text </p>
                    </div>


                    <div class="about-content">
                        @if ($aboutContent instanceof App\Models\AboutContent)
                            <div class="about-item">
                                <p class="content">{{ $aboutContent->content }}</p>
                                <p class="additional-sentences" style="display: none;">Additional content goes here...</p>
                                <a href="javascript:;" class="read-more">Read More..</a>

                            </div>
                        @else
                            <p>No content available.</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="doctor-slider slider">

                        @foreach ($doctor as $doctors)
                            <div class="profile-widget">

                                <div class="doc-img">
                                    <a href="{{ route('doctor.profile', $doctors->id) }}">
                                        <img class="img-fluid" alt="User Image"
                                            src="{{ asset('uploads/doctor_themble_photo') }}/{{ $doctors->doctor_themble_photo }}">
                                    </a>

                                    @auth()
                                        @if (App\Models\Favourit::where(['user_id' => auth()->id(), 'doctor_id' => $doctors->id])->exists())
                                            <i class="far bg-danger fa-bookmark fav-btn"></i>
                                        @else
                                            <a href="{{ route('add.favourite', $doctors->id) }}" class="fav-btn">
                                                <i class="far fa-bookmark"></i>

                                            </a>
                                        @endif
                                    @endauth

                                </div>


                                <div class="pro-content">

                                    <h3 class="title">
                                        <a href="{{ route('doctor.profile', $doctors->id) }}">{{ $doctors->fname }}
                                            {{ $doctors->lname }}</a>
                                        <i class="fas fa-check-circle verified"></i>
                                    </h3>
                                    <h5>{{ $doctors->hospital_name }}</h5>
                                    <div class="rating">
                                        <p class="doc-department"><img
                                                src="{{ asset('uploads/special_photp/') }}/{{ $doctors->relationwithspeclist->category_photo }}"
                                                class="img-fluid"
                                                alt="Speciality">{{ $doctors->relationwithspeclist->special }}</p>




                                        @php
                                            $rr = $doctors->relationwithReviewDoctor
                                                ->pluck('rating')
                                                ->filter()
                                                ->avg();
                                        @endphp

                                        @if ($doctors->relationwithReviewDoctor->pluck('rating')->isEmpty())
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
                                            <span class="d-inline-block average-rating">
                                                @if ($review_count == '0')
                                                @else
                                                    ({{ count($review) }})
                                                @endif

                                            </span>
                                        @endif


                                    </div>



                                    <ul class="available-info">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>{{ $doctors->city }}
                                        </li>
                                        <li>



                                            <i class="far fa-clock"></i> Available on
                                            @if ($review_count == '0')
                                            @else
                                                @if ($doctors->relationwithUser && $doctors->relationwithUser->relationwithTime)
                                                    {{ $doctors->relationwithUser->relationwithTime->day }}
                                                @endif
                                            @endif



                                        </li>
                                        <li>
                                            <i class="far fa-money-bill-alt"></i>{{ $doctors->price }}
                                            <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
                                        </li>
                                    </ul>
                                    <div class="row row-sm">
                                        <div class="col-6">
                                            <a href="{{ route('doctor.profile', $doctors->id) }}" class="btn view-btn">View
                                                Profile</a>
                                        </div>
                                        @auth()
                                            <div class="col-6">
                                                <a href="{{ route('doctor.book.now', $doctors->id) }}"
                                                    class="btn book-btn">Book
                                                    Now</a>


                                            </div>
                                        @else
                                            <div class="col-6">


                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#staticBackdrop">
                                                    Book Now
                                                </button>
                                            </div>
                                        @endauth

                                    </div>

                                </div>

                            </div>
                        @endforeach





                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scpritss')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            // Event handler for select menu change
            $('#specialist-select').on('change', function() {
                var specialistId = $(this).val(); // Get the selected specialist ID
                fetchDoctors(specialistId); // Fetch doctors based on the selected specialist
            });

            // Function to fetch and display doctors based on the selected specialist
            function fetchDoctors(specialistId) {

                $('#doctor-list').empty();

                // Send AJAX request to fetch doctors
                axios.get('{{ route('getDoctors') }}/' + specialistId)
                    .then(function(response) {
                        var doctors = response.data;

                        if (doctors.length > 0) {
                            // Generate HTML for each doctor

                            var doctorHtml = doctors.map(function(doctor) {

                                return `



                                   <div class="col-md-6 col-lg-6 col-xl-6">

                                     <div class="profile-widget">
                                            <!-- Doctor's image -->
                                            <div class="doc-img">
                                                <a href="">
                                                    <img class="img-fluid" alt="User Image" src="{{ asset('uploads/doctor_themble_photo') }}/${doctor.doctor_themble_photo}">
                                                </a>
                                            </div>
                                            <div class="pro-content">
                                                <!-- Doctor's name -->

                                                <h3 class="title">
                                                    <a href="{{ route('doctor.profile', $doctors->id) }}">${ doctor.fname } ${doctor.lname }</a>
                                                    <i class="fas fa-check-circle verified"></i>
                                                </h3>


                                                <h5>${doctor.hospital_name}</h5>
                                                <!-- Specialty -->

                                                <div class="row row-sm">
                                                    <div class="col-6">
                                                        <a href="{{ route('doctor.profile', $doctors->id) }}" class="btn view-btn">View Profile</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="{{ route('doctor.book.now', $doctors->id) }}" class="btn book-btn">Book Now</a>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        </div>
                                    </div>

                             </div>

                                `;




                            }).join('');


                            $('#doctor-list').append(doctorHtml);
                        } else {
                            // No doctors found
                            $('#doctor-list').html('<p>No doctors found.</p>');
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        });


        // Get all the read more links
        var readMoreLinks = document.querySelectorAll('.read-more');

        // Add click event listener to each read more link
        readMoreLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                var parent = this.parentNode; // Use parentNode instead of closest('.about-item')
                var content = parent.querySelector('.content');
                var additionalSentences = parent.querySelector('.additional-sentences');

                // Toggle visibility of additional sentences
                if (additionalSentences.style.display === 'none') {
                    additionalSentences.style.display = 'block';
                    this.textContent = 'Read Less';
                } else {
                    additionalSentences.style.display = 'none';
                    this.textContent = 'Read More..';
                }
            });
        });



//search
var delayTimer;

$(document).ready(function() {
    $('#searchs').typeahead({
        source: function(query, process) {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                $.get('{{ route("autocomplete") }}', { query: query }, function(data) {
                    process(data);
                });
            }, 500);
        },
        updater: function(item) {
            var selectedDoctor = item; // Assuming the item is the doctor's name

            // Find the doctor's ID based on the selected name
            var doctorId = doctors.find(function(doctor) {
                return doctor.fname === selectedDoctor;
            }).id;

            // Redirect to the doctor's profile page based on the selected item
            var url = "{{ route('doctor.profile', ':id') }}";
            url = url.replace(':id', doctorId);
            window.location.href = url;

            return item;
        }
    });
});


// $(document).ready(function() {
//     $('#searchs').typeahead({
//         source: function(query, process) {
//             clearTimeout(delayTimer);
//             delayTimer = setTimeout(function() {
//                 $.get('{{ route("autocomplete") }}', { query: query }, function(data) {
//                     process(data);
//                 });
//             }, 500);
//         },
//         updater: function(item) {
//             var selectedDoctor = item; // Assuming the item is the doctor's name

//             // Find the doctor's ID based on the selected name
//             var doctorId = doctors.find(function(doctor) {
//                 return doctor.fname === selectedDoctor;
//             }).id;

//             // Redirect to the doctor's profile page based on the selected item
//             var url = "{{ route('doctor.profile', ':id') }}";
//             url = url.replace(':id', doctorId);
//             window.location.href = url;

//             return item;
//         }
//     });
// });





    </script>
@endsection


<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Login Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('custom.login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email">

                    </div>
                    <label for="exampleInputPassword1">Password</label>
                    <div class="input-group form-group">
                        <input type="password" name="password" placeholder="Password" id="password"
                            class="form-control   @error('password') is-invalid @enderror">




                        <div class="input-group-append" onclick="myFunction()">

                            <span class="input-group-text">

                                <i class="fa fa-eye"></i>

                            </span>

                        </div>

                        <script>
                            function myFunction() {
                                var x = document.getElementById("password");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                        </script>


                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                    <br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>

        </div>
    </div>
</div>
