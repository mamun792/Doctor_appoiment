@extends('layouts.dashboard_master')
@section('contant')
    @if (session('Delete'))
        <div class="alert alert-danger">
            <span class="badge badge-success">Delete</span>
            {{ session('Delete') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            <span class="badge badge-success">Success</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="about-content">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aboutContent as $aboutContents)
                        <tr>
                            <td class="content-cell">
                                <div class="content-text">{{ $aboutContents->content }}</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary mr-2 edit-button" data-id="{{ $aboutContents->id }}" data-toggle="modal" data-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $aboutContents->id }}">Delete</button>
                                </div>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>






    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Content</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit form -->
                    <form action="{{ route('about.update', $aboutContent[0]->id) }}" method="POST">
                        @csrf

                        <label for="content">Content:</label>
                        <div class="form-group">

                            <textarea name="content" id="content" rows="8" cols="80">{{ $aboutContent[0]->content }}</textarea>
                            <div class="error-msg" id="errorMsg"></div>
                        </div>
                        <div class="form-group">
                            <span id="charCount" class="word-count">Character count: 0</span>
                            <span id="remainingChars" class="word-count">Remaining characters: 1500</span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveChanges">Save Changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer_scprit')
    <script>
        // Delete button click event
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var aboutId = this.getAttribute('data-id');

                // Show confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with deletion
                        var deleteForm = document.createElement('form');
                        deleteForm.action = "{{ route('about.destroy', '') }}/" + aboutId;
                        deleteForm.method = 'POST';
                        deleteForm.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                        document.body.appendChild(deleteForm);
                        deleteForm.submit();
                    }
                });
            });
        });



        window.addEventListener('DOMContentLoaded', () => {
            const textarea = document.getElementById('content');
            const charCountDisplay = document.getElementById('charCount');
            const maxCharCount = 1500;
            const errorMsg = document.getElementById('errorMsg');

            textarea.addEventListener('input', () => {
                let content = textarea.value.trim();

                if (content.length > maxCharCount) {
                    content = content.substr(0, maxCharCount);
                    textarea.value = content;
                }

                const charCount = content.length;
                charCountDisplay.textContent = `Character count: ${charCount}`;

                if (charCount >= maxCharCount) {
                    errorMsg.textContent = 'Maximum character count exceeded.';
                    textarea.classList.add('error');
                    textarea.disabled = true;
                } else {
                    errorMsg.textContent = '';
                    textarea.classList.remove('error');
                    textarea.disabled = false;
                }

                const remainingChars = maxCharCount - charCount;
                const remainingCharsDisplay = document.getElementById('remainingChars');
                remainingCharsDisplay.textContent = `Remaining characters: ${remainingChars}`;
            });
        });
    </script>
@endsection
