@extends('layouts.doctor_master')

@section('contents')
    <div class="content">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="col-md-5 col-lg-9 col-xl-12 theiaStickySidebar">
                        <form method="POST" action="{{ route('patient.review.replay.add') }}">
                            @csrf

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title "> <label>Replay</label></h5>


                                    <input type="hidden" name="p_id" value="{{$patient_id}}">
                                    <div class="form-group ">




                                    </div>
                                    <div class="form-group">
                                        <label>Title of your replay</label>
                                        <input class="form-control" type="text"
                                            placeholder="If you could say it in one sentence, what would you say?"
                                            name="title">


                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Your suggest</label>
                                        <textarea id="review_desc" name="comment" maxlength="100" class="form-control"></textarea>
                                        @error('comment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span
                                                    id="chater">100</span>
                                                characters remaining</small></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="terms-accept">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="terms_accept">
                                                <label for="terms_accept">I have read and accept <a href="#">Terms
                                                        &amp; Conditions</a></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endsection
