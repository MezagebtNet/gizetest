<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Http\DynamicHLSPlaylist;

// use vendor\pbmedia\laravel-ffmpeg\src\Http\DynamicHLSPlaylist;

class VideoController extends Controller
{

    protected $vid_id = 0;
    protected $playlist = '';

    public function stream($vid_id, $playlist = 'plist.m3u8')
    {
        $this->vid_id = $vid_id;
        $this->playlist = $playlist;
        // echo $this->vid_id.' '.$this->playlist;
        // $url = '/hls/'.$this->vid_id.'/';
        $DPL = new DynamicHLSPlaylist();
        return $DPL
            ->fromDisk('public')
            ->open('/hls/' . $vid_id . '/' . $playlist)
            ->setKeyUrlResolver(function ($key) {
                // return route('video.key', ['key' => $key, 'vid_id' => '20']);
                return $this->videoKey($key, $vid_id);
            })
            ->setMediaUrlResolver(function ($mediaFilename) use ($vid_id) {
                return Storage::disk('public')->url('/hls/' . $vid_id . '/' . $mediaFilename);
            })
            ->setPlaylistUrlResolver(function ($playlistFilename) use ($vid_id, $playlist) {
                return route('video.playlist', ['vid_id' => $vid_id, 'playlist' => $playlistFilename]);
                // return $this->stream($vid_id, $playlist);
            });
    }

    public function videoKey($key, $vid_id)
    {
        abort_if(Auth::guest(), 403);
        return Storage::disk('hls_secrets')->download($vid_id . '/' . $key);

    }
}
