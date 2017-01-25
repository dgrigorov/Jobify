<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    public $table = 'jobcategories';

    protected $fillable = [
        'name'
    ];

    public function jobs()
    {
    	return $this->hasMany(Job::class);
    }
}
