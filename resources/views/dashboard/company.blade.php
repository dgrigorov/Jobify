@extends('layouts.app')

@section('content')
<section class="header_yellow">
    <div class="container">
        <span class="section-heading">{{ $company->name }}'s Jobs</span>
    </div>
</section>
<div class="container">

    <h3>Add New Job</h3>
    
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/jobs') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
            <label for="category" class="col-md-4 control-label">Category</label>

            <div class="col-md-6">
                <select name="category" class="selectpicker" data-live-search="true">
                    @foreach ($categoriesById as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category') ? 'selected' : '' }} >{{ $category->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('category'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-md-4 control-label">Description</label>
            <div class="col-md-6">
                <textarea name="description" class="form-control" rows="5" required autofocus>{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button class="btn btn-primary" type="submit">Add Job</button>
            </div>
        </div>

    </form>

    <hr></hr>

    <ul class="list-group">
        @foreach ($jobs as $job)
        <li class="list-group-item">
            <div class="col-lg-12">
                <h3 class="col-lg-8">{{ $job->title }}</h3>
                <span class="pull-right btn btn-primary"><b>{{ $categoriesById[$job->category_id]->name }}</b></span>
            </div>
            <div style="padding: 15px;">
                {{ $job->description }}
            </div>
            @if (count($job->applications) > 0)
            <div style="padding-top: 15px;">
                <b>Applications</b>
                <ul class="list-group">
                    @foreach ($job->applications as $application)
                    <li class="list-group-item job-app">
                        {{ $application->user->first_name }} {{ $application->user->last_name }} on {{ $application->created_at }}
                        @foreach ($application->fileNames() as $fileName)
                        <a claass="btn btn-primary" href="{{ url($application->downloadUrl($fileName)) }}">{{ $fileName }}</a>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </li>
        @endforeach
    </ul>

</div>
@endsection


