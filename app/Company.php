<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'account_id', 'name', 'description', 'address', 'webaddress'
    ];

    public function jobs()
    {
    	return $this->hasMany(Job::class);
    }

    public function addJob(Job $job)
    {
    	return $this->jobs()->save($job);
    }
}
