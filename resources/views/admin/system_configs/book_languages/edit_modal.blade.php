<div class="modal" id="book_languageEditModal" tabindex="-1" aria-labelledby="book_languageEditModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="book_languageEditModalLabel">Edit Book Language</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="validation-errors"></div>
                <form id="book_languageEditForm" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <label for="language_name_ed">Name</label>
                        <input type="text" class="form-control" id="language_name_ed" />
                    </div>
                    <div class="form-group">
                        <label for="language_native_name_ed">Native Name</label>
                        <input type="text" class="form-control" id="language_native_name_ed" />
                    </div>
                    <div class="form-group">
                        <label for="language_code_ed">Code</label>
                        <input type="text" class="form-control" id="language_code_ed" />
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
