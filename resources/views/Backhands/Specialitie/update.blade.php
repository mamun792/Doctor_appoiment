@extends('layouts.dashboard_master')
@section('contant')

@if (session('Success'))
<div class="alert alert-success" >
  {{ session('Success') }}
</div>
@endif
<h1 class="m-t-3">Update Specialities</h1>

<form method="POST" action="{{url('supdate/special_update')}}/{{$update->id}}" enctype="multipart/form-data">
@csrf
    <div class="row form-row">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Specialities</label>
                <input type="text" class="form-control" value="{{$update->special}}" name="special">
                @error('special')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="form-group">
                <label>Current Image</label>
                <img class="avatar-img" src="{{asset('uploads/special_photp/')}}/{{$update->category_photo}}" alt="Speciality">
            </div>
        </div>
        <div class="col-12 col-sm-9">
            <div class="form-group">
                <label>Update Image</label>
                <input type="file"  class="form-control" name="category_photo">
@error('category_photo')
<span class="text-danger">{{$message}}</span>
@enderror
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-primary btn-block">Save Update</button>
</form>
@endsection
