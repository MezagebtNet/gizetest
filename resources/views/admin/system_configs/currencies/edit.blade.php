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
                    <h3 class="card-title">Editt Currency (ID: {{ $currency->id }}) </h3>

                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('admin.system_configs.currencies.update', $currency->id) }}">
                        @csrf
                        @method('put')
                        <div class="px-4 py-2 sm:p-6">

                            <label for="currency_name" class="">Currency
                                Name</label>

                            <input class="form-control" type="text" id="currency_name" name="currency_name"
                                placeholder="Currency Name"
                                value="{{ old('currency_name', $currency->currency_name) }}" />

                            @error('currency_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-2 sm:p-6">
                            <label for="currency_code" class="">Currency
                                Code</label>
                            <input class="form-control" type="text" id="currency_code" name="currency_code"
                                placeholder="Currency Code"
                                value="{{ old('currency_code', $currency->currency_code) }}" />
                            @error('currency_code')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div class="px-4 pt-4 text-right">
                            <a href="{{ route('admin.system_configs.currencies.index') }}" class="btn btn-default mr-2">
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
