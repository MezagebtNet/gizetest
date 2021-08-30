@extends('layouts.admin.index')

@section('page_title', 'Users')

@section('page_title', 'Users')

@section('header_title')
	Users Management Page
@stop

@section('breadcrumb')
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
		<li class="breadcrumb-item active">Users Management</li>
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
        <div class="col-sm-12  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users List </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                    data-target="#currencyCreateModal">
                    Add modal
                </button> --}}
                    <a class="btn btn-xs px-2 ml-2 btn-primary" href="{{ route('admin.manage.user.create') }}">
                        Add New
                    </a>
                    <div class="card-tools">

                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table  class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Email Verified At</th>
                                <th scope="col">Roles</th>
                                <th scope="col" width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>

                                    <td>{{ $user->fullName() }}</td>

                                    <td>{{ $user->email }}</td>

                                    <td>{{ $user->email_verified_at }}</td>

                                    <td>
                                        @foreach ($user->getRoleNames() as $role)
                                            <span class="badge badge-secondary">{{ $role }}</span>
                                        @endforeach
                                    </td>

                                    <td class="">
                                        <div class="row">
                                            <a href="{{ route('admin.manage.user.show', $user->id) }}"
                                                class="mx-1 btn btn-xs btn-outline-success" title="View"><i
                                                    class="fa fa-eye"></i> View</a>

                                            <a href="{{ route('admin.manage.user.edit', $user->id) }}"
                                                class="mx-1 btn btn-xs btn-outline-info" title="Edit"><i
                                                    class="fa fa-edit"></i>
                                                Edit</a>
                                            <form class="inline-block"
                                                action="{{ route('admin.manage.user.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="mx-1 btn btn-xs btn-outline-danger"
                                                    title="Delete" value="Delete">
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('js')

    @livewireScripts
@endsection
