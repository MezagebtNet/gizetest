<div class="modal" id="book_genreModal" tabindex="-1" aria-labelledby="book_genreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="book_genreModalLabel">Add New Book Genre</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="book_genreForm" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="genre_book_type_id" name="genre_book_type_id" />

              <div class="form-group">
                  <label for="genre_name">Name</label>
                  <input type="text" class="form-control" id="genre_name" />
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
