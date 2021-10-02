<?php

namespace App\Http\Controllers;

use App\Models\BatchUser;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ChannelvideoRentalController extends Controller
{
    //
    public function index($gize_channel_id)
    {
        $users = User::all();
        $rentals = collect([]);

        $gize_channel = GizeChannel::find($gize_channel_id);

        $channelvideos = Channelvideo::where('gize_channel_id', $gize_channel_id)->where('active', 1)->orderBy('id', 'DESC')->get();

        foreach ($channelvideos as $vid) {
            $vid->text = $vid->title;
        }


        foreach ($users as $user) {

            $rental_details = $user->channelvideos()->where('gize_channel_id', $gize_channel_id)->get();
            foreach ($rental_details as $rental_detail) {
                $rental_detail->user = $user;
                $rental_detail->channelvideo = Channelvideo::find($rental_detail->id);

                $published_at = Date::createFromFormat('Y-m-d H:i:s', $rental_detail->rental_detail->published_at)->setTimezone(\Config::get('app.timezone'))->format('M d, Y H:i A');
                $rental_detail->published_at_formatted = $published_at;

                $rental_detail->validity= $this->checkRentalValidity($user->id, $rental_detail->rental_detail->id);

            }

            $rentals = $rentals->merge($rental_details);

        }

        return view('admin.manage.rentals.index', compact('rentals', 'gize_channel', 'channelvideos', 'users'));


    }

    public function addRental($gize_channel_id, Request $request)
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


        return response()->json($last_inserted);
    }



    public function checkRentalValidity($user_id, $channelvideo_rental_id = 0)
    {
        // return false;
        $q = $this::getChannelActiveRentalsByUser(null, $user_id);

        $rid = $channelvideo_rental_id;

        $found = 0;

        foreach ($q as $query) {
            if ($query->rental_detail->id == $rid) {
                $found = 1;
            }

        }

        return $found;

        // return response()->json(["status" => $found]);

    }

    /**
     * The active rentals that belong to the User
     * @param int $user_id
     * @param int $status //Status of user watching status 0:not started watching, 1: started watching, 2: completed
     * @return \App\Models\Channelvideo
     */
    public static function getChannelActiveRentalsByUser($slug, $user_id, $status = null)
    {

        if($slug != null){
            $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();
            $gize_channel_id = $gize_channel->id;
        }

        $now = \Carbon\Carbon::now();

        $user_id = \Auth::user()->id;


        $user_batches = BatchUser::where('user_id', $user_id)
            ->where('active', 1)
            ->get()->pluck('batch_id');

        $channelvideos = collect([]);

        $videos = Channelvideo::where('active', 1)
            ->whereIn('video_available_for', [1, 2])
            ->get();

        $active_channelvideo_ids = $videos->pluck('id');

        if($slug != null) {
            $result = User::find($user_id)->channelvideos()
            ->whereIn('channelvideos.id', $active_channelvideo_ids)
            ->where('gize_channel_id', $gize_channel_id)->get();
        }
        else {
            $result = User::find($user_id)->channelvideos()
            ->whereIn('channelvideos.id', $active_channelvideo_ids)
            ->get();
        }


        $rentals = collect([]);

        foreach ($result as $rent) {
            if ($rent->rental_detail->started_at == null && $rent->rental_detail->status == 0) {
                $start_date = $rent->rental_detail->published_at;
                $within_days = $rent->rental_detail->within_days;

                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->addDays($within_days);

                $check = $now->between($start_date, $end_date);

                if ($check) {

                    $rentals = $rentals->add($rent);

                }
            } else if ($rent->rental_detail->started_at != null && $rent->rental_detail->status != 0) {
                $start_date = $rent->rental_detail->started_at;
                $for_hours = $rent->rental_detail->for_hours;

                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->addHours($for_hours);

                $check = $now->between($start_date, $end_date);

                if ($check) {

                    $rentals = $rentals->add($rent);

                }
            }
        }

        return $rentals;

    }

    public function markStartedAt($user_id, $channelvideo_rental_id)
    {
        $user = User::find($user_id);
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        DB::table('channelvideo_rentals')
            ->where('id', $channelvideo_rental_id)
            ->where('status', 0)
            ->update(['status' => 1, 'started_at' => \Carbon\Carbon::now()]);

        return 1;

    }

    public function markCompleted($user_id, $channelvideo_rental_id)
    {
        $user = User::find($user_id);
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        DB::table('channelvideo_rentals')
            ->where('id', $channelvideo_rental_id)
            ->whereNotNull('started_at')
            ->update(['status' => 2]);

        return 1;

    }

    public function getEndingTime($user_id, $channelvideo_rental_id)
    {
        $user = User::find($user_id);
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        $started_at = DB::table('channelvideo_rentals')
            ->select('started_at')
            ->where('id', $channelvideo_rental_id)->value('started_at');
        $for_hours = DB::table('channelvideo_rentals')
            ->select('for_hours')
            ->where('id', $channelvideo_rental_id)->value('for_hours');

        $ends_at = Date::createFromFormat('Y-m-d H:i:s', $started_at)->addHours($for_hours)->setTimezone(\Config::get('app.timezone'));

        return $ends_at->format('M d, Y H:i A') . ' (' . $ends_at->diffForHumans() . ')';

    }

}
