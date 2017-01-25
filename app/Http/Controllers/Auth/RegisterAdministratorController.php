<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\AccountRoles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterAdministratorController extends RegisterController
{
    public function showRegistrationForm()
    {
        return view('auth.register.administrator');
    }

    protected function getRole()
    {
        return AccountRoles::Administrator;
    }
}
