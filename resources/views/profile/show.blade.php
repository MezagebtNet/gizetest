@extends('layouts.website.index')

@section('title', 'User Account')

@section('styles')
    @livewireStyles
@endsection

@section('navbar')
    @include('website.navbar')
@endsection

@section('content')
    {{-- <div class="row"> --}}
    <div class="container mb-4">
        <div class="row mt-4">
            <div class="col">
                <h2 class="mb-4">{{ __('Edit Profile') }}</h2>
            </div>
        </div>
        <div class="grid-container">
            <div class="justify-content-center ">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">

                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                    @livewire('profile.update-profile-information-form')

                                @endif
                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                    @livewire('profile.update-password-form')

                                @endif

                                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                    @livewire('profile.two-factor-authentication-form')

                                @endif

                                @livewire('profile.logout-other-browser-sessions-form')

                                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())

                                    @livewire('profile.delete-user-form')
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    {{-- </div> --}}

@endsection

@section('js')
    @parent
    @livewireScripts
@endsection
