@extends('layouts.dashboard_master')
@section('contant')
{{-- <div class="content container-fluid"> --}}

    <!-- Page Header -->
    @if (session('delete'))
    <div class="alert alert-danger">
        {{ session('delete') }}
    </div>
    @endif

    <div class="page-header">
        <div class="row">
            <div class="col-sm-7 col-auto">
                <h3 class="page-title">Doctors</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">All Doctors</li>
                </ul>
            </div>

        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="special_id" class="display   " style="width:100% ">
                            <thead>
                                <tr>
                                    <th>SI ON</th>
                                    <th>Doctor Photo</th>
                                    <th>Doctor Name</th>
                                    <th>Create at</th>
                                    <th>Update at</th>
                                    {{-- <th class="text-right">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctor as $doctors)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        {{-- <img class="rounded-circle"
                                            src="{{asset('uploads/profile_photo/')}}/{{ $doctors->profile_photo }}"
                                            width="50" alt="user"> --}}
                                            @if ($doctors->profile_photo)
                                            <img class="rounded-circle"
                                                src="{{ asset('uploads/profile_photo/') }}/{{ $doctors->profile_photo }}"
                                                width="50" alt="user">
                                        @else
                                            <img class="rounded-circle"
                                                src="{{ Avatar::create($doctors->name)->toBase64() }}" width="45"
                                                alt="{{ $doctors->name }}">
                                        @endif
                                        </td>
                                    <td>


                                        <a href="{{route('doctorDetailes.index',$doctors->id)}}"> {{ $doctors->name }}</a>
                                    </td>
                                    <td>{{ $doctors->created_at->format('d-m-y') }}</td>
                                    <td>
                                        {{-- {{ $doctors->updated_at->diffForHumans() }} --}}
                                    </td>

                                </tr>
                                {{-- @empty --}}
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
