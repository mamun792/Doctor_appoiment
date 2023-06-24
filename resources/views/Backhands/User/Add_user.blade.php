@extends('layouts.dashboard_master')
@section('contant')
@if (session('adds'))
<div class="alert alert-success">
    {{ session('adds') }}
</div>
@endif
<h1 class="m-t-3">Add User</h1>

<form method="POST" action="{{ route('user.insert') }}" enctype="multipart/form-data">
    @csrf
    <div class="row form-row">
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>User Name</label>
                <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name"
                    placeholder=" Name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>User Email</label>
                <input type="email" class="form-control @error('email') is-invalid  @enderror" name="email"
                    placeholder="Email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Mobile</label>
                <div class="input-group">
                    <select class="form-control @error('country_code') is-invalid @enderror" id="country-code"
                        name="country_code">
                        <option value="+880">+880 (BD)</option>
                        <!-- Add more country code options as needed -->
                    </select>
                    <input type="text" id="phone-number" name="phone_number" value="{{ old('phone_number') }}"
                        placeholder="Phone Number" class="form-control @error('phone_number') is-invalid @enderror" />
                </div>
                <span id="phone-number-error" class="text-danger"></span>
            </div>
        </div>


        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Profile Photo</label>
                <style>
                    .hidden {
                        visibility: hidden;
                    }
                </style>
                <input type="file" class="form-control" name="profile_photo" onchange="readURL(this)" ;>

                <img class="hidden mt-3" id="profile_photo_viewer" src="#" alt="your profile photo" />

                <script>
                    function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#profile_photo_viewer').attr('src', e.target.result).width(150).height(195);
                                };
                                $('#profile_photo_viewer').removeClass('hidden');
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                </script>

                @error('profile_photo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Role</label>
                <select class="form-control  @error('role') is-invalid  @enderror" name="role">
                    <option>--Select one Role--</option>
                    @if (auth()->user()->role == 'vendor')
                    <option value="doctor">Doctors</option>
                    <option value="appointment_assistance">appointment assistant</option>
                    @else
                    <option value="admin">Admin</option>
                    <option value="vendor">Vendor</option>

                    @endif
                    {{-- <option value="vendor">Vendor</option>
                    --}}

                </select>
                @error('role')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Add Users</button>
</form>
@endsection
@section('footer_scprit')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function validateForm() {
            var countryCodeSelect = $('#country-code');
            var selectedOption = countryCodeSelect.val();

            if (selectedOption === '') {
                alert('Please select a country code.');
                return false;
            }

            var phoneNumberInput = $('#phone-number');
            var phoneNumber = phoneNumberInput.val();
            var countryCode = selectedOption;

            var phoneNumberError = $('#phone-number-error');

            // Clear previous error message
            phoneNumberError.text('');

            // Check if the phone number is valid
            if (countryCode === '+880') { // Check for Bangladesh country code
                var pattern = /^\d{11}$/; // Assuming an 11-digit phone number format

                if (!pattern.test(phoneNumber)) {
                    phoneNumberError.text('Please enter a valid 11-digit phone number for Bangladesh (+880).');
                    return false; // Prevent form submission
                }
            }

            // Check for other form validation errors
            var otherErrors = $('.is-invalid');
            if (otherErrors.length > 0) {
                return false;
            }

            // Form validation passed
            return true;
        }
    </script>
@endsection
