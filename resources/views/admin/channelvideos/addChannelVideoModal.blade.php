<div class="modal fade" id="channelvideoModal" tabindex="-1" aria-labelledby="channelvideoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="channelvideoModalLabel">Add Channel Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="channelvideoForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" />
            </div>
            <div class="form-group">
                <label for="author">Trainer</label>
                <input type="text" class="form-control" id="trainer" />
            </div>
            <div class="form-group">
                <label for="author">Duration</label>
                <input type="text" class="form-control" id="duration" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="image_input">Poster Image</label>
                <input type="file" name="image_input" class="form-control-file" id="image_input" />
                <div class="card" id="imgPreviewCard" style="display: none;">
                  <div class="card-body">
                    <img id="imgPreview" src="#" alt="your image" style="border-radius: 8px; display:none; max-width:250px; height: auto;" />
                  </div>
                </div>
                <span id="imgDetails" style=""></span>
                <span class="text-danger" id="image_input_error"></span>
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