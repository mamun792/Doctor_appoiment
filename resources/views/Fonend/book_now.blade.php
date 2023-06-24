@extends('layouts.fonend_master')
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Booking</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="doctor-profile.html" class="booking-doc-img">
                                    <img src="{{ asset('uploads/doctor_themble_photo') }}/{{ $doctor->doctor_themble_photo }}"
                                        alt="User Image">
                                </a>
                                <div class="booking-info">
                                    <h4><a href="{{ route('doctor.profile', $doctor->id) }}">{{ $doctor->fname }}
                                            {{ $doctor->lname }}</a></h4>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">35</span>
                                    </div>
                                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{ $doctor->city }},
                                        {{ $doctor->locations }}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <!-- Schedule Widget -->
                    <div class="card booking-schedule schedule-widget">
                        <form method="post" action="{{ route('patient.Check.out') }}">
                            @csrf

                            <!-- Schedule Header -->
                            <div class="schedule-header">
                                <div class="row">
                                    <div class="col-md-12">



                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">


                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active p-2 m-2" id="pills-h1-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-h1" type="button"
                                                    role="tab" aria-controls="pills-h1"
                                                    aria-selected="true">{{ $a0->format('D') }}
                                                    <h5>{{ $a0->format('d M Y') }}</h5>
                                                </button>
                                            </li>
                                            <li class="nav-item p-2 m-2" role="presentation">
                                                <button class="nav-link" id="pills-h2-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-h2" type="button" role="tab"
                                                    aria-controls="pills-h2" aria-selected="false">{{ $a1->format('D') }}
                                                    <h5>{{ $a1->format('d M Y') }}</h5>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link p-2 m-2" id="pills-h3-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-h3" type="button" role="tab"
                                                    aria-controls="pills-h3" aria-selected="false">{{ $a2->format('D') }}
                                                    <h5>{{ $a2->format('d M Y') }}</h5>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">

                                                <button class="nav-link p-2 m-2" id="pills-h4-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-h4" type="button" role="tab"
                                                    aria-controls="pills-h4" aria-selected="false">{{ $a3->format('D') }}
                                                    <h5>{{ $a3->format('d M Y') }}</h5>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">

                                                <button class="nav-link p-2 m-2" id="pills-h5-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-h5" type="button" role="tab"
                                                    aria-controls="pills-h5" aria-selected="false">{{ $a4->format('D') }}
                                                    <h5>{{ $a4->format('d M Y') }}</h5>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">

                                                <button class="nav-link p-2 m-2" id="pills-h6-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-h6" type="button" role="tab"
                                                    aria-controls="pills-h6" aria-selected="false">{{ $a5->format('D') }}
                                                    <h5>{{ $a5->format('d M Y') }}</h5>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">

                                                <button class="nav-link p-2 m-2" id="pills-h7-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-h7" type="button" role="tab"
                                                    aria-controls="pills-h7" aria-selected="false">{{ $a6->format('D') }}
                                                    <h5>{{ $a6->format('d M Y') }}</h5>
                                                </button>
                                            </li>






                                        </ul>


                                        <div class="tab-content" id="pills-tabContent">

                                                <div class="tab-pane fade show active" id="pills-h1" role="tabpanel"
                                                aria-labelledby="pills-h1-tab">


                                                @php
                                                    $aa0 = $a0->format('D');
                                                    $dat = $a0->format('l');
                                                    $date = $a0->format('d M Y');
                                                @endphp

                                                @if ($aa0 == $aa0)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="Date"
                                                            value="{{ $date }}" required>

                                                    </div>
                                                    @foreach ($time as $times)
                                                        @if ($times->day == $dat)
                                                            <div class="doc-times">
                                                                <input class="form-check-input p-2 ml-2" type="radio"
                                                                    name="time"
                                                                    value="{{ $times->sart_time }} - {{ $times->end_time }}"
                                                                    required>

                                                                <label class="btn btn-outline-success p-1 "
                                                                    for="success-outlined">{{ $times->sart_time }}-{{ $times->end_time }}</label>

                                                            </div>

                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="tab-pane fade " id="pills-h2" role="tabpanel"
                                                aria-labelledby="pills-h2-tab">

                                                @php
                                                    $aa1 = $a1->format('D');
                                                    $dat = $a1->format('l');
                                                    $date = $a1->format('d M Y');
                                                @endphp

                                                <div class="form-check">
                                                    <input class="form-check-input " type="radio" name="Date"
                                                        value="{{ $date }}" required>
                                                </div>
                                                @if ($aa1 == $aa1)
                                                    @foreach ($time as $times)
                                                        @if ($times->day == $dat)
                                                            <div class="doc-times">
                                                                <input class="form-check-input p-2 ml-2" type="radio"
                                                                    name="time"
                                                                    value="{{ $times->sart_time }} - {{ $times->end_time }}"
                                                                    required>

                                                                <label class="btn btn-outline-success p-1 "
                                                                    for="success-outlined">{{ $times->sart_time }}-{{ $times->end_time }}</label>

                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>

                                            <div class="tab-pane fade " id="pills-h3" role="tabpanel"
                                                aria-labelledby="pills-h3-tab">

                                                @php
                                                    $aa2 = $a2->format('D');
                                                    $dat = $a2->format('l');
                                                    $date = $a2->format('d M Y');

                                                @endphp

                                                @if ($aa2 == $aa2)
                                                    <div class="form-check">
                                                        <input class="form-check-input p-2 ml-2" type="radio"
                                                            name="Date" value="{{ $date }}" required>
                                                    </div>
                                                    @foreach ($time as $times)
                                                        @if ($times->day == $dat)
                                                            <div class="doc-times">
                                                                <input class="form-check-input p-2 ml-2" type="radio"
                                                                    name="time"
                                                                    value="{{ $times->sart_time }} - {{ $times->end_time }}"
                                                                    required>

                                                                <label class="btn btn-outline-success p-1 "
                                                                    for="success-outlined">{{ $times->sart_time }}-{{ $times->end_time }}</label>

                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>

                                            <div class="tab-pane fade " id="pills-h4" role="tabpanel"
                                                aria-labelledby="pills-h4-tab">

                                                @php
                                                    $aa3 = $a3->format('D');
                                                    $day = $a3->format('l');
                                                    $date = $a3->format('d M Y');

                                                @endphp

                                                @if ($aa3 == $aa3)
                                                    <div class="form-check">
                                                        <input class="form-check-input p-2 ml-2" type="radio"
                                                            name="Date" value="{{ $date }}" required>
                                                    </div>
                                                    @foreach ($time as $times)
                                                        @if ($times->day == $day)
                                                            <div class="doc-times">

                                                                <input class="form-check-input p-2 ml-2" type="radio"
                                                                    name="time"
                                                                    value="{{ $times->sart_time }} - {{ $times->end_time }}"
                                                                    required>

                                                                <label class="btn btn-outline-success p-1 "
                                                                    for="success-outlined">{{ $times->sart_time }}-{{ $times->end_time }}</label>

                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>

                                            <div class="tab-pane fade " id="pills-h5" role="tabpanel"
                                                aria-labelledby="pills-h5-tab">

                                                @php
                                                    $aa4 = $a4->format('D');
                                                    $day = $a4->format('l');
                                                    $date = $a4->format('d M Y');
                                                @endphp

                                                @if ($aa4 == $aa4)
                                                    <div class="form-check">
                                                        <input class="form-check-input p-2 ml-2" type="radio"
                                                            name="Date" value="{{ $date }}" required>
                                                    </div>
                                                    @foreach ($time as $times)
                                                        @if ($times->day == $day)
                                                            <div class="doc-times">
                                                                <input class="form-check-input p-2 ml-2" type="radio"
                                                                    name="time"
                                                                    value="{{ $times->sart_time }} - {{ $times->end_time }}"
                                                                    required>

                                                                <label class="btn btn-outline-success p-1 "
                                                                    for="success-outlined">{{ $times->sart_time }}-{{ $times->end_time }}</label>

                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>

                                            <div class="tab-pane fade " id="pills-h6" role="tabpanel"
                                                aria-labelledby="pills-h6-tab">

                                                @php
                                                    $aa5 = $a5->format('D');
                                                    $day = $a5->format('l');
                                                    $date = $a5->format('d M Y');
                                                @endphp

                                                @if ($aa5 == $aa5)
                                                    <div class="form-check">
                                                        <input class="form-check-input p-2 ml-2" type="radio"
                                                            name="Date" value="{{ $date }}" required>
                                                    </div>
                                                    @foreach ($time as $times)
                                                        @if ($times->day == $day)
                                                            <div class="doc-times">
                                                                <input class="form-check-input p-2 ml-2" type="radio"
                                                                    name="time"
                                                                    value="{{ $times->sart_time }} - {{ $times->end_time }}"
                                                                    required>

                                                                <label class="btn btn-outline-success p-1 "
                                                                    for="success-outlined">{{ $times->sart_time }}-{{ $times->end_time }}</label>

                                                            </div>

                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>

                                            <div class="tab-pane fade " id="pills-h7" role="tabpanel"
                                                aria-labelledby="pills-h7-tab">

                                                @php
                                                    $aa6 = $a6->format('D');
                                                    $day = $a6->format('l');
                                                    $date = $a6->format('d M Y');
                                                @endphp

                                                @if ($aa6 == $aa6)
                                                    <div class="form-check">
                                                        <input class="form-check-input p-2 ml-2" type="radio"
                                                            name="Date" value="{{ $date }}" required>
                                                    </div>

                                                    @foreach ($time as $times)
                                                        @if ($times->day == $day)
                                                            <div class="doc-times">
                                                                <input class="form-check-input p-2 ml-2" type="radio"
                                                                    name="time"
                                                                    value="{{ $times->sart_time }} - {{ $times->end_time }}"
                                                                    required>

                                                                <label class="btn btn-outline-success p-1 "
                                                                    for="success-outlined">{{ $times->sart_time }}-{{ $times->end_time }}</label>

                                                            </div>

                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="submit-section proceed-btn text-right">
                                    <button type="submit" name="id" class="btn btn-primary"
                                        value="{{ $doctor->id }}">Submit</button>
                                </div>
                            </div>



                        </form>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->


<script>
    function add_event_to_tab() {
        tabs = document.querySelectorAll("button.nav-link")
        for (let i = 0; i < tabs.length; i = i + 1) {
            tabs[i].addEventListener("click",addEvent(i))
        }
    }

    function addEvent(num) {
        func = () => {
            document.querySelectorAll("input[name='Date']")[num].checked = true;
        }
        return func
    }
    add_event_to_tab()
</script>

@endsection
