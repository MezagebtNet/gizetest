<?php

namespace App\Http\Controllers\Admin\Channels\Channelvideos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Channelvideo;
use App\Models\ChannelvideoActivity;
use Jenssegers\Date\Date;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Hashids\Hashids;


class ChannelvideoActivityController extends Controller
{
    //

    public static function decodeHashID($hashid){
        $hashids = new Hashids();
        $id = $hashids->decode($hashid);
        return $id;
    }

    public function markStarted($video, Request $request)
    {
        $user_id = \Auth::user()->id;

        // $user = User::where('id', $user_id);
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        $ip_address = '';
        $user_agent = '';
        //get current user's ip_address and user-agent
        $ip_address = $request->ip();
        $user_agent = $request->server('HTTP_USER_AGENT');

        $channelvideo_id = Channelvideo::decodeHashID($video)[0];

        $row_exists = false;

        if (ChannelvideoActivity::
            where('channelvideo_id', '=', $channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->exists()) {
            $row_exists = true;
        }


        if (!$row_exists) {
            // It does not exist

            //View for first time...
            DB::table('channelvideo_activity')
            ->insert(
                [
                    'channelvideo_id' => $channelvideo_id,
                    'user_id' => $user_id,
                    'ip_address' => $ip_address,
                    'user_agent' => $user_agent,
                    'started_at' => \Carbon\Carbon::now(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'status' => 1,
                    'view_count' => 1,
                ]
            );

        } else {
            // It exists
            //Increment view count
            DB::table('channelvideo_activity')

            ->where('channelvideo_id', '=', $channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->increment('view_count', 1,
            [
                'channelvideo_id' => $channelvideo_id,
                'user_id' => $user_id,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
            ]);

            DB::table('channelvideo_activity')

            ->where('channelvideo_id', '=', $channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->update(['updated_at' => \Carbon\Carbon::now()]);
        }

        return 1;

    }

    public function markCompleted($video, Request $request)
    {
        $user_id = \Auth::user()->id;

        // $user = User::find($user_id);
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        $ip_address = '';
        $user_agent = '';
        //get current user's ip_address and user-agent
        $ip_address = $request->ip();
        $user_agent = $request->server('HTTP_USER_AGENT');

        $row_exists = false;

        $channelvideo_id = Channelvideo::decodeHashID($video)[0];

        if (ChannelvideoActivity::
            where('channelvideo_id', '=', $channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->exists()) {
            $row_exists = true;
        }


        if ($row_exists) {

            DB::table('channelvideo_activity')
                ->where('channelvideo_id', $channelvideo_id)
                ->where('user_id', $user_id)
                ->where('ip_address', $ip_address)
                ->where('user_agent', $user_agent)
                ->where('status', 1)
                ->whereNotNull('started_at')
                ->update(['status' => 2]);

        }

        return $row_exists;

    }
}
