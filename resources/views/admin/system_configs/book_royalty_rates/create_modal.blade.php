<div class="modal" id="book_royalty_rateModal" tabindex="-1" aria-labelledby="book_royalty_rateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="book_royalty_rateModalLabel">Add New Book Royalty Rate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="book_royalty_rateForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="genre_book_royalty_rate_id" name="genre_book_royalty_rate_id" />

                    <div class="form-group">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <label class="input-group-text" for="inputGroupSelect01">Currency</label>
                          </div>
                          <select class="custom-select" id="inputGroupSelect01">
                              <option selected>Choose...</option>
                              @foreach ($currencies as $currency)
                                  <option value="{{ $currency->id }}">{{ $currency->currency_name }}
                                      ({{ $currency->currency_code }})</option> @endforeach
                          </select>
                      </div>
                    </div>


                    <div class="form-group">
                      <label>Royalty Rate:</label>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-percent"> </i> </span>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="">
                      </div>
                      <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Publish Date:</label>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"> </i> </span>
                          </div>
                          <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="">
                        </div>
                        <!-- /.input group -->
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
