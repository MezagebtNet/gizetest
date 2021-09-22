@extends('layouts.admin.index')

@section('page_title', 'Gize Channels')

@section('header_title')
	Gize Channels Management Page
@stop

@section('breadcrumb')
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
		<li class="breadcrumb-item active">Gize Channel Management</li>
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
                    <h3 class="card-title">Channels List </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                    data-target="#currencyCreateModal">
                    Add modal
                </button> --}}
                    <a class="btn btn-xs px-2 ml-2 btn-primary" href="{{ route('admin.manage.gize_channel.create') }}">
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
                                <th scope="col">Chanel Name</th>
                                <th scope="col">(En)</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Producer</th>
                                <th scope="col">Description</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Contact Address</th>
                                <th scope="col">Website</th>
                                <th scope="col">Admins</th>
                                <th scope="col" width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gize_channels as $channel)
                                <tr>
                                    <td>{{ $channel->id }}</td>

                                    <td>{{ $channel->name }}</td>

                                    <td>{{ $channel->name_en }}</td>

                                    <td>{{ $channel->slug }}</td>

                                    <td>{{ $channel->producer }}</td>

                                    <td>{{ $channel->description }}</td>

                                    <td>{{ $channel->phone_number }}</td>

                                    <td>{{ $channel->contact_address }}</td>

                                    <td>{{ $channel->website }}</td>

                                    <td>
                                        @foreach ($channel->users()->get() as $channel_admin)
                                            <span class="badge badge-secondary">{{ $channel_admin->name }}</span>
                                        @endforeach
                                    </td>

                                    <td class="">
                                        <div class="row">
                                            <a href="{{ route('admin.manage.gize_channel.show', $channel->id) }}"
                                                class="mx-1 btn btn-xs btn-outline-success" title="View"><i
                                                    class="fa fa-eye"></i> View</a>

                                            <a href="{{ route('admin.manage.gize_channel.edit', $channel->id) }}"
                                                class="mx-1 btn btn-xs btn-outline-info" title="Edit"><i
                                                    class="fa fa-edit"></i>
                                                Edit</a>
                                            <form class="inline-block"
                                                action="{{ route('admin.manage.gize_channel.destroy', $channel->id) }}" method="POST"
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
