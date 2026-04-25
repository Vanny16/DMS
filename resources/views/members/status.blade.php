@extends('templates.frontend.layouts.main')
@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('frontend/images/bg_1.jpg') }}')">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Register</h2>
                    <p>All registration for membership will undergo screening process.</p>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ action('MainController@home') }}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Member Registration</span>
        </div>
    </div>

    @if(session('successMessage'))
    <div class="site-section">
        <div class="container">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-check"></i> Alert!</h5>
                {!! session('successMessage') !!}
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <h2><strong>Awaiting Approval</strong></h2>
            <p>You membership registration has been submitted pending approval. Please take note of your membership code [<span style="color:red;">{{ session('mem_code') }}</span>].</p>
            <div class="row">
                <div class="col-md-12 mx-0">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"><small>Register</small></span></div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><small>Approval</small></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-tasks"></i> </span> <span class="text"><small>Nominate</small></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-star-half-full"></i> </span> <span class="text"><small>Vote</small></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-line-chart"></i> </span> <span class="text"><small>Results</small></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <button type="button" class="btn btn-primary btn-lg px-5" data-toggle="modal" data-target="#loginModal">Login to continue</button>
            </div>
        </div>
    </div>
@endsection