@extends('layouts.app')

@section('content')
<header>
    <div class="container">
        <div class="intro-text col-lg-12">
            <div class="intro-heading text-left">Over <span class="h1">100,000 <sup>+</sup></span> jobs are waiting for you</div>
            <form action="" class="form-inline col-lg-12 col-xs-12 col-md-12 col-sm-12">
                <div class="form-group col-lg-9 col-xs-12 col-sm-12 pl-0">
                    <input type="text" class="form-control input-lg" required="" name="keywords" placeholder="job title / keywords / company name" autofocus="">
                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                </div>
                <div class="form-group col-lg-3 col-xs-12 col-sm-12 pl-0">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Search">
                </div>
            </form>
        </div>
        <div class="popular-keywords col-lg-12 col-xs-12 col-md-12 col-sm-12">
            <small>Popular keywords:</small>
            <small class="tag">web design</small>
            <small class="tag">car dealer</small>
            <small class="tag">accountant</small>
        </div>
    </div>
</header>
<section class="header_yellow">
    <div class="container">
        <span class="section-heading">Jobs</span>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="input-group">
        <input type="text" class="form-control input-lg job-search-input" placeholder="Search for...">
        <span class="input-group-btn">
            <button class="btn btn-default btn-lg job-search" type="button">Search</button>
        </span>
        </div>
    </div>

    @include('jobs.joblist', [
        'account' => $account,
        'jobsByCategory' => $jobsByCategory,
    ]);
</div>
<section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-heading">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-xs-6">
                    <div class="team-member">
                        <img src="imgs/team/1.jpg" class="img-responsive img-circle col-xs-6" alt="" width="225px">
                        <h4>Nicky Andreev</h4>
                        <p class="text-muted">PHP Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-github"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div class="team-member">
                        <img src="imgs/team/2.jpg" class="img-responsive img-circle col-xs-6" alt="Daniel Grigorov Photo" width="225px">
                        <h4>Daniel Grigorov</h4>
                        <p class="text-muted">Front-End Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-github"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <div class="team-member">
                        <img src="imgs/team/3.jpg" class="img-responsive img-circle col-xs-6" alt="Kristiyan Kradjov Photo" width="225px">
                        <h4>Kristiyan Karadjov</h4>
                        <p class="text-muted">WIKI Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-github"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection