<div class="modal " id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel"> Payment Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="pmt_create_batch_user_id" name="pmt_create_batch_user_id" value="" />
                    <input type="hidden" id="pmt_create_batch_id" name="pmt_create_batch_id" value="" />
                    <input type="hidden" id="pmt_create_subscription_period" name="pmt_create_subscription_period"
                        value="" />
                    <div class="form-group row my-0">
                        <label for="pmt_create_period_no"
                            class="text-sm-left text-md-right col-sm-8 col-form-label">Subscription Period</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext" id="pmt_create_period_no" value="">
                        </div>
                    </div>
                    <div class="form-group row my-0">
                        <label for="pmt_create_subscriber_name"
                            class="text-sm-left text-md-right  col-sm-8 col-form-label">User</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext" id="pmt_create_subscriber_name"
                                value="">
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="pmt_create_payment_date">Payment Date</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group date" id="pmt_create_payment_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#pmt_create_payment_date" value="">
                                    <div class="input-group-append" data-target="#pmt_create_payment_date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="pmt_create_amount">Amount</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="pmt_create_amount" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="pmt_create_select_method">Select Method</label>
                            </div>
                            <div class="col-8">
                                <select id="pmt_create_select_method" name="pmt_create_select_method"
                                    class="custom-select select-method">
                                    <option value="">Choose</option>
                                    <option value="Cash">Cash</option>
                                    <option value="CBE">Commercial Bank of Ethiopia (Deposit)</option>
                                    <option value="Dashen">Dashen Bank (Deposit)</option>
                                    <option value="Abyssinia">Abyssinia Bank (Deposit)</option>
                                    <option value="CBE-birr">CBE-birr</option>
                                    <option value="Telebirr">Telebirr</option>
                                    <option value="M-birr">M-Birr</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="pmt_create_reciept_no">Reciept No.</label>

                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="pmt_create_reciept_no" />

                            </div>
                        </div>
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Update</button>
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
