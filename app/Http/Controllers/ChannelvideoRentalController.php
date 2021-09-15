<?php

namespace App\Http\Controllers;

use App\Models\GizeChannel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChannelvideoRentalController extends Controller
{
    //
    public function getAllRentals()
    {
        //
    }

    /**
     * The active rentals that belong to the User
     * @param int $user_id
     * @param int $status //Status of user watching status 0:not started watching, 1: started watching, 2: completed
     * @return \App\Models\Channelvideo
     */
    public function getActiveRentalsByUser($slug, $user_id, $status = null)
    {

        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();

        $now = \Carbon\Carbon::now();

        $result = User::find($user_id)->channelvideos($status)->where('gize_channel_id', $gize_channel->id)->get();

        $rentals = collect([]);

        foreach ($result as $rent) {
            $start_date = $rent->rental_detail->published_at;
            $within_days = $rent->rental_detail->within_days;

            $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->addDays($within_days);

            $check = $now->between($start_date, $end_date);

            if ($check) {

                $rentals = $rentals->add($rent);

            }
        }

        return $rentals;
    }

    public function markStartedAt($user_id, $channelvideo_rental_id)
    {
        $user = User::find($user_id);

        DB::table('channelvideo_rentals')
            ->where('id', $channelvideo_rental_id)
            ->where('status', 0)
            ->update(['status' => 1, 'started_at' => \Carbon\Carbon::now()]);

    }

    public function markCompleted($user_id, $channelvideo_rental_id)
    {
        $user = User::find($user_id);

        DB::table('channelvideo_rentals')
            ->where('id', $channelvideo_rental_id)
            ->update(['status' => 2, 'started_at' => \Carbon\Carbon::now()]);

    }
}
