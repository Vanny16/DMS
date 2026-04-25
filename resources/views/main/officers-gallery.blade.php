<section id="project-area" class="project-area solid-bg">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <a href="{{ action('MainController@officersPage') }}"><h2 class="section-title">NEWLY ELECTED OFFICERS</h2>
                {{-- <h3 class="section-sub-title">PIEP Davao Board of Trustees and Officers for CY 2024-2025</h3></a> --}}
                <h3 class="section-sub-title">Congratulations to the newly elected PIEP Davao Board of Trustees and Officers for CY 2024-2025</h3></a>
            </div>
            <div class="row justify-content-center">
                <div class="gallery-item">
                    <a href="{{ action('MainController@officersPage') }}">
                        <img src="{{ asset('images/offcrs-2024.png') }}" id="myImage" alt="Officers 2024-2025" class="img-fluid gallery-image" >
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myImage = document.getElementById('myImage');
        var tooltip = new bootstrap.Tooltip(myImage, {
            title: 'Click to visit Officers page',
            placement: 'top'
        });
    });
</script>