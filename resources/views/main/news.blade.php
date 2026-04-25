<section class="subscribe no-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="subscribe-call-to-action">
                    <h3 class="text-white">Search our news</h3>
                    <h4>archives</h4>
                </div>
            </div>

            <div class="col-lg-8 col-sm-12">
                    <div class="col-md-7 newsletter-introtext">
                        <!-- <h4 class="text-white mb-0">Search News Articles</h4> -->
                        <p class="text-white mt-2 ml-1">Search news articles for specific topic or content</p>
                    </div>
                    <div class="col-md-7 newsletter-form">
                        <form action="#" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="news-search" class="content-hidden">Search News</label>
                                <input type="text" name="keyword" id="news-search" class="form-control form-control-lg" placeholder="Enter keyword(s) and hit enter" autocomplete="off">
                            </div>
                        </form>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</section>

<section id="news" class="news">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-title">News and Events</h2>
                <h3 class="section-sub-title">Recent News</h3>
            </div>
        </div>

        <div class="row">
            @foreach($news as $news_article)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="latest-post">
                        <div class="latest-post-media">
                            <a href="" class="latest-post-img">
                              
                            </a>
                        </div>
                        <div class="post-body">
                          
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="general-btn text-center mt-4">
            <a class="btn btn-primary" href="{{ action('NewsController@home') }}">See All News</a>
        </div>
    </div>
</section>
