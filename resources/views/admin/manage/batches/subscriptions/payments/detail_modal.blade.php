<div class="modal " id="paymentModalDetail" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="paymentAddForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="pmt_show_batch_user_id" name="pmt_show_batch_user_id" value="" />
                    <div class="form-group row my-0">
                        <label for="pmt_show_period_no" class="text-sm-left text-md-right col-sm-8 col-form-label">Subscription Period</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext" id="pmt_show_period_no"
                                value="">
                        </div>
                    </div>
                    <div class="form-group row my-0">
                        <label for="pmt_show_subscriber_name" class="text-sm-left text-md-right  col-sm-8 col-form-label">User</label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control-plaintext" id="pmt_show_subscriber_name"
                                value="">
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4" >
                                <label for="pmt_show_payment_date">Payment Date</label>
                            </div>
                            <div class="col-sm-8" >
                                <input type="text" readonly class="form-control" id="pmt_show_payment_date"
                                    value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="pmt_show_amount">Amount</label>
                            </div>
                            <div class="col-8">
                                <input type="text" readonly class="form-control" id="pmt_show_amount" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="pmt_show_select_method">Method</label>
                            </div>
                            <div class="col-8">
                                <input type="text" readonly class="form-control" id="pmt_show_method" />

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="pmt_show_reciept_no">Recuept No.</label>
                            </div>
                            <div class="col-8">
                                <input type="text" readonly class="form-control" id="pmt_show_reciept_no" />
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="col-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
