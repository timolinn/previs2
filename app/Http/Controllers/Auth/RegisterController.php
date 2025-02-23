<?php

namespace Previs\Http\Controllers\Auth;

use Previs\Models\User;
use Previs\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Previs\Services\Notifier;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|string|email|max:255|unique:users',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phonenumber' => 'required|string|min:9',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Previs\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['username'],
            'email' => $data['email'],
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'phone_number' => $data['phonenumber'],
            'role_id' => 3,
            'password' => Hash::make($data['password']),
        ]);
    }


    public function register(Request $request)
    {
        // dd("stopped");
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        Notifier::welcome($user);

        if ($request->checkout == true) {
            // dd($request->checkout);
            return redirect(route('review-order'));
        }

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());

    }
}
