@extends('layouts.app')

@section('content')
<section class="header_yellow">
    <div class="container">
        <span class="section-heading">Job Categories</span>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item">{{ $category->name }}</li>
                @endforeach
            </ul>
            
            <hr></hr>
            
            <h3>Add New Category</h3>
            
            <form method="POST" action="{{ url('/jobs/categories') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="name" class="form-control" rows="5" value="{{ old('name') }}" required autofocus></input>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection