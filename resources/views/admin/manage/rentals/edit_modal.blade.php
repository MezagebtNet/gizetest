<div class="modal" id="book_formatEditModal" tabindex="-1" aria-labelledby="book_formatEditModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="book_formatEditModalLabel">Edit Book Format</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="book_formatEditForm" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <label for="name_ed">Name</label>
                        <input type="text" class="form-control" id="name_ed" />
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
