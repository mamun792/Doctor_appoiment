@extends('layouts.profile_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">



                            <li class="breadcrumb-item "><a href="{{ route('index') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>

                    <h2 class="breadcrumb-title">Dashboard</h2>


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
                                        <li class="active">
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

                    <form method="POST" action="{{ route('profile.details.update', $update->id) }}"
                        onsubmit="return validateForm();">
                        @csrf

                        <div class="row form-row">

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="fname" value="{{ $update->fname }}">
                                    @error('fname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="{{ $update->lname }}">
                                    @error('lname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>

                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ $update->date_of_birth }}" />

                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form">
                                    <label>Email ID</label>
                                    <input type="email" class="form-control" name="email" value="{{ $update->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <div class="input-group">
                                        <select class="form-control @error('country_code') is-invalid @enderror"
                                            id="country-code" name="country_code">
                                            <option value="+880">+880 (BD)</option>
                                            <!-- Add more country code options as needed -->
                                        </select>
                                        <input type="text" id="phone-number" name="phone_number"
                                            value="{{ $update->phone_number }}" placeholder="Phone Number"
                                            class="form-control @error('phone_number') is-invalid @enderror" />
                                    </div>
                                    <span id="phone-number-error" class="text-danger"></span>
                                </div>
                            </div>



                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text"
                                        class="form-control @error('city') is-invalid
          @enderror"
                                        value=" {{ $update->city }}" placeholder="City Name" name="city">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Zip Code</label>
                                    <input type="text" class="form-control" name="zip"
                                        value="{{ $update->zip }}">
                                    @error('zip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                                        value="{{ $update->country }}" placeholder="Country Name" name="country" />
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="adderss"
                                        value="{{ $update->adderss }}">
                                    @error('adderss')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>About <span class="text-danger">*</span> </label>
                                    <textarea class="form-control @error('about') is-invalid @enderror" rows="3" name="about">
                {{ $update->about }}</textarea>
                                    @error('about')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scprit')
    <script>
        function validateForm() {
            var countryCodeSelect = document.getElementById('country-code');
            var selectedOption = countryCodeSelect.value;

            if (selectedOption === '') {
                alert('Please select a country code.');
                return false;
            }

            var phoneNumberInput = document.getElementById('phone-number');
            var phoneNumber = phoneNumberInput.value;
            var countryCode = selectedOption;

            var phoneNumberError = document.getElementById('phone-number-error');

            // Clear previous error message
            phoneNumberError.textContent = '';

            // Check if the phone number is valid
            if (countryCode === '+880') { // Check for Bangladesh country code
                var pattern = /^\d{11}$/; // Assuming an 11-digit phone number format

                if (!pattern.test(phoneNumber)) {
                    phoneNumberError.textContent = 'Please enter a valid 11-digit phone number for Bangladesh (+880).';
                    return false; // Prevent form submission
                }

            }

            // Check for other form validation errors
            var otherErrors = document.getElementsByClassName('is-invalid');
            if (otherErrors.length > 0) {
                return false;
            }

            // Form validation passed
            return true;
        }
    </script>
@endsection
