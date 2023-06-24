@extends('layouts.profile_master')

@section('contents')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Review</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.review.add') }}">
                            @csrf

                            @foreach ($inoice_detail as $inoice_details)
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <img class="rounded-circle"
                                                src="{{ asset('uploads/doctor_themble_photo/') }}/{{ $inoice_details->relationInvoiceDoctor->doctor_themble_photo }}"
                                                height="70" width="70" alt="not found">
                                            <span> {{ $inoice_details->relationInvoiceDoctor->fname }}
                                                {{ $inoice_details->relationInvoiceDoctor->fname }} </span>
                                            <h5>{{ $inoice_details->relationInvoiceDoctor->relationwithspeclist->special }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if (App\Models\Review::where('invioce_detealies_id', $doctor_revie_id)->exists())
                                <div class="alert alert-warning" role="alert">
                                    Review Already Given!
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <div class="star-rating">
                                        <input id="star-5" type="radio" name="rating" value="5">
                                        <label for="star-5" title="5 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-4" type="radio" name="rating" value="4">
                                        <label for="star-4" title="4 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-3" type="radio" name="rating" value="3">
                                        <label for="star-3" title="3 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-2" type="radio" name="rating" value="2">
                                        <label for="star-2" title="2 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-1" type="radio" name="rating" value="1">
                                        <label for="star-1" title="1 star">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                    </div>
                                    <div class="star-rating">
                                        @error('rating')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title of your review</label>
                                    <input class="form-control" type="text"
                                        placeholder="If you could say it in one sentence, what would you say?"
                                        name="title">
                                    <input class="form-control" type="hidden" name="comment_id"
                                        value="{{ $doctor_revie_id }}">

                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="comment">Your review</label>
                                    <textarea id="review_desc" name="comment" maxlength="100" class="form-control"></textarea>
                                    @error('comment')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <div class="d-flex justify-content-between mt-3">
                                        <small class="text-muted">
                                            Characters remaining: <span id="charCount" style="color: #777;">100</span>
                                        </small>
                                    </div>



                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="terms_accept">
                                        <label for="terms_accept">I have read and accept <a href="#">Terms
                                                &amp; Conditions</a></label>
                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_scprit')
    <script>
        const textarea = document.getElementById('review_desc');
        const charCount = document.getElementById('charCount');
        const maxChars = 100;

        textarea.addEventListener('input', function() {
            const remainingChars = maxChars - textarea.value.length;
            charCount.textContent = remainingChars;
        });
    </script>
@endsection
