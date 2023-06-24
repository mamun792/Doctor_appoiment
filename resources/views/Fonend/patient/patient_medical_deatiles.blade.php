@extends('layouts.profile_master')

@section('contents')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">



                            <li class="breadcrumb-item "><a href="{{ route('index') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Medical Details</li>
                        </ol>
                    </nav>

                    <h2 class="breadcrumb-title">Medical Details</h2>


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
                                        <li class="active">
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


                    <div class="card-body pt-0">

                        <nav class="user-tabs mb-4">
                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#pat_medicalrecords" data-bs-toggle="tab">Medical
                                        Records</a>
                                </li>

                            </ul>
                        </nav>

                        <div class="tab-content pt-0">

                            <div id="pat_medicalrecords" class="tab-pane fade show active">

                                <div class="text-end ">
                                    <button type="button" class="btn btn-primary add-new-btn" data-toggle="modal"
                                        data-target="#exampleModalScrollable">
                                        Add Details
                                    </button>
                                </div>
                                <div class="card card-table mb-0">

                                    <div class="card-body">
                                        <div class="table-responsive"  style="overflow: auto; max-height: 300px;">
                                            <table class=" table table-hover table-center mb-0  ">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>BMI</th>
                                                        <th class="text-center">Heart Rate</th>
                                                        <th class="text-center">FBC Status</th>
                                                        <th>Weight</th>
                                                        <th>Order date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medical_detailes as $medical_detaile)
                                                        <tr>
                                                            <td>1</td>
                                                            <td>{{ $medical_detaile->relationWithPatientMedicalDetailes->name }}
                                                            </td>
                                                            <td>{{ $medical_detaile->bmi }}</td>
                                                            <td class="text-center">{{ $medical_detaile->heart }}</td>
                                                            <td class="text-center">{{ $medical_detaile->Fbc }}</td>
                                                            <td>{{ $medical_detaile->Weight }}Kg</td>
                                                            <td>{{ $medical_detaile->created_at ? $medical_detaile->created_at->format('d F Y') : '' }}
                                                                <span
                                                                    class="d-block text-info">{{ $medical_detaile->created_at ? $medical_detaile->created_at->format('H:m:s') : '' }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="table-action">
                                                                    <a href="{{ route('patient.medical.record.edit', $medical_detaile->id) }}"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="fas fa-edit"></i> Edit
                                                                    </a>
                                                                    </a>

                                                                    <a href="{{ route('patient.medical.deatiles.delete', $medical_detaile->id) }}"
                                                                        class="btn btn-sm bg-danger-light delete-btn">
                                                                        <i class="fas fa-trash-alt"></i> Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
    </div>
@endsection

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('patient.medical.deatiles.add') }}">
                    @csrf

                    <div class="form-group">
                        <label class="control-label mb-10"> BMI <span class="text-danger">*</span></label>
                        <input type="text" name="bmi" class="form-control">
                        @error('bmi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">Heart rate </label>
                        <input type="text" name="heart" class="form-control">
                        @error('heart')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">Weight</label>
                        <input type="text" name="Weight" class="form-control">
                        @error('Weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">Fbc</label>
                        <input type="text" id="Fbc" name="Fbc" class="form-control">
                        @error('Fbc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">Created Date </label>
                        <input type="text" name="dob" id="dob" value readonly class="form-control">
                    </div>
                    {{-- <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-outline btn-success ">Submit</button>
                    </div> --}}
                    <div class="modal-footer text-center">
                        <div class="submit-section text-center">
                            <button type="submit" id="medical_btn"
                                class="btn btn-primary submit-btn">Submit</button>
                            <button type="button" class="btn btn-secondary m-3" data-dismiss="modal">Close</button>
                        </div>

                    </div>

                </form>
            </div>

            </form>
        </div>

    </div>
</div>

@section('footer_scprit')
<script>

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

          window.location.href = event.target.href;
        }
      });
    });
  </script>

    @endsection
