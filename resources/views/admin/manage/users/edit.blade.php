@extends('layouts.admin.index')

@section('title', 'User Management')

@section('styles')
    @livewireStyles
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                    <h3 class="card-title">Edit User (ID: {{ $user->id }}) </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>


                <div class="card-body">
                    <form method="post" action="{{ route('admin.manage.users.update', $user->id) }}">
                        @csrf
                        @method('put')
                        <div class="px-4 py-2 sm:p-6">

                            <label for="firstname" class="">First Name</label>

                            <input class="form-control" type="text" id="firstname" name="firstname" placeholder="First Name"
                                value="{{ old('firstname', $user->firstname) }}" />

                            @error('firstname')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-2 sm:p-6">

                            <label for="lastname" class="">Last Name</label>

                            <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last Name"
                                value="{{ old('lastname', $user->lastname) }}" />

                            @error('lastname')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="email" class="">Email</label>

                            <input class="form-control" type="text" id="email" name="email" placeholder="Email"
                                value="{{ old('email', $user->email) }}" />

                            @error('email')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="px-4 py-2 sm:p-6">

                            <label for="password" class="">Password</label>

                            <input class="form-control" type="password" id="password" name="password" value="" />

                            @error('password')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="password_confirmation" class="">Confirm Password</label>

                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" />

                            @error('password_confirmation')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div class="px-4 py-2 sm:p-6">

                            <label for="roles" class="">Roles</label>
                            <div class="select2-purple">
                                <select style="width: 100%;" data-placeholder="Select a Role" name="roles[]" id="roles"
                                    class="select2 slect-roles-multiple"
                                    multiple="multiple"
                                    data-dropdown-css-class="select2-purple">
                                    @foreach ($roles as $id => $role)
                                        <option value="{{ $role->id }}"
                                            {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('roles')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="px-4 pt-4 text-right">
                            <a href="{{ route('admin.manage.users.index') }}" class="btn btn-default mr-2">
                                Cancel
                            </a>
                            <button class="btn btn-primary ">
                                Edit
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
        $('.slect-roles-multiple').select2({
            theme: 'bootstrap4'
        })

    </script>
    @livewireScripts
@endsection
