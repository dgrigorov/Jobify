<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountRoles;
use App\Company;
use App\User;
use App\Job;
use App\JobCategory;
use App\JobApplication;
use Mail;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class JobController extends Controller
{
    public function index()
    {
        $account = Auth::user();

        $jobsByCategory = $this->getJobsByCategory($account);
        
        $model = [
            'account' => $account,
            'jobsByCategory' => $jobsByCategory,
        ];

        return view('jobs.jobs', $model);
    }

    public function search(Request $request)
    {
        $account = Auth::user();

        $jobsByCategory = $this->getJobsByCategory($account, $request->searchText);

        $model = [
            'account' => $account,
            'jobsByCategory' => $jobsByCategory,
        ];

        return view('jobs.joblist', $model);
    }

    public function show(Job $job)
    {
        $account = Auth::user();

        $model = [
            'account' => $account,
            'job' => $job,
        ];
        
        switch ($account->role) {
            case AccountRoles::Administrator:
            {
                $model['categories'] = JobCategory::all();
                return view('jobs.edit', $model);
            }
            case AccountRoles::User:
            {
                $user = User::where('account_id', $account->id)->first();
                
                $model['readonly'] = JobApplication::where('user_id', $user->id)
                    ->where('job_id', $job->id)
                    ->exists();

                return view('jobs.apply', $model);
            }
            case AccountRoles::Company:
            {
                return view('jobs.show', $model);
            }
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);

        $job = new Job($request->all());

        $job->category_id = intval($request->category);

        $company = Company::where('account_id', Auth::user()->id)->first();

        $company->addJob($job);
        
        return back();
    }

    public function createCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:jobcategories|max:100',
        ]);

        $category = new JobCategory($request->all());
        $category->save();

        return back();
    }

    public function edit(Request $request, Job $job)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);

        $job->update($request->all());
        $job->category_id = intval($request->category);
        $job->save();

        return back();
    }

    public function publish(Job $job)
    {
        if (isset($job) && !$job->published) {
            $job->published = true;
            $job->save();
        }
    }

    public function delete(Job $job)
    {
        if (isset($job)) {
            $job->delete();
        }
    }

    public function apply(Job $job, Request $request)
    {
        // Create application
        $user = User::where('account_id', Auth::user()->id)->first();
        $application = new JobApplication();
        $application->user_id = $user->id;
        $job->addApplication($application);

        // Save uploaded files
        $files = $request->file('file');
        if (!empty($files)) {
            $diskStorage = Storage::disk('local');
            foreach ($files as $file) {
                $diskStorage->put($application->id . '/' . $file->getClientOriginalName(), file_get_contents($file));
            }
        }

        // Send emails
        $administratorAccount = Account::where('role', AccountRoles::Administrator)->first();

        $companyAccount = Account::where('id', $job->company->account_id)->first();

        $mailModel = [
            'user' => $user,
            'job' => $job,
        ];

        Mail::send('emails.administrator_notify', $mailModel, function ($mail) use ($administratorAccount) {
            $mailFrom = config('mail.from');
            $mail->from($mailFrom['address'], $mailFrom['name']);
            $mail->to($administratorAccount->email)->subject('New Job Application');
        });

        Mail::send('emails.company_notify', $mailModel, function ($mail) use ($job, $companyAccount, $application, $files) {
            $mailFrom = config('mail.from');
            $mail->from($mailFrom['address'], $mailFrom['name']);
            $mail->to($companyAccount->email)->subject('New Job Application');
            $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

            foreach ($files as $file) {
                $filePath = $storagePath . DIRECTORY_SEPARATOR . strval($application->id) . DIRECTORY_SEPARATOR . $file->getClientOriginalName();
                $mail->attach($filePath);
            }
        });

        return redirect('/dashboard');
    }

    private function getJobs(Account $account = null, string $searchText = null)
    {
        $query = Job::with(['company' => function ($query) {
            $query->select('name', 'id');
        }])->with(['category' => function ($query) {
            $query->select('name', 'id')->orderBy('name');
        }])->select('id', 'title', 'description', 'published', 'company_id', 'category_id', 'created_at')
            ->orderBy('created_at', 'desc');

        if (!isset($account) || !$account->isAdministrator()) {
             $query->where('published', true);
        }

        if (!empty($searchText)) {
            $searchClauses = preg_split('/\s+/', trim($searchText));
            if (!empty($searchClauses)) {
                $query->where(function ($query) use ($searchClauses) {
                    foreach ($searchClauses as $searchClause) {
                        $query->where('title', 'like', "%$searchClause%");
                        $query->orWhere('description', 'like', "%$searchClause%");
                    }
                });
            }
        }

        return $query->get();
    }

    private function getJobsByCategory(Account $account = null, string $searchText = null)
    {
        $allJobs = $this->getJobs($account, $searchText);

        $jobsByCategory = [];

        foreach ($allJobs as $job) {
            $categoryName = $job->category->name;
            if (!isset($jobsByCategory[$categoryName])) {
                $jobsByCategory[$categoryName] = [];
            }

            array_push($jobsByCategory[$categoryName], $job);
        }

        return $jobsByCategory;
    }
}
