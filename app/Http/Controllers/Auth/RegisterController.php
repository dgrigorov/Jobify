<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

abstract class RegisterController extends Controller
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
        $validations = [
            'email' => 'required|email|max:255|unique:accounts',
            'password' => 'required|min:6|confirmed',
        ];

        return Validator::make($data, array_merge($validations, $this->getValidations()));
    }

    /**
     * Create a new account instance after a valid registration.
     *
     * @param  array  $data
     * @return Acount
     */
    protected function create(array $data)
    {
        return Account::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $this->getRole(),
        ]);
    }

    abstract protected function getRole();

    protected function getValidations()
    {
        return [];
    }
}
