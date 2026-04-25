{{-- @include('image-gallery.external-head') --}}
@include('image-gallery.external-styles')

<style>
    .cid-u2OeWQ0rWX {
        padding-top: 5rem;
        padding-bottom: 3rem;

        @media (max-width: 767px) {
            padding-bottom: 4rem;
        }

        background-image: url("{{ asset('gallery-external/images/photo-1472214103451-9374bd1c798e.jpeg') }}");
    }

    .font-bold-outline {
        color: rgb(255, 255, 255);
        /* Text color */
        text-shadow: -1px 1px 0 rgb(13, 61, 42);
        /* Outline effect */
    }
</style>

<section class="contacts02 map1 cid-u2OeWQ4xCF" id="contacts-2-u2OeWQ4xCF">
    <div class="container">
        <div class="row justify-content-center">
            <div class="map-wrapper col-md-12">
                <div class="google-map"><iframe frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCt1265A4qvZy9HKUeA8J15AOC4SrCyZe4&q=Davao+Region,+Philippines"
                        allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features032 cid-u2OeWQ0rWX mbr-parallax-background white" id="features-33-u2OeWQ0rWX2">
    <div class="container">
        {{-- <p class="font-arial">This text uses Arial font.</p>
        <p class="font-Moririse2">This text uses Arial font.</p>
        <p class="font-helvetica">This text uses Helvetica font.</p>
        <p class="font-times-new-roman">This text uses Times New Roman font.</p>
        <p class="font-georgia">This text uses Georgia font.</p>
        <p class="font-courier-new">This text uses Courier New font.</p>
        <p class="font-verdana">This text uses Verdana font.</p> --}}

        {{-- <h1 class="text-center mb-5 mt-n4 font-bold-outline font-Moririse2">BOARD OF TRUSTEES AND OFFICERS 2024
        </h1> --}}
        <div class="row justify-content-center mb-3">
            <div class="col-md-5">
                <h1 class="font-bold-outline">PIEP</h1>
            </div>

            <div class="col-md-7">
                <h4 class="font-bold-outline"> Is a non-governmental, non-profit, professional organization who promotes, advances & raises the
                    study, practice &
                    development of environmental planning in the philippines.</h4>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('gallery-external/parallax/jarallax.js') }}"></script>
<script src="{{ asset('gallery-external/ytplayer/index.js') }}"></script>
<script src="{{ asset('gallery-external/theme/js/script.js') }}"></script>
<script>
    (function () {
      var animationInput = document.createElement('input');
      animationInput.setAttribute('name', 'animation');
      animationInput.setAttribute('type', 'hidden');
      document.body.append(animationInput);
    })();

    window.addEventListener('hashchange', function() {
        var element = document.getElementById(location.hash.substring(1));
        if (element) {
            element.scrollIntoView({behavior: "smooth"});
        }
    });
</script>