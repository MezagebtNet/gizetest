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

                    <x-jet-validation-errors class="mb-3" />

                    <form method="POST" action="/reset-password">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <x-jet-label value="{{ __('Email') }}" />

                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                :value="old('email', $request->email)" required autofocus />
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <x-jet-label value="{{ __('Password') }}" />

                            <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                name="password" required autocomplete="new-password" />
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <x-jet-label value="{{ __('Confirm Password') }}" />

                            <x-jet-input class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-jet-input-error for="password_confirmation"></x-jet-input-error>
                        </div>

                        <div class="mb-0">
                            <div class="d-flex justify-content-end">
                                <x-jet-button>
                                    {{ __('Reset Password') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </x-jet-authentication-card>
        @endsection

        @section('js')
            @livewireScripts
        @endsection
