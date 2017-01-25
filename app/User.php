<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'account_id', 'first_name', 'last_name'
    ];

    public function applications()
    {
    	return $this->hasMany(JobApplication::class);
    }

    public function addApplication(JobApplication $application)
    {
    	return $this->applications()->save($application);
    }
}
