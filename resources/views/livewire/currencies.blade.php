@extends('layouts.admin')

@section('title', 'System Settings')

@section('styles')
    @livewireStyles
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">x
            {{ session('message') }}
        </div>
    @endif
    <div class="row .flex-md-row-reverse">
        <div class="col-sm-3  order-sm-2">

            @include('admin.system_configs_sidebar')

        </div>

        <div class="col-sm-9  order-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Currency Setup </h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-xs ml-2 btn-secondary" data-toggle="modal"
                        data-target="#currencyModal">
                        Add modal
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#currencyModal">
                        Open Form
                    </button>
                    <div class="card-tools">

                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <div>
                        <table class="table table-bordered mt-5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($currencies as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->currency_name }}</td>
                                        <td>{{ $value->currency_code }}</td>
                                        <td>
                                            <button data-toggle="modal" data-target="#currencyModal"
                                                wire:click="edit({{ $value->id }})"
                                                class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="delete({{ $value->id }})"
                                                class="btn btn-danger btn-sm">Delete</button>
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


@section('modals')


    @include('livewire.create')
    @include('livewire.update')

@endsection


@section('js')


    @livewireScripts

    <script type="text/javascript">
        window.livewire.on('currencyStore', () => {
            $('#currencyModal').modal('hide');
        });

    </script>


@endsection
