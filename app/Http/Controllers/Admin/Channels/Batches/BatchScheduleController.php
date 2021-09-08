<?php

namespace App\Http\Controllers\Admin\Channels\Batches;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchChannelvideo;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BatchScheduleController extends Controller
{

    public function index($gize_channel_id, $batch_id = null)
    {
        // abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $batch = null;
        if (isset($batch_id)) {
            $batch = Batch::where('gize_channel_id', $gize_channel_id)
                ->where('id', $batch_id)->first();
        }
        $batches = Batch::
            where('gize_channel_id', $gize_channel_id)
            ->whereIn('status', [1, 2]) //ongoing or onhold
            ->orderBy('id', 'DESC')->get();

        $schedules = BatchChannelvideo::whereIn('batch_id', $batches->pluck('id'))->get();
        foreach ($schedules as $schedule) {
            if (Channelvideo::find($schedule->channelvideo_id)) {
                $schedule->title = Channelvideo::find($schedule->channelvideo_id)->title;
            }

            $schedule->start = $schedule->starts_at; //Carbon::createFromFormat('Y-m-d H', $schedule->starts_at)->toDateTimeString(); // 1975-05-21 22:00:00
            $schedule->end = $schedule->ends_at; //Carbon::createFromFormat('Y-m-d H', $schedule->starts_at)->toDateTimeString(); // 1975-05-21 22:00:00
        }
        $events = $schedules->toArray();
        $channelvideos = Channelvideo::where('gize_channel_id', $gize_channel_id)->orderBy('id', 'DESC')->get();
        foreach ($channelvideos as $vid) {
            $vid->text = $vid->title;
        }

        $channelvideos = $channelvideos->toArray();
        // $channelvideos = array('channelvideos' => json_decode($channelvideos));

        return view('admin.manage.batches.schedules.index', compact(
            'events',
            'batch',
            'batches',
            'gize_channel',
            'channelvideos'
        ));

        // return view('admin.manage.batches.subscriptions.index', compact(
        //     [
        //         'subscriptions',
        //         'batch',
        //         'batches',
        //     ]
        // ));
    }

    public function loadEvent($gize_channel_id, $batch_id, Request $request = null)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        if ($request && $request->ajax()) {
            $data = BatchChannelvideo::whereDate('starts_at', '>=', $request->start)
                ->whereDate('ends_at', '<=', $request->end)
                ->get(['id', 'title', 'starts_at', 'ends_at']);
            return response()->json($data);
        }
        return [];
    }

    public function crudCalendarEvents($gize_channel_id, $batch_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        switch ($request->type) {
            case 'create':
                $channelvideo = Channelvideo::find($request->select_video)->first();
                $event = Channelvideo::find($request->select_video)->batches()->attach($batch_id, [
                    // 'title' => $request->title,
                    'starts_at' => $request->starts_at,
                    'ends_at' => $request->ends_at,
                ]);

                return response()->json([
                    'id' => DB::table('batch_channelvideo')->select(DB::raw('max(id) as id'))->where('channelvideo_id', '=', $request->select_video)->first()->id,
                    'title' => $channelvideo->title,
                    'starts_at' => $request->starts_at,
                    'ends_at' => $request->ends_at,
                ]);
                break;

            case 'edit':
                $channelvideo_id = DB::table('batch_channelvideo')->where('id', $request->id)->select('channelvideo_id')->get()->first()->channelvideo_id;
                DB::table('batch_channelvideo')->where('id', $request->id)->delete();
                $id = DB::table('batch_channelvideo')->select(DB::raw('max(id) as id'))->where('channelvideo_id', '=', $request->select_video)->first()->id;

                Channelvideo::find($channelvideo_id)->batches()->attach($batch_id, [
                    'id' => $id,
                    'starts_at' => $request->start,
                    'ends_at' => $request->end,
                ]);
                $channelvideo = Channelvideo::find($channelvideo_id);
                // $event = BatchChannelvideo::find($request->id)->update([
                //     // 'title' => $request->title,
                //     'starts_at' => $request->starts_at,
                //     'ends_at' => $request->ends_at,
                // ]);

                return response()->json([
                    'id' => $id,
                    'title' => $channelvideo->title,
                    'starts_at' => $request->starts_at,
                    'ends_at' => $request->ends_at,
                ]);
                break;

            case 'delete':
                $event = BatchChannelvideo::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # ...
                break;
        }
    }

}
