

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="currencyModal" tabindex="-1" role="dialog" aria-labelledby="currencyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="currencyModalLabel">Create Currency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="currency_name">Currency Name</label>
                        <input type="text" class="form-control" id="currency_name" placeholder="Enter Currency Name" wire:model="currency_name">
                        @error('currency_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="currency_code">Currency Code</label>
                        <input type="text" class="form-control" id="currency_code" wire:model="email" placeholder="Enter Currency Code">
                        @error('currency_code') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save changes</button>
            </div>
        </div>
    </div>
</div>