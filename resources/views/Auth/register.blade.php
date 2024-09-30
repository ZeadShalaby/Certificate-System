<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">

    <!--- shapes --->
    <x-shapes />

    <!-- Loading Screen -->
    <x-loading :loadingId="'loading-screen'" :style="'display: none;'" />


    <!-- Login Container -->
    <div class="container text-center py-5" id="container">
        <div class="login-container bg-white rounded-lg shadow-lg">
            <img src="{{ asset('images/LusailUN.png') }}" alt="University Logo" class="logo mb-4">
            <h1 class="login-message mb-3">@lang('certificate.register_title')</h1>
            <form action="{{ route('register') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <x-inputs.input :item="'email'" :lang="'email'" :langplaceholder="'placeholder_email'" :type="'email'"
                        :icon="'envelope'" :forId="'email'" />
                </div>

                <div class="form-group">
                    <x-inputs.input :item="'password'" :lang="'password'" :langplaceholder="'placeholder_password'" :type="'password'"
                        :icon="'lock'" :forId="'password'" />
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4" id="submit"
                    onclick="showLoadingScreens()">@lang('certificate.register')</button>
            </form>
            <p class="mt-3">@lang('certificate.login') <a href="#" class="text-primary">@lang('certificate.click_here')</a></p>
        </div>
    </div>

    <script src="{{ asset('js/loading.js') }}"></script>
@endsection
