<?php

namespace App\Http\Controllers;


use App\Models\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        if (!Auth::check()) {
            return redirect('auth/login');
        }
    }

    public function index()
    {
        $users = User::all();

        return renderView('users.index');
    }
}