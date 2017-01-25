@extends('layouts.app')

@section('content')
<section class="header_yellow">
    <div class="container">
        <span class="section-heading">Job: <span class="job-title">{{ $job->title }}</span></span>
    </div>
</section>
<div class="row">
    <div class="form-group">
        <label class="col-md-4 control-label">Category</label>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{ $job->category->name }}" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Created On</label>
        <div class="col-md-6">
            <input type="text" class="form-control" value="{{ $job->created_at }}" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Description</label>
        <div class="col-md-6">
            <textarea class="form-control" rows="5" readonly>{{ $job->description }}</textarea>
        </div>
    </div>
</div>
@endsection