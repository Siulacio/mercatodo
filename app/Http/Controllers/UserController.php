<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function edit(int $id) : View
    {
        $user = User::find($id);
        return view('Users.edit_user', compact('user'));
    }

    public function update(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();

        return redirect()->route('admin.index')->with('message', 'User updated success');
    }

}
