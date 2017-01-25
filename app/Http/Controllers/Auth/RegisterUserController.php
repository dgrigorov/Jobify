<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Account;
use App\AccountRoles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterUserController extends RegisterController
{
    protected $redirectTo = '/';

    public function showRegistrationForm()
    {
        return view('auth.register.user');
    }

    protected function create(array $data)
    {
        DB::transaction(function () use (&$data, &$account) {
            $account = parent::create($data);

            User::create([
                'account_id' => $account->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
            ]);
        }, 5);
  

        return $account;
    }

    protected function getRole()
    {
        return AccountRoles::User;
    }

    protected function getValidations()
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
        ];
    }
}
