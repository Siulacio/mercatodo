<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index() : View
    {
        return view('admin.template');
    }

    public function usersList() : View
    {
        $users = User::get();
        return view('admin.user', compact('users'));
    }

    public function productsList() : View
    {
        return view('admin.product');
    }

    public function reports() : View
    {
        return view('admin.reports');
    }
}
