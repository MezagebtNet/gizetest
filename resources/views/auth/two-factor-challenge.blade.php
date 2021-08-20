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
                    <div x-data="{ recovery: false }">
                        <div class="mb-3" x-show="! recovery">
                            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                        </div>

                        <div class="mb-3" x-show="recovery">
                            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                        </div>

                        <x-jet-validation-errors class="mb-3" />

                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="form-group" x-show="! recovery">
                                <x-jet-label value="{{ __('Code') }}" />
                                <x-jet-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text"
                                    inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                                <x-jet-input-error for="code"></x-jet-input-error>
                            </div>

                            <div class="form-group" x-show="recovery">
                                <x-jet-label value="{{ __('Recovery Code') }}" />
                                <x-jet-input class="{{ $errors->has('recovery_code') ? 'is-invalid' : '' }}" type="text"
                                    name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                                <x-jet-input-error for="recovery_code"></x-jet-input-error>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-outline-secondary" x-show="! recovery" x-on:click="
                                            recovery = true;
                                            $nextTick(() => { $refs.recovery_code.focus() })
                                        ">
                                    {{ __('Use a recovery code') }}
                                </button>

                                <button type="button" class="btn btn-outline-secondary" x-show="recovery" x-on:click="
                                            recovery = false;
                                            $nextTick(() => { $refs.code.focus() })
                                        ">
                                    {{ __('Use an authentication code') }}
                                </button>

                                <x-jet-button>
                                    {{ __('Log in') }}
                                </x-jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </x-jet-authentication-card>
        </div>
    </div>

@endsection
