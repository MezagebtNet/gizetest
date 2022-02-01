<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Channelvideo;
use App\Models\GizePackage;
use App\Models\UserGizePackage;

class GizePackageController extends Controller
{
    public function index()
    {
        $users = User::all();
        // $user_gize_packages = collect([]);

        $gize_packages = GizePackage::where('active', 1)->get();


        //get user-gize-packages list...

        $all_gize_packages = UserGizePackage::all();
        $now = \Carbon\Carbon::now();

        $user_gize_packages = collect([]);

        foreach ($all_gize_packages as $package) {
            $start_date = Date::createFromFormat('Y-m-d H:i:s', $package->start_date)->setTimezone(\Config::get('app.timezone'))->format('M d, Y h:i A');
            $package->start_date_formatted = $start_date;
            $user = User::find($package->user_id);
            $price = ($user->currency_code == 'ETB') ? $package->gize_package->etb_amount : $package->gize_package->usd_amount;
            $price = $price . ' ' . $user->currency_code;
            $package->price = $price;

            $months = $package->months;
            $start_date = $package->start_date;

            $package->expires_at = Date::createFromFormat('Y-m-d H:i:s', $package->start_date)->addMonths($months)->setTimezone(\Config::get('app.timezone'))->diffForHumans();

            $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->addMonths($months);
            $check = $now->between($start_date, $end_date);

            if ($check) {
                $package->status = 1; //active
            }
            else {
                $package->status = 0; //expired
            }

            $user_gize_packages = $user_gize_packages->add($package);
        }

        foreach ($gize_packages as $package) {
            // dd($package->first());
            $package->text = '('.$package->code.')' . ' ' . $package->months . 'Month - '.  $package->etb_amount;
        }

        $gize_packages =  $gize_packages->toArray();


        return view('admin.gize_packages.index', compact('users', 'gize_packages', 'user_gize_packages'));


    }

    public function addPackage(Request $request)
    {
        $user = User::find($request->user_id);

        $gize_package_id = $request->gize_package_id;

        $published_at = $request->published_at;
        $gize_package = GizePackage::find($gize_package_id);

        $user->gize_packages()->attach($gize_package_id, [
            'unit_values_balance' => $gize_package->for_unit_values,
            'start_date' => $published_at,
        ]);

        //last inserted
        $last_inserted = UserGizePackage::all()->last();
        $price = ($user->currency_code == 'ETB') ? $last_inserted->gize_package->etb_amount : $last_inserted->gize_package->usd_amount;
        $price = $price . ' ' . $user->currency_code;
        $last_inserted->price = $price;

        $now = \Carbon\Carbon::now();


        $months = $last_inserted->months;
        $start_date = $last_inserted->start_date;

        $last_inserted->expires_at = Date::createFromFormat('Y-m-d H:i:s', $last_inserted->start_date)->addMonths($months)->setTimezone(\Config::get('app.timezone'))->diffForHumans();

        $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->addMonths($months);
        $check = $now->between($start_date, $end_date);

        if ($check) {
            $last_inserted->status = 1; //active
        }
        else {
            $last_inserted->status = 0; //expired
        }

        $start_date = Date::createFromFormat('Y-m-d H:i:s', $last_inserted->start_date)->setTimezone(\Config::get('app.timezone'))->format('M d, Y h:i A');
        $last_inserted->start_date_formatted = $start_date;


        return response()->json($last_inserted);
    }

}
