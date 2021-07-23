<div class="modal fade" id="currencyEditModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Currency</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="put" id="frmEditCurrency" action="{{ route('admin.system_configs.currencies.update', $currency->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="currency_name" class="block font-medium text-sm text-gray-700">Currency
                                Name</label>

                            <input class="form-control"
                                type="text"
                                name="currency_name"
                                id="currency_name"
                                placeholder="Currency Name"
                                value="{{ old('currency_name', $currency->currency_name) }}" />

                            @error('currency_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="currency_code" class="block font-medium text-sm text-gray-700">Currency
                                Code</label>
                            <input class="form-control"
                                type="text"
                                name="currency_code"
                                id="currency_code"
                                placeholder="Currency Name"
                                value="{{ old('currency_code', $currency->currency_code) }}" />

                                @error('currency_code')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnEditCurrency" onclick="
            $('#frmEditCurrency').submit();
            // $this->preventDefault();
          ">Create</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



{{-- <div>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('currencies.update', $currency->id) }}">
                @csrf
                @method('put')
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="currency_name" class="block font-medium text-sm text-gray-700">Currency Name</label>
                        <input type="text" name="currency_name" id="currency_name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                               value="{{ old('currency_name', $currency->currency_name) }}" />
                        @error('currency_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="currency_code" class="block font-medium text-sm text-gray-700">Currency Code</label>
                        <input type="text" name="currency_code" id="currency_code" class="form-input rounded-md shadow-sm mt-1 block w-full"
                               value="{{ old('currency_code', $currency->currency_code) }}" />
                        @error('currency_code')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}