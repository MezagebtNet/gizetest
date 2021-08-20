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
                    <div class="mb-3 small text-muted">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-jet-button type="submit">
                                    {{ __('Resend Verification Email') }}
                                </x-jet-button>
                            </div>
                        </form>

                        <form method="POST" action="/logout">
                            @csrf

                            <button type="submit" class="btn btn-link">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </x-jet-authentication-card>
        </div>
    </div>

@endsection
