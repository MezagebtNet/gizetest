<div class="modal" id="gize_channelModal" tabindex="-1" aria-labelledby="gize_channelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="gize_channelModalLabel">Add New Gize Channel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="gize_channelForm" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" />
              </div>
              <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug" />
              </div>
              <div class="form-group">
                <label for="select_channel-admin">Select Channel Admins</label>
                <select id="select_channel-admin" multiple name="select_channel-admins[]" class="select-channel-admins"></select>


              </div>
              <div class="form-group">
                <label for="users">Channel Admins</label>

                  <div class="select2-purple">
                    <select style="width: 100%;" data-placeholder="Select Admins" name="users[]" id="users"
                        class="select2 slect-users-multiple"
                        multiple="multiple"
                        data-dropdown-css-class="select2-purple">
                        @foreach ($users as $id => $user)
                            <option value="{{ $user->id }}">
                                {{ $user->fullName() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" rows="5"></textarea>

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
