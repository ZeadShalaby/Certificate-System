@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/excel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">

    <!--- shape --->
    <x-shapes />

    <!-- Loading Screen -->
    <x-loading :loadingId="'loading-screen'" :style="'display: none;'" />


    <div class="upload-container d-flex justify-content-center align-items-center" style="min-height: 100vh;" id="container">
        <div class="card shadow" style="width: 100%; max-width: 500px;"> <!-- Limit max-width if necessary -->
            <div class="card-header text-center">
                <h2>@lang('certificate.upload_title')</h2>
            </div>
            <div class="card-body">
                <p class="text-muted">@lang('certificate.upload_desc')</p>

                <form id="upload-form" action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group upload-input">
                        <div class="input-wrapper">
                            <input type="file" id="excel-file" name="file" class="form-control" accept=".xlsx, .xls"
                                onchange="updateUploadLabel(event)">
                            <label for="excel-file" class="upload-button" id="upload-label">
                                <div id="error-message" class="error-inside-input text-center" style="display: none;">
                                    <i class="fas fa-exclamation-circle" style="font-size: 20px; color: red;"></i>
                                    <span id="error-text" style="color: red;"></span>
                                </div>
                                <div id="upload-button-text">
                                    <i class="fas fa-upload"></i>
                                    <span id="upload-label-text">@lang('certificate.upload_label')</span>
                                </div>
                            </label>
                        </div>
                    </div>



                    <button type="button" class="btn btn-primary btn-block" id="upload-button" onclick="uploadFile()">
                        @lang('certificate.upload_button')
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function uploadFile() {
            showLoadingScreen(); // Show loading screen
            var formData = new FormData($('#upload-form')[0]);
            $.ajax({
                url: "{{ route('excel.upload') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    setTimeout(function() {
                        location.reload(); // Reload the page after 5 seconds
                    }, 5000);
                },
                error: function(xhr) {

                    var errorMessage = "{{ __('certificate.upload_error') }}";

                    // Hide the loading screen and show the error message
                    document.getElementById("loading-screen").style.display = "none";
                    document.getElementById("container").style.display = "block";

                    // Display the error message in the designated div
                    document.getElementById("error-text").innerText = errorMessage; // Set error message text
                    document.getElementById("upload-button-text").style.display = "none";
                    document.getElementById("error-message").style.display = "block"; // Show error message
                }
            });
        }
    </script>

    <script src="{{ asset('js/loading.js') }}"></script>
@endsection
