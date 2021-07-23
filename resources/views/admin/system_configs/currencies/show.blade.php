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

                            <h3 class="card-title">Currency Detail (ID: {{ $currency->id }}) </h3>

                            <div class="card-tools">
                                <!-- Collapse Button -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                            <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr class="border-b">
                            <th scope="col"
                                class="px-6 py-2 bg-gray-50 text-right  font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <td class="pl-3 px-6 py-2 whitespace-nowrap  text-gray-900 bg-white divide-y divide-gray-200">
                                {{ $currency->id }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col"
                                class="px-6 py-2 bg-gray-50 text-right  font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <td class="pl-3 px-6 py-2 whitespace-nowrap  text-gray-900 bg-white divide-y divide-gray-200">
                                {{ $currency->currency_name }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <th scope="col"
                                class="px-6 py-2 bg-gray-50 text-right  font-medium text-gray-500 uppercase tracking-wider">
                                Code
                            </th>
                            <td class="pl-3 px-6 py-2 whitespace-nowrap  text-gray-900 bg-white divide-y divide-gray-200">
                                {{ $currency->currency_code }}
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.system_configs.currencies.index') }}"
                        class="ml-2">
                        < Back to list</a>

                </div>
            </div>
        </div>
    </div>


@endsection
