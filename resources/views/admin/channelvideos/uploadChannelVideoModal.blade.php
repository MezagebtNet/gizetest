<div class="modal fade" data-backdrop="static" id="channelvideoUploadModal" tabindex="-1" aria-labelledby="channelvideoUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="channelvideoUploadModalLabel">Upload Video File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



        <input type="hidden" id="upload_channelvideo_id" name="upload_channelvideo_id" value="" />
        <input type="hidden" id="channelvideo_id" name="channelvideo_id" value="" />


          <!-- <form id="channelvideoUploadForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="channelvideo_id" name="channelvideo_id" value="" />
            <div class="row">
              <label for="channelvideo_file_input">Allowed file format: 'mp4'</label>
              <div class="col-8">

                <input type="file" name="channelvideo_file_input" class="form-control-file" id="channelvideo_file_input" />
              </div>
              <div class="col-4">
                <button id="btn_upload_channelvideo" type="submit" class="btn btn-sm btn-primary">Upload</button>
              </div>
            </div>

            <div class="form-group">

                <span class="text-danger" id="channelvideo_file_input_error"></span>
            </div>


          </form> -->
        <div class="row stream-uploader">
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <div style="padding-bottom: 4px;">Upload: (Zip File) Containing <strong>Video Stream files</strong>: </div>
              </div>
            </div>
            <div class="row">
              <div style="margin-top: auto; margin-bottom: auto;" class="col-5  align-self-center">
                <div class="flex text-center justify-center" >
                  <i style="font-size: 4.5em; color: lightgray;" class="fas fa-video"></i>
                  <a href="#" title="Removes all Video Stream files" style="margin-top: 22px; color: red;" id="resumable-stream-delete" >
                    <div class="bg-indigo-800 text-brown text-center font-bold rounded-lg border shadow-lg">
                      Delete
                    </div>
                  </a>


                </div>
              </div>
              <div class="col-7">
                <div  class="row">
                  <div class="col-12">
                    <div style="margin-top: auto; margin-bottom: auto;" class="card card-block ">
                      <div class="card-body text-center"  id="videoStreamUploader">
                        <div class="">
                          <div id="resumable-stream-error" style="display: none">
                              Resumable not supported
                          </div>
                          <div id="resumable-stream-drop" style="display: none">
                            <div class="flex justify-content-center col-sm-12">
                              <div class="row">
                                  <div class="col-12">
                                      <div id="alert_container" class="alert_container"></div>
                                  </div>
                              </div>


                              <div class="row">
                                <div class="col-12  text-wrap">
                                  <button style="margin-top: 22px;" type="button" class="btn btn-success" id="resumable-stream-browse" data-url="{{ route('admin.manage.channelvideo.uploadhlschunk', $gize_channel->id) }}" >Upload</button>

                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="row">
                              <div class="col-12  text-wrap">
                                  <div id="stream_file_size" class="stream_file_size"></div>
                              </div>
                          </div>
                        </div>
                        <ul id="stream-file-upload-list" class="list-unstyled"  style="display: none">

                        </ul>
                        <button type="button" class="btn btn-primary" id="resumable-stream-cancel" style="display: none;">Cancel</button>


                        <br/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>




        </div>



        <div class="row keys-uploader" style="margin-top: 25px;">
          <div class="col-12">
            <div class="row">
              <div class="col-12">
                <div style="padding-bottom: 4px;">Upload: (Zip File) Containing <strong>Secret Key files</strong>: </div>
              </div>
            </div>
            <div class="row">
              <div style="margin-top: auto; margin-bottom: auto;" class="col-5  align-self-center">
                <div class="flex text-center justify-center" >
                  <i style="font-size: 4.5em; color: lightgray;" class="fas fa-key"></i>
                  <a href="#" title="Removes all Video Key files" style="margin-top: 22px; color: red;" id="resumable-keys-delete" >
                    <div class="bg-indigo-800 text-brown text-center font-bold rounded-lg border shadow-lg">
                      Delete
                    </div>
                  </a>

                </div>
              </div>
              <div class="col-7">
                <div  class="row">
                  <div class="col-12">
                    <div style="margin-top: auto; margin-bottom: auto;" class="card card-block ">
                      <div class="card-body text-center" id="videoKeysUploader">
                        <div class="">
                          <div id="resumable-keys-error" style="display: none">
                              Resumable not supported
                          </div>
                          <div id="resumable-keys-drop" style="display: none">
                            <div class="flex justify-content-center col-sm-12">
                              <div class="row">
                                  <div class="col-4"></div>
                                  <div class="col-4">
                                      <div id="alert_container" class="alert_container"></div>
                                  </div>
                                  <div class="col-4"></div>
                              </div>

                              <button style="margin-top: 22px;"  type="button" class="btn btn-success" id="resumable-keys-browse" data-url="{{ route('admin.manage.channelvideo.uploadkeyschunk', $gize_channel->id) }}" >Upload</button>

                            </div>

                          </div>
                          <div class="row">
                              <div class="col-12  text-wrap">
                                  <div id="keys_file_size" class="keys_file_size"></div>
                              </div>
                          </div>
                        </div>
                        <ul id="keys-file-upload-list" class="list-unstyled"  style="display: none">

                        </ul>
                        <button type="button" class="btn btn-primary" id="resumable-keys-cancel" style="display: none;">Cancel</button>

                        <br/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>




        </div>

      </div>


      <div class="modal-footer">
          <!-- <button id="btn-delete-channelvideo" bookid="" type="button" class="btn btn-danger">Delete</button> -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>