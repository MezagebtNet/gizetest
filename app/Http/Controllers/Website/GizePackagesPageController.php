<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GizePackage;
use App\Models\UserGizePackage;
use Jenssegers\Date\Date;
use App\Models\User;
use App\Models\Channelvideo;
use App\Models\UserGizePackageHistory;

class GizePackagesPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $gize_packages = GizePackage::where('active', 1)->get();
        return view('website.gize_packages.index', compact(
            'gize_packages'
        ));

    }

    public function addRental($user_id, $channelvideo_id, $within_days, $for_hours, $published_at)
    {
        $user = User::find($user_id);
        $channelvideo_id = $channelvideo_id;
        $within_days = $within_days;
        $for_hours = $for_hours;
        $published_at = $published_at;

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

        // $last_inserted->validity= $this->checkRentalValidity($user->id, $last_inserted->id);

        // return response()->json($last_inserted);
        return $last_inserted;
    }


    public function orderVideoUsingPackage(Request $request){
        // return 1;
        $user_id = auth()->user()->id;
        $channelvideos = explode (",", $request->videos_in_cart);

        $package_id = $request->package_id;
        // $within_days = $request->within_days;
        $within_days = 7;
        // $for_hours = $request->for_hours;
        $for_hours = 24;
        $published_at = $request->published_at;
        // return 'package '. $package_id;

        try {
            //loop through selected channelvideo ids and add rentals...

            foreach ( $channelvideos as $channelvideo_id) {

                //check if package belongs to user
                $channelvideo = $channelvideo_id;

                $users_available_packages = $this->getUserPackages($user_id);

                // dd($package_id, $users_available_packages->pluck('id'));
                // return $users_available_packages->pluck('id')->toArray();
                // return $package_id;
                if (in_array($package_id, $users_available_packages->pluck('id')->toArray())) {
                    // dd( $channelvideo_id);
                    //check if package has sufficient balance
                    // return 'here';
                    if(count($channelvideos) <= $users_available_packages->where('id', $package_id)->first()->unit_values_balance){

                        $user_gize_package = UserGizePackage::find($package_id);

                        $package_months = $user_gize_package->gize_package->value('months');

                        $start_date =\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $published_at);
                        $within_days = $start_date->diffInDays($start_date->copy()->addMonths($package_months)) + 1;
                        // return $within_days;

                        // place order
                        $rental = $this->addRental($user_id, $channelvideo_id, $within_days, $for_hours, $published_at);

                        if($rental != null){
                            //Subtract balance from package
                            $user_gize_package->unit_values_balance = $user_gize_package->unit_values_balance - 1;
                            $user_gize_package->save();

                            //save user gizepackage usage history on db

                            $last_inserted_id = $user_gize_package->id;

                            $history = [
                                [
                                    'user_gize_package_id' => $last_inserted_id,
                                    'unit_value_used' => 1,
                                    'model_id' => $channelvideo_id,
                                ]
                            ];

                            foreach ($history as $h) {
                                // dd($h);
                                UserGizePackageHistory::create($h);
                            }

                        }

                    }
                    return response()->json(['success' => "Rental is set."]);

                }


            }


        } catch (Exception $e) {}
        return response()->json(['fail' => "Rental is not set."]);
    }

    public function getUserPackages($user_id){

        $user_gize_packages = UserGizePackage::where('user_id', $user_id)->get();

        $now = \Carbon\Carbon::now();


        $available_packages = collect([]);

        //filter active , not-expired
        foreach($user_gize_packages as $package){

            $gize_package = GizePackage::find($package->gize_package_id);
            if($gize_package !=null){
    		  	$package_months = $gize_package->value('months');
                $months = $package_months;
                $start_date = $package->start_date;
                $package->expires_at = Date::createFromFormat('Y-m-d H:i:s', $package->start_date)->addMonths($months)->addDays($package->extended_days)->setTimezone(\Config::get('app.timezone'))->diffForHumans();

                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->addMonths($months)->addDays($package->extended_days);

                $check = $now->between($start_date, $end_date);

                if ($check) {
                    $package->status = 1; //active
                }
                else {
                    $package->status = 0; //expired
                }

                if($package->gize_package->active && $package->status){
                    $available_packages = $available_packages->add($package);
                }
            }
        }

        return $available_packages;
    }
}
