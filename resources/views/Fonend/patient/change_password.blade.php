@extends('layouts.profile_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">



                            <li class="breadcrumb-item "><a href="{{ route('index') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>

                    <h2 class="breadcrumb-title">Change Password</h2>


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
                                        <li>
                                            <a href="{{ route('patient.dashboard') }}">
                                                <i class="fas fa-columns"></i>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('favourit.details') }}">
                                                <i class="fas fa-bookmark"></i>
                                                <span>Favourites</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.record', auth()->user()->id) }}">
                                                <i class="fas fa-clipboard"></i>
                                                <span>Add Medical Records</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.deatiles', auth()->user()->id) }}">
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
                                            <a href="chat.html">
                                                <i class="fas fa-comments"></i>
                                                <span>Message</span>
                                                <small class="unread-msg">23</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.details', auth()->user()->id) }}">
                                                <i class="fas fa-user-cog"></i>
                                                <span>Profile Settings</span>
                                            </a>
                                        </li>
                                        <li class="active">
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
                    <div class="card">
                        <div class="card-body">


                                <div class="col-md-7 col-lg-8 col-xl-9">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (session('update'))
                                                <div class="alert alert-success">
                                                    {{ session('update') }}
                                                </div>
                                            @endif

                                            @if (session('passS'))
                                                <div class="alert alert-success">
                                                    {{ session('passS') }}
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-12 col-lg-9">

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
                                    </div>
                                </div


                            {{-- </div>
                        </div> --}}


                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-9">
                                            <h1 class="m-t-3">Change Information</h1>
                                            <form method="POST" action="{{ route('change.information') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label> Profile Photo</label>
                                                    <div class="mb-4">
                                                        @if (auth()->user()->profile_photo)
                                                            <img class="rounded-circle" width="100" height="100"
                                                                src="{{ asset('uploads/profile_photo/') }}/{{ auth()->user()->profile_photo }}"
                                                                width="50" alt="user">
                                                        @else
                                                            <img class="rounded-circle ml-3"
                                                                src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                                                width="45">
                                                        @endif
                                                    </div>
                                                    <input type="file" class="form-control" name="profile_photo"
                                                        onchange="readURL(this)" ;>

                                                    @error('profile_photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ auth()->user()->name }}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ auth()->user()->email }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block">Update
                                                    Information</button>


                                            </form>
                                            <!-- /Change Password Form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection

            @section('footer_scprit')

            <script>
                // Show/hide password
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
