@extends('layouts.app')

@section('content')
<section class="header_yellow">
    <div class="container">
        <span class="section-heading">Apply for: <span class="job-title">{{ $job->title }}</span></span>
    </div>
</section>
<div class="container">
    <div class="row">
        <form class="form-horizontal job-form" data-jobid="{{ $job->id }}" role="form" method="POST" enctype="multipart/form-data" action="{{ url("/jobs/$job->id/apply") }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="col-md-4 control-label">Category:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $job->category->name }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Created On:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $job->created_at }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Description:</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5" readonly>{{ $job->description }}</textarea>
                </div>
            </div>

            @if (!$readonly)
            <div class="form-group">
                <label class="col-md-4 control-label">Upload CV:</label>
                <div class="col-md-6">
                    <input type="file" name="file[]" multiple>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button class="btn btn-primary" type="submit">Apply</button>
                </div>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection