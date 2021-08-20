@extends('layouts.auth.index')

@section('header-menu')
    <div class="inner">
        <img src="{{ asset('assets/image/logos/Gize logo banner dark.png') }}" alt="Gize"
            class="masthead-brand brand-image pr-2" height="54px" style="opacity: 1">
        {{-- <h3 class="masthead-brand">{{ config('app.name', 'Gize')  }}</h3> --}}
        <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="{{ url('/') }}">Home</a>
            @if (Route::has('login'))

                @auth

                @else
                    <a class="nav-link" href="{{ url('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ url('register') }}">Register</a>

                    @endif

                @endauth

            @endif
        </nav>
    </div>
@endsection

@section('main-content')
    <h1 class="cover-heading">{{ __('welcome.welcome') }}</h1>
    <p class="lead" style="text-shadow: 2px 2px 4px #000;" class="mt-3 text-base text-gray-100 mt-sm-5 text-lg ">
        {{ __('welcome.message') }}</p>
    <p class="lead">
    <div class="">
        @if (Route::has('login'))

            @auth
                {{-- <div class="rounded-md shadow"> --}}
                <a href="{{ url('/dashboard') }}" class="large-buttons mx-2 py-2 btn btn-lg btn-secondary">
                    Get started
                </a>
                {{-- </div> --}}
            @else
                {{-- <div class="rounded-md shadow"> --}}
                <a href="{{ url('login') }}" class="large-buttons mx-2 py-2 btn btn-lg btn-secondary">
                    Login
                </a>
                {{-- </div> --}}




                @if (Route::has('register'))
                    {{-- <div class="mt-3 mt-sm-0 ml-sm-3"> --}}
                    <a href="{{ url('register') }}" class="large-buttons mx-2 py-2 btn btn-lg btn-secondary">
                        Register
                    </a>
                    {{-- </div> --}}
                @endif

            @endauth

        @endif


    </div>
    </p>
@endsection
