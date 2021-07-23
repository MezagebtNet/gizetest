@extends('layouts.website.index')

@section('title', 'User Account')

@section('styles')
    @livewireStyles
@endsection

@section('navbar')
    @include('website.navbar')
@endsection

@section('content')

        <div>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="col-sm-12  order-sm-1">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile </h3>

                            <div class="card-tools">
                                <!-- Collapse Button -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">


                            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                @livewire('profile.update-profile-information-form')

                            @endif


                        </div>

                    </div>
                </div>
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



@endsection

@section('js')
    @parent
    @livewireScripts
@endsection