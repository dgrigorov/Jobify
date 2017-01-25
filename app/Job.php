<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'company_id', 'title', 'description', 'published'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function applications()
    {
    	return $this->hasMany(JobApplication::class);
    }

    public function addApplication(JobApplication $application)
    {
    	return $this->applications()->save($application);
    }
}
