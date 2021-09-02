<?php

namespace App\Http\Controllers\Admin\Channels\Batches;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\SubscriptionPeriod;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class BatchController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::orderBy('id', 'DESC')->get();
        $subscription_types = SubscriptionType::all();
        // $subscription_periods = SubscriptionPeriod::all();
        // foreach ($subscription_periods as $subscription_period) {

        // $STname = SubscriptionType::find($subscription_period->subscription_type_id);
        // $subscription_period->subscription_type_name = $subscription_type_name;

        // }

        return view('admin.manage.batches.index', compact(
            [
                'batches',
                'subscription_types',
                // 'subscription_periods',
            ]
        ));
    }

    public function addBatch(Request $request)
    {
        try {
            //code...

            $batch = new Batch();

            $validated = $request->validate([
                'code_name' => 'required|max:100|unique:batches,code_name',
                'description' => 'max:255',
                'subscription_type' => 'required',
                'starts_on_date' => 'required',
                'status' => 'required',
                'payment_fee' => 'required',
                'currency' => 'required',
                'gize_channel_id' => 'required',
            ]);

            $batch->code_name = $request->code_name;
            $batch->gize_channel_id = $request->gize_channel_id;
            $batch->description = $request->description;
            // $batch->subscription_period_id = $request->subscription_period_id;
            $batch->payment_fee = $request->payment_fee;
            $batch->currency = $request->currency;
            $batch->subscription_type_id = $request->subscription_type;
            $batch->starts_on_date = $request->starts_on_date;
            $batch->status = $request->status;

            $batch->save();
            return response()->json($batch);
        } catch (\Throwable $th) {
throw $th;

        }
    }

    public function editBatchForm($id)
    {
        $batch = Batch::find($id);
        $subscription_types = SubscriptionType::all();
        // $subscription_periods = SubscriptionPeriod::all();
        // foreach ($subscription_periods as $subscription_period) {

        //     $subscription_type_name = SubscriptionType::find($subscription_period->subscription_type_id);
        //     $subscription_period->subscription_type_name = $subscription_type_name;

        // }

        return view('admin.manage.batches.edit', compact([
            'batch',
            'subscription_types',
            // 'subscription_type_name',
            // 'subscription_periods',
        ]));

    }

    public function addBatchForm()
    {
        $batches = Batch::orderBy('id', 'DESC')->get();
        $subscription_types = SubscriptionType::all();
        // $subscription_periods = SubscriptionPeriod::all();
        // foreach ($subscription_periods as $subscription_period) {

        //     $subscription_type_name = SubscriptionType::find($subscription_period->subscription_type_id);
        //     $subscription_period->subscription_type_name = $subscription_type_name;

        // }

        return view('admin.manage.batches.create', compact([
            'batches',
            'subscription_types',
            // 'subscription_type_name',
            // 'subscription_periods',
        ]));
    }

    public function updateBatch(Request $request)
    {

        $batch = Batch::find($request->id);

        $validated = $request->validate([
            'code_name' => 'required|max:100|unique:batches,code_name,' . $request->id . ',id',
            'description' => 'max:255',
            'subscription_type' => 'required',
            'starts_on_date' => 'required',
            'status' => 'required',
            'payment_fee' => 'required',
            'currency' => 'required',
        ]);

        $batch->code_name = $request->code_name;
        $batch->description = $request->description;
        // $batch->subscription_period_id = $request->subscription_period_id;
        $batch->payment_fee = $request->payment_fee;
        $batch->currency = $request->currency;
        $batch->subscription_type_id = $request->subscription_type;
        $batch->starts_on_date = $request->starts_on_date;
        $batch->status = $request->status;
        // $validated = $request->validate([
        //     'code_name' => 'required|max:255|unique:batches,code_name,' . $request->id . ',id',
        // ]);

        $batch->save();
        return response()->json($batch);
    }

    public function getBatchById($id)
    {
        $batch = Batch::find($id);
        return response()->json($batch);
    }

    public function deleteBatch($id)
    {

        $batch = Batch::find($id);

        $batch->delete();

        return response()->json(['success' => 'Recored has been deleted.'], 200);
    }

    public static function deleteRelatedRecords($id)
    {
        try {
            //Delete data from subscriptions (batch_user) table
            // $channelvideo_access_by_app_users = ChannelvideoAccessByAppUser::where('channelvideo_id', $id)->delete();

            // //Delete data from channelvideo_channelvideo_category table
            // $channelvideo_channelvideo_category = Channelvideo::find($id)->channelvideoCategories()->detach();
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function deleteCheckedBatches(Request $request)
    {
        $ids = $request->ids;

        try {

            // foreach ($ids as $id) {
            //     $book = Batch::find($id);

            // }
            //delete all records of $ids..
            Batch::whereIn('id', $ids)->delete();

        } catch (Exception $e) {}
        return response()->json(['success' => "Records have been deleted."], 200);
    }

    public function addPeriod(Request $request)
    {

        // try {
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'name' => 'required',
            'period_batch_id' => 'required',
        ]);

        $batch_id = $request->period_batch_id;

        $subscription_period = new SubscriptionPeriod();

        $subscription_period->batch_id = $batch_id;
        $subscription_period->name = $request->name;
        $subscription_period->from_date = $request->from_date;
        $subscription_period->to_date = $request->to_date;

        //get next period no for $batch_id
        $max_period_no = Batch::where('id', $batch_id)->first()->max_period_no;
        $period_no = $max_period_no + 1;

        $subscription_period->period_no = $period_no;

        $subscription_period->save();

        return response()->json(['status' => 'success', 'message' => 'New period added.', 'subscription_period' => $subscription_period], 200);

        // } catch (\Throwable $th) {

        // }
        // return response()->json(['status' => 'fail', 'message' => 'Unable to add period.']);
    }

    public function editPeriod(Request $request)
    {

        // try {
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'batch_id' => 'required',
            'name' => 'required',
            'subscription_period_id'  => 'required',
        ]);

        $batch_id = $request->period_batch_id;
        $subscription_period_id = $request->subscription_period_id;

        $subscription_period = SubscriptionPeriod::find($subscription_period_id);

        $subscription_period->from_date = $request->from_date;
        $subscription_period->to_date = $request->to_date;
        $subscription_period->name = $request->name;

        $subscription_period->save();

        return response()->json(['status' => 'success', 'message' => 'Period Updated.', 'subscription_period' => $subscription_period], 200);

        // } catch (\Throwable $th) {

        // }
        // return response()->json(['status' => 'fail', 'message' => 'Unable to add period.']);
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
     * @param  \App\Models\Batch  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $bookFormat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $bookFormat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $bookFormat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $bookFormat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $bookFormat)
    {
        //
    }
}
