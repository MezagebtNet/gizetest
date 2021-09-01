<div class="modal" id="periodEditModal" tabindex="-1" aria-labelledby="periodEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodModalLabel">{{ __('Edit Period') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="periodEditForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="period_batch_id_ed" name="period_batch_id_ed" value="" />

                    <input type="hidden" id="subscription_period_id_ed" name="subscription_period_id_ed" value="" />
                    <div class="container">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="period_name_ed">{{ __('Name') }}</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="period_name_ed" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="period_from_date_ed">{{ __('From Date') }}</label>
                                </div>
                                <div class='col-md-8'>
                                    <div class="form-group">
                                        <div class="input-group date" id="period_from_date_ed" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#period_from_date_ed" />
                                            <div class="input-group-append" data-target="#period_from_date_ed"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="period_to_date_ed">{{ __('To Date') }}</label>
                                </div>
                                <div class='col-md-8'>
                                    <div class="form-group">
                                        <div class="input-group date" id="period_to_date_ed" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#period_to_date_ed" />
                                            <div class="input-group-append" data-target="#period_to_date_ed"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="period_from_date_ed">From Date</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group date" id="period_from_date_ed" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#period_from_date_ed" value="">
                                    <div class="input-group-append" data-target="#period_from_date_ed"
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
                                <label for="period_to_date_ed">To Date</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group date" id="period_to_date_ed" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#period_to_date_ed" value="">
                                    <div class="input-group-append" data-target="#period_to_date_ed"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
