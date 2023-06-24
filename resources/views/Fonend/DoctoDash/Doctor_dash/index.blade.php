@extends('layouts.doctor_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Profile Settings</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

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
                                    <li >
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
                                        <a href="{{route('doctor.patient.invoices.list')}}">
                                            <i class="fas fa-file-invoice"></i>
                                            <span>Invoices</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('doctor.patient.review')}}">
                                            <i class="fas fa-star"></i>
                                            <span>Reviews</span>
                                        </a>
                                    </li>

                                    <li class="active">
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


                </div>




                <div class="col-md-7 col-lg-8 col-xl-9">



                        @if (auth()->user()->role !== 'doctor')
                            <div class="row form-row">

                                <div class="col-12 col-md-12">
                                    <div class="profile-header">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto profile-image">
                                                        @if (auth()->user()->profile_photo)
                                                            <img class="rounded "
                                                                src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                                                height="100" width="100" alt="user">
                                                        @else
                                                            <img class="rounded-circle "
                                                                src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                                                height="100" width="100">
                                                        @endif
                                                    </div>
                                                    <div class="col ml-md-n2 profile-user-info mb-2">
                                                        <h4 class="user-name mb-0">Name:</h4>
                                                        <h6 class="text-muted">Email:</h6>
                                                        <div class="user-Location"><i class="fa fa-map-marker"></i> Address
                                                        </div>
                                                        <div class="about-text"> .....</div>
                                                    </div>

                                                    <div class="col-auto profile-btn">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-menu mt-3">
                                        <div class="card ">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-tabs-solid">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab"
                                                            href="#per_details_tab">About</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#password_tab">Password</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>


                                <div class="col-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                                <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i
                                                        class="fa fa-edit mr-1"></i>Edit</a>
                                            </h5>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Fist Name: ...
                                                </p>
                                                <p class="col-sm-10"></p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Last Name: ...
                                                </p>
                                                <p class="col-sm-10"></p>
                                            </div>

                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Gender: ...</p>
                                                <p class="col-sm-10"></p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth:
                                                    ...</p>
                                                <p class="col-sm-10"></p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Spelist: ...</p>
                                                <p class="col-sm-10"></p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID: ...
                                                </p>
                                                <p class="col-sm-10"></p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile: ....</p>
                                                <p class="col-sm-10"></p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0">Address: ....</p>
                                                <p class="col-sm-10 mb-0">
                                            </div>

                                        </div>
                                    </div>
                                @else
                                    <div class="profile-header">
                                        <div class="card ">
                                            <div class="card-body">
                                                @foreach ($profile_det as $profile_dets)
                                                    <div class="row align-items-center">


                                                        <div class="col-auto profile-image">
                                                            <a href="#">
                                                                @if (auth()->user()->profile_photo)
                                                                    <img class="rounded "
                                                                        src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                                                        height="100" width="100" alt="user">
                                                                @else
                                                                    <img class="rounded"
                                                                        src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                                                        height="100" width="100">
                                                                @endif

                                                            </a>
                                                        </div>
                                                        <div class="col ml-md-n2 profile-user-info">
                                                            <h4 class="user-name mb-0">{{ auth()->user()->name }}</h4>
                                                            <h6 class="text-muted">{{ auth()->user()->email }}</h6>
                                                            <div class="user-Location"><i class="fa fa-map-marker"></i>
                                                                {{ $profile_dets->locations }}
                                                            </div>
                                                            <div class="about-text">{{ $profile_dets->about }}
                                                                <br>
                                                            </div>
                                                        </div>

                                                    </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="profile-menu">
                                                <ul class="nav nav-tabs nav-tabs-solid">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab"
                                                            href="#per_details_tab">About</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#password_tab">Password</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content profile-tab-cont">


                                        <div class="tab-pane fade show active" id="per_details_tab">


                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card mt-4">
                                                                <div class="card-body">
                                                                    <h5 class="card-title d-flex justify-content-between">
                                                                        <span>Personal Details</span>


                                                                        <button type="button" class="btn btn-primary"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalScrollable">
                                                                            <i class="fa fa-edit mr-1">Edit</i>
                                                                        </button>

                                                                    </h5>
                                                                    <div class="row">
                                                                        <p
                                                                            class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                                                            Fist Name</p>
                                                                        <p class="col-sm-10">{{ $profile_dets->fname }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p
                                                                            class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                                                            Last Name</p>
                                                                        <p class="col-sm-10">{{ $profile_dets->lname }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p
                                                                            class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                                                            Gender</p>
                                                                        <p class="col-sm-10">{{ $profile_dets->gender }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p
                                                                            class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                                                            Date of Birth
                                                                        </p>
                                                                        <p class="col-sm-10">
                                                                            {{ $profile_dets->date_of_birth }}</p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p
                                                                            class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                                                            Email ID</p>
                                                                        <p class="col-sm-10">{{ auth()->user()->email }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p
                                                                            class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                                                            Mobile</p>
                                                                        <p class="col-sm-10">
                                                                            {{ $profile_dets->phone_number }}</p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p class="col-sm-2 text-muted text-sm-right mb-0">
                                                                            Address</p>
                                                                        <p class="col-sm-10 mb-0">
                                                                            {{ $profile_dets->locations }}</p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p class="col-sm-2 text-muted text-sm-right mb-0">
                                                                            Education</p>
                                                                        <p class="col-sm-10 mb-0">
                                                                            {{ $profile_dets->degree }}</p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p class="col-sm-2 text-muted text-sm-right mb-0">
                                                                            Specialization</p>
                                                                        <p class="col-sm-10 mb-0">
                                                                            {{ $profile_dets->relationwithspeclist->special }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p class="col-sm-2 text-muted text-sm-right mb-0">
                                                                            Hospital Name</p>
                                                                        <p class="col-sm-10 mb-0">
                                                                            {{ $profile_dets->hospital_name }}</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>


                                        </div>

                                        <div id="password_tab" class="tab-pane fade">

                                            <div class="card">
                                                <div class="card-body">



                                                        <form method="POST" action="{{ route('change.password') }}">
                                                            @csrf

                                                            <div class="form-group">
                                                                <label>Current Password</label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                                        id="current_password" name="current_password" placeholder="Current Password">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary toggle-password" type="button" toggle="#current_password">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                @error('current_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                @if (session('pass'))
                                                                    <span class="text-danger">{{ session('pass') }}</span>
                                                                @endif
                                                            </div>



                                                            <div class="form-group">
                                                                <label>New Password</label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                                        id="new_password" name="password" placeholder="New Password">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary toggle-password" type="button" toggle="#new_password">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                @error('password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Confirm Password</label>
                                                                <div class="input-group">
                                                                    <input type="password"
                                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                        id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary toggle-password" type="button" toggle="#confirm_password">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                @error('password_confirmation')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                <span id="password-match-error" class="text-danger"></span>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                                                        </form>
                                                    </div>


                                            </div>
                                        </div>
                                        <!-- /Change Password Tab -->

                                    </div>
                        @endforeach
                        @endif

                    </div>






                </div>


            </div>


        </div>
    </div>
    </div>


@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('doctorDetailes.update', $profile_dets->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <div class="row form-row">
                        <div class="col-md-12">


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                    value="{{ $profile_dets->fname }}" name="fname">
                                @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ $profile_dets->lname }}"
                                    name="lname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" value="{{ $profile_dets->phone_number }}"
                                    name="phone_number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control"
                                    value="{{ $profile_dets->date_of_birth }}" name="date_of_birth">

                            </div>
                        </div>
                    </div>


                    <!-- /Basic Information -->

                    <!-- About Me -->

                    <div class="card-body">
                        <h4 class="card-title">About Me</h4>
                        <div class="form-group mb-0">
                            <label>Biography</label>
                            <textarea class="form-control" name="about" rows="5">{{ $profile_dets->about }}</textarea>
                        </div>
                    </div>

                    <!-- /About Me -->

                    <!-- Clinic Info -->


                    <h4 class="card-title">Clinic Info</h4>
                    <div class="row form-row">



                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Clinic Address</label>
                                <input type="text" class="form-control"
                                    value="{{ $profile_dets->hospital_address }}" name="hospital_address">
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Doctor Themble Photo <span class="text-danger">*</span> </label>

                                <style>
                                    .hidden {
                                        visibility: hidden;
                                    }
                                </style>
                                <input type="file" class="form-control" name="doctor_themble_photo"
                                    onchange="readURL(this)" ;>
                                <img class="hidden mt-3" id="category_photo_viewer" src="#"
                                    alt="your image" />
                                <script>
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function(e) {
                                                $('#category_photo_viewer').attr('src', e.target.result).width(150).height(195);
                                            };
                                            $('#category_photo_viewer').removeClass('hidden');
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                                @error('doctor_themble_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- --}}
                        </div>

                    </div>

                    <!-- /Clinic Info -->

                    <!-- Contact Details -->

                    <div class="card-body">
                        <h4 class="card-title">Contact Details</h4>
                        <div class="row form-row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" class="form-control" value="{{ $profile_dets->city }}"
                                        name="city">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <input type="text" class="form-control"
                                        value="{{ $profile_dets->locations }}" name="locations">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- /Contact Details -->

                    <!-- Pricing -->

                    <!-- /Pricing -->



                    <!-- Education -->

                    <div class="card-body">
                        <h4 class="card-title">Education</h4>
                        <div class="education-info">
                            <div class="row form-row education-cont">
                                <div class="col-12 col-md-10 col-lg-11">
                                    <div class="row form-row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>Degree</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $profile_dets->degree }}" name="degree">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5 col-lg-3">
                                            <div class="form-group">
                                                <label>College</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $profile_dets->college }}" name="college">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5 col-lg-5">
                                            <div class="form-group">
                                                <label>Year of Completion</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $profile_dets->year_of_completion }}"
                                                    name="year_of_completion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /Education -->



                    <!-- Awards -->

                    <div class="card-body">
                        <h4 class="card-title">Awards</h4>
                        <div class="awards-info">
                            <div class="row form-row awards-cont">
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label>Awards</label>
                                        <input type="text" class="form-control"
                                            value="{{ $profile_dets->dwards }}" name="dwards">
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <input type="text" class="form-control" value="{{ $profile_dets->year }}"
                                            name="year">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /Awards -->





                    <div class="submit-section submit-btn-bottom">
                        <button type="submit" class="btn btn-primary submit-btn">Update Profile</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


@section('footer_scprits')


<script>
 const togglePassword = document.querySelectorAll('.toggle-password');
                togglePassword.forEach(button => {
                    button.addEventListener('click', function () {
                        const passwordInput = document.querySelector(this.getAttribute('toggle'));
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            this.querySelector('i').classList.remove('fa-eye');
                            this.querySelector('i').classList.add('fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            this.querySelector('i').classList.remove('fa-eye-slash');
                            this.querySelector('i').classList.add('fa-eye');
                        }
                    });
                });

                // Password match validation
                const newPasswordInput = document.getElementById('new_password');
                const confirmPasswordInput = document.getElementById('confirm_password');
                const passwordMatchError = document.getElementById('password-match-error');

                confirmPasswordInput.addEventListener('input', function () {
                    if (newPasswordInput.value !== confirmPasswordInput.value) {
                        passwordMatchError.textContent = 'Passwords do not match';
                    } else {
                        passwordMatchError.textContent = '';
                    }
                });

    </script>

@endsection
