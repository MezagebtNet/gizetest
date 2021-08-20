<div class="modal" id="subscriptionModal" tabindex="-1"
    aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscriptionModalLabel">Add New Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="subscriptionForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="batch_id" name="batch_id" value=""/>

                    <div class="form-group">
                        <label for="select_subscriber">Select User</label>
                        <select id="select_subscriber"  name="select_subscriber" class="select-subscribers"></select>


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
