@extends('layouts.admin.index')

@section('title', 'System Settings')

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
                    <h3 class="card-title">Currency Settings </h3>
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyCreateModal">
                        Add modal
                    </button> --}}
                    <a class="btn btn-xs px-2 ml-2 btn-primary" href="{{ route('admin.system_configs.currencies.create') }}" >
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
                    <table class="table table-hover table-sm">
                        <caption>List of Currencies</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $currency)
                                <tr>
                                    <th scope="row"> {{ $currency->id }}</th>
                                    <td>{{ $currency->currency_name }}</td>
                                    <td>{{ $currency->currency_code }}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('admin.system_configs.currencies.show', $currency->id) }}"
                                                class="mx-1 btn btn-xs btn-outline-success" title="View"><i
                                                    class="fa fa-eye"></i> View</a>

                                            <a href="{{ route('admin.system_configs.currencies.edit', $currency->id) }}"
                                                class="mx-1 btn btn-xs btn-outline-info" title="Edit"><i
                                                    class="fa fa-edit"></i> Edit</a>






                                            <form action="{{ route('admin.system_configs.currencies.destroy', $currency->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-outline-danger" value="Delete">
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


@section('modals')

    @include('admin.system_configs.currencies.create_modal')
    @include('admin.system_configs.currencies.edit_modal')

@endsection


@section('js')

    @livewireScripts

    <script>
        $('#currencyEditModal').on('show.bs.modal', function(event) {
            $('#currency_name').val()
        });


        $('#currencyCreateModal').on('hide.bs.modal', function(event) {
            $this.preventDefault();
            $('#currency_name').val()
        });

        $('#btnAddCurrency').on('click', function(event) {
            alert('clicked');
        });

    </script>
@endsection
