<?php

namespace App\Http\Controllers\Admin\Channels\Batches;
use App\Http\Controllers\Controller;
use App\Models\BatchUser;
use App\Models\User;
use App\Models\Channelvideo;
use App\Models\BatchVideoActivity;
use Jenssegers\Date\Date;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BatchChannelvideoActivityController extends Controller
{
    public function index($gize_channel_id, $batch_id = null){

        return view('admin.manage.batches.video_views.index');
    }

    public function addView($gize_channel_id, Request $request)
    {
        $user = User::find($request->user_id);

        $channelvideo_id = $request->channelvideo_id;

        $within_days = $request->within_days;
        $for_hours = $request->for_hours;
        $published_at = $request->published_at;

        $user->channelvideos()->attach($channelvideo_id, [
            'status' => 0,
            'within_days' => $within_days,
            'for_hours' => $for_hours,
            'published_at' => $published_at
        ]);

        //last inserted
        $last_inserted = $user->channelvideos()->first()->rental_detail->orderBy('id', 'desc')->first();
        $last_inserted->user = User::find($user->id);
        $last_inserted->channelvideo = Channelvideo::find($last_inserted->channelvideo_id);

        $published_at = Date::createFromFormat('Y-m-d H:i:s', $last_inserted->published_at)->setTimezone(\Config::get('app.timezone'))->format('M d, Y h:i A');
        $last_inserted->published_at_formatted = $published_at;

        $started_at = "-";

        if($last_inserted->started_at != null){
            $started_at = Date::createFromFormat('Y-m-d H:i:s', $last_inserted->started_at)->setTimezone(\Config::get('app.timezone'))->format('M d, Y h:i A');
        }
        $last_inserted->started_at_formatted = $started_at;

        $last_inserted->validity= $this->checkRentalValidity($user->id, $last_inserted->id);

        return response()->json($last_inserted);
    }


    public function markStarted($batch_channelvideo_id, Request $request)
    {
        $user_id = \Auth::user()->id;

        // $user = User::where('id', $user_id);
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        $ip_address = '';
        $user_agent = '';
        //get current user's ip_address and user-agent
        $ip_address = $request->ip();
        $user_agent = $request->server('HTTP_USER_AGENT');

        $row_exists = false;

        if (BatchVideoActivity::
            where('batch_channelvideo_id', '=', $batch_channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->exists()) {
            $row_exists = true;
        }


        if (!$row_exists) {
            // It does not exist

            //View for first time...
            DB::table('batch_video_activity')
            ->insert(
                [
                    'batch_channelvideo_id' => $batch_channelvideo_id,
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
            DB::table('batch_video_activity')

            ->where('batch_channelvideo_id', '=', $batch_channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->increment('view_count', 1,
            [
                'batch_channelvideo_id' => $batch_channelvideo_id,
                'user_id' => $user_id,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
            ]);

            DB::table('batch_video_activity')

            ->where('batch_channelvideo_id', '=', $batch_channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->update(['updated_at' => \Carbon\Carbon::now()]);
        }

        return 1;

    }

    public function markCompleted($batch_channelvideo_id, Request $request)
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

        if (BatchVideoActivity::
            where('batch_channelvideo_id', '=', $batch_channelvideo_id)
            ->where('user_id', '=', $user_id)
            ->where('ip_address', '=', $ip_address)
            ->where('user_agent', '=', $user_agent)
            ->exists()) {
            $row_exists = true;
        }


        if ($row_exists) {

            DB::table('batch_video_activity')
                ->where('batch_channelvideo_id', $batch_channelvideo_id)
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
