@extends('layouts.auth.index')

@section('header-menu')
    <div class="inner">
        <img src="{{ asset('assets/image/logos/Gize logo banner dark.png') }}" alt="Gize"
            class="masthead-brand brand-image pr-2" height="54px" style="opacity: 1">
        {{-- <h3 class="masthead-brand">{{ config('app.name', 'Gize')  }}</h3> --}}
        <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
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

    <div class="d-flex justify-content-center">
        <div class="flex-row">

            <x-jet-authentication-card>
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>

                <div class="card-body">

                    <div class="mb-3 text-sm text-muted">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <x-jet-validation-errors class="mb-2" />

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div>
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" type="password" name="password" required
                                autocomplete="current-password" autofocus />
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Confirm') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </x-jet-authentication-card>
        </div>
    </div>

@endsection
