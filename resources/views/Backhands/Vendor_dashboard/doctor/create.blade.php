@extends('layouts.dashboard_master')
@section('contant')

<div class="col-md-7 col-lg-8 col-xl-12">
    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (session('succ'))
                <div class="alert alert-success">
                    {{ session('succ') }}
                </div>
                @endif
                <!-- Basic Information -->
                <form method="POST" action="{{route('doctor.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title">Basic Information</h4>

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
                                            value="{{old('fname')}}" name="fname">
                                        @error('fname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{old('lanme')}}" name="lname">
                                        @error('lname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="number" class="form-control" name="phone_number"
                                            value="{{old('phone_number')}}">
                                        @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror




                                    </div>
                                </div>

                                {{-- <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <div class="input-group">
                                            <select class="form-control @error('country_code') is-invalid @enderror" id="country-code"
                                                name="country_code">
                                                <option value="+880">+880 (BD)</option>
                                                <!-- Add more country code options as needed -->
                                            </select>
                                            <label>Phone Number</label>
                                            <input type="number" class="form-control" name="phone_number"
                                                value="{{old('phone_number')}}">
                                            @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        <span id="phone-number-error" class="text-danger"></span>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control select" name="gender">
                                            <option>Select</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth"
                                            value="{{old('date_of_birth')}}">
                                        @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /Basic Information -->

                    <!-- About Me -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Me</h4>
                            <div class="form-group mb-0">
                                <label>Biography</label>
                                <textarea class="form-control" name="about" rows="5">{{old('about')}}</textarea>
                            </div>
                        </div>
                    </div>


                    <!-- Clinic Info -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Clinic Info</h4>
                            <div class="row form-row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>User Name Doctor<span class="text-danger">*</span> </label>
                                        <select class="form-control" name="vendor_id">

                                            <option>-Select One User Name Doctor </option>


                                            @foreach ($vendor as $doctors)



                                            <option value="{{$doctors->id}}">
                                                {{ $doctors->name }},{{ $doctors->id }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Clinic Address</label>
                                        <input type="text" class="form-control" name="hospital_address"
                                            value="{{old('hospital_address')}}">
                                        @error('hospital_address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label>Fillinges</label>
                                        <input type="text" class="form-control" name="fillinges"
                                            value="{{old('fillinges')}}">
                                        @error('fillinges')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group mb-0">
                                        <label>Price</label>
                                        <input type="number" value="{{old('price')}}" class="form-control" name="price">
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-5">

                                    <div class="form-group">
                                        <label>Doctor Themble Photo <span class="text-danger">*</span> </label>

                                        <style>
                                            .hidden {
                                                visibility: hidden;
                                            }
                                        </style>
                                        <input type="file" class="form-control" name="doctor_themble_photo"
                                            onchange="readURL(this)" ;>
                                        <img class="hidden mt-3" id="category_photo_viewer" src="#" alt="your image" />
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
                                    <div class="form-group">
                                        <label>Doctors Features Photos <span class="text-danger">*</span> </label>
                                        <style>
                                            .hidden {
                                                visibility: hidden;
                                            }
                                        </style>
                                        <input type="file" class="form-control" multiple
                                            name="doctors_features_photos[]" onchange="readURL(this)" ;>
                                        <img class="hidden mt-3" id="category_photo_viewer" src="#" alt="your image" />
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
                                        @error('featured_photos_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Clinic Info -->

                    <!-- Contact Details -->
                    <div class="card contact-card">
                        <div class="card-body">
                            <h4 class="card-title">Contact Details</h4>
                            <div class="row form-row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control" value="{{old('city')}}" name="city">
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <input type="text" class="form-control" name="locations"
                                            value="{{old('locations')}}">
                                        @error('locations')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /Contact Details -->

                    <!-- Pricing -->

                    <!-- /Pricing -->

                    <!-- Services and Specialization -->
                    <div class="card services-card">
                        <div class="card-body">
                            <h4 class="card-title">Services and Specialization</h4>

                            <div class="form-group">
                                <label>Specialist Doctor<span class="text-danger">*</span> </label>
                                <select class="form-control" name="special_id">
                                    <option>-Select One Specialist </option>
                                    @foreach ($speci as $specials)
                                    <option value="{{ $specials->id }}">{{ $specials->special }}</option>
                                    @endforeach


                                </select>
                            </div>

                        </div>
                    </div>
                    <!-- /Services and Specialization -->

                    <!-- Education -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Education</h4>
                            <div class="education-info">
                                <div class="row form-row education-cont">
                                    <div class="col-12 col-md-10 col-lg-11">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Degree</label>
                                                    <input type="text" class="form-control" name="degree"
                                                        value="{{old('degree')}}">
                                                    @error('degree')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>College/Institute</label>
                                                    <input type="text" class="form-control" name="college"
                                                        value="{{old('college')}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Year of Completion</label>
                                                    <input type="text" class="form-control" name="year_of_completion"
                                                        value="{{old('year_of_completion')}}">
                                                    @error('year_of_completion')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i>
                                    Add More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Education -->



                    <!-- Awards -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Awards</h4>
                            <div class="awards-info">
                                <div class="row form-row awards-cont">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Awards</label>
                                            <input type="text" class="form-control" name="dwards">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" class="form-control" name="year">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Awards -->



                    <!-- Registrations -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Registrations</h4>
                            <div class="registrations-info">
                                <div class="row form-row reg-cont">
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Registrations</label>
                                            <input type="text" class="form-control" name="registrations">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" class="form-control" name="year_of_registrations">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add
                                    More</a>
                            </div>
                        </div>


                    </div>
                    <!-- /Registrations -->
                    <button type="submit" class="btn btn-primary submit-btn-bottom submit-section">Save
                        Information</button>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection


