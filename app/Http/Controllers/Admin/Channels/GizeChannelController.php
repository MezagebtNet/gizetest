<?php

namespace App\Http\Controllers\Admin\Channels;

use App\Http\Controllers\Controller;
use App\Models\GizeChannel;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        $gize_channels = GizeChannel::orderBy('id', 'ASC')->get();
        $users = User::all();
        // $books = Book::orderBy('id','DESC')->get();
        return view('admin.manage.gize_channels.index', compact('gize_channels', 'users'));
    }

    public function addGizeChannel(Request $request)
    {
        $gize_channel = new GizeChannel();
        $gize_channel->name = $request->name;
        $gize_channel->description = $request->description;
        $gize_channel->slug = $request->slug;
        $validated = $request->validate([
            'name' => 'required|unique:gize_channels,name|max:255',
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
        $gize_channel->description = $request->description;
        $gize_channel->slug = $request->slug;

        $validated = $request->validate([
            'name' => 'required|max:255|unique:gize_channels,name,' . $request->id . ',id',
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

}
