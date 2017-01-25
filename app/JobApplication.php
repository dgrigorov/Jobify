<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class JobApplication extends Model
{
    public $table = 'jobapplications';

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fileNames()
    {
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $storagePath = $storagePath . DIRECTORY_SEPARATOR . strval($this->id);
        return array_diff(scandir($storagePath), array('.', '..'));
    }

    public function downloadUrl($fileName)
    {
        return '/download/' . strval($this->id) . '/' . $fileName;
    }
}
