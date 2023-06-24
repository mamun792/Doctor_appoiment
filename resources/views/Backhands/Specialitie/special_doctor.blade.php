@extends('layouts.dashboard_master')
@section('contant')
    {{-- <div class="content container-fluid"> --}}

    <!-- Page Header -->
    @if (session('Success'))
    <div class="alert alert-success">
        {{ session('Success') }}
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
                <h3 class="page-title">Specialities</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Specialities</li>
                </ul>
            </div>
            <div class="col-sm-5 col">
                {{-- <a href="{{ route('add') }}" class="btn btn-primary float-right mt-2">Add</a> --}}
                <button type="button" class="btn btn-primary float-right mt-2" data-toggle="modal" data-target="#exampleModalCenter">
                    Add Specialities
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
                        <table id="special_id" class="display " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Specialities</th>
                                    <th>Create at</th>
                                    <th>Update at</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($speci as $specist)
                                    <tr>
                                        <td>{{ $specist->SI }}</td>

                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar avatar-sm mr-2">

                                                    <img class="avatar-img"
                                                        src="{{ asset('uploads/special_photp/') }}/{{ $specist->category_photo }}"
                                                        alt="Speciality">
                                                </a>
                                                <a href="profile.html">{{ $specist->special }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $specist->created_at->format('d-m-y') }}</td>
                                        <td>
                                            @if ($specist->updated_at)
                                                {{ $specist->updated_at->diffForHumans() }}
                                            @else
                                                <span class="badge badge-danger">Not Update Yet</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="actions">

                                                <a class="btn btn-sm bg-success-light"
                                                    href="{{ url('special/update') }}/{{ $specist->id }}">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <button value="{{ url('special/delete') }}/{{ $specist->id }}"
                                                    class="btn btn-sm btn-danger speical_sweetalert">
                                                    <i class="fe fe-trash"></i> Delete
                                                </button>

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
    {{-- </div> --}}
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Add Specialities</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('insert')}}" enctype="multipart/form-data">
                @csrf
                <div class="row form-row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Specialities</label>
                            <input type="text" class="form-control @error('special') is-invalid  @enderror"
                                value="{{old('special')}}" name="special">
                            @error('special')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Image</label>
                            <style>
                                .hidden {
                                    visibility: hidden;
                                }
                            </style>
                            <input type="file" class="form-control" name="category_photo" onchange="readURL(this)" ;>
                            <img class="hidden mt-3" id="category_photo_viewer" src="#" alt="your image" />
                            <script>
                                function readURL(input) {
                                  if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                      $('#category_photo_viewer').attr('src', e.target.result).width(150).height(195);
                                    };
                                    $('#category_photo_viewer').removeClass('hidden');
                                    reader.readAsDataURL(input.files[0]);
                                  }
                                }
                            </script>
                            @error('category_photo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

@section('footer_scprit')
    <script>
        $(document).ready(function() {
            $('#special_id').DataTable();

            $('#special_id').on('click', '.speical_sweetalert', function() {

                var link = $(this).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                })
            });

        });
    </script>
@endsection
