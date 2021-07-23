<!-- Modal -->
<div wire:ignore.self class="modal fade" id="currencyUpdateModal" tabindex="-1" role="dialog" aria-labelledby="currencyUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="currencyUpdateModalLabel">Edit Currency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <input type="hidden" wire:model="currency_id">

                    <div class="form-group">
                        <label for="currency_name">Currency Name</label>
                        <input type="text" class="form-control" wire:model="currency_name" id="currency_name" placeholder="Enter Currency Name">
                        @error('currency_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="currency_code">Currency Code</label>
                        <input type="text" class="form-control" wire:model="currency_code" id="currency_code" placeholder="Enter Currency Code">
                        @error('currency_code') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>