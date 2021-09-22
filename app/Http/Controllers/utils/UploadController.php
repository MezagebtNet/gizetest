<?php
namespace App\Http\Controllers\Utils;

use Storage;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;


use App\Models\Channelvideo;
use App\Models\GizeChannel;

// use App\Models\Video;


class UploadController extends Controller
{
    /**
     * Handles the file upload
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws UploadMissingFileException
     * @throws \Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException
     */
    public function upload($gize_channel_id, Request $request) {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            $vid_id = $request->vid_id;
            // $vid_id = 12;
            $location = "app/files/c/" . $gize_channel_id . "/";

            if($this->saveFile($gize_channel_id, $save->getFile(), $location, $vid_id)){
                //Extract Zip Archive
                if(self::extractZipFile( $vid_id, $location )){
                    //remove zip file...
                    if(file_exists(storage_path($location.$vid_id.'.zip'))){
                        unlink(storage_path($location.$vid_id.'.zip')); //delete thumbnail image
                        return response()->json([
                            'status' => 'success'
                        ]);
                    }
                };
            }


        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }



    public function uploadHLSChunk($gize_channel_id, Request $request) {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            $vid_id = $request->vid_id;

            // $location = "app/files/l/";
            $location = "app/public/hls/c/" . $gize_channel_id . "/";

            if($this->saveFile($gize_channel_id, $save->getFile(), $location, $vid_id)){
                //Extract Zip Archive
                if(self::extractZipFile( $vid_id, $location )){

                    //Update database
                    $channelvideo = Channelvideo::find($vid_id);
                    // $channelvideo->file_url = $fileName;
                    $channelvideo->hls_uploaded = 1;
                    $channelvideo->save();

                    //remove zip file...
                    if(file_exists(storage_path($location.$vid_id.'.zip'))){

                        unlink(storage_path($location.$vid_id.'.zip')); //delete thumbnail image
                        return response()->json([
                            'status' => 'success',
                            'channelvideo' => $channelvideo
                        ]);
                    }
                };
            }
            else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Unable to upload HLS'
                ]);
            }


        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }


    public function uploadKeysChunk($gize_channel_id, Request $request) {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            $vid_id = $request->vid_id;

            $location = "app/files/c/" . $gize_channel_id ."/";
            // $location = "app/public/hls/";

            if($this->saveFile($gize_channel_id, $save->getFile(), $location, $vid_id)){
                //Extract Zip Archive
                if(self::extractZipFile( $vid_id, $location )){

                    //Update database
                    $channelvideo = Channelvideo::find($vid_id);
                    // $channelvideo->file_url = $fileName;
                    $channelvideo->keys_uploaded = 1;
                    $channelvideo->save();

                    //remove zip file...
                    if(file_exists(storage_path($location.$vid_id.'.zip'))){

                        unlink(storage_path($location.$vid_id.'.zip')); //delete thumbnail image
                        return response()->json([
                            'status' => 'success',
                            'channelvideo' => $channelvideo
                        ]);
                    }
                };
            }
            else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Unable to upload Keys'
                ]);
            }


        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }


    /*
    * php delete function that deals with directories recursively
    */
    public function delete_files($gize_channel_id, $target) {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

            foreach( $files as $file ){
                $this->delete_files( $file );
            }
            try {
                rmdir( $target );
            } catch (\Throwable $th) {
                //throw $th;
            }

        } elseif(is_file($target)) {
            unlink( $target );
        }
    }

    public function deleteHLSFiles($gize_channel_id, $id){
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // try {
            $channelvideo = Channelvideo::find($id);
            $path = 'app/public/hls/c/' . $gize_channel_id . "/";

            $dir = storage_path($path.$channelvideo->id);
            if(is_dir($dir)){ //if directory exists...
                $this->delete_files($dir);
            }
            $channelvideo->hls_uploaded = 0;
            $channelvideo->save();
            return response()->json([
                "status" => 'success',
                "channelvideo" => $channelvideo
            ]);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        return response()->json([
            "status" => 'fail',
            "message" => 'Unable to delete HLS files.'
        ]);
    }

    public function deleteKeysFiles($gize_channel_id, $id){
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        try {
            $channelvideo = Channelvideo::find($id);
            $path = 'app/files/c/' . $gize_channel_id . '/';

            $dir = storage_path($path.$channelvideo->id);
            if(is_dir($dir)){ //if directory exists...
                $this->delete_files($dir);
            }
            $channelvideo->keys_uploaded = 0;
            $channelvideo->save();
            return response()->json([
                "status" => 'success',
                "channelvideo" => $channelvideo
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json([
            "status" => 'fail',
            "message" => 'Unable to delete Key files.'
        ]);
    }








    public function uploadVideoHLSChunk($gize_channel_id, Request $request) {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            $vid_id = $request->vid_id;

            $location = "app/files/c/" . $gize_channel_id . "/";
            // $location = "app/public/video/";

            if($this->saveFile($gize_channel_id, $save->getFile(), $location, $vid_id)){
                //Extract Zip Archive
                if(self::extractZipFile( $vid_id, $location )){

                    //Update database
                    $video = Channelvideo::find($vid_id);
                    // $video->file_url = $fileName;
                    $video->hls_uploaded = 1;
                    $video->save();

                    //remove zip file...
                    if(file_exists(storage_path($location.$vid_id.'.zip'))){

                        unlink(storage_path($location.$vid_id.'.zip')); //delete thumbnail image
                        return response()->json([
                            'status' => 'success',
                            'video' => $video
                        ]);
                    }
                };
            }
            else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Unable to upload Video HLS'
                ]);
            }


        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }


    public function uploadVideoKeysChunk($gize_channel_id, Request $request) {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            $vid_id = $request->vid_id;

            $location = "app/files/v/";
            // $location = "app/public/hls/";

            if($this->saveFile($gize_channel_id, $save->getFile(), $location, $vid_id)){
                //Extract Zip Archive
                if(self::extractZipFile( $vid_id, $location )){

                    //Update database
                    $video = Channelvideo::find($vid_id);
                    // $video->file_url = $fileName;
                    $video->keys_uploaded = 1;
                    $video->save();

                    //remove zip file...
                    if(file_exists(storage_path($location.$vid_id.'.zip'))){

                        unlink(storage_path($location.$vid_id.'.zip')); //delete thumbnail image
                        return response()->json([
                            'status' => 'success',
                            'video' => $video
                        ]);
                    }
                };
            }
            else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Unable to upload Video Keys'
                ]);
            }


        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }


    public function deleteVideoHLSFiles($gize_channel_id, $id){
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        try {
            $video = Channelvideo::find($id);
            $path = 'app/public/l/';

            $dir = storage_path($path.$video->id);
            if(is_dir($dir)){ //if directory exists...
                $this->delete_files($dir);
            }
            $video->hls_uploaded = 0;
            $video->save();
            return response()->json([
                "status" => 'success',
                "video" => $video
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json([
            "status" => 'fail',
            "message" => 'Unable to delete Video HLS files.'
        ]);
    }

    public function deleteVideoKeysFiles($gize_channel_id, $id){
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // try {
            $video = Channelvideo::find($id);
            $path = 'app/files/v/';

            $dir = storage_path($path.$video->id);
            if(is_dir($dir)){ //if directory exists...
                $this->delete_files($dir);
            }
            $video->keys_uploaded = 0;
            $video->save();
            return response()->json([
                "status" => 'success',
                "video" => $video
            ]);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        return response()->json([
            "status" => 'fail',
            "message" => 'Unable to delete Video Key files.'
        ]);
    }


    /**
     * Saves the file to S3 server
     *
     * @param UploadedFile $file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function saveFileToS3($file)
    {
        $fileName = $this->createFilename($file);
        $disk = Storage::disk('s3');
        // It's better to use streaming Streaming (laravel 5.4+)
        $disk->putFileAs('photos', $file, $fileName);
        // for older laravel
        // $disk->put($fileName, file_get_contents($file), 'public');
        $mime = str_replace('/', '-', $file->getMimeType());
        // We need to delete the file when uploaded to s3
        unlink($file->getPathname());
        return response()->json([
            'path' => $disk->url($fileName),
            'name' => $fileName,
            'mime_type' =>$mime
        ]);
    }


    /**
     * Saves the file
     *
     * @param UploadedFile $file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function saveFile($gize_channel_id, UploadedFile $file, $location, $vid_id)
    {
        $fileName = $this->createFilename($file);

        $extension = $file->getClientOriginalExtension();
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m-W");

        // Build the file path
        // $filePath = "upload/{$mime}/{$dateFolder}/";
        // $filePath = "files/l/";
        $finalPath = storage_path($location);
        // move the file name
        // $file->move($finalPath, $fileName);
        $file->move($finalPath, $vid_id.".".$extension);







        return true;
        // return response()->json([
        //     'path' => $filePath,
        //     'name' => $fileName,
        //     'mime_type' => $mime
        // ]);
    }


    /**
     * Extract zipped file to a directory
     * @param String $fileName
     *
     * @return \Illuminate\Http\JsonResponse
     * @return bool
     */
    protected static function extractZipFile($fileName, $location){
       //Search for the zip file in app/files/l folder

       $zip = new \ZipArchive();
       if ($zip->open(storage_path($location.$fileName.".zip")) === TRUE) {
            $zip->extractTo(storage_path($location.$fileName));
            $zip->close();
            return true;
        } else {
            return false;
        }

    }

    /**
     * Extract zipped file to a directory
     * @param String $fileName
     *
     * @return \Illuminate\Http\JsonResponse
     * @return bool
     */
    protected static function extract(Request $request){
       //Search for the zip file in app/files/l folder
        $vid_id = $request->vid_id;
        // return $vid_id;
        $zip = new \ZipArchive();
        if ($zip->open(storage_path("app/files/l/"."13".".zip")) === TRUE) {
            $zip->extractTo(storage_path("app/files/l/"."13"));
            $zip->close();
            echo 'ok';
        } else {
            echo storage_path("app/files/l/".$vid_id.".zip");
        }

    }

    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file){
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension
        // Add timestamp hash to name of the file
        // $filename .= "_" . md5(time()) . "." . $extension;

        $filename = time().'.'.$extension;
        return $filename;
    }
}