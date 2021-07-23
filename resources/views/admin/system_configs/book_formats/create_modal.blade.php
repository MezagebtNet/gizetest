<div class="modal"  id="book_formatModal" tabindex="-1" aria-labelledby="book_formatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="book_formatModalLabel">Add New Book Format</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="book_formatForm" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" />
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
