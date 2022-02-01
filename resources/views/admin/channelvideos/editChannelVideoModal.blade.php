<div class="modal fade" id="channelvideoEditModal" tabindex="-1" aria-labelledby="channelvideoEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="channelvideoEditModalLabel">Edit Channel Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="channelvideoEditForm" enctype="multipart/form-data">

            @csrf
            <input type="hidden" id="id" name="id" />
            <div class="form-group">
                <label for="title_ed">Title</label>
                <input type="text" class="form-control" id="title_ed" />
            </div>
            <div class="form-group">
                <label for="trainer_ed">Host</label>
                <input type="text" class="form-control" id="trainer_ed" />
            </div>
            <div class="form-group">
                <label for="duration_ed">Duration</label>
                <input type="text" class="form-control" id="duration_ed" />
            </div>

            <div class="form-group">
              <label for="collection_id_ed">{{ __('Collection') }}</label>
              <select class="form-control select2 " name="collection_id_ed" id="collection_id_ed">
                  <option>{{ __('Please Select') }}</option>
                  @foreach($first_level_collections as $collection)
                      <option disabled="disabled" value="{{ $collection->id }}">{{  $collection->title . ($collection->seriesable ? ' - ' . $collection->collection_type->singular_name . ' ' . $collection->series_no.'' : '')}}</option>
                      @foreach($collection->childCollections()->get() as $childCollection)
                          <option value="{{ $childCollection->id }}">-- {{ $collection->title . ($collection->seriesable ? ' - ' . $collection->collection_type->singular_name . ' ' . $collection->series_no.'' : ''). ' >> ' .  $childCollection->collection_type->singular_name  . ($childCollection->seriesable ? ' '.$childCollection->series_no : '') . ($childCollection->title !='' ? ': '.$childCollection->title : '') }}</option>
                      @endforeach
                  @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="description_ed">Description</label>
                <textarea class="form-control" id="description_ed" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="image_input_ed">Cover Image</label>
                <div class="card" id="imgUploadCard_ed" style="display: none;">
                  <input type="file" name="image_input_ed" class="form-control-file" id="image_input_ed">
                  <span id="imgDetails_ed" style=""></span>
                </div>
                <div class="card" id="imgPreviewCard_ed" style="display: none;">
                  <div class="card-body">
                    <img class="mr-2" id="imgPreview_ed" src="#" alt="your image" style="border-radius: 8px; display:none; max-width:100px; height: auto;" />
                    <button id="btn-delete-cover-image" channelvideoid="" type="button" class="btn btn-danger">Delete</button>
                  </div>
                </div>

                <span class="text-danger" id="image_input_error_ed"></span>
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