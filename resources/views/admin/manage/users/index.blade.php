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

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">

        <style>
            th,
            td {
                white-space: nowrap;
            }

            div.dataTables_wrapper {
                /* width: 800px; */
                margin: 0 auto;
            }

        </style>

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

                <div class="card-body" style="overflow-x:scroll;">
                    <div class="dataTables_wrapper">

                        <table id="userTable" class="table table-hover table-sm" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">ID</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
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

                                        <td style="width: 40px;">
                                            <img style="max-wdith: 64px !important;" width="64" src="{{ $user->profile_photo_url }}" alt="{{ $user->fullName() }}"/>
                                        </td>

                                        <td>{{ $user->fullName() }}</td>

                                        <td>{{ $user->phone_number }}</td>

                                        <td>{{ $user->address }}</td>

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
    </div>
@endsection

@section('js')

    @livewireScripts

<!-- DataTables  & Plugins -->
<script src="{{ asset('vendors/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('vendors/admin/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.js') }}"></script>
<script src="{{ asset('vendors/admin/plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js') }}">
</script>

<script>
$(function() {
    $("#userTable").DataTable({
            // scrollY:        "100px",
            scrollX: true,
            // scrollCollapse: true,
            paging: true,
        }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');

});
</script>
@endsection
