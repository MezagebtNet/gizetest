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
                        <a class="nav-link active" href="{{ url('register') }}">Register</a>

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

                <x-jet-validation-errors class="mb-3" />

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <x-jet-label value="{{ __('First Name') }}" />

                            <x-jet-input class="{{ $errors->has('firstname') ? 'is-invalid' : '' }}" type="text"
                                name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                            <x-jet-input-error for="firstname"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <x-jet-label value="{{ __('Last Name') }}" />

                            <x-jet-input class="{{ $errors->has('lastname') ? 'is-invalid' : '' }}" type="text"
                                name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                            <x-jet-input-error for="lastname"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <x-jet-label value="{{ __('Email') }}" />

                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                :value="old('email')" required />
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

                            <x-jet-input class="form-control" type="password" name="password_confirmation" required
                                autocomplete="new-password" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <x-jet-checkbox id="terms" name="terms" />
                                    <label class="custom-control-label" for="terms">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '">' . __('Privacy Policy') . '</a>',
]) !!}
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div class="mb-0">
                            <div class="d-flex justify-content-end align-items-baseline">
                                <a class="text-muted mr-3 text-decoration-none" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                                <div class="button">
                                    <x-jet-button>
                                        {{ __('Register') }}
                                    </x-jet-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </x-jet-authentication-card>
        </div>

    </div>


@endsection
