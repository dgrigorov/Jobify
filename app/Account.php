<?php

namespace App;

use App\AccountRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdministrator()
    {
        return $this->role === AccountRoles::Administrator;
    }

    public function isCompany()
    {
        return $this->role === AccountRoles::Company;
    }

    public function isUser()
    {
        return $this->role === AccountRoles::User;
    }
}
