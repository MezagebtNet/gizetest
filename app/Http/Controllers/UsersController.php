<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use SPatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;


class UsersController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $users = User::with('roles')->get();

        return view('admin.manage.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::get();

        return view('admin.manage.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        // $user->roles()->sync($request->input('roles', []));

        $user->syncRoles($request->input('roles', []));

        //Notify Super Admins of this event...
        $super_admins = User::role('super-admin')->get();

        // Notification::send($super_admins, new NewUserNotification($event->user));
        // event(new UserCreated($user));

        return redirect()->route('admin.manage.user.index');

    }

    public function show(User $user)
    {
        abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.manage.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::get();

        $user->load('roles');

        return view('admin.manage.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // if($request->input('password')!=''){
        //     $user->password = bcrypt($request->input('password'));
        // }
        $user->update($request->validated());
        // $user->roles()->sync($request->input('roles', []));
        $user->syncRoles($request->input('roles', []));

        return redirect()->route('admin.manage.user.index');

    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();

        return redirect()->route('admin.manage.user.index');

    }

    public function renderedNotificationDropdownData($dropdown_state=false)
    {
        // abort_if(\Auth::user()->id == null, Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = \Auth::user();

        return $user->renderedNotificationDropdownData($dropdown_state);

    }

    public function markAllNotificationAsRead($dropdown_state = false){
        // abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = \Auth::user();

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        // return $user->renderedNotificationDropdownData($dropdown_state);
        return 'success';
    }

    public function markNotificationAsRead($notification_id, $dropdown_state = false){

        // abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');


        $user = \Auth::user();
        // return $user;

        foreach ($user->unreadNotifications as $notification) {
            if($notification_id == $notification->id){
                $notification->markAsRead();
                // return $user->renderedNotificationDropdownData($dropdown_state);

                break;
            }
        }
        return 'success';


    }




}
