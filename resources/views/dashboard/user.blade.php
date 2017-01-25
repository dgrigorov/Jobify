@extends('layouts.app')

@section('content')
<section class="header_yellow">
    <div class="container">
        <span class="section-heading">{{ $user->first_name }}'s Job Applications</span>
    </div>
</section>

<div class="container">
    <ul class="list-group">
        @foreach ($applicationsByCategory as $category => $applications)
        <h4>{{ $category }}</h4>
        @foreach ($applications as $application)
        <li class="list-group-item">
            <div>
                <b>{{ $application->job->title }} ({{ $application->job->company->name }})</b>
                <span class="pull-right">Applied on <b>{{ $application->created_at }}</b></span>
            </div>
            <div style="padding-top: 15px;">
                {{ $application->job->description }}
            </div>
        </li>
        @endforeach
        @endforeach
    </ul>
</div>


@endsection


