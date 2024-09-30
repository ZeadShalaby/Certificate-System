<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@extends('layouts.app')

@section('content')
    <!--- shapes --->
    <x-shapes />


    <!-- Login Container -->
    <div class="container text-center py-5">
        <div class="login-container bg-white rounded-lg shadow-lg">
            <img src="{{ asset('images/LusailUN.png') }}" alt="University Logo" class="logo mb-4">
            <h1 class="login-message mb-3">@lang('certificate.login_title')</h1>
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <x-inputs.input :item="'name'" :lang="'username'" :langplaceholder="'placeholder_username'" :type="'text'"
                        :icon="'user'" :forId="'username'" />
                </div>

                <div class="form-group">
                    <x-inputs.input :item="'password'" :lang="'password'" :langplaceholder="'placeholder_password'" :type="'password'"
                        :icon="'lock'" :forId="'password'" />
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4" id="submit">@lang('certificate.login')</button>
            </form>
            <p class="mt-3">@lang('certificate.forgot_password') <a href="#" class="text-primary">@lang('certificate.click_here')</a></p>
        </div>
    </div>
@endsection
