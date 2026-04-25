@extends('templates.frontend.layouts.main')
@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                </div>
            </div>
        </div>
    </div> 
    

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ action('MainController@home') }}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Invalid Credentials</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="alert alert-danger">
                                <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                                Invalid e-mail or member code! Only approved members can login and continue with the PIEP election process.
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection