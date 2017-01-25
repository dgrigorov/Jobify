<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use App\Company;
use App\Job;
use App\JobCategory;
use App\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;

class DownloadController extends Controller
{
    public function applicationFile($applicationId, $fileName)
    {
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $storagePath = $storagePath . DIRECTORY_SEPARATOR . strval($applicationId) . DIRECTORY_SEPARATOR . $fileName;
        return response()->download($storagePath, $fileName);
    }
}
