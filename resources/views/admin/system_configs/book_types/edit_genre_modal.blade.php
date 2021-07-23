<div class="modal" id="book_genreEditModal" tabindex="-1" aria-labelledby="book_genreEditModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="book_genreEditModalLabel">Edit Book Genre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="validation-errors"></div>
                <form id="book_genreEditForm" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" id="genre_id" name="genre_id" />
                    <input type="hidden" id="genre_book_type_id_ed" name="genre_book_type_id_ed" />
                    <div class="form-group">
                        <label for="genre_name_ed">Name</label>
                        <input type="text" class="form-control" id="genre_name_ed" />
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
