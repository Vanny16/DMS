@extends('templates.frontend.layouts.main')
@section('content')
<div id="banner-area" class="banner-area" style="background-image:url( {{ asset('images/banner/banner1.jpg') }})">
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">News</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a
                                        href="{{ action('MainController@home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ action('NewsController@home') }}">News</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create New</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="main-container" class="main-container">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="ts-newsletter row align-items-center">
                    <div class="col-md-5 newsletter-introtext">
                        <p class="text-white">Search our news articles for specific topic or content</p>
                    </div>
                    <div class="col-md-7 newsletter-form">
                        <form action="{{ action('NewsController@search') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="news-search" class="content-hidden">Search News</label>
                                <input type="text" name="keyword" id="news-search" class="form-control form-control-lg"
                                    placeholder="Enter keyword(s) and hit enter" autocomplete="off">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ action('NewsController@save') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="news_date">Date</label>
                                <input class="form-control" type="date" id="news_date" name="news_date" required/>
                            </div>
                            <div class="form-group">
                                <label for="news_title">Title</label>
                                <input class="form-control" type="text" id="news_title" name="news_title" placeholder="News Caption" required/>
                            </div>
                            <div class="form-group">
                                <label for="news_content">Content</label>
                                <textarea id="summernote" name="news_content" required></textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="image">Attach Image</label>
                                    <input type="file" class="btn btn-default btn-file" id="image" name="image" value="Attach Photo" aria-describedby="inputGroupFileAddon01" required/>  
                                    <small id="fileHelp" class="form-text text-muted">Allowed file: jpg or png</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Publish</button>
                                <a class="btn btn-primary" style="background-color:gray;" href="{{ action('NewsController@home') }}"><span class="fa fa-arrow-left"></span> Back to News</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('news.news-sidebar')
        </div>
    </div>
</section>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function($) {
        $("#summernote").summernote({
            height: 500,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                ['insert', ['link', 'picture',]],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ],
            ],
        });
    })
</script>
@endsection