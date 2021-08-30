@extends('layouts.admin.index')

@section('page_title', 'Users')

@section('header_title')
	Users Management Page
@stop

@section('breadcrumb')
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
		<li class="breadcrumb-item active"><a href="{{ route('admin.manage.user.index') }}">Users Management</a></li>
		<li class="breadcrumb-item active"><a href="#">Show</a></li>
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('navbar')
    @include('admin.navbar')
@endsection


@section('notifications-dropdown')
    @include('admin.navbar-notifications-dropdown')
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection


@section('content')
    <div class="row .flex-md-row-reverse">
        <div class="col-12">
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
                    <a href="{{ route('admin.manage.user.index') }}" class="ml-2">
                        < Back to list</a>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    @livewireScripts
@endsection
