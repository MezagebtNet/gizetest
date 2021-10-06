<div class="modal" id="rentalModal" tabindex="-1" aria-labelledby="rentalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rentalModalLabel">Add New Rental</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rentalForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="select_subscriber">Select User</label>
                        <select id="select_subscriber" name="select_subscriber" class="select-subscribers"></select>

                    </div>

                    <div class="form-group">
                        <label for="select_video">Select Video</label>
                        <select id="select_video" name="select_video" class="select-videos">

                        </select>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="publish_date">Publish Date</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group date" id="publish_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#publish_date" value="">
                                    <div class="input-group-append" data-target="#publish_date"
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
                                <label for="within_days">Within Days</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="within_days" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="for_hours">For Hours</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="for_hours" />
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
