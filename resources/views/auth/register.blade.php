<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboard_assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/font-awesome.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/css/style.css') }}">

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        {{-- <img class="img-fluid" src="{{ asset('dashboard_assets/img/logo-white.png')}}" alt="Logo"> --}}
                        <h1 class="text-white p-5">DLPCMS</h1>
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Register</h1>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Form -->
                            <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm();">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control   @error('name') is-invalid @enderror" type="text"
                                        name="name" value="{{ old('name') }}" placeholder="Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control   @error('login') is-invalid @enderror" type="email"
                                        name="email" value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select class="form-control @error('country_code') is-invalid @enderror"
                                                id="country-code" name="country_code">

                                                <option value="+880">+880 (BD)</option>
                                                <!-- Add more country code options as needed -->
                                            </select>
                                        </div>
                                        <input class="form-control @error('phone_number') is-invalid @enderror"
                                            type="text" name="phone_number" id="phone-number"
                                            value="{{ old('phone_number') }}" placeholder="Phone Number">
                                    </div>
                                    @error('country_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <span id="phone-number-error" class="text-danger"></span>
                                </div>



                                <div class="form-group">
                                    <input class="form-control" type="hidden"
                                        value="{{ '#INV' . '-' . rand(0000, 1000000) }}" name="p_id">

                                </div>


                                <div class="form-group input-group">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password"
                                        value="{{ old('password') }}" placeholder="Password">
                                    <div class="input-group-append" onclick="togglePasswordVisibility('password', 'passwordToggleIcon')">
                                        <span class="input-group-text">
                                            <i id="passwordToggleIcon" class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="form-group input-group">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                        type="password" name="password_confirmation" placeholder="Confirm Password" onkeyup="validatePassword()">
                                    <div class="input-group-append" onclick="togglePasswordVisibility('password_confirmation', 'passwordConfirmToggleIcon')">
                                        <span class="input-group-text">
                                            <i id="passwordConfirmToggleIcon" class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <span id="confirmPasswordError" class="text-danger"></span>

                                {!! NoCaptcha::display() !!}
                                <br>
                                @error('g-recaptcha-response')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                                </div>
                            </form>
                            <!-- /Form -->

                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <!-- Social Login -->
                            <div class="social-login">
                                <span>Register with</span>
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a
                                    href="{{ route('google.redirect') }}" class="google"><i
                                        class="fa fa-google"></i></a>
                            </div>
                            <!-- /Social Login -->

                            <div class="text-center dont-have">Already have an account? <a
                                    href="{{ route('login') }}">Login</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="{{ asset('dashboard_assets/js/jquery-3.2.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('dashboard_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/bootstrap.min.js') }}"></script>
    {!! NoCaptcha::renderJs() !!}




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

//showpassword

function togglePasswordVisibility(inputId, toggleIconId) {
        var input = document.getElementById(inputId);
        var toggleIcon = document.getElementById(toggleIconId);
        if (input.type === "password") {
            input.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

    function validatePassword() {
        var passwordInput = document.getElementById("password");
        var confirmPasswordInput = document.getElementById("password_confirmation");
        var confirmPasswordError = document.getElementById("confirmPasswordError");
        if (passwordInput.value !== confirmPasswordInput.value) {
            confirmPasswordError.textContent = "Password and confirm password do not match";
        } else {
            confirmPasswordError.textContent = "";
        }
    }

    </script>



</body>


</html>
