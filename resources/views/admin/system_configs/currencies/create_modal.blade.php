<div class="modal fade" id="currencyCreateModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Currency</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCurrency" action="{{ route('admin.system_configs.currencies.store') }}">
                    @csrf
                        <label for="currency_name" class="block font-medium text-sm text-gray-700">Currency
                            Name</label>

                        <input class="form-control" type="text" id="currency_name" name="currency_name"
                            placeholder="Currency Name" value="{{ old('currency_name', '') }}" />

                        @error('currency_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="currency_code" class="block font-medium text-sm text-gray-700">Currency
                            Code</label>
                        <input class="form-control" type="text" id="currency_code" name="currency_code"
                            placeholder="Currency Code" value="{{ old('currency_code', '') }}" />
                        @error('currency_code')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <button> Create </button>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnAddCurrency">Create</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
