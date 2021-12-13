<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index() : View
    {
        $users = User::get();
        return view('admin.menu', compact('users'));
    }
}
