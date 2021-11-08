<?php

namespace App\Http\Controllers\Admin\Channels\Channelvideos;

use App\Http\Controllers\Controller;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use App\Models\ChannelvideoAccessByAppUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Image;

class ChannelvideoController extends Controller
{
    use SoftDeletes;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($gize_channel_id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideos = ChannelVideo::where('gize_channel_id', $gize_channel_id)->orderBy('id', 'DESC')->get();
        return view('admin.channelvideos.index', compact(
            'channelvideos',
            'gize_channel'
        ));
    }

    public static function countActiveChannelVideos()
    {
        $channelvideos_count = ChannelVideo::where('active', 1)->count();
        return $channelvideos_count;
    }

    public function addChannelVideo($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');
        // dd($request);
        $channelvideo = new ChannelVideo();
        $channelvideo->title = $request->title;
        $channelvideo->trainer = $request->trainer;
        $channelvideo->duration = $request->duration;
        $channelvideo->description = $request->description;
        $channelvideo->gize_channel_id = $gize_channel_id;
        // $channelvideo->video_available_for = 1;

            // Poster Image...
        $request->validate([
            'image_input' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('image_input');

        if ($image) {
            $image = $request->file('image_input');
            // $imageName = $image->getClientOriginalName();

            $ext = $request->file('image_input')->extension();
            $storeFileName = time() . '.' . $ext;

            $imagePath = 'images/c'; //local /c stands for channelvideo
            $thumbPath = 'images/c/thumb'; //public /c stands for channelvideo

            //original sized (max: 900 x 900)
            $storedImageUrl = $imagePath . '/' . $storeFileName;
            $img = Image::make($image->getRealPath())->resize(900, 900,
                function ($constraint) {
                    $constraint->aspectRatio();
                }); //->save(public_path($storedImageUrl));
            Storage::disk('public')->put($storedImageUrl, (string) $img->encode());

            //thumb (max: 100 X 150)
            $storedThumbImageUrl = $thumbPath . '/' . $storeFileName;
            $img = Image::make($image->getRealPath())->resize(150, 100,
                function ($constraint) {
                    $constraint->aspectRatio();
                }); //->save(public_path($storedThumbImageUrl));

            Storage::disk('public')->put($storedThumbImageUrl, (string) $img->encode());

            $channelvideo->poster_image_url = $storedImageUrl;
            $channelvideo->thumb_image_url = $storedThumbImageUrl;
        }

        $channelvideo->save();
        return response()->json($channelvideo);
    }

    public function streamVideo()
    {
        return 1;
        //https://drive.google.com/file/d/1qZ_SSLXhJIIzxiZ
        $path = storage_path('app/files/SampleVideo.mp4');
        $video_path = $path;
        $stream = new VideoStream($video_path);
        $stream->start();
    }

    public function imageDeletePost($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $id = $request->channelvideo_id;

        self::deleteChannelVideoImageFiles($gize_channel_id, $id);

        return 'success';
    }

    public function folderSize($dir)
    {
        $size = 0;

        foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : $this->folderSize($each);
        }

        return $size;
    }

    public function getChannelVideoById($gize_channel_id, $id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideo = ChannelVideo::find($id);
        $channelvideo->hls_size = 0; // in bytes
        $channelvideo->keys_size = 0; // in bytes
        // $channelvideo->hls_data;

        if ($channelvideo->hls_uploaded) {
            //get filesize of directory...
            $dir = storage_path('app/public/hls/c' . $gize_channel_id . '/' . $channelvideo->id);
            if (is_dir($dir)) {
                $channelvideo->hls_size = $this->folderSize($dir);
            }
        }
        if ($channelvideo->keys_uploaded) {
            //get filesize of directory...
            $dir = storage_path('app/files/c/' . $gize_channel_id . '/' . $channelvideo->id);
            if (is_dir($dir)) {
                $channelvideo->keys_size = $this->folderSize($dir);
            }
        }
        return response()->json($channelvideo);
    }

    public static function getChannelVideoCount()
    {
        //Create a counter for active channelvideos
        // $channelvideos = new ChannelVideo();
        $count = ChannelVideo::count('id');
        // $count = ChannelVideo::where('id', 1)->count();
        return $count;
    }

    public static function getActiveChannelVideoCount()
    {
        //Create a counter for active channelvideos
        // $channelvideos = new ChannelVideo();
        // $count = ChannelVideo::count('id');
        $count = ChannelVideo::where('active', 1)->count();
        return $count;
    }

    public function updateChannelVideo($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // return $request->id;
        $channelvideo = ChannelVideo::find($request->id);

        $channelvideo->title = $request->title;
        $channelvideo->trainer = $request->trainer;
        $channelvideo->duration = $request->duration;
        $channelvideo->description = $request->description;
        // image...

        // $pathme = $imagePath->getClientOrigin="";

        $image = $request->file('image_input_ed');

        if ($image) {
            $request->validate([
                'image_input_ed' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $ext = $request->file('image_input_ed')->extension();
            $storeFileName = time() . '.' . $ext;

            $imagePath = 'images/c'; //local /c stands for channelvideo
            $thumbPath = 'images/c/thumb'; //public /c stands for channelvideo

            //original sized (max: 900 x 900)
            $storedImageUrl = $imagePath . '/' . $storeFileName;
            $img = Image::make($image->getRealPath())->resize(900, 900,
                function ($constraint) {
                    $constraint->aspectRatio();
                }); //->save(public_path($storedImageUrl));

            Storage::disk('public')->put($storedImageUrl, (string) $img->encode());

            //thumb (max: 150 X 100)
            $storedThumbImageUrl = $thumbPath . '/' . $storeFileName;
            $img = Image::make($image->getRealPath())->resize(150, 100,
                function ($constraint) {
                    $constraint->aspectRatio();
                }); //->save(public_path($storedThumbImageUrl));

            Storage::disk('public')->put($storedThumbImageUrl, (string) $img->encode());

            $channelvideo->poster_image_url = $storedImageUrl;
            $channelvideo->thumb_image_url = $storedThumbImageUrl;

            /*$image = $request->file('image_input_ed');
        // $imageName = $image->getClientOriginalName();

        $ext = $request->file('image_input_ed')->extension();
        $storeFileName = time().'.'.$ext;

        $imagePath = 'images/l'; //local /l stands for channelvideo
        $thumbPath = 'images/l/thumb'; //public /l stands for channelvideo

        //original sized (max: 900 x 900)
        $storedImageUrl = $imagePath.'/'.$storeFileName;
        $img = Image::make($image->getRealPath())->resize(900, 900,
        function ($constraint) {
        $constraint->aspectRatio();
        })->save(public_path($storedImageUrl));

        //thumb (max: 100 X 150)
        $storedThumbImageUrl = $thumbPath.'/'.$storeFileName;
        $img = Image::make($image->getRealPath())->resize(150, 100,
        function ($constraint) {
        $constraint->aspectRatio();
        })->save(public_path($storedThumbImageUrl));

        $channelvideo->poster_image_url = $storedImageUrl;
        $channelvideo->thumb_image_url = $storedThumbImageUrl;*/
        }

        $channelvideo->save();
        return response()->json($channelvideo);
    }

    public function deleteChannelVideo($gize_channel_id, $id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // return $id;

        $channelvideo = ChannelVideo::find($id);
        // return response()->json($channelvideo);

        //Delete cover image and thumbnail image
        self::deleteChannelVideoImageFiles($gize_channel_id, $id);

        //Delete related data from other tables
        self::deleteRelatedRecords($gize_channel_id, $id);

        //Delete channelvideo file and sample channelvideo file
        // self::deleteChannelVideoFiles($id);

        //Delete HLS files
        $this->deleteChannelVideoHLSFiles($gize_channel_id, $id);

        //Delete Keys files
        $this->deleteChannelVideoKeyFiles($gize_channel_id, $id);

        $channelvideo->delete();

        //Delete directory
        Storage::disk('local_disk')->deleteDirectory('c/' . $gize_channel_id . '/' . $id);

        //Delete all video access data by users...
        ChannelvideoAccessByAppUser::where('channelvideo_id', $id)->delete();

        return response()->json(['success' => 'Recored has been deleted.']);
    }

    /*
     * php delete function that deals with directories recursively
     */
    public function delete_files($gize_channel_id, $target)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

            foreach ($files as $file) {
                $this->delete_files($file);
            }
            try {
                rmdir($target);
            } catch (\Throwable $th) {
                //throw $th;
            }

        } elseif (is_file($target)) {
            unlink($target);
        }
    }

    public function deleteChannelVideoHLSFiles($gize_channel_id, $id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        try {
            $channelvideo = ChannelVideo::find($id);
            $path = 'app/public/hls/c/';

            $dir = storage_path($path . $gize_channel_id . '/' . $channelvideo->id);
            if (is_dir($dir)) { //if directory exists...
                $this->delete_files($dir);
            }
            return response()->json([
                "status" => 'success',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json([
            "status" => 'fail',
            "message" => 'Unable to delete HLS files.',
        ]);
    }

    public function deleteChannelVideoKeyFiles($gize_channel_id, $id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        try {
            $channelvideo = ChannelVideo::find($id);
            $path = 'app/files/c/';

            $dir = storage_path($path . $gize_channel_id . '/' . $channelvideo->id);
            if (is_dir($dir)) { //if directory exists...
                $this->delete_files($dir);
            }
            return response()->json([
                "status" => 'success',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json([
            "status" => 'fail',
            "message" => 'Unable to delete HLS files.',
        ]);
    }

    public static function deleteRelatedRecords($gize_channel_id, $id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        try {
            //Delete data from channelvideo_access_by_app_users table
            $channelvideo_access_by_app_users = ChannelvideoAccessByAppUser::where('channelvideo_id', $id)->delete();

            //Delete data from channelvideo_channelvideo_category table
            $channelvideo_channelvideo_category = Channelvideo::find($id)->channelvideoCategories()->detach();
            return true;
        } catch (Throwable $e) {
            return false;
        }

    }

    public static function deleteChannelVideoImageFiles($gize_channel_id, $id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideo = ChannelVideo::find($id);
        if ($channelvideo->poster_image_url != null || $channelvideo->poster_image_url != '') {
            if (file_exists('storage/' . $channelvideo->poster_image_url)) {
                unlink('storage/' . $channelvideo->poster_image_url); //delete cover image
                $channelvideo->poster_image_url = null;
            }
        }

        if ($channelvideo->thumb_image_url != null || $channelvideo->thumb_image_url != '') {
            if (file_exists('storage/' . $channelvideo->thumb_image_url)) {
                unlink('storage/' . $channelvideo->thumb_image_url); //delete thumbnail image
                $channelvideo->thumb_image_url = null;
            }
        }
        $channelvideo->save();
        return 1;
    }

    public static function deleteChannelVideoFiles($gize_channel_id, $id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideo = ChannelVideo::find($id);

        if ($channelvideo->file_url != null || $channelvideo->file_url != '') {
            // return Storage::disk('local_disk')->exists('l/4/SampleVideo.mp4');
            if (Storage::disk('local_disk')->exists('c/' . $gize_channel_id . '/' . $channelvideo->id . '/' . $channelvideo->file_url)) {
                Storage::disk('local_disk')->delete('c/' . $gize_channel_id . '/' . $channelvideo->id . '/' . $channelvideo->file_url); //Delete ChannelVideo file
                $channelvideo->file_url = null;
                $channelvideo->file_type = 0; //default
                $channelvideo->active = 0;

                $channelvideo->save();
                return 1;
            }
        }

        if ($channelvideo->sample_file_url != null || $channelvideo->sample_file_url != '') {
            if (Storage::disk('local_disk')->exists('c/' . $gize_channel_id . '/' . $channelvideo->id . '/' . $channelvideo->sample_file_url)) {
                Storage::disk('local_disk')->delete('c/' . $gize_channel_id . '/' . $channelvideo->id . '/' . $channelvideo->sample_file_url); //Delete Sample ChannelVideo file
                $channelvideo->sample_file_url = null;
                $channelvideo->sample_file_type = 0; //default

                $channelvideo->save();
                return 1;
            }
        }

        return 0;
    }

    public function deleteCheckedChannelVideos($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $ids = $request->ids;

        try {
            //loop through ids and remove images...

            foreach ($ids as $id) {
                $channelvideo = ChannelVideo::find($id);

                //Delete cover image and thumbnail image
                self::deleteChannelVideoImageFiles($gize_channel_id, $id);

                //Delete related data from other tables
                self::deleteRelatedRecords($gize_channel_id, $id);

                //Delete channelvideo file and sample channelvideo file
                // self::deleteChannelVideoFiles($id);

                //Delete HLS files
                $this->deleteChannelVideoHLSFiles($gize_channel_id, $id);

                //Delete Keys files
                $this->deleteChannelVideoKeyFiles($gize_channel_id, $id);

            }
            //delete all records of $ids..
            ChannelVideo::whereIn('id', $ids)->delete();

            //delete all directories
            foreach ($ids as $id) {
                Storage::disk('local_disk')->deleteDirectory('c/' . $gize_channel_id . '/' . $id);
            }

            //delete all video access data by users..
            foreach ($ids as $id) {
                ChannelvideoAccessByAppUser::where('channelvideo_id', $id)->delete();
            }

        } catch (Exception $e) {}
        return response()->json(['success' => "Records have been deleted."]);
    }

    public function activateChannelVideo($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideo = ChannelVideo::find($request->channelvideoid);
        if ($channelvideo->hls_uploaded != 0) {
            if ($channelvideo->keys_uploaded != 0) {
                $channelvideo->active = 1;
                $channelvideo->save();
            } else {
                return response()->json(['status' => 'fail', 'message' => "Unable to activate. Please upload HLS Keys first."]);
            }
        } else {
            return response()->json(['status' => 'fail', 'message' => "Unable to activate. Please upload HLS Videos first."]);
        }

        return response()->json(['status' => 'success', 'channelvideo' => $channelvideo]);

        // return response()->json($channelvideo);
    }

    public function deactivateChannelVideo($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideo = ChannelVideo::find($request->channelvideoid);
        $channelvideo->active = 0;

        $channelvideo->save();
        return response()->json(['status' => 'success', 'channelvideo' => $channelvideo]);

        // return response()->json($channelvideo);
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function fileUpload()
    // {
    //     return view('fileUpload');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideo = ChannelVideo::find($request->channelvideo_id);
        $path = "";
        // $request->validate([
        //   'channelvideo_file_input' => 'required|mimes:pdf,epub,opf|max:2048',
        // ]);
        if ($request->file('channelvideo_file_input')) {
            $filePath = $request->file('channelvideo_file_input');
            $orignalfileName = $request->file('channelvideo_file_input')->getClientOriginalName();
            $ext = $request->file('channelvideo_file_input')->extension();
            $storeFileName = $channelvideo->id . '.' . $ext;
            // $storeFileName = time().'.'.$ext;
            // $url = file('channelvideo_file_input')

            //Upload to Google Drive...
            // Storage::disk('google')->allFiles();
            // return 'here';

            // Storage::disk('google')->put('text.txt', 'Hello world!');
            // $path = $request->file('channelvideo_file_input')->storePubliclyAs('channel-videos', $storeFileName, 'public');
            // return 'here';
            // return $filePath;

            Storage::disk('local_disk')->putFileAs('/c/'. $gize_channel_id . '/', $filePath, $storeFileName);
            // Storage::disk('local_disk')->putFileAs('/c/'.$channelvideo->id.'/', $filePath, $storeFileName);

            $prev_url = $channelvideo->file_url;
            $storedFileUrl = "";

            try {
                $storedFileUrl = $storeFileName;
                $channelvideo->file_url = $storedFileUrl;
                $channelvideo->save();
                return response()->json(['status' => 'success', 'file' => $storedFileUrl, 'channelvideoid' => $channelvideo->id, 'channelvideo' => $channelvideo]);
            } catch (Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Unable to upload or save file']);
            }

            /*try {
        if($path != NULL && $path != ''){
        $storedFileUrl = $path;
        $channelvideo->file_url = $storedFileUrl;
        if($ext == 'mp4') $channelvideo->file_type = 0;
        if($ext == 'pdf' || $ext == 'pdf') $channelvideo->file_type = 1;
        }
        if($prev_url != NULL && $prev_url != '') {
        // if(file_exists(public_path($prev_url))){
        //   unlink(public_path($prev_url));
        // }
        }
        $channelvideo->save();
        // return Storage::setVisibility('/public/channel-videos/'.$storeFileName, 'public');
        // return Storage::getVisibility('/public/channel-videos/'.$storeFileName);
        return response()->json(['status'=>'success', 'file'=>$storedFileUrl, 'channelvideoid'=>$channelvideo->id, 'channelvideo'=>$channelvideo] );
        }
        catch(Exception $e)
        {
        return  response()->json(['status'=>'error', 'message'=>'Unable to upload or save file']);
        }
         */
        }
        return response()->json(['status' => 'error', 'message' => 'Unable to upload or save file']);

        // $request->validate([
        //     'channelvideo_file_input' => 'required|mimes:pdf,epub|max:2048',
        // ]);

        // $fileName = time().'.'.$request->file->extension();

        // $request->file->move(public_path('uploads'), $fileName);

        // return back()
        //     ->with('success','You have successfully upload file.')
        //     ->with('file',$fileName);

    }

    /*
    public function fileDeletePost(Request $request){
    $channelvideo = ChannelVideo::find($request->channelvideo_id);
    return '/storage/'.$channelvideo->file_url;
    if($channelvideo->file_url!=null || $channelvideo->file_url != "")
    Storage::delete('/storage/'.$channelvideo->file_url);
    if($channelvideo->sample_file_url!=null || $channelvideo->sample_file_url != "")
    Storage::delete('/storage/'.$channelvideo->sample_file_url);

    }
     */

    public function fileRead($gize_channel_id, $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channelvideo = ChannelVideo::find($request->channelvideo_id);

        $url = $gize_channel_id . '/' . $channelvideo->file_url;
        return asset('storage/' . $url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChannelVideo  $channelvideo
     * @return \Illuminate\Http\Response
     */
    public function show(ChannelVideo $channelvideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChannelVideo  $channelvideo
     * @return \Illuminate\Http\Response
     */
    public function edit(ChannelVideo $channelvideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChannelVideo  $channelvideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChannelVideo $channelvideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChannelVideo  $channelvideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChannelVideo $channelvideo)
    {
        //
    }
}
