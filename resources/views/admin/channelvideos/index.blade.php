@extends('layouts.admin.index')

@section('page_title', 'Addmes Channel')

@section('styles')
	<!-- <link rel="stylesheet" href="./css/admin_custom.css"> -->
	<link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />

@endsection

@section('header_title')
	Channel Videos Management Page
@stop

@section('breadcrumb')
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
		<li class="breadcrumb-item active">{{ $gize_channel->name }} - Channel Videos</li>
@endsection


@section('navbar')
    @include('admin.navbar')
@endsection

@section('notifications-dropdown')
    @include('admin.navbar-notifications-dropdown')
@endsection

@section('mainsidebar')
    @include('admin.mainsidebar')
@endsection

@section('content')
	<section style="padding-top: 60px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							Channel Videos &nbsp;
							<a href="#"  class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#channelvideoModal"><i class="fa fa-plus"> </i> Add New</a>

						</div>
						<div class="card-body" style="min-width: 850px; overfloww-s:scroll;">
							<table id="channelvideoTable" class="table table-striped table-hover table-sm  table-responsive-md">
								<thead>
									<tr>
										<th scope="col"><input type="checkbox" id="chkCheckAll" /></th>
										<th scope="col">Image</th>
										<th scope="col">Title</th>
										<th scope="col">Trainer</th>
										<th scope="col">Duration</th>
										<th scope="col">Description</th>
										<th style="text-align: center;" scope="col">VIDEO</th>
										<th style="text-align: center;" scope="col">Active</th>
										<th scope="col" style="min-width: 170px;">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($channelvideos as $channelvideo)
										<tr id="channelvideoid{{$channelvideo->id}}">
											<td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$channelvideo->id}}"/></td>
											<td>
											   <img style="border-radius: 8px;" width="130" src="{{($channelvideo->poster_image_url!=null)? asset('storage\\'.$channelvideo->poster_image_url):asset('storage\\images\\l\\thumb\\channelvideo.jpg')}}" />
											</td>
											<td scope="row">{{$channelvideo->title}}</td>
											<td>{{$channelvideo->trainer}}</td>
											<td>{{$channelvideo->duration}}</td>
											<td>{{(mb_strlen($channelvideo->description) > 200) ? mb_substr($channelvideo->description, 0,200) .'...': mb_substr($channelvideo->description, 0,200) .''}}</td>
											<td style="text-align: center; font-size: 1.6em;">
												@if ($channelvideo->hls_uploaded)
													<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>
												@else
													<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>
												@endif

												@if ($channelvideo->keys_uploaded)
													<i style="color: #000; padding: 2px;" class="fa fa-key"></i>
												@else
													<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>
												@endif
											</td>
											<td style="text-align: center;">
												@if ($channelvideo->active === 1)
													<a href="javascript:void(0)" channelvideoid="{{$channelvideo->id}}" class="btn-toggle-active active"><i style="color: green;" class="fa fa-check"></i></a>
												@else
													<a href="javascript:void(0)" channelvideoid="{{$channelvideo->id}}" class="btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a>
												@endif
											</td>
											<td id="{{$channelvideo->id}}">
												<div class="row d-flex justify-content-start justify-content-between p-2">
													<button
													channelvideoid = "{{$channelvideo->id}}" class="btn btn-xs btn-edit btn-info" data-toggle="modal" data-target="#channelvideoEditModal" title="Edit ChannelVideo"><i class="fa fa-edit"></i> Edit</button>
													<button
													channelvideoid = "{{$channelvideo->id}}" class="btn btn-xs btn-upload-channelvideo btn-success" data-toggle="modal" data-target="#channelvideoUploadModal" title="Upload Channel Video File"><i class="fa fa-upload"></i> Upload</button>
												</div>
												<div class="row d-flex justify-content-start justify-content-between p-2">
													<button
														channelvideoid = "{{$channelvideo->id}}" class="btn btn-xs btn-permit-channelvideo btn-primary" data-toggle="modal" data-target="#channelvideoViewersPermissionModal" title="Permissions"><i class="fa fa-check"></i> Permissions</button>
													<button
													channelvideoid = "{{$channelvideo->id}}" class="btn btn-xs btn-delete btn-danger" title="Delete"><i class="fa fa-trash"></i> Delete</button>

												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>

						</div>
						<div class="card-footer">
							<a href="#" style="" id="deleteAllSelectedRecord" class="btn btn-xs btn-danger pull-right " title="Delete All Selected">
							  <i class="fa fa-trash"></i> Delete Selected
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection


@section('modals')
	<!-- Add New Modal -->
	@include('admin.channelvideos.addChannelVideoModal')

	<!-- Edit Modal -->
	@include('admin.channelvideos.editChannelVideoModal')

	<!-- Upload ChannelVideo Modal -->
	@include('admin.channelvideos.uploadChannelVideoModal')

	<!-- Play ChannelVideoPlayer Modal -->
	{{-- @include('admin.channelvideos.channelVideoPlayerModal') --}}

	<!-- Play ChannelVideoViewersPermission Modal -->
	@include('admin.channelvideos.editChannelVideoViewersPermissionModal')

@endsection

@section('js')

	<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
	<!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->

	{{-- <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script> --}}


	<script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>

	<script>

		// window.addEventListener('load', function() {


			function byteLength(str) {
				// returns the byte length of an utf8 string
				let s = 0;
				if(str !=null && str != undefined){
					s = str.length;
					for (var i=str.length-1; i>=0; i--) {
						var code = str.charCodeAt(i);
						if (code > 0x7f && code <= 0x7ff) s++;
						else if (code > 0x7ff && code <= 0xffff) s+=2;
						if (code >= 0xDC00 && code <= 0xDFFF) i--; //trail surrogate
					}
				}
				return s;
			};

			function encode_utf8( s )
			{
			return unescape( encodeURIComponent( s ) );
			}

			function substr_utf8_bytes(str, startInBytes, lengthInBytes) {

				var resultStr = '';
				var startInChars = 0;
				if(str !=null && str != undefined){

				/* this function scans a multibyte string and returns a substring.
					* arguments are start position and length, both defined in bytes.
					*
					* this is tricky, because javascript only allows character level
					* and not byte level access on strings. Also, all strings are stored
					* in utf-16 internally - so we need to convert characters to utf-8
					* to detect their length in utf-8 encoding.
					*
					* the startInBytes and lengthInBytes parameters are based on byte
					* positions in a utf-8 encoded string.
					* in utf-8, for example:
					*       "a" is 1 byte,
							"ü" is 2 byte,
					and  "你" is 3 byte.
					*
					* NOTE:
					* according to ECMAScript 262 all strings are stored as a sequence
					* of 16-bit characters. so we need a encode_utf8() function to safely
					* detect the length our character would have in a utf8 representation.
					*
					* http://www.ecma-international.org/publications/files/ecma-st/ECMA-262.pdf
					* see "4.3.16 String Value":
					* > Although each value usually represents a single 16-bit unit of
					* > UTF-16 text, the language does not place any restrictions or
					* > requirements on the values except that they be 16-bit unsigned
					* > integers.
					*/


					// scan string forward to find index of first character
					// (convert start position in byte to start position in characters)

					for (bytePos = 0; bytePos < startInBytes; startInChars++) {

						// get numeric code of character (is >128 for multibyte character)
						// and increase "bytePos" for each byte of the character sequence

						ch = str.charCodeAt(startInChars);
						bytePos += (ch < 128) ? 1 : encode_utf8(str[startInChars]).length;
					}

					// now that we have the position of the starting character,
					// we can built the resulting substring

					// as we don't know the end position in chars yet, we start with a mix of
					// chars and bytes. we decrease "end" by the byte count of each selected
					// character to end up in the right position
					end = startInChars + lengthInBytes - 1;

					for (n = startInChars; startInChars <= end; n++) {
						// get numeric code of character (is >128 for multibyte character)
						// and decrease "end" for each byte of the character sequence
						ch = str.charCodeAt(n);
						end -= (ch < 128) ? 1 : encode_utf8(str[n]).length;

						resultStr += str[n];
					}
				}

				return resultStr;
			}


			function clearImgPreview(){
				// for Add modal..
				$('#imgPreview').attr('src', '').hide();
				$('#imgDetails').html('');
				$('#imgPreviewCard').hide();

				// for Edit modal..
				$('#imgPreview_ed').attr('src', '').hide();
				$('#imgDetails_ed').html('');
				$('#imgPreviewCard_ed').hide();
			}

			//Add New ChannelVideo
			$(function readURL(input){
				var url = $("#image_input").val();
				var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
				if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {

					var reader = new FileReader();

					reader.onload = function(e) {
						$('#imgPreview').attr('src', e.target.result).show();
						$('#imgPreviewCard').show();
					}

					reader.readAsDataURL(input.files[0]); // convert to base64 string
				}
				else {
					$('#imgPreview').hide();
					$('#imgDetails').html('No image Uploaded.');
					$('#imgPreviewCard').show();
				}
				$("#image_input").change(function() {
					readURL(this);
				});
			});


			function round(num) {
				var m = Number((Math.abs(num) * 100).toPrecision(15));
				return Math.round(m) / 100 * Math.sign(num);
			}


			$('#channelvideoUploadModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				let id = button.attr('channelvideoid');
				// $('#btn-delete-channelvideo').attr('channelvideoid', id);

				let url = "{{ route('admin.manage.channelvideo.getById', ['gize_channel_id' => ':gize_channel_id', 'id' => ':id']) }}";
				let gize_channel_id = "{{ $gize_channel->id }}";
				url = url.replace(':gize_channel_id', gize_channel_id);
				url = url.replace(':id', id);

				let modal = $(this);

				$.get(url, function(channelvideo) {
					$('#channelvideo_id').val(channelvideo.id);

					modal.find('.modal-title').text('Upload Channel Video (ID: ' + channelvideo.id +')' )

					if(channelvideo.hls_uploaded){
						//Show uploaded file...

						$('#resumable-stream-browse').hide();
						$('#resumable-stream-delete').show();
						let hls_size = channelvideo.hls_size;
						hls_measurement = ' bytes';	//display in bytes
						if(hls_size > 1024 && hls_size <= (1024 * 1024)) { //display in kilobytes
							hls_size = round(hls_size / 1024);
							hls_measurement = ' KB';
						}
						else if(hls_size > (1024 * 1024) && hls_size <= (1024 * 1024 * 1024)) { //display in megabytes
							hls_size = round(hls_size / (1024 * 1024));
							hls_measurement = ' MB';
						}
						else if(hls_size > (1024 * 1024 * 1024)) { //display in gigabytes
							hls_size = round(hls_size / (1024 * 1024 * 1024));
							hls_measurement = ' GB';
						}

						hls_size = hls_size + hls_measurement;


						// $('#videoUploader').hide();

						// $('#btn-delete-channelvideo').show();
						$('#stream_file_size').html('Uploaded File Size: <b>' + hls_size + '</b>');
						$('#stream_file_size').show();
					}
					else {
						//Show file upload form...
						console.log(channelvideo.hls_uploaded);

						// $('#videoStreamUploader').show();
						$('#resumable-stream-browse').show();
						$('#resumable-stream-delete').hide();
						// $('#videoKeysUploader').show();
						// $('#videoKeysUploader').show();
						// $('#btn-delete-channelvideo').hide();
						$('#stream_file_size').hide();
					}

					if(channelvideo.keys_uploaded){
						//Show uploaded file...

						$('#resumable-keys-browse').hide();
						$('#resumable-keys-delete').show();
						let keys_size = channelvideo.keys_size;
						keys_measurement = ' bytes';	//display in bytes
						if(keys_size > 1024 && keys_size <= (1024 * 1024)) { //display in kilobytes
							keys_size = round(keys_size / 1024);
							keys_measurement = ' KB';
						}
						else if(keys_size > (1024 * 1024) && keys_size <= (1024 * 1024 * 1024)) { //display in megabytes
							keys_size = round(keys_size / (1024 * 1024));
							keys_measurement = ' MB';
						}
						else if(keys_size > (1024 * 1024 * 1024)) { //display in gigabytes
							keys_size = round(keys_size / (1024 * 1024 * 1024));
							keys_measurement = ' GB';
						}

						keys_size = keys_size + keys_measurement;

						$('#resumable-keys-browse').hide();
						// $('#videoUploader').hide();

						// $('#btn-delete-channelvideo').show();
						$('#keys_file_size').html('Uploaded File Size: <b>'+ keys_size +'</b>');
						$('#keys_file_size').show();
					}
					else {
						//Show file upload form...

						// $('#videoStreamUploader').show();
						$('#resumable-keys-browse').show();
						$('#resumable-keys-delete').hide();
						// $('#videoKeysUploader').show();
						// $('#btn-delete-channelvideo').hide();
						$('#keys_file_size').hide();
					}



				});
			});

			$('#channelvideoUploadModal').on('hide.bs.modal', function (event) {

				$('#resumable-stream-browse').hide();
				$('#resumable-stream-delete').hide();
				$('#stream_file_size').hide();

				$('#resumable-keys-browse').hide();
				$('#resumable-keys-delete').hide();
				$('#keys_file_size').hide();

			});

			$(document).on('click', '#resumable-stream-delete', function(e){
				e.preventDefault();

				let channelvideoid = $('#channelvideo_id').val();

				if(confirm("Do you want to delete the channel video stream files?")){
					//Delete channelvideo stream files for $channelvideoid.....

					let gize_channel_id = "{{ $gize_channel->id }}";
					let url = "{{ route('admin.manage.channelvideo.deletehls', ['gize_channel_id' => ':gize_channel_id', 'id' => ':id']) }}";
					url = url.replace(':gize_channel_id', gize_channel_id);
					url = url.replace(':id', channelvideoid);

					$.ajax(
						{
							url: url,
							type: 'DELETE',
							data: {
								_token : $("input[name=_token]").val()
							},
							success: function(response){
								if(response.status == "success"){

									$('#resumable-stream-browse').show();
									$('#resumable-stream-delete').hide();
									$('#stream_file_size').hide();

									let tdHtml = '';

									let hasHLS = response.channelvideo.hls_uploaded? true:false;
									let hasKey = response.channelvideo.keys_uploaded? true:false;

									tdHtml += (hasHLS)? '<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>';
									tdHtml += (hasKey)? '<i style="color: #000; padding: 2px;" class="fa fa-key"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>';


									$('#channelvideoid' + channelvideoid + ' td:nth-child(7)').html(tdHtml);
									$('#channelvideoid' + channelvideoid + ' td:nth-child(8)').html('<a href="javascript:void(0)" channelvideoid="' + channelvideoid + '" class="btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a>');

								}
								else if(response.status == 'fail'){
									alert(response.message);
								}

							}
						}
					);
				}

			});


			$(document).on('click', '#resumable-keys-delete', function(e){
				e.preventDefault();
				if(confirm("Do you want to delete keys for this channelvideo?")){
					//Delete channelvideo key files for $channelvideoid.....
					let channelvideoid = $('#channelvideo_id').val();
					// alert(channelvideoid);

					let gize_channel_id = "{{ $gize_channel->id }}";
					let url = "{{ route('admin.manage.channelvideo.deletekeys', ['gize_channel_id' => ':gize_channel_id', 'id' => ':id']) }}";
					url = url.replace(':gize_channel_id', gize_channel_id);
					url = url.replace(':id', channelvideoid);
					// alert(url);

					$.ajax(
						{
							url: url,
							type: 'DELETE',
							data: {
								_token : $("input[name=_token]").val()
							},
							success: function(response){
								if(response.status == "success"){

									$('#resumable-keys-browse').show();
									$('#resumable-keys-delete').hide();
									$('#keys_file_size').hide();

									let tdHtml = '';

									let hasHLS = response.channelvideo.hls_uploaded? true:false;
									let hasKey = response.channelvideo.keys_uploaded? true:false;

									tdHtml += (hasHLS)? '<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>';
									tdHtml += (hasKey)? '<i style="color: #000; padding: 2px;" class="fa fa-key"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>';


									$('#channelvideoid' + channelvideoid + ' td:nth-child(7)').html(tdHtml);
									$('#channelvideoid' + channelvideoid + ' td:nth-child(8)').html('<a href="javascript:void(0)" channelvideoid="' + channelvideoid + '" class="btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a>');

								}
								else if(response.status == 'fail'){
									alert(response.message);
								}

							}
						}
					);

				}
			});


			$('#channelvideoUploadForm').submit(function(e){
				e.preventDefault();

				let formData = new FormData($('#channelvideoUploadForm').get(0));
				// formData.append("channelvideoid", );

				// let channelvideo_file_input = $('#channelvideo_file_input').val();
				let gize_channel_id = "{{ $gize_channel->id }}";
				let url = "{{ route('admin.manage.channelvideo.upload.post', ['gize_channel_id' => ':gize_channel_id']) }}";
				url = url.replace(':gize_channel_id', gize_channel_id);

				$.ajax({
					url: url,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(res) {
						// let msg = "";
							// alert(res.status);
						if(res){
							if (res.status == "success"){
								// msg = "Channel Video uploaded sucessfully";
								// alertHTML = '<div class="alert alert-success alert-block">'+
								//     ' <button type="button" class="close" data-dismiss="alert">×</button>'+
								//     '    <strong>' + res.message + '</strong> '+
								// '</div>';
								// $('#alert_container').prepend(alertHTML);
								$('#channelvideoUploadForm').hide();
								$('#btn-delete-channelvideo').show();

								let channelvideo = res.channelvideo;
								$('#file_url_link').html('File Location on Server: <b>'+channelvideo.file_url+'</b>');
								$('#file_url_link').show();

								let hasFile = false;
								let isMP = false; // is MP4
								if(channelvideo.file_url != null && channelvideo.file_url != '') {
									hasFile = true;
									if(channelvideo.file_type == 0){
										isMP = true;
									}
								}
								let tdHtml = '';
								tdHtml +=  (hasFile && isMP) ? '<i style="color: brown;" class="fa fa-file-video"></i> <strong>MP4</strong>' +
								'<button channelvideoid = "'+ channelvideo.id +'" class="btn btn-xs btn-play btn-info" data-toggle="modal" data-target="#channelvideoPlayerModal" title="Play ChannelVideo"><i class="fa fa-play"></i></button>' :'';
								tdHtml +=  (hasFile && !isMP) ? '<i style="color: purple;" class="fa fa-file"></i> <strong>Other</strong>' :'';
								tdHtml +=  (!hasFile) ? '<i style="color: lightgrey;" class="fa fa-video"></i>' :'';

								$('#channelvideoid' + channelvideo.id + ' td:nth-child(7)').html(tdHtml);

							}
							else if(res.status == "fail") {
								// msg = "Channel Video no uploaded";
								// alertHTML = '<div class="alert alert-danger alert-block">'+
								//     ' <button type="button" class="close" data-dismiss="alert">×</button>'+
								//     '    <strong>' + res.message + '</strong> '+
								// '</div>';
								// $('#alert_container').prepend(alertHTML);

								$('#channelvideoUploadForm').show();
								$('#btn-delete-channelvideo').hide();
							}
							// $('#alert_container').prepend(alertHTML);
							// alert('here');

							// $('#channelvideoUploadModal').modal('hide');
						}
					},
				});
			});


			$('#channelvideoForm').submit(function(e){
				e.preventDefault();

				let formData = new FormData($('#channelvideoForm').get(0));
				let title = $('#title').val();
				let trainer = $('#trainer').val();
				let duration = $('#duration').val();
				let description = $('#description').val();
				let image_input = $('#image_input').val();
				let _token = $('input[name=_token]').val();

				formData.append("title", title);
				formData.append("trainer", trainer);
				formData.append("duration", duration);
				formData.append("description", description);
				formData.append("_token", _token);

				let gize_channel_id = "{{ $gize_channel->id }}";
				let url = "{{ route('admin.manage.channelvideo.add', ['gize_channel_id' => ':gize_channel_id']) }}";
				url = url.replace(':gize_channel_id', gize_channel_id);

				$.ajax({
					url: url,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(response) {

						if(response){
							// var desc = response.description.toString().substr(1, 20);
							let desc = (byteLength(response.description) > 200)? substr_utf8_bytes(response.description,0,200)+'...' : (response.description)?response.description:'' +'';
							let imgUrl = "{{ asset('storage/:_imgUrl') }}";

							if(response.poster_image_url!=null){
								imgUrl = imgUrl.replace(':_imgUrl', response.poster_image_url);
							}
							else {
								imgUrl = imgUrl.replace(':_imgUrl', 'images/l/thumb/channelvideo.jpg');
							}

							let tableRowHtml = '<tr id="channelvideoid'+ response.id+'"><td><input type="checkbox" name="ids" class="checkBoxClass" value="' + response.id + '"/></td>'+
								'<td><img style="border-radius: 8px;" width="130" src="' + imgUrl +
								'" /></td><td>' +
								response.title + '</td><td>' +
								response.trainer + '</td><td>' +
								response.duration + '</td><td>' +
								desc + '' + '</td><td style="text-align: center;  font-size: 1.6em;">';

								// let hasFile = false;
								// let isMP = false; //is MP4
								// if(response.file_url != null && response.file_url != '') {
								// 	hasFile = true;
								// 	if(response.file_type == 0){
								// 		isMP = true;
								// 	}
								// }

							let hasHLS = response.hls_uploaded? true:false;
							let hasKey = response.keys_uploaded? true:false;

							tableRowHtml += (hasHLS)? '<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>';
							tableRowHtml += (hasKey)? '<i style="color: #000; padding: 2px;" class="fa fa-key"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>';


							// tableRowHtml +=  (hasFile && isMP) ? '<i style="color: brown;" class="fa fa-file-video"></i> <strong>MP4</strong>' +
							// 	'<button channelvideoid = "'+ response.id +'" class="btn btn-xs btn-play btn-info" data-toggle="modal" data-target="#channelvideoPlayerModal" title="Play ChannelVideo"><i class="fa fa-play"></i></button>' :'';
							// tableRowHtml +=  (hasFile && !isMP) ? '<i style="color: purple;" class="fa fa-file"></i> <strong>Other</strong>' :'';
							// tableRowHtml +=  (!hasFile) ? '<i style="color: lightgrey;" class="fa fa-video"></i>' :'';

							tableRowHtml +=  '</td><td style="text-align:center;">';
							tableRowHtml += (response.active) ? '<a href="javascript:void(0)" channelvideoid="' + response.id + '" class="btn-toggle-active active"><i style="color: green;" class="fa fa-check"></i></a>' : '' +
								'<a href="javascript:void(0)" channelvideoid="' + response.id + '" class="btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a>' +'</td><td style="text-align: center;">';

							tableRowHtml+= '<div class="row d-flex justify-content-start justify-content-between p-2">' +
							'	<button' +
							'	channelvideoid = "' + response.id + '" class="btn btn-xs btn-edit btn-info" data-toggle="modal" data-target="#channelvideoEditModal" title="Edit ChannelVideo"><i class="fa fa-edit"></i> Edit</button>' +
							'	<button' +
							'	channelvideoid = "' + response.id + '" class="btn btn-xs btn-upload-channelvideo btn-success" data-toggle="modal" data-target="#channelvideoUploadModal" title="Upload Channel Video File"><i class="fa fa-upload"></i> Upload</button>' +
							'</div>' +
							'<div class="row d-flex justify-content-start justify-content-between p-2">' +
							'	<button' +
							'		channelvideoid = "' + response.id + '" class="btn btn-xs btn-permit-channelvideo btn-primary" data-toggle="modal" data-target="#channelvideoViewersPermissionModal" title="Permissions"><i class="fa fa-check"></i> Permissions</button>' +
							'	<button' +
							'	channelvideoid = "' + response.id + '" class="btn btn-xs btn-delete btn-danger" title="Delete"><i class="fa fa-trash"></i> Delete</button>' +
							'</div></td></tr>';

							$('#channelvideoTable tbody').prepend(tableRowHtml);


							$('#channelvideoForm')[0].reset();
							$('#imgPreview').attr('src', '').hide();
							$('#channelvideoModal').modal('hide');
						}
					}
				});
			});

			$('#channelvideoModal').on('hide.bs.modal', function (event) {
				clearImgPreview();
				$('#channelvideoForm')[0].reset();
			});

			$('#channelvideoModal').on('show.bs.modal', function (event){
				clearImgPreview();
				$('#channelvideoForm')[0].reset();
			});



			//Edit ChannelVideo
			$(function readURL(input){
				var url = $("#image_input_ed").val();
				var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
				if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {

					var reader = new FileReader();

					reader.onload = function(e) {
						$('#imgPreview_ed').attr('src', e.target.result).show();

						$('#imgPreview_ed').show();
						$('#imgPreviewCard_ed').show();
					}
					reader.readAsDataURL(input.files[0]); // convert to base64 string
				}
				else {
					$('#imgPreview_ed').hide();
					$('#imgDetails_ed').html('No image Uploaded.');
					$('#imgPreviewCard_ed').show();
				}
				$("#image_input_ed").change(function() {
					readURL(this);
				});

			});

			$('#channelvideoEditForm').on('submit', function(e){
				e.preventDefault();

				let formData = new FormData(this);
				// let formData = new FormData($('#channelvideoEditForm').get(0));

				let id = $('#id').val();

				let title = $('#title_ed').val();
				let trainer = $('#trainer_ed').val();
				let duration = $('#duration_ed').val();
				let description = $('#description_ed').val();
				let image_input_ed = $('#image_input_ed').val();
				let _token = $('input[name=_token]').val();

				// formData.append("id", id);
				formData.append("title", title);
				formData.append("trainer", trainer);
				formData.append("duration", duration);
				formData.append("description", description);
				// formData.append("_token", _token);
				// formData.append("channelvideoid", id);



				let data = {
					channelvideoid: id,
					title: title,
					trainer: trainer,
					duration: duration,
					description: description,
					image_input_ed: image_input_ed,
					_token: _token
				};

				let gize_channel_id = "{{ $gize_channel->id }}";
				let url = "{{ route('admin.manage.channelvideo.update', ['gize_channel_id' => ':gize_channel_id']) }}";
				url = url.replace(':gize_channel_id', gize_channel_id);

				$.ajax({
					url: url,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(response) {
						let imgUrl = "{{ asset('storage/:_imgUrl') }}";

						if(response.poster_image_url!=null){
							imgUrl = imgUrl.replace(':_imgUrl', response.poster_image_url);
						}
						else {
							imgUrl = imgUrl.replace(':_imgUrl', 'images/l/thumb/channelvideo.jpg');
						}

						if(response){
							$('#channelvideoid' + response.id + ' td:nth-child(1)').html('<input type="checkbox" name="ids" class="checkBoxClass" value="' + response.id + '"/>');
							$('#channelvideoid' + response.id + ' td:nth-child(2)').html('<img style="border-radius: 8px;" width="130" src="'+imgUrl+'" />');
							$('#channelvideoid' + response.id + ' td:nth-child(3)').text(response.title);
							$('#channelvideoid' + response.id + ' td:nth-child(4)').text(response.trainer);
							$('#channelvideoid' + response.id + ' td:nth-child(5)').text(response.duration);
							$('#channelvideoid' + response.id + ' td:nth-child(6)').text((byteLength(response.description) > 200)? substr_utf8_bytes(response.description,0,200)+'...' : (response.description)?response.description:'' +'');
							// let hasFile = false;
							// let isMP = false; // is mp4
							// if(response.file_url != null && response.file_url != '') {
							// 	hasFile = true;
							// 	if(response.file_type == 0){
							// 		isMP = true;
							// 	}
							// }
							let tdHtml = '';
							// tdHtml +=  (hasFile && isMP) ? '<i style="color: brown;" class="fa fa-file-video"></i> <strong>MP4</strong>' +
							// 	// '<button channelvideoid = "' + response.id + '" class="btn btn-xs btn-play btn-info" data-toggle="modal" data-target="#channelvideoPlayerModal" title="Play ChannelVideo"><i class="fa fa-play"></i></button>'
							// 	''
							// 	:'';
							// tdHtml +=  (hasFile && !isMP) ? '<i style="color: purple;" class="fa fa-file"></i> <strong>Other</strong>' :'';
							// tdHtml +=  (!hasFile) ? '<i style="color: lightgrey;" class="fa fa-video"></i>' :'';


							let hasHLS = response.hls_uploaded? true:false;
							let hasKey = response.keys_uploaded? true:false;

							tdHtml += (hasHLS)? '<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>';
							tdHtml += (hasKey)? '<i style="color: #000; padding: 2px;" class="fa fa-key"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>';

							$('#channelvideoid' + response.id + ' td:nth-child(7)').html(tdHtml);
							$('#channelvideoid' + response.id + ' td:nth-child(8)').html((response.active) ? '<a href="javascript:void(0)" channelvideoid="' + response.id + '" class="btn-toggle-active active"><i style="color: green;" class="fa fa-check"></i></a>' : '' +
								'<a href="javascript:void(0)" channelvideoid="' + response.id + '" class="btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a>');

							// $('#channelvideoTable tbody').prepend('<tr><td>'+ response.title +'</td><td>'+ response.trainer +'</td><td>'+ response.price +'</td></tr>')
							$('#channelvideoEditModal').modal('toggle');
							$('#channelvideoEditForm')[0].reset();
							$('#imgPreview_ed').attr('src', '').hide();

						}

					}
				});

			});



			$(document).on('click', '#btn-delete-cover-image', function(e){
				channelvideoid = $(this).attr('channelvideoid');
				if(confirm("Do you want to delete this image?")){
					//Delete cover image files for $channelvideoid.....

					$.ajax(
						{
							url: './del-channelvideo-cover-image/'+ channelvideoid,
							type: 'DELETE',
							data: {
								_token : $("input[name=_token]").val()
							},
							success: function(response){

								$('#imgPreviewCard_ed').hide();
								$('#imgUploadCard_ed').show();
							}
						}
					);

					//render default image..

					let imgUrl = "{{ asset('storage/images/l/thumb/channelvideo.jpg') }}";
					$('#channelvideoid' + channelvideoid + ' td:nth-child(2)').html('<img style="border-radius: 8px;" width="130" src="'+imgUrl+'" />');


				}
			});

			$('#channelvideoEditModal').on('show.bs.modal', function (event) {
				// console.log(id);
				// alert("heres");

				var button = $(event.relatedTarget) // Button that triggered the modal
				let id = button.attr('channelvideoid');

				$('#btn-delete-cover-image').attr('channelvideoid', id);
				var modal = $(this);
				modal.find('.modal-title').text('Edit Channel Video (ID:' + id + ')');
				let gize_channel_id = "{{ $gize_channel->id }}";
				let url = "{{ route('admin.manage.channelvideo.getById', ['gize_channel_id' => ':gize_channel_id', 'id' => ':id']) }}";
				url = url.replace(':gize_channel_id', gize_channel_id);
				url = url.replace(':id', id);

				$.get(url, function(channelvideo) {
					$('#id').val(channelvideo.id);
					$('#title_ed').val(channelvideo.title);
					$('#trainer_ed').val(channelvideo.trainer);
					$('#duration_ed').val(channelvideo.duration);
					$('#description_ed').val(channelvideo.description);
					// $('#image_input_ed').val(channelvideo.poster_image_url);

					if(channelvideo.poster_image_url != null){
						let imgUrl = "{{ asset('storage/:_imgUrl') }}";
						imgUrl = imgUrl.replace(':_imgUrl', channelvideo.poster_image_url);

						$('#imgUploadCard_ed').hide();
						$('#imgPreview_ed').attr('src', imgUrl);
						$('#imgPreview_ed').show();
						$('#imgPreviewCard_ed').show();
					}
					else {
						$('#imgUploadCard_ed').show();
						$('#imgPreviewCard_ed').hide();
					}
				});

			});

			$('#channelvideoEditModal').on('hide.bs.modal', function (event) {

				clearImgPreview();
				$('#channelvideoEditForm')[0].reset();
			});




			//Delete ChannelVideo Meta and its related files
			$(document).on('click', '.btn-delete', function(){
				let id = $(this).attr('channelvideoid');
				// alert(id);
				let gize_channel_id = "{{ $gize_channel->id }}";
				let url = "{{ route('admin.manage.channelvideo.delete', ['gize_channel_id' => ':gize_channel_id', 'id' => ':id']) }}";
				url = url.replace(':gize_channel_id', gize_channel_id);
				url = url.replace(":id", id);
				// alert(url);

				if(confirm("Do you want to delete this record?")){
					$.ajax(
						{
							url: url,
							type: 'DELETE',
							data: {
								id: id,
								_token : $("input[name=_token]").val()
							},
							success: function(response){
								$('#channelvideoid'+id).remove();
								Swal.fire({
									position: 'top-end',
									toast: true,
									icon: 'warning',
									title: 'Record has been deleted',
									showConfirmButton: false,
									timer: 1500
								});
							}
						}
					);
					//Also delete the cover image and channelvideo file too....

				}

			});

			//Multiple Delete ChannelVideo and their related files
			$(function(e){

				$('#chkCheckAll').click(function(){
					$(".checkBoxClass").prop('checked', $(this).prop('checked'));
				});

				$('#deleteAllSelectedRecord').click(function(e){
					if(confirm("Do you want to delete multiple records?")){
						e.preventDefault();
						var allids = [];


						$("input:checkbox[name=ids]:checked").each(function(){
							allids.push($(this).val());
						});

						let gize_channel_id = "{{ $gize_channel->id }}";
						let url = "{{ route('admin.manage.channelvideo.deleteSelected', ['gize_channel_id' => ':gize_channel_id']) }}";
						url = url.replace(':gize_channel_id', gize_channel_id);

						$.ajax({
							url: url,
							type: 'DELETE',
							data: {
								_token: $("input[name=_token]").val(),
								ids:allids
							},
							success:function(response){
								$.each(allids, function(key, val){
									$('#channelvideoid'+val).remove();
								});

								$('#chkCheckAll').prop('checked', false );

							}
						});
					}
				});

			});



			// Activate or Deactivate channelvideo
			$(document).on('click', '.btn-toggle-active', function(e){
				let channelvideoId = $(this).attr('channelvideoid'),
					isActive = $(this).hasClass('active')? true : false, //Activate or Deactivate
					_token =  $("input[name=_token]").val();

				let data = {
					channelvideoid: channelvideoId,
					_token: _token
				};
				// alert(JSON.stringify(data));
				let routeUrl = (isActive) ? "{{route('admin.manage.channelvideo.deactivate', ['gize_channel_id' => ':gize_channel_id'])}}" : "{{route('admin.manage.channelvideo.activate', ['gize_channel_id' => ':gize_channel_id'])}}";
				let gize_channel_id = "{{ $gize_channel->id }}";
				routeUrl = routeUrl.replace(':gize_channel_id', gize_channel_id);

				$.ajax({
					url: routeUrl,
					type: "PUT",
					data: data,
					// contentType: false,
					// processData: false,
					success: function(response) {
						if(response.status == "success"){
							let channelvideo = response.channelvideo;
							let imgUrl = "{{ asset('storage/:_imgUrl') }}";

							if(channelvideo.poster_image_url!=null){
								imgUrl = imgUrl.replace(':_imgUrl', channelvideo.poster_image_url);
							}
							else {
								imgUrl = imgUrl.replace(':_imgUrl', 'images/l/thumb/channelvideo.jpg');
							}

							$('#channelvideoid' + channelvideo.id + ' td:nth-child(1)').html('<input type="checkbox" name="ids" class="checkBoxClass" value="' + channelvideo.id + '"/>');
							$('#channelvideoid' + channelvideo.id + ' td:nth-child(2)').html('<img style="border-radius: 8px;" width="130" src="'+imgUrl+'" />');
							$('#channelvideoid' + channelvideo.id + ' td:nth-child(3)').text(channelvideo.title);
							$('#channelvideoid' + channelvideo.id + ' td:nth-child(4)').text(channelvideo.trainer);
							$('#channelvideoid' + channelvideo.id + ' td:nth-child(5)').text(channelvideo.duration);
							$('#channelvideoid' + channelvideo.id + ' td:nth-child(6)').text((byteLength(channelvideo.description) > 200)? substr_utf8_bytes(channelvideo.description,0,200)+'...' : (channelvideo.description)?channelvideo.description:''+'');
							// let hasFile = false;
							// let isMP = false; // is mp4
							// if(channelvideo.file_url != null && channelvideo.file_url != '') {
								// hasFile = true;
								// if(channelvideo.file_type == 0){
								// 	isMP = true;
								// }
							// }
							// else {
							// 	alert('Please upload a channel video first!');
							// }
							let tdHtml = '';
							// tdHtml +=  (hasFile && isMP) ? '<i style="color: brown;" class="fa fa-file-video"></i> <strong>MP4</strong>' +
							// 	// '<button channelvideoid = "' + channelvideo.id + '" class="btn btn-xs btn-play btn-info" data-toggle="modal" data-target="#channelvideoPlayerModal" title="Play ChannelVideo"><i class="fa fa-play"></i></button>'
							// 	'':'';
							// tdHtml +=  (hasFile && !isMP) ? '<i style="color: purple;" class="fa fa-file"></i> <strong>Other</strong>' :'';
							// tdHtml +=  (!hasFile) ? '<i style="color: lightgrey;" class="fa fa-video"></i>' :'';


							let hasHLS = channelvideo.hls_uploaded? true:false;
							let hasKey = channelvideo.keys_uploaded? true:false;

							tdHtml += (hasHLS)? '<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>';
							tdHtml += (hasKey)? '<i style="color: #000; padding: 2px;" class="fa fa-key"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>';


							$('#channelvideoid' + channelvideo.id + ' td:nth-child(7)').html(tdHtml);
							$('#channelvideoid' + channelvideo.id + ' td:nth-child(8)').html((channelvideo.active) ? '<a href="javascript:void(0)" channelvideoid="' + channelvideo.id + '" class="btn-toggle-active active"><i style="color: green;" class="fa fa-check"></i></a>' : '' +
								'<a href="javascript:void(0)" channelvideoid="' + channelvideo.id + '" class="btn-toggle-active"><i style="color: red;" class="fa fa-times"></i></a>');

						}
						else if(response.status == 'fail'){
							alert(response.message);
						}

					}
				});
			});



		// });




		// var table = $('#tbl_users_list').DataTable();
		// $('#tbl_users_list tbody').on( 'click', 'td', function () {
		// 	alert( $('#tbl_users_list').DataTable().cell( this ).data() );
		// } );


		$(document).on('click', '.btn_lv_permission_revoke', function(){
			// alert('revoking');
			let el = $(this);
			let usr_id = $(this).attr('lv_usr_id');
			let lv_id = $(this).attr('lv_id');

			let gize_channel_id = "{{ $gize_channel->id }}";
			let url = "{{ route('admin.manage.channelvideo.revokeaccess', ['gize_channel_id' => ':gize_channel_id']) }}";
			url = url.replace(':gize_channel_id', gize_channel_id);



			$.post(url,
				{
					_token : $("input[name=_token]").val(),
						vid_id: lv_id,
						usr_id: usr_id
				})
				.done(function (channelvideo) {
					 $('#tbl_users_list').DataTable().cell( el.parent('td') ).data(
							'<a lv_usr_id = "' + usr_id + '" lv_id = "' + lv_id + '" href="#" class="btn_lv_permission_allow badge badge-secondary">Revoked</a>'
						);
					})
				.fail(function (e) {
					alert('Unable to update.'+ JSON.stringify(e));
				})
		});

		$(document).on('click', '.btn_lv_permission_allow', function(){
			// alert('allowing');
			let el = $(this);
			let usr_id = $(this).attr('lv_usr_id');
			let lv_id = $(this).attr('lv_id');

			let gize_channel_id = "{{ $gize_channel->id }}";
			let url = "{{ route('admin.manage.channelvideo.allowaccess', ['gize_channel_id' => ':gize_channel_id']) }}";
			url = url.replace(':gize_channel_id', gize_channel_id);

			$.post(url,
				{
					_token : $("input[name=_token]").val(),
						vid_id: lv_id,
						usr_id: usr_id
				})
				.done(function (channelvideo) {
					 $('#tbl_users_list').DataTable().cell( el.parent('td') ).data(
							'<a lv_usr_id = "' + usr_id + '" lv_id = "' + lv_id + '" href="#" class="btn_lv_permission_revoke badge badge-success">Allowed</a>'
						);
					})
				.fail(function (e) {
					alert('Unable to update.'+ JSON.stringify(e));
				})
		});


		$('#channelvideoViewersPermissionModal').on('hide.bs.modal', function (event) {
			$('#tbl_users_list').DataTable().clear();
			$('#tbl_users_list').DataTable().destroy();
		});

		$('#channelvideoViewersPermissionModal').on('show.bs.modal', function (event) {

			var button = $(event.relatedTarget) // Button that triggered the modal
			let id = button.attr('channelvideoid');

			let gize_channel_id = "{{ $gize_channel->id }}";
			let url = "{{ route('admin.manage.channelvideo.accesslist', ['gize_channel_id' => ':gize_channel_id']) }}";
			url = url.replace(':gize_channel_id', gize_channel_id);

			$.post(url, { vid_id: id})
				.done(function (channelvideo) {
					$('#tbl_users_list').DataTable().destroy();
					$('#tbl_users_list').DataTable( {
						responsive: true,
						// data: JSON.parse(channelvideo),
						// serverSide: true,
						// ajax: {
						// 	url: url,
						// 	type: 'GET'
						// },
						"_token": "{{ csrf_token() }}",
						data: channelvideo.users,
						"order": [[ 3, "desc" ]],
						columns: [
								{ data: 'status' },
								{ data: 'user' },
								{ data: 'address' },
								{ data: 'created_at' }
						]
					});
				})


			var modal = $(this);
			modal.find('.modal-title').text('Edit Video Access Permissions for Video: ID ("' + id + '")');

		});

	</script>



	<script>
		//Upload Forms
		var $ = window.$; // use the global jQuery instance

		function round(num) {
			var m = Number((Math.abs(num) * 100).toPrecision(15));
			return Math.round(m) / 100 * Math.sign(num);
		}


		//STREAM...
			var $fileUploadStream = $('#resumable-stream-browse');
			var $fileUploadDropStream = $('#resumable-stream-drop');
			var $uploadListStream = $("#stream-file-upload-list");

			if ($fileUploadStream.length > 0 && $fileUploadDropStream.length > 0) {
				let resumableStream = new Resumable({
					// Use chunk size that is smaller than your maximum limit due a resumable issue
					// https://github.com/23/resumable.js/issues/51
					chunkSize: 1 * 1024 * 1024, // 1MB
					simultaneousUploads: 3,
					testChunks: false,
					fileType: ['zip'],
					maxFiles: 1,
					throttleProgressCallbacks: 1,
					// Get the url from data-url tag
					target: $fileUploadStream.data('url'),
					// Append token to the request - required for web routes
					query:{_token : $('input[name=_token]').val(), vid_id: "fileid"}
				});

				// Resumable.js isn't supported, fall back on a different method
				if (!resumableStream.support) {
					$('#resumable-stream-error').show();
				} else {
					// Show a place for dropping/selecting files
					$fileUploadDropStream.show();
					resumableStream.assignDrop($fileUploadStream[0]);
					resumableStream.assignBrowse($fileUploadDropStream[0]);
					// Handle file add event
					resumableStream.on('fileAdded', function (file) {

						// Show progress pabr
						$uploadListStream.show();
						// Show pause, hide resume
						$('.stream-uploader .resumable-progress .progress-resume-link').hide();
						$('.stream-uploader .resumable-progress .progress-pause-link').show();
						// Add the file to the list
						$uploadListStream.html('<li class="resumable-file-' + file.uniqueIdentifier + '">Uploading <span class="resumable-file-name"></span> <span class="resumable-file-progress"></span>');
						$('.stream-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-name').html(file.fileName);
						// Actually start the upload
						resumableStream.opts.query.vid_id = $("#channelvideo_id").val();
						resumableStream.upload();

						$('#resumable-stream-cancel').on('click', function() {
							resumableStream.cancel();
							$uploadListStream.html('');
							$("#resumable-stream-cancel").hide();
							$("#resumable-stream-browse").show();
						});
						$("#resumable-stream-cancel").show();
					});
					resumableStream.on('fileSuccess', function (file, message) {
						// Reflect that the file upload has completed
						$('.stream-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html('(completed)');
					});
					resumableStream.on('fileError', function (file, message) {
						// Reflect that the file upload has resulted in error
						$('.stream-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html('(file could not be uploaded: ' + message + ')');
					});
					resumableStream.on('fileProgress', function (file) {
						// Handle progress for both the file and the overall upload
						$('.stream-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html(Math.floor(file.progress() * 100) + '%');
						$('.stream-uploader .progress-bar').css({width: Math.floor(resumableStream.progress() * 100) + '%'});
						$("#resumable-stream-browse").hide();
					});
					resumableStream.on('complete', function () {
						// Handle progress for both the file and the overall upload
						resumableStream.cancel();
						$uploadListStream.html('');


						let id = $("#channelvideo_id").val();
						let gize_channel_id = "{{ $gize_channel->id }}";
						let url = "{{ route('admin.manage.channelvideo.deletehls', ['gize_channel_id' => ':gize_channel_id', 'id' => ':id']) }}";
						url = url.replace(':gize_channel_id', gize_channel_id);
						url = url.replace(':id', id);

						$.get(url, function(channelvideo) {
							$('#channelvideo_id').val(channelvideo.id);


							if(channelvideo.hls_uploaded){
								//Show uploaded file...

								$('#resumable-stream-browse').hide();
								$('#resumable-stream-delete').show();
								let hls_size = channelvideo.hls_size;
								hls_measurement = ' bytes';	//display in bytes
								if(hls_size > 1024 && hls_size <= (1024 * 1024)) { //display in kilobytes
									hls_size = round(hls_size / 1024);
									hls_measurement = ' KB';
								}
								else if(hls_size > (1024 * 1024)) { //display in megabytes
									hls_size = round(hls_size / (1024 * 1024));
									hls_measurement = ' MB';
								}
								else if(hls_size > (1024 * 1024 * 1024)) { //display in gigabytes
									hls_size = round(hls_size / (1024 * 1024 * 1024));
									hls_measurement = ' GB';
								}

								hls_size = hls_size + hls_measurement;

								// $('#btn-delete-channelvideo').show();
								$('#stream_file_size').html('Uploaded File Size: <b>' + hls_size + '</b>');
								$('#stream_file_size').show();



								// $('#file_url_link').html('File Location on Server: <b>'+channelvideo.file_url+'</b>');
								// $('#file_url_link').show();


								let tdHtml = '';

								let hasHLS = channelvideo.hls_uploaded? true:false;
								let hasKey = channelvideo.keys_uploaded? true:false;

								tdHtml += (hasHLS)? '<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>';
								tdHtml += (hasKey)? '<i style="color: #000; padding: 2px;" class="fa fa-key"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>';

								$('#channelvideoid' + channelvideo.id + ' td:nth-child(7)').html(tdHtml);

							}
							else {
								//Show file upload form...

								$('#resumable-stream-browse').show();
								$('#resumable-stream-delete').hide();
								$('#stream_file_size').hide();

							}

						});

						$("#resumable-stream-cancel").hide();
					});
				}

			}





		//KEYS...
			var $fileUploadKeys = $('#resumable-keys-browse');
			var $fileUploadDropKeys = $('#resumable-keys-drop');
			var $uploadListKeys = $("#keys-file-upload-list");

			if ($fileUploadKeys.length > 0 && $fileUploadDropKeys.length > 0) {
				let resumableKeys = new Resumable({
					// Use chunk size that is smaller than your maximum limit due a resumable issue
					// https://github.com/23/resumable.js/issues/51
					chunkSize: 1 * 1024 * 1024, // 1MB
					simultaneousUploads: 3,
					testChunks: false,
					fileType: ['zip'],
					maxFiles: 1,
					throttleProgressCallbacks: 1,
					// Get the url from data-url tag
					target: $fileUploadKeys.data('url'),
					// Append token to the request - required for web routes
					query:{_token : $('input[name=_token]').val(), vid_id: "fileid"}
				});

				// Resumable.js isn't supported, fall back on a different method
				if (!resumableKeys.support) {
					$('#resumable-keys-error').show();
				} else {
					// Show a place for dropping/selecting files
					$fileUploadDropKeys.show();
					resumableKeys.assignDrop($fileUploadKeys[0]);
					resumableKeys.assignBrowse($fileUploadDropKeys[0]);
					// Handle file add event
					resumableKeys.on('fileAdded', function (file) {

						// Show progress pabr
						$uploadListKeys.show();
						// Show pause, hide resume
						$('.keys-uploader .resumable-progress .progress-resume-link').hide();
						$('.keys-uploader .resumable-progress .progress-pause-link').show();
						// Add the file to the list
						$uploadListKeys.html('<li class="resumable-file-' + file.uniqueIdentifier + '">Uploading <span class="resumable-file-name"></span> <span class="resumable-file-progress"></span>');
						$('.keys-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-name').html(file.fileName);
						// Actually start the upload
						resumableKeys.opts.query.vid_id = $("#channelvideo_id").val();
						resumableKeys.upload();

						$('#resumable-keys-cancel').on('click', function() {
							resumableKeys.cancel();
							$uploadListKeys.html('');
							$("#resumable-keys-cancel").hide();
							$("#resumable-keys-browse").show();
						});
						$("#resumable-keys-cancel").show();
					});
					resumableKeys.on('fileSuccess', function (file, message) {
						// Reflect that the file upload has completed
						$('.keys-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html('(completed)');
					});
					resumableKeys.on('fileError', function (file, message) {
						// Reflect that the file upload has resulted in error
						$('.keys-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html('(file could not be uploaded: ' + message + ')');
					});
					resumableKeys.on('fileProgress', function (file) {
						// Handle progress for both the file and the overall upload
						$('.keys-uploader .resumable-file-' + file.uniqueIdentifier + ' .resumable-file-progress').html(Math.floor(file.progress() * 100) + '%');
						$('.keys-uploader .progress-bar').css({width: Math.floor(resumableKeys.progress() * 100) + '%'});
						$("#resumable-keys-browse").hide();
					});
					resumableKeys.on('complete', function () {
						// Handle progress for both the file and the overall upload
						resumableKeys.cancel();
						$uploadListKeys.html('');


						let id = $("#channelvideo_id").val();
						let gize_channel_id = "{{ $gize_channel->id }}";
						let url = "{{ route('admin.manage.channelvideo.getById', ['gize_channel_id' => ':gize_channel_id', 'id' => ':id']) }}";
						url = url.replace(':gize_channel_id', gize_channel_id);
						url = url.replace(':id', id);

						$.get(url, function(channelvideo) {
							$('#channelvideo_id').val(channelvideo.id);


							if(channelvideo.keys_uploaded){
								//Show uploaded file...

								$('#resumable-keys-browse').hide();
								$('#resumable-keys-delete').show();
								let keys_size = channelvideo.keys_size;
								keys_measurement = ' bytes';	//display in bytes
								if(keys_size > 1024 && keys_size <= (1024 * 1024)) { //display in kilobytes
									keys_size = round(keys_size / 1024);
									keys_measurement = ' KB';
								}
								else if(keys_size > (1024 * 1024)) { //display in megabytes
									keys_size = round(keys_size / (1024 * 1024));
									keys_measurement = ' MB';
								}
								else if(keys_size > (1024 * 1024 * 1024)) { //display in gigabytes
									keys_size = round(keys_size / (1024 * 1024 * 1024));
									keys_measurement = ' GB';
								}

								keys_size = keys_size + keys_measurement;

								// $('#btn-delete-channelvideo').show();
								$('#keys_file_size').html('Uploaded File Size: <b>' + keys_size + '</b>');
								$('#keys_file_size').show();



								// $('#file_url_link').html('File Location on Server: <b>'+channelvideo.file_url+'</b>');
								// $('#file_url_link').show();


								let tdHtml = '';

								let hasHLS = channelvideo.hls_uploaded? true:false;
								let hasKey = channelvideo.keys_uploaded? true:false;

								tdHtml += (hasHLS)? '<i style="color: #029ad4; padding: 2px;" class="fa fa-video"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-video"></i>';
								tdHtml += (hasKey)? '<i style="color: #000; padding: 2px;" class="fa fa-key"></i>' : '<i style="color: lightgrey; padding: 2px;" class="fa fa-key"></i>';

								$('#channelvideoid' + channelvideo.id + ' td:nth-child(7)').html(tdHtml);

							}
							else {
								//Show file upload form...

								$('#resumable-keys-browse').show();
								$('#resumable-keys-delete').hide();
								$('#keys_file_size').hide();

							}

						});

						$("#resumable-keys-cancel").hide();
					});
				}

			}






	</script>



@endsection