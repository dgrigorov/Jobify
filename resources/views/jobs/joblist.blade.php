<ul class="list-group job-list row">
    @foreach ($jobsByCategory as $category => $jobs)
    <h3 class="category">{{ $category }}</h3>
    @foreach ($jobs as $job)
    <li class="list-group-item row job-item col-lg-12" data-jobid="{{ $job->id }}">
        <div class="col-lg-12">
            <h2 class="fll">{{ $job->title }} <small>{{ $job->company->name }}</small></h2> 
            <span class="pull-right">
                <a class="btn btn-primary" href="{{ url("/jobs/$job->id") }}">
                    @if ($account == null or $account->isUser()) Apply
                    @elseif ($account->isCompany()) Show
                    @elseif ($account->isAdministrator()) Edit
                    @endif
                </a>
            </span>
        </div>
        <div class="col-lg-12">
            {{ $job->description }}
        </div>
    </li>
    @endforeach
    @endforeach
</ul>