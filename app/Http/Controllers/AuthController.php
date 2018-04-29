<?php

namespace Previs\Http\Controllers;


use PDC\Request;
use Previs\Repositories\UserRepository as UserRepo;
use Previs\Services\Notifier;
use Previs\Services\Session;
use Previs\Models\Auth;

class AuthController extends Controller
{
    protected $userepo;

    public function __construct(UserRepo $userepo)
    {
        $this->userepo = $userepo;
    }

    public function getLoginForm()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function getRegisterForm()
    {

        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('auth.register');
    }

    public function postRegister(Request $pdcRequest)
    {
        $user = $this->userepo->create($pdcRequest->request->all());

        if (!empty($user->toArray()) && $user->get('id')) {
            $res = Notifier::welcome($user);
            Session::success("Your Registration was successful we sent you an email.");
            return redirect('auth/login');
        }
        Session::error($user->get('error'));
        return redirect('auth/register');
    }

    public function postLogin(Request $pdcRequest)
    {
        $login = $this->userepo->loginUser($pdcRequest->request->all());

        if (array_key_exists('error', $login->toArray())) {
                Session::error($login->get('error'));
                return redirect('auth/login');
        }
        return redirect('dashboard');

    }

    public function logout()
    {
        $auth = app('authfactory')->newInstance();
        $logoutServive = app('logoutservice');

        $logoutServive->logout($auth);

        Session::clear();
        if ($auth->isAnon()) {

            return redirect('auth/login');
        } else {
            return redirect('dashboard');
        }
    }
}