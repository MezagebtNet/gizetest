<div class="modal" id="batchEditModal" tabindex="-1" aria-labelledby="batchEditModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="batchEditModalLabel">Edit Batch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="batchEditForm" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <label for="code_name_ed">Code Name</label>
                        <input type="text" class="form-control" id="code_name_ed" />
                    </div>
                    <div class="form-group">
                        <label for="description_ed">Description</label>
                        <textarea class="form-control" id="description_ed" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="subscription_period_id_ed">Starting Period</label>
                        <input type="text" class="form-control" id="subscription_period_id_ed" />
                    </div>
                    <div class="form-group">
                        <label for="payment_fee_ed">Fee</label>
                        <input type="text" class="form-control" id="payment_fee_ed" />
                    </div>
                    <div class="form-group">
                        <label for="currency_ed">Currency</label>
                        <input type="text" class="form-control" id="currency_ed" />
                    </div>
                    <div class="form-group">
                        <label for="status_ed">Status</label>
                        <input type="text" class="form-control" id="status_ed" />
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-2">
                            <button id="btn-update-submit" type="submit" class="btn btn-primary " disabled >Update</button>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
