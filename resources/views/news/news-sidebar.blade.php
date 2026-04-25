<div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">

    <div class="sidebar sidebar-right">
        <div class="widget recent-posts mb-4">
            <h3 class="widget-title">Recent News</h3>
            <ul class="list-unstyled">
                @foreach($recent_news as $article)
                    <li class="d-flex align-items-start mb-3">
                        <div class="posts-thumb me-3 flex-shrink-0" style="max-width: 80px;">
                            <a href="{{ action('NewsController@article',[$article->news_id]) }}">
                                @if($article->news_image)
                                    <img loading="lazy" alt="{{ $article->news_title }}" src="{{ asset('images/news/' . $article->news_image) }}" class="img-fluid rounded">
                                @else
                                    <img loading="lazy" alt="{{ $article->news_title }}" src="{{ asset('images/news/default.jpg') }}" class="img-fluid rounded">
                                @endif
                            </a>
                        </div>
                        <div class="post-info">
                            <h6 class="entry-title mb-1">
                                <a href="{{ action('NewsController@article',[$article->news_id]) }}" class="text-dark text-decoration-none">{{ $article->news_title }}</a>
                            </h6>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget">
            <h3 class="widget-title">News Archives</h3>
            <ul class="nav flex-column">
                @foreach($years as $year)
                    <li class="nav-item">
                        <a class="nav-link p-0 fw-bold" data-bs-toggle="collapse" href="#collapse-{{$year->year}}" role="button" aria-expanded="false" aria-controls="collapse-{{$year->year}}">
                            {{ $year->year }}
                        </a>
                        <div class="collapse" id="collapse-{{$year->year}}">
                            @foreach($months as $month)
                                @if($month->year == $year->year)
                                    <ul class="list-unstyled ms-3">
                                        <li>
                                            <a class="text-maroon d-flex align-items-center gap-1" href="{{ action('NewsController@archive',[$month->year,$month->month]) }}">
                                                <span class="fa fa-bookmark"></span>
                                                {{ $month->monthname }}
                                                <span class="badge bg-warning text-dark ms-auto">{{ $month->data }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
