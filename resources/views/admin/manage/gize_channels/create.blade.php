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



        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Gize Channel  </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>


                <div class="card-body">
                    <form method="post" action="{{ route('admin.manage.gize_channel.store') }}">
                        @csrf
                        @method('post')
                        <div class="px-4 py-2 sm:p-6">

                            <label for="name" class="">Channel Name</label>

                            <input class="form-control" type="text" id="name" name="name" placeholder="Channel Name"
                                value="{{ old('name', '') }}" />

                            @error('name')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-2 sm:p-6">

                            <label for="name_en" class="">Channel Name (En)</label>

                            <input class="form-control" type="text" id="name_en" name="name_en" placeholder="Channel Name (English)"
                                value="{{ old('name_en', '') }}" />

                            @error('name_en')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-2 sm:p-6">

                            <label for="slug" class="">Slug</label>

                            <input class="form-control" type="text" id="slug" name="slug" placeholder="Slug"
                                value="{{ old('slug', '') }}" />

                            @error('slug')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="px-4 py-2 sm:p-6">

                            <label for="producer" class="">Producer</label>

                            <input class="form-control" type="text" id="producer" name="producer" placeholder="Producer"
                                value="{{ old('producer', '') }}" />

                            @error('producer')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="description" class="">Description</label>

                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', '') }}</textarea>


                            @error('description')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="phone_number" class="">Phone Number</label>

                            <textarea class="form-control" id="phone_number" name="phone_number" rows="5">{{ old('phone_number', '') }}</textarea>


                            @error('phone_number')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="contact_address" class="">Contact Address</label>

                            <textarea class="form-control" id="contact_address" name="contact_address" rows="5">{{ old('contact_address', '') }}</textarea>


                            @error('contact_address')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="website" class="">Website</label>

                            <textarea class="form-control" id="website" name="website" rows="5">{{ old('website', '') }}</textarea>


                            @error('website')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="px-4 py-2 sm:p-6">

                            <label for="roles" class="">Channel Admins</label>
                            <div class="select2-purple">
                                <select style="width: 100%;" data-placeholder="Select Channel Admins" name="users[]" id="users"
                                    class="select2 select-channel-admins-multiple"
                                    multiple="multiple"
                                    data-dropdown-css-class="select2-purple">
                                    @foreach ($channel_admins as $id => $channel_admin)
                                        <option value="{{ $channel_admin->id }}">
                                            {{ $channel_admin->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('roles')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="px-4 pt-4 text-right">
                            <a href="{{ route('admin.manage.gize_channel.index') }}" class="btn btn-default mr-2">
                                Cancel
                            </a>
                            <button class="btn btn-primary ">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('vendors/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select-channel-admins-multiple').select2({
            theme: 'bootstrap4'
        })

    </script>
    @livewireScripts
@endsection
