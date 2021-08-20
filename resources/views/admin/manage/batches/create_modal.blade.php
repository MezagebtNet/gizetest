<div class="modal" id="batchModal" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="batchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="batchModalLabel">Add New Batch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="batchForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="code_name">Code Name</label>
                        <input type="text" class="form-control" id="code_name" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="subscription_period_id">Starting Period</label>
                        <div class="select2-purple">

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="payment_fee">Fee</label>
                        <input type="text" class="form-control" id="payment_fee" />
                    </div>
                    <div class="form-group">
                        <label for="currency">Currency</label>
                        <select id="currency" class="custom-select mb-3">
                            <option value="ETB">ETB (Ethiopian Birr)</option>
                            <option value="USD">USD (United States Dollar)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        {{-- <input type="text" class="form-control" id="status" /> --}}
                        <select id="status" class="custom-select mb-3">
                            <option value="0" selected>Not Started</option>
                            <option value="1">Ongoing</option>
                            <option value="2">Onhold</option>
                            <option value="3">Closed</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
