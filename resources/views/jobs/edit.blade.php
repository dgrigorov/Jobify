@extends('layouts.app')

@section('content')
<section class="header_yellow">
    <div class="container">
        <span class="section-heading">Job: <span class="job-title">{{ $job->title }}</span></span>
    </div>
</section>
<div class="row">
    <form class="form-horizontal job-form" data-jobid="{{ $job->id }}" role="form" method="POST" action="{{ url("/jobs/$job->id") }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
            <label for="category" class="col-md-4 control-label">Category</label>

            <div class="col-md-6">
                <select name="category" class="selectpicker" data-live-search="true">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $job->category_id ? 'selected' : '' }} >{{ $category->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('category'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-md-4 control-label">Description</label>
            <div class="col-md-6">
                <textarea name="description" class="form-control" rows="5" required autofocus>{{ $job->description }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                @if (!$job->published)
                <a class="btn btn-success job-publish" href="#">Publish</a>
                @endif
                <a class="btn btn-danger job-delete" href="#">Delete</a>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection