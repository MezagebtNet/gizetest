<?php

namespace App\Http\Controllers\Admin\Channels;

use App\Http\Requests\StoreGizeChannelRequest;
use App\Http\Requests\UpdateGizeChannelRequest;
use App\Http\Controllers\Controller;
use App\Models\GizeChannel;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class GizeChannelController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('system_gize_channels'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $gize_channels = GizeChannel::with('users')->orderBy('id', 'ASC')->get();

        return view('admin.manage.gize_channels.index', compact('gize_channels'));
    }

    public function addGizeChannel(Request $request)
    {
        $gize_channel = new GizeChannel();
        $gize_channel->name = $request->name;
        $gize_channel->producer = $request->producer;
        $gize_channel->description = $request->description;
        $gize_channel->slug = $request->slug;
        $validated = $request->validate([
            'name' => 'required|unique:gize_channels,name|max:255',
            'producer' => 'required|unique:gize_channels,name|max:255',
            'description' => 'required',
            'slug' => 'required|unique:gize_channels,slug|max:25',
        ]);

        $gize_channel->save();
        return response()->json($gize_channel);
    }

    public function updateGizeChannel(Request $request)
    {

        $gize_channel = GizeChannel::find($request->id);

        $gize_channel->name = $request->name;
        $gize_channel->producer = $request->producer;
        $gize_channel->description = $request->description;
        $gize_channel->slug = $request->slug;

        $validated = $request->validate([
            'name' => 'required|max:255|unique:gize_channels,name,' . $request->id . ',id',
            'producer' => 'required|max:255|unique:gize_channels,name,' . $request->id . ',id',
            'description' => 'required',
            'slug' => 'required|max:25|unique:gize_channels,slug,' . $request->id . ',id',
        ]);

        $gize_channel->save($validated);

        // $gize_channel->save();
        return response()->json($gize_channel);
    }

    public function getGizeChannelById($id)
    {
        $gize_channel = GizeChannel::find($id);
        return response()->json($gize_channel);
    }

    public function deleteGizeChannel(Request $request)
    {

        $gize_channel = GizeChannel::find($request->id);

        $gize_channel->delete();

        return response()->json(['success' => 'Recored has been deleted.'], 200);
    }

    public function deleteCheckedGizeChannels(Request $request)
    {
        $ids = $request->ids;

        try {

            foreach ($ids as $id) {
                $book = GizeChannel::find($id);

            }
            //delete all records of $ids..
            GizeChannel::whereIn('id', $ids)->delete();

        } catch (Exception $e) {}
        return response()->json(['success' => "Records have been deleted."], 200);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(GizeChannel::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }

    public function webGizeChannelList(){
        $gize_channels = GizeChannel::all();
//TODO:: Show only active ones.


        return view('website.home.');
    }

    public function create()
    {
        abort_if(Gate::denies('system_gize_channels'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channel_admins = User::role('channel-admin')->get();

        return view('admin.manage.gize_channels.create', compact('channel_admins'));
    }

    public function store(StoreGizeChannelRequest $request)
    {
        $gize_channel = GizeChannel::create($request->validated());
        // $user->roles()->sync($request->input('roles', []));
$users = $request->input('users', []);


$gize_channel->users()->syncWithoutDetaching($users);


        //Notify Super Admins of this event...
        // event(new UserCreated($user));


        return redirect()->route('admin.manage.gize_channels.index');

    }

    public function show(GizeChannel $gize_channel)
    {
        abort_if(Gate::denies('system_gize_channels'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.manage.gize_channels.show', compact('gize_channel'));
    }

    public function edit(GizeChannel $gize_channel)
    {
        abort_if(Gate::denies('system_gize_channels'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $channel_admins = User::role('channel-admin')->get();

        $gize_channel->load('users');

        return view('admin.manage.gize_channels.edit', compact('gize_channel', 'channel_admins'));
    }

    public function update(UpdateGizeChannelRequest $request, GizeChannel $gize_channel)
    {
        // if($request->input('password')!=''){
        //     $user->password = bcrypt($request->input('password'));
        // }
        $gize_channel->update($request->validated());
        // $user->roles()->sync($request->input('roles', []));
$gize_channel->users()->sync($request->input('users', []));


        return redirect()->route('admin.manage.gize_channel.index');

    }

    public function destroy(GizeChannel $gize_channel)
    {
        abort_if(Gate::denies('system_gize_channels'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $gize_channel->delete();

        return redirect()->route('admin.manage.gize_channel.index');

    }

}
