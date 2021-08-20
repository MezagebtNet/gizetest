<div class="modal fade" id="channelvideoPlayerModal" tabindex="-1" aria-labelledby="channelvideoPlayerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="channelvideoPlayerModalLabel">Video Player</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div id="alert_container" class="alert_container"></div>
            </div>
            <div class="col-4"></div>
        </div>

        <div class="row">
            <div class="col-12">
                <video class="h-80 w-full object-cover md:w-96"
												id="player"
												class="video-js"
												controls
												preload="auto"
												width="100%"
												data-setup="{}"
												responsive="true"
												poster=""
												controlsList="nodownload"
												>

												<!-- <source src="{{ route('admin.videostream', 0) }}" type="video/mp4" /> -->


											</video>
            </div>
        </div>


      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>