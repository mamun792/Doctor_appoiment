@extends('layouts.doctor_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Change Password</h2>
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


            </div>
        </div>

    </div>
@endsection

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
