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
                                    <li class="breadcrumb-item"><a href="{{ action('MainController@home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ action('NewsController@home') }}">News</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Recent News</li>
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
                                    <input type="text" name="keyword" id="news-search" class="form-control form-control-lg" placeholder="Enter keyword(s) and hit enter" autocomplete="off">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('typ_id') == '2' OR session('typ_id') == '3')
                <div class="row mb-3">
                    <div class="col-lg-12 mb-5 mb-lg-0">
                        <a class="btn btn-primary" href="{{ action('NewsController@new') }}"><span class="fa fa-plus-circle"></span> Create New</a>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    @foreach($news as $news_article)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="post-content post-single">
                                    <div class="post-media post-image">
                                        <a href="{{ action('NewsController@article',[$news_article->news_id]) }}">
                                            @if($news_article->news_image <> '')
                                                <img loading="lazy" src="{{ asset('images/news/' . $news_article->news_image) }}" class="img-fluid" alt="{{ $news_article->news_title }}">
                                            @else
                                                <img loading="lazy" src="{{ asset('images/news/default.jpg') }}" class="img-fluid" alt="{{ $news_article->news_title }}">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="post-body">
                                        <div class="entry-header">
                                            <div class="post-meta">
                                                <span class="post-author">
                                                    <i class="far fa-user"></i><a href="#"> {{ getUserName($news_article->news_created_by) }}</a>
                                                </span>
                                                <span class="post-cat">
                                                    <i class="far fa-folder-open"></i><a href="{{ action('NewsController@home') }}"> News</a>
                                                </span>
                                                <span class="post-meta-date"><i class="far fa-calendar"></i> {{ $news_article->news_date }}</span>
                                            </div>
                                            <h2 class="entry-title">
                                                <a href="{{ action('NewsController@article',[$news_article->news_id]) }}">{{ $news_article->news_title }}</a>
                                            </h2>
                                        </div>
                                        <div class="post-footer">
                                            <a href="{{ action('NewsController@article',[$news_article->news_id]) }}" class="btn btn-primary">Continue Reading</a>
                                        </div>
                                    </div>
                                </div>
                                @if(session('usr_mod1') == '1')
                                    <a class="btn btn-danger btn-sm" href="{{ action('NewsController@delete',[$news_article->news_id]) }}"><span class="fa fa-trash"></span> Delete</a>
                                    <a class="btn btn-info btn-sm" href="{{ action('NewsController@edit',[$news_article->news_id]) }}"><span class="fa fa-edit"></span> Edit</a>
                                    @if($news_article->news_active=='1')
                                        <a class="btn btn-info btn-sm" href="{{ action('NewsController@moveArchive',[$news_article->news_id]) }}"><span class="fa fa-history"></span> Move to archive</a>
                                    @elseif($news_article->news_active=='2')
                                        <a class="btn btn-info btn-sm" href="{{ action('NewsController@activate',[$news_article->news_id]) }}"><span class="fa fa-history"></span> Move to active</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @include('news.news-sidebar')
            </div>
        </div>
    </div>
</div>

@endsection
