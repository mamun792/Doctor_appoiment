@extends('layouts.dashboard_master')
@section('contant')


@if (session('passS'))
<div class="alert alert-success">
    {{ session('passS') }}
</div>
@endif

@if (session('update'))
<div class="alert alert-success">
    {{ session('update') }}
</div>
@endif


<div class="row">
    <div class="col-md-12">
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    <a href="#">
                        <span class="user-img  ">
                            @if (auth()->user()->profile_photo)
                            <img class="rounded-circle "
                                src="{{asset('uploads/profile_photo/')}}/{{auth()->user()->profile_photo}}" height="40"
                                width="40" alt="user">
                            @else
                            <img class="rounded-circle " src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                width="45">
                            @endif

                        </span>
                    </a>
                </div>
                <div class="col ml-md-n2 profile-user-info">
                    <h4 class="user-name mb-0">{{$user->name}}</h4>
                    <h6 class="text-muted">{{$user->email}}</h6>
                    <h6 class="text-muted">{{$user->role}}</h6>

                </div>

            </div>
        </div>
        <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
                </li>
            </ul>
        </div>
        <div class="tab-content profile-tab-cont">


            <div class="tab-pane fade show active" id="per_details_tab">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span>
                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details">
                                        <i class="fa fa-edit mr-1 btn btn-primary">Edit</i>
                                    </a>
                                </h5>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                    <p class="col-sm-10">{{$user->name}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Role</p>
                                    <p class="col-sm-10">{{$user->role}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                    <p class="col-sm-10">{{$user->email}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Create date</p>
                                    <p class="col-sm-10">{{$user->created_at}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Update date</p>
                                    <p class="col-sm-10">{{$user->updated_at}}</p>
                                </div>

                            </div>
                        </div>


                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Personal Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('change.information')}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label> Profile Photo</label>
                                                <div class="mb-4">
                                                    @if (auth()->user()->profile_photo)
                                                    <img class="rounded-circle"  width="100" height="100" src="{{asset('uploads/profile_photo/')}}/{{auth()->user()->profile_photo}}"
                                                        width="50" alt="user">
                                                    @else
                                                    <img class="rounded-circle ml-3" src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" width="45">
                                                    @endif
                                                </div>
                                                <input type="file" class="form-control" name="profile_photo" onchange="readURL(this)" ;>

                                                @error('profile_photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                                @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                                @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Update Information</button>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>


            </div>

            <div id="password_tab" class="tab-pane fade">



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
</div>



@endsection


@section('footer_scprit')
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
