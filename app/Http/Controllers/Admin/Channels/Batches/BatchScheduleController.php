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

        $batches = Batch::
            where('gize_channel_id', $gize_channel_id)
            ->whereIn('status', [1, 2]) //ongoing or onhold
            ->orderBy('id', 'DESC')->get();

        $batch = null;
        $schedules = collect([]);
        $channelvideos = Channelvideo::where('active', 1)->get()->pluck('id');

        $events = collect([]);
        if (isset($batch_id)) {

            $events = BatchChannelvideo::whereIn('channelvideo_id', $channelvideos)
                ->where('batch_id', $batch_id)->get();

            foreach ($events as $event) {
                $event->start = $event->starts_at;

                $event->end = $event->ends_at;
                $event->title = $event->video->first()->title;

                //$batch_channelvideos = $batch_channelvideos->merge($event);
            }

            // dd($schedules->toArray());
            $batch = Batch::find($batch_id);

        }

        $events = $events->toArray();

        $channelvideos = Channelvideo::where('gize_channel_id', $gize_channel_id)->where('active', 1)->orderBy('id', 'DESC')->get();
        foreach ($channelvideos as $vid) {
            $vid->text = $vid->title;
        }

        $channelvideos = $channelvideos->toArray();

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
