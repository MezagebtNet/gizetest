<div class="modal" id="book_languageModal" tabindex="-1" aria-labelledby="book_languageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="book_languageModalLabel">Add New Book Language</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="book_languageForm" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="language_name">Name</label>
                  <input type="text" class="form-control" id="language_name" />
              </div>
              <div class="form-group">
                  <label for="language_native_name">Native Name</label>
                  <input type="text" class="form-control" id="language_native_name" />
              </div>
              <div class="form-group">
                  <label for="language_code">Code</label>
                  <input type="text" class="form-control" id="language_code" />
              </div>
              <div class="row">
                <div class="col-8"></div>
                <div class="col-2">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
