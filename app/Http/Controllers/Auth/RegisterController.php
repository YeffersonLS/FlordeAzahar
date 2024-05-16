<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/admin';

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
            'sys01name' => ['required', 'string', 'max:255'],
            'sys01lastname' => ['required', 'string', 'max:255'],
            'sys01email' => ['required', 'string', 'email', 'max:255', 'unique:sys01usuarios'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);

        return User::create([
            'sys01name' => $data['sys01name'],
            // 'sys01middlename' => $data['sys01middlename'],
            'sys01lastname' => $data['sys01lastname'],
            // 'sys01secondsurname' => $data['sys01secondsurname'],
            'sys01phonenumber' => $data['sys01phonenumber'],
            'sys01fullname' => $data['sys01name'].' '.$data['sys01lastname'],
            'sys01email' => $data['sys01email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
