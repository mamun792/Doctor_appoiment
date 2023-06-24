@extends('layouts.dashboard_master')
@section('contant')


<div class="container">
    <h1>Create New About Content</h1>

    <form method="POST" action="{{ route('about.store') }}">
        @csrf
        <label for="content">Content:</label>
        <div class="form-group">

            <textarea name="content" id="content" rows="8" cols="80" maxlength="1000" ></textarea>
            <div class="error-msg" id="errorMsg"></div>
        </div>
        <div class="form-group">
            <span id="charCount" class="word-count">Character count: 0</span>
            <span id="remainingChars" class="word-count">Remaining characters: 1500</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>



    @endsection


    @section('footer_scprit')

    <script>
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
