<div class="modal" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Add New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="scheduleForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="batch_id" name="batch_id" value="" />

                    <div class="form-group">
                        <label for="select_video">Select Video</label>
                        <select id="select_video" name="select_video" class="select-videos">

                        </select>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="schedule_starts_at">{{ __('Starts at date and time') }}</label>


                                    <div class="input-group date" id="schedule_starts_at" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#schedule_starts_at" />
                                        <div class="input-group-append" data-target="#schedule_starts_at"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="schedule_ends_at">{{ __('Ends at date and time') }}</label>

                                    <div class="input-group date" id="schedule_ends_at" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#schedule_ends_at" />
                                        <div class="input-group-append" data-target="#schedule_ends_at"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">

                                <label for="video_schedule_duration">{{ __('Duration (Hrs.)') }}</label>

                                <input type="text" class="form-control" id="video_schedule_duration" value="24"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">

                                <label for="notify_viewers">{{ __('Notify Viewers') }}</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="notify_viewers">
                                    <label class="form-check-label" for="notify_viewers">
                                      Send notification message to viewers in batch about this schedule.
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4"/>
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
