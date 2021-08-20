<div class="modal" id="periodModal" tabindex="-1"
    aria-labelledby="periodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodModalLabel">Add New Period</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="periodForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="period_batch_id" name="period_batch_id" value=""/>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="period_from_date">From Date</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group date" id="period_from_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#period_from_date" value="">
                                    <div class="input-group-append" data-target="#period_from_date"
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
                                <label for="period_to_date">To Date</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group date" id="period_to_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#period_to_date" value="">
                                    <div class="input-group-append" data-target="#period_to_date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Add</button>
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
