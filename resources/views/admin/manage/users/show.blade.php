@extends('layouts.admin.index')

@section('title', 'User Management')

@section('styles')
    @livewireStyles
@endsection

@section('notifications-dropdown')
    @include('admin.notifications-dropdown')
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('content')
    <div class="row .flex-md-row-reverse">
        <div class="col-sm-3  order-sm-2">

            @include('admin.system_configs.sidebar')

        </div>

        <div class="col-sm-9  order-sm-1">
            <div class="card">
                <div class="card-header">

                    <h3 class="card-title">User Detail (ID: {{ $user->id }}) </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th scope="col">
                                ID
                            </th>
                            <td>
                                {{ $user->id }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Name
                            </th>
                            <td>
                                {{ $user->fullName() }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Email
                            </th>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Email Verified At
                            </th>
                            <td>
                                {{ $user->email_verified_at }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Roles
                            </th>
                            <td>
                                @foreach ($user->getRoleNames() as $role)
                                    <span
                                        class="badge badge-secondary">
                                        {{ $role }}
                                    </span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.manage.users.index') }}" class="ml-2">
                        < Back to list</a>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    @livewireScripts
@endsection
