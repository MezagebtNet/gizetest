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



        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create User  </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>


                <div class="card-body">
                    <form method="post" action="{{ route('admin.manage.user.store') }}">
                        @csrf
                        <div class="px-4 py-2 sm:p-6">

                            <label for="firstname" class="">First Name</label>

                            <input class="form-control" type="text" id="firstname" name="firstname" placeholder="First Name"
                                value="{{ old('firstname', '') }}" />

                            @error('firstname')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="px-4 py-2 sm:p-6">

                            <label for="lastname" class="">Last Name</label>

                            <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last Name"
                                value="{{ old('lastname', '') }}" />

                            @error('lastname')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="email" class="">Email</label>

                            <input class="form-control" type="text" id="email" name="email" placeholder="Email"
                                value="{{ old('email', '') }}" />

                            @error('email')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="password" class="">Password</label>

                            <input class="form-control" type="password" id="password" name="password" />

                            @error('password')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">

                            <label for="password" class="">Confirm Password</label>

                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" />

                            @error('password')
                                <p class="text-sm text-red">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="px-4 py-2 sm:p-6">

                            <label for="roles" class="">Roles</label>
                            <div class="select2-purple">
                                <select style="width: 100%;" data-placeholder="Select a Role" name="roles[]" id="roles"
                                    class="select2 slect-roles-multiple"
                                    multiple="multiple"
                                    data-dropdown-css-class="select2-purple">
                                    @foreach ($roles as $id => $role)
                                        <option value="{{ $role->id }}">
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
                            <a href="{{ route('admin.manage.user.index') }}" class="btn btn-default mr-2">
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
        $('.slect-roles-multiple').select2({
            theme: 'bootstrap4'
        })

    </script>
    @livewireScripts
@endsection
