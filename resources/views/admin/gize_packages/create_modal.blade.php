<div class="modal" id="packageModal" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="packageModalLabel">Add Gize Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="packageForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="select_subscriber">Select User</label>
                        <select id="select_subscriber" name="select_subscriber" class="select-subscribers"></select>

                    </div>

                    <div class="form-group">
                        <label for="select-package">Select Package</label>
                        <select id="select_package" name="select-package" class="select-packages">

                        </select>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="start_date">Publish Date</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group date" id="start_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#start_date" value="">
                                    <div class="input-group-append" data-target="#start_date"
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
                            <button type="submit" class="btn btn-submit btn-primary">Submit</button>
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
