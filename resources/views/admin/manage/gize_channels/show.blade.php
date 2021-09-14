@extends('layouts.admin.index')

@section('page_title', 'Gize Channels')

@section('header_title')
	Gize Channels Management Page
@stop

@section('breadcrumb')
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
		<li class="breadcrumb-item active"><a href="{{ route('admin.manage.gize_channel.index') }}">Gize Channels Management</a></li>
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

                    <h3 class="card-title">Gize Channel Detail (ID: {{ $gize_channel->id }}) </h3>

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
                                {{ $gize_channel->id }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Channel Name
                            </th>
                            <td>
                                {{ $gize_channel->name }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Channel Name (English)
                            </th>
                            <td>
                                {{ $gize_channel->name_en }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Slug
                            </th>
                            <td>
                                {{ $gize_channel->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Producer
                            </th>
                            <td>
                                {{ $gize_channel->producer }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Description
                            </th>
                            <td>
                                {{ $gize_channel->description }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">
                                Admins
                            </th>
                            <td>
                                @foreach ($gize_channel->users()->get() as $channel_admin)
                                    <span
                                        class="badge badge-secondary">
                                        {{ $channel_admin->name }}
                                    </span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.manage.gize_channel.index') }}" class="ml-2">
                        < Back to list</a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    @livewireScripts
@endsection
