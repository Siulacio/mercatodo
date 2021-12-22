<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{

    public function index() : Collection
    {
        return User::get();
    }

    public function store(UserStoreRequest $request) : void
    {
        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->identification = $request->identification;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->state = $request->state;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function show(User $user) : User
    {
        return $user;
    }

    public function update(Request $request, User $user) : void
    {
        $user->update($request->all());
    }

    public function changeState(int $id) : void
    {
        $user = User::find($id);
        $user->state = !$user->state;
        $user->save();
    }
}
