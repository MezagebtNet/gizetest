<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use SPatie\Permission\Models\Role;
use SPatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

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


return redirect()->route('admin.manage.users.index');


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


return redirect()->route('admin.manage.users.index');


    }

    public function destroy(User $user)
    {
abort_if(Gate::denies('system_user'), Response::HTTP_FORBIDDEN, 'Forbidden');


        $user->delete();

return redirect()->route('admin.manage.users.index');


    }
}
