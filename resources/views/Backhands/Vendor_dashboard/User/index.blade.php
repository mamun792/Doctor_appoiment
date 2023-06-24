@extends('layouts.dashboard_master')
@section('contant')
{{-- <div class="content container-fluid"> --}}

    <!-- Page Header -->

    @if (session('adds'))
    <div class="alert alert-success">
        {{ session('adds') }}
    </div>
    @endif
    @if (session('delete'))
    <div class="alert alert-danger">
        {{ session('delete') }}
    </div>
    @endif

    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">Users</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ul>
            </div>
            <div class="col-sm-5 col">
                {{-- <a href="{{ route('add.user') }}" class="btn btn-primary float-right mt-2">Add User</a> --}}
                <button type="button" class="btn btn-primary float-right mt-2" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    Add User
                </button>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user_id" class="display " style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI.ON</th>
                                    <th>Profile photo</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Account Create at</th>
                                    <th>Role</th>
                                    <th class="text-right">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @if ($users->profile_photo)
                                        <img class="rounded-circle"
                                            src="{{ asset('uploads/profile_photo/') }}/{{ $users->profile_photo }}"
                                            width="50" alt="user">
                                        @else
                                        <img class="rounded-circle" src="{{ Avatar::create($users->name)->toBase64() }}"
                                            width="45" alt="{{ $users->name }}">
                                        @endif

                                    </td>
                                    <td>

                                        {{ $users->name }}
                                    </td>
                                    <td>
                                        {{ $users->email }}
                                    </td>
                                    <td>{{ $users->created_at->format('d-m-y') }}</td>

                                    <td>
                                        {{ $users->role }}
                                    </td>
                                    <td>gg</td>
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
{{-- </div> --}}
@endsection
@section('footer_scprit')
<script>
    $(document).ready(function() {
            $('#user_id').DataTable();
        });
</script>
@endsection


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                                <input type="email" class="form-control @error('email') is-invalid  @enderror"
                                    name="email" placeholder="Email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                    {{-- <option value="appointment_assistance">appointment assistant</option> --}}
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
