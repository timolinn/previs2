<?php

namespace Previs\Http\Controllers;


use Previs\Models\Auth;
use Previs\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('users.index');
    }
}