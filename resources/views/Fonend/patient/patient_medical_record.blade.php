@extends('layouts.profile_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">



                            <li class="breadcrumb-item "><a href="{{ route('index') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Medical Records</li>
                        </ol>
                    </nav>

                    <h2 class="breadcrumb-title">Medical Records</h2>


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
                                        <li class="active">

                                            <a href="{{ route('patient.medical.record',auth()->user()->id)}}">
                                                <i class="fas fa-clipboard"></i>
                                                <span>Add Medical Records </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('patient.medical.deatiles',auth()->user()->id) }}">
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
                                            <a href="{{ route('profile.details',auth()->user()->id) }}">
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

                    @if (session('Success'))
                        <div class="alert alert-success">
                            {{ session('Success') }}
                        </div>
                    @endif

                    @if (session('del'))
                        <div class="alert alert-danger">
                            {{ session('del') }}
                        </div>
                    @endif



                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link " href="#pat_appointments" data-toggle="tab">Appointments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Prescriptions</a>
                            </li>


                        </ul>
                    </nav>

                    <div class="tab-content pt-0">



                        <div class="text-end ">
                            <button type="button" class="btn btn-primary add-new-btn" data-toggle="modal"
                                data-target="#exampleModalScrollable">
                                Add Medical Records
                            </button>
                        </div>


                    </div>
                                <div id="pat_medical_records" class="tab-pane fade">
                                    <div class="card card-table mb-0 ">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Date </th>
                                                            <th>Description</th>
                                                            <th>Attachment</th>
                                                            <th>Created</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><a href="javascript:void(0);">#MR-0010</a></td>
                                                            <td>14 Nov 2019</td>
                                                            <td>Dental Filling</td>
                                                            <td><a href="#">dental-test.pdf</a></td>
                                                            <td>
                                                                <h2 class="table-avatar">

                                                                    <a href="doctor-profile.html">Dr. Ruby Perrin
                                                                        <span>Dental</span></a>
                                                                </h2>
                                                            </td>
                                                            <td class="text-right">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm bg-primary-light">
                                                                        <i class="fas fa-print"></i> Print
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                    <div class="tab-content pt-0">

                        <!-- Appointment Tab -->
                        <div id="pat_appointments" class="tab-pane fade show active">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive"  style="overflow: auto; max-height: 300px;">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Attachment</th>
                                                    <th>Orderd By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($medical_record as $medical_records)
                                                    <tr>
                                                        <td>{{ $medical_records->relationWithPatient->p_id}}</td>
                                                        <td>{{ $medical_records->relationWithPatient->name }}
                                                        </td>
                                                        <td>{{ $medical_records->created_at ? $medical_records->created_at->format('d F Y') : '' }}
                                                            <span
                                                                class="d-block text-info">{{ $medical_records->created_at ? $medical_records->created_at->format(' H:i:s') : '' }}

                                                            </span>
                                                        </td>
                                                        <td>{{ $medical_records->title }}</td>
                                                        <td>
                                                            <a href="{{route('patient.medical.record.download',$medical_records->id)}}" title="Download attachment"
                                                                class="btn btn-primary btn-sm"> <i
                                                                    class="fa fa-download"></i></a>
                                                        </td>
                                                        <td>{{ $medical_records->patient_relative }}</td>
                                                        <td>





                                                        <a href="{{ route('patient.medical.record.delete', $medical_records->id) }}" class="btn btn-sm bg-danger-light delete-btn">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                          </a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="tab-pane fade" id="pat_prescriptions">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Date </th>
                                                    <th>Name</th>
                                                    <th>Created by </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>14 Nov 2019</td>
                                                    <td>Prescription 1</td>
                                                    <td>
                                                        <h2 class="table-avatar">

                                                            <a href="doctor-profile.html">Dr. Ruby Perrin
                                                                <span>Dental</span></a>
                                                        </h2>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-sm bg-primary-light">
                                                                <i class="fas fa-print"></i> Print
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-sm bg-info-light">
                                                                <i class="far fa-eye"></i> View
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<br>

@endsection



<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medical Records</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('patient.medical.record.add') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Title Name</label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Enter Title Name">
                                </div>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Patient</label>
                                    <select class="form-select" name="patient_relative">
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
                                    <input type="text" name="hospital" class="form-control"
                                        placeholder="Enter name here..">
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
                                        <input type="file" name="user_prespation" id="image"
                                            class="form-control-file" onchange="readURL(this)" ; />

                                        <div class="upload-content dropzone">
                                            <div class="text-center">
                                                <div class="upload-icon mb-2">
                                                </div>
                                                <h5>Drag &amp; Drop</h5>
                                                <h6>or <span class="text-danger">Browse</span></h6>
                                                <img class="hidden mt-3" id="category_photo_viewer" src="#"
                                                    alt="your image" />
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
                                    <input type="text" data-role="tagsinput" class="input-tags form-control"
                                        name="services" id="services">
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
                                        <input type="date" class="form-control" name="tratment_date"
                                            id="tratment_date">
                                    </div>
                                </div>
                            </div>
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-4">
                            <div class="submit-section text-center">
                                <button type="submit" id="medical_btn"
                                    class="btn btn-primary submit-btn">Submit</button>
                                <button type="button" class="btn btn-secondary m-3"
                                    data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



@section('footer_scprit')
<script >


 document.querySelector('.delete-btn').addEventListener('click', function(event) {
    event.preventDefault();


    Swal.fire({
      title: 'Are you sure?',
      text: 'This action cannot be undone.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        // If user confirms, proceed with the deletion by following the link
        window.location.href = event.target.href;
      }
    });
  });
</script>

@endsection
