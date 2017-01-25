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

class DashboardController extends Controller
{
    public function administrator()
    {
        $categories = JobCategory::all();

        $model = [
            'categories' => $categories,
        ];

        return view('dashboard.administrator', $model);
    }

    public function company()
    {
        $categories = JobCategory::orderBy('name', 'asc')->get();

        $categoriesById = [];

        foreach ($categories as $category) {
            $categoriesById[$category->id] = $category;
        }
        
        $company = Company::where('account_id', Auth::user()->id)->first();

        $jobs = Job::where('company_id', $company->id)
            ->with(['applications' => function($query) {
                $query->with(['user']);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        $model = [
            'company' => $company,
            'categoriesById' => $categoriesById,
            'jobs' => $jobs,
        ];

        return view('dashboard.company', $model);
    }

    public function user()
    {
        $user = User::where('account_id', Auth::user()->id)->first();

        $allApplications = JobApplication::where('user_id', $user->id)
            ->with(['job' => function($query) {
                $query->with(['company', 'category']);
            }])
            ->get();

        $applicationsByCategory = [];

        foreach ($allApplications as $application) {
            $categoryName = $application->job->category->name;
            if (!isset($applicationsByCategory[$categoryName])) {
                $applicationsByCategory[$categoryName] = [];
            }

            array_push($applicationsByCategory[$categoryName], $application);
        }

        $model = [
            'user' => $user,
            'applicationsByCategory' => $applicationsByCategory,
        ];

        return view('dashboard.user', $model);
    }
}
