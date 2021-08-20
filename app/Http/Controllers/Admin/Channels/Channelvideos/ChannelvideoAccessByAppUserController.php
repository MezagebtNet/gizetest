<?php

namespace App\Http\Controllers\Admin\Channels\Channelvideos;

use App\Http\Controllers\Controller;
use App\Models\Channelvideo;
use App\Models\ChannelvideoAccessByAppUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChannelvideoAccessByAppUserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $channelVideos = Channelvideo::all();
        $channelVideos = Channelvideo::orderBy('id', 'DESC')->get();
        return view('admin.channelvideoaccessbyappusers.index');

    }

    public function chk_exists($vid_id, $usr_id)
    {
        $count = ChannelvideoAccessByAppUser::all()->where('app_user_id', $usr_id)
            ->where('channel_video_id', $vid_id)->count();
        return $count;
    }

    public static function checkPermission($vid_id, $usr_id)
    {
        if (ChannelvideoAccessByAppUser::where('app_user_id', $usr_id)
            ->where('channel_video_id', $vid_id)
            ->where('revoked', 0)->count()) {
            return true;
        }

        return false;
    }

    public function allow_video_access(Request $request)
    {
        $vid_id = $request->vid_id;
        $usr_id = $request->usr_id;

        $lv_access = ChannelvideoAccessByAppUser::updateOrCreate(['channel_video_id' => $vid_id, 'app_user_id' => $usr_id], ['revoked' => 0]);

        return "access granted";
    }

    public function revoke_video_access(Request $request)
    {
        $vid_id = $request->vid_id;
        $usr_id = $request->usr_id;

        $lv_access = ChannelvideoAccessByAppUser::updateOrCreate(['channel_video_id' => $vid_id, 'app_user_id' => $usr_id], ['revoked' => 1]);
        return "access revoked";

    }

    public function video_access_list(Request $request)
    {
        // return 1;
        $vid_id = $request->vid_id;
        // $vid_id = 1;
        // return $vid_id;
        $users = array();
        // $lv_access = ChannelvideoAccessByAppUser::all()->where('channel_video_id', $vid_id);

        foreach (User::all() as $user) {
            $lv_status = 1; //default revoked
            $lv_access = ChannelvideoAccessByAppUser::where("channel_video_id", $vid_id)->where("app_user_id", $user->id)->first();
            if ($lv_access) {
                $lv_status = $lv_access->revoked;
            }
            $datetime = strtotime($user->created_at);
            $date = new Carbon('@' . $datetime);
            $formated_date = $date->format('Y-m-d h:i A');

            array_push($users,
                array(
                    "name" => $user->name,
                    "email" => $user->email,
                    "phone_number" => $user->student_phone_number,
                    "profile_photo" => $user->profile_photo_path ?
                    '<img class="img-circle elevation-2" src="/storage/' . $user->profile_photo_path . '" width="50" style="max-height: 50px; height:auto;"/>' :
                    '<img class="img-circle elevation-2" src="https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $user->name) . '&color=7F9CF5&background=EBF4FF" width="50" style="max-height: 50px; height:auto;"/>',
                    "user" => $user->profile_photo_path ?
                    '<div style="text-align:center;"><img class="img-circle elevation-2" src="/storage/' . $user->profile_photo_path . '" width="50" style="max-height: 50px; height:auto;"/></div><div style="text-align:center; width:100%">' . $user->name . "</div>" :
                    '<div style="text-align:center;"><img class="img-circle elevation-2" src="https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $user->name) . '&color=7F9CF5&background=EBF4FF" width="50" style="max-height: 50px; height:auto;"/></div><div style="text-align:center; width: 100%">' . $user->name . "</div>",
                    "created_at" => $formated_date,
                    "email" => $user->email,
                    "address" => '<div><strong>E: </strong>' . $user->email . '</div>' . '<div><strong>P: </strong>' . $user->student_phone_number . '</div>' . '<div><strong>A: </strong>' . $user->email . '</div>',
                    "status" => $lv_status ?
                    '<a lv_id = "' . $vid_id . '" lv_usr_id = "' . $user->id . '" href="#" class="btn_lv_permission_allow badge badge-secondary">Revoked</a>' :
                    '<a lv_id = "' . $vid_id . '" lv_usr_id = "' . $user->id . '" href="#" class="btn_lv_permission_revoke badge badge-success">Allowed</a>',
                )
            );

        }

        return response(['users' => $users], 201);

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
     * @param  \App\Models\ChannelvideoAccessByAppUser  $channelVideoAccessByAppUser
     * @return \Illuminate\Http\Response
     */
    public function show(ChannelvideoAccessByAppUser $channelVideoAccessByAppUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChannelvideoAccessByAppUser  $channelVideoAccessByAppUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ChannelvideoAccessByAppUser $channelVideoAccessByAppUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChannelvideoAccessByAppUser  $channelVideoAccessByAppUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChannelvideoAccessByAppUser $channelVideoAccessByAppUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChannelvideoAccessByAppUser  $channelVideoAccessByAppUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChannelvideoAccessByAppUser $channelVideoAccessByAppUser)
    {
        //
    }
}
