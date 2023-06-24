@extends('layouts.dashboard_master')
@section('contant')
    <div class="card">
        @if (session('Success'))
            <div class="alert alert-success">
                {{ session('Success') }}
            </div>
        @endif
        <div class="card-header bg-primary">
            <h3 class="text-center">Patient Medical Report Add</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('vendor.patient.medical.report.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Medical Report Name</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title Name">
                            </div>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="patient_id" value="{{ $p_id }}">
                        <div class="col-12 col-md-6">
                            <label>Patient</label>
                            <div class="form-group ">

                                <select class="form-select form-control" name="patient_relative">
                                    <option>Myself</option>
                                    <option>Child_1</option>
                                    <option>Self</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Hospital Name</label>
                                <input type="text" name="hospital" class="form-control" placeholder="Enter name here..">
                                @error('hospital')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Upload</label>
                                <div class="upload-medical-records">
                                    <style>
                                        .hidden {
                                            visibility: hidden;
                                        }
                                    </style>
                                    <input type="file" name="user_prespation" id="image" class="form-control-file"
                                        onchange="readURL(this)" ; />

                                    <div class="upload-content dropzone medical">
                                        <div class="text-center">
                                            <div class="upload-icon mb-2">
                                            </div>
                                            <h5>Drag &amp; Drop</h5>
                                            <h6>or <span class="text-danger">Browse
                                                    <img class="hidden mt-3" id="category_photo_viewer" src="#"
                                                        alt="your image" />
                                                </span></h6>

                                            <script>
                                                function readURL(input) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            $('#category_photo_viewer').attr('src', e.target.result).width(300).height(255);
                                                        };
                                                        $('#category_photo_viewer').removeClass('hidden');
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }
                                            </script>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @error('user_prespation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Symptoms</label>
                                <input type="text" data-role="tagsinput" class="input-tags form-control" name="services"
                                    id="services">
                            </div>
                        </div>
                        @error('services')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="tratment_date" id="tratment_date">
                                </div>
                            </div>
                        </div>
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-center mt-4">
                        <div class="submit-section ">
                            <button type="submit" id="medical_btn" class="btn btn-primary submit-btn">Submit</button>

                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>

    <br>
@endsection
