<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Account;
use App\AccountRoles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterCompanyController extends RegisterController
{
    public function showRegistrationForm()
    {
        return view('auth.register.company');
    }

    protected function create(array $data)
    {
        DB::transaction(function () use (&$data, &$account) {
            $account = parent::create($data);

            Company::create([
                'account_id' => $account->id,
                'name' => $data['name'],
                'description' => $data['description'],
                'address' => $data['address'],
                'webaddress' => $data['webaddress'],
            ]);
        });

        return $account;
    }

    protected function getRole()
    {
        return AccountRoles::Company;
    }

    protected function getValidations()
    {
        return [
            'name' => 'required|max:100|unique:companies',
            'description' => 'required',
            'address' => 'max:255',
            'webaddress' => 'max:255',
        ];
    }
}
