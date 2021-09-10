<?php

namespace App\Http\Controllers\Admin\Channels\Batches;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchUser;
use App\Models\SubscriptionPayment;
use App\Models\SubscriptionPeriod;
use App\Models\User;
use App\Models\GizeChannel;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Symfony\Component\HttpFoundation\Response;

class BatchUserController extends Controller
{
    public function index($gize_channel_id, $batch_id = null)
    {
        // abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');


        $batch = null;
        if ($batch_id != null) {
            $batch = Batch::where('gize_channel_id', $gize_channel_id)
                ->where('id', $batch_id)->first();
        }
        $batches = Batch::
            whereIn('status', [1, 2]) //ongoing or onhold
            ->where('gize_channel_id', $gize_channel_id)
            ->orderBy('id', 'DESC')->get();

        // $batch = Batch::find(1);
        // $users = [];
        // foreach ($batch->users as $user) {
        //     $userdata = User::find($user->id);
        //     array_add($user, 'key', 'value')()=
        //     echo $user->pivot->created_at;
        // }
        if ($batch_id) {
            $subscriptions = BatchUser::where('batch_id', $batch_id)->orderBy('id', 'DESC')->get();
        } else {
            $subscriptions = null;
        }
        return view('admin.manage.batches.subscriptions.index', compact(
            [
                'subscriptions',
                'batch',
                'batches',
                'gize_channel',
            ]
        ));
    }

    public function unsubscribedUsersList($gize_channel_id, $batch_id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $users = [];
        try {

            $users = User::whereNotIn('id', BatchUser::select('user_id')
                    ->where('batch_id', $batch_id)->pluck('user_id')
            )->get();

        } catch (\Trhowable $e) {}
        return $users;
    }

    public function addSubscriber($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        // try {
        $batch = Batch::find($request->batch_id);
        $batch->users()->syncWithoutDetaching(
            $request->user_id,
            [
                // 'user_id' => $faker->randomElement([1, 2, 3]),
                'approved' => 0,
                'active' => 0,
                // 'method' => $faker->randomElement(['Cash', 'CBE', 'Abyssinia', 'CBE Birr', 'Dashen']),
                // 'payment_date' => $faker->numberBetween(0, 3),
                // 'created_at' => Date::now()->format('Y-m-d H:i:s'),
                // 'updated_at' => Date::now()->format('Y-m-d H:i:s'),
            ]
        );

        $timezone = env("APP_TIMEZONE", "");
        // $date = new Date($batch->created_at, $timezone);
        $date = new Date($batch->created_at, $timezone);
        $batch->created_at_diffForHumans = $date->diffForHumans();
        $subscription = BatchUser::where('user_id', $request->user_id)->where('batch_id', $batch->id)->first();

        return response()->json($subscription);
        // } catch (\Throwable $th) {
        //throw $th;
        // }
    }

    public function activateBatchUser($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $subscription = BatchUser::find($request->subscriptionid);
        if ($subscription->approved != 0) {
            $subscription->active = 1;
            $subscription->save();
        } else {
            return response()->json(['status' => 'fail', 'message' => "Unable to activate. Please approve subscription first."]);
        }

        return response()->json(['status' => 'success', 'subscription' => $subscription]);

        // return response()->json($subscription);
    }

    public function deactivateBatchUser($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $subscription = BatchUser::find($request->subscriptionid);
        $subscription->active = 0;

        $subscription->save();
        return response()->json(['status' => 'success', 'subscription' => $subscription]);

        // return response()->json($subscription);
    }

    public function approveBatchUser($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        $subscription = BatchUser::find($request->subscriptionid);

        $subscription->approved = 1;
        $subscription->save();

        return response()->json(['status' => 'success', 'subscription' => $subscription]);

        // return response()->json($subscription);
    }

    public function addPaymentDetail($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        //vallidate
        $request->validate([
            'payment_date' => 'required',
        ]);

        $batch_user_id = $request->batch_user_id;
        $subscription_period = $request->subscription_period;
        $batch_id = $request->batch_id;

        // Get Subscription Period Id for current Batch and Period_no
        $subscription_period_id = SubscriptionPeriod::where('batch_id', $batch_id)
            ->where('period_no', $subscription_period)
            ->value('id');
        // return "subscriptioN_period_id: " . $subscription_period_id;

        //payment_details
        $pmt_amount = $request->amount;

        // return $request->amount;
        $pmt_reciept_no = $request->reciept_no;
        $pmt_payment_date = $request->payment_date;
        $pmt_method = $request->method;

        //Add New Payment detail
        $subscription_period = SubscriptionPeriod::find($subscription_period_id);
        $subscription_period->subscribers()
            ->syncWithPivotValues($batch_user_id,
                [
                    'amount' => $pmt_amount,
                    'reciept_no' => $pmt_reciept_no,
                    'method' => $pmt_method,
                    'payment_date' => $pmt_payment_date,
                    'created_at' => Date::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                ]);

        //get the new subscription_period_id
        // $subscription_period_id = SubscriptionPayment::where('batch_user_id', 3)
        //     ->where('subscription_period_id', 3)
        //     ->value('id');

        $batch = Batch::where('id', $batch_id);

        $currency = $batch->value('currency');
        $subscription_type = '';
        $subscriber_name = '';
        $batch_user = BatchUser::where('id', $batch_user_id)->first();
        $total_paid_for_batch = $batch_user->getTotalPaidForBatch($batch_id);

        return response()->json(['status' => 'success', 'message' => 'Payment Detail Added.',
            'subscription_period_id' => $subscription_period_id,
            'currency' => $currency,
            'subscription_type' => $subscription_type,
            'subscriber_name' => $subscriber_name,
            'id' => $batch_user_id,
            'batch_id' => $batch_id,
            'total_paid' => $total_paid_for_batch,

        ], 200);

    }

    public function editPaymentDetail($gize_channel_id, Request $request)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');

        //vallidate
        $request->validate([
            'payment_date' => 'required',
        ]);

        $batch_user_id = $request->batch_user_id;
        $subscription_period_id = $request->subscription_period_id;

        //payment_details
        $pmt_amount = $request->amount;
        // return $request->amount;
        $pmt_reciept_no = $request->reciept_no;
        $pmt_payment_date = $request->payment_date;
        $pmt_method = $request->method;

        //Update Payment detail
        $subscription_period = SubscriptionPeriod::find($subscription_period_id);
        $subscription_period->subscribers()
            ->syncWithPivotValues($batch_user_id,
                [
                    'amount' => $pmt_amount,
                    'reciept_no' => $pmt_reciept_no,
                    'method' => $pmt_method,
                    'payment_date' => $pmt_payment_date,
                    'updated_at' => Date::now()->format('Y-m-d H:i:s'),

                ]);

        $batch_id = BatchUser::find($batch_user_id)->first()->value('batch_id');

        $batch = Batch::where('id', $batch_id);

        $currency = $batch->value('currency');
        $subscription_type = '';
        $subscriber_name = '';
        $batch_user = BatchUser::where('id', $batch_user_id)->first();
        $total_paid_for_batch = $batch_user->total_paid;

        return response()->json(['status' => 'success', 'message' => 'Payment Detail Updated.',
            'subscription_period_id' => $subscription_period_id,
            'currency' => $currency,
            'subscription_type' => $subscription_type,
            'subscriber_name' => $subscriber_name,
            'id' => $batch_user_id,
            'batch_id' => $batch_id,
            'total_paid' => $total_paid_for_batch,
        ], 200);

    }

    public function deletePaymentDetail($gize_channel_id, $batch_user_id, $subscription_period_id)
    {
        $gize_channel = GizeChannel::find($gize_channel_id);
        abort_if(!$gize_channel->isPermittedEditor(\Auth::user()), Response::HTTP_FORBIDDEN, 'Forbidden');


        // $batch_user_id = $request->batch_user_id;
        // $subscription_period_id = $request->subscription_period_id;

        //Delete Payment detail
        // $subscription_period = SubscriptionPeriod::find($subscription_period_id);
        // $subscription_period->subscribers()->where('')
        //     ->detach($batch_user_id);
        $batch_id = BatchUser::find($batch_user_id)->first()->value('batch_id');
        SubscriptionPayment::where('batch_user_id', $batch_user_id)
            ->where('subscription_period_id', $subscription_period_id)->delete();
        $batch = Batch::where('id', $batch_id)->first();
        $currency = $batch->value('currency');
        $batch_user = BatchUser::where('id', $batch_user_id)->first();
        $total_paid_for_batch = $batch_user->getTotalPaidForBatch($batch_id);

        // return 1;
        return response()->json(['status' => 'success', 'message' => 'Payment Detail Deleted.',
            'batch_id' => $batch_id,
            'currency' => $currency,
            'total_paid' => $total_paid_for_batch,

        ], 200);

    }

}
