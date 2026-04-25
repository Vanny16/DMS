<style>
    .white {
        color: #fff;
    }

    .font-Moririse2 {
    font-family: Moririse2 !important;
    }

    .font-arial {
    font-family: Arial, sans-serif;
    }
    
    /* Helvetica, sans-serif */
    .font-helvetica {
    font-family: Helvetica, sans-serif;
    }
    
    /* Times New Roman, serif */
    .font-times-new-roman {
    font-family: 'Times New Roman', serif;
    }
    
    /* Georgia, serif */
    .font-georgia {
    font-family: Georgia, serif;
    }
    
    /* Courier New, monospace */
    .font-courier-new {
    font-family: 'Courier New', monospace;
    }
    
    /* Verdana, Geneva, sans-serif */
    .font-verdana {
    font-family: Verdana, Geneva, sans-serif;
    }

    .font-bold-outline {
        font-size: 50px;
        font-weight: 900;
        color: rgb(16, 118, 59); /* Text color */
        text-shadow: -2px 1px 0 rgb(97, 229, 176),
        1px -1px 0 rgb(158, 247, 216),
        -1px 1px 0 rgb(158, 247, 216),
        1px 1px 0 rgb(158, 247, 216); /* Outline effect */
    }
    
    
    .officer {
        text-align: center;
        margin-bottom: 30px;
    }

    .officer img {
        border-radius: 50%;
        width: 250px;
        height: 330px;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        /* margin-left: 25px; */
    }

    .officer-2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .officer-2 img {
        border-radius: 50%;
        width: 250px;
        height: 250px;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        /*  */
        /* margin-left: 25px; */
    }

    .officer-name {
        font-weight: 900;
        margin-top: 10px;
        font-size: 1.2rem;
    }

    .officer-title {
        margin-top: -5px;
        font-size: 1.1rem;
    }
</style>


<section class="features032 cid-u2OeWQ0rWX mbr-parallax-background white" id="features-33-u2OeWQ0rWX">
    <div class="container">
    
        {{-- <p class="font-arial">This text uses Arial font.</p>
        <p class="font-Moririse2">This text uses Arial font.</p>
        <p class="font-helvetica">This text uses Helvetica font.</p>
        <p class="font-times-new-roman">This text uses Times New Roman font.</p>
        <p class="font-georgia">This text uses Georgia font.</p>
        <p class="font-courier-new">This text uses Courier New font.</p>
        <p class="font-verdana">This text uses Verdana font.</p> --}}

        <h1 class="text-center mb-5 mt-n4 font-bold-outline font-Moririse2">BOARD OF TRUSTEES AND OFFICERS 2024</h1>
        <div class="row justify-content-center mb-3">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <!-- President -->
                <div class="officer">
                    <a href="{{ asset('images/officers2024/(Pres)JOEL S PARDILLO.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Pres)JOEL S PARDILLO.png') }}" class="img-fluid gallery-image" alt="President">
                    </a>
                    <div class="officer-name">EnP JOEL S. PARDILLO</div>
                    <div class="officer-title">President</div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Vice President -->
                <div class="officer">
                    <a href="{{ asset('images/officers2024/(VP)SOFRONIO M JUCUTAN.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(VP)SOFRONIO M JUCUTAN.png') }}" class="img-fluid gallery-image"
                            alt="Vice President">
                    </a>
                    <div class="officer-name">EnP SOFRONIO M. JUCUTAN</div>
                    <div class="officer-title">Vice President</div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    
        <div class="row justify-content-center">
            <div class="col-md-3">
                <!-- President -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(Sect)JANE P BANTILAN.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Sect)JANE P BANTILAN.png') }}" class="img-fluid gallery-image"
                            alt="Secretary">
                    </a>
                    <div class="officer-name">EnP JANE P. BANTILAN</div>
                    <div class="officer-title">Secretary</div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Vice President -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(Tres)RYAN ANTHONY A PARAN.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Tres)RYAN ANTHONY A PARAN.png') }}" class="img-fluid gallery-image"
                            alt="Treasurer">
                    </a>
                    <div class="officer-name">EnP RYAN ANTHONY A. PARAN</div>
                    <div class="officer-title">Treasurer</div>
                </div>
            </div>
            <!-- Add other officers here -->
            <!-- Below is just a sample layout -->
            <div class="col-md-3">
                <!-- Secretary -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(Audt)CAROLINA R ANGEL.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Audt)CAROLINA R ANGEL.png') }}" class="img-fluid gallery-image"
                            alt="Auditor">
                    </a>
                    <div class="officer-name">EnP CAROLINA R. ANGEL</div>
                    <div class="officer-title">Auditor</div>
                </div>
            </div>
            <!-- Repeat the above pattern for other officers -->
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3">
                <!-- President -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(BOT1)JOSIE JEAN R RABANOZ.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(BOT1)JOSIE JEAN R RABANOZ.png') }}" class="img-fluid gallery-image"
                            alt="BOT Member">
                    </a>
                    <div class="officer-name">EnP JOSIE JEAN R. RABANOZ</div>
                    <div class="officer-title">BOT Member</div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Vice President -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(BOT2)IVAN C CORTEZ.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(BOT2)IVAN C CORTEZ.png') }}" class="img-fluid gallery-image"
                            alt="BOT Member">
                    </a>
                    <div class="officer-name">EnP IVAN C. CORTEZ</div>
                    <div class="officer-title">BOT Member</div>
                </div>
            </div>
            <!-- Add other officers here -->
            <!-- Below is just a sample layout -->
            <div class="col-md-3">
                <!-- Secretary -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(BOT3)JOSEPH RAYMUND A SUMABAL.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(BOT3)JOSEPH RAYMUND A SUMABAL.png') }}" class="img-fluid gallery-image"
                            alt="BOT Member">
                    </a>
                    <div class="officer-name">EnP JOSEPH RAYMUND A. SUMABAL</div>
                    <div class="officer-title">BOT Member</div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Secretary -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(BOT4)HANNAH JOYCE R MOLDE.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(BOT4)HANNAH JOYCE R MOLDE.png') }}" class="img-fluid gallery-image"
                            alt="BOT Member">
                    </a>
                    <div class="officer-name">EnP HANNAH JOYCE R. MOLDE</div>
                    <div class="officer-title">BOT Member</div>
                </div>
            </div>
            <!-- Repeat the above pattern for other officers -->
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3">
                <!-- President -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(Rep1)DIDNO C CORDA.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Rep1)DIDNO C CORDA.png') }}" class="img-fluid gallery-image"
                            alt="Davao City Representative">
                    </a>
                    <div class="officer-name">EnP DIDNO C. CORDA</div>
                    <div class="officer-title">Davao City Representative</div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Vice President -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(Rep2)NELSON F PLATA.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Rep2)NELSON F PLATA.png') }}" class="img-fluid gallery-image"
                            alt="Davao del Norte Representative">
                    </a>
                    <div class="officer-name">EnP NELSON F. PLATA</div>
                    <div class="officer-title">Davao del Norte Representative</div>
                </div>
            </div>
            <!-- Add other officers here -->
            <!-- Below is just a sample layout -->
            <div class="col-md-3">
                <!-- Secretary -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(Rep3)VIVIEN S BERMUDEZ.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Rep3)VIVIEN S BERMUDEZ.png') }}" class="img-fluid gallery-image"
                            alt="Davao de Oro Representative">
                    </a>
                    <div class="officer-name">EnP VIVIEN S. BERMUDEZ</div>
                    <div class="officer-title">Davao de Oro Representative</div>
                </div>
            </div>
            <div class="col-md-3">
                <!-- Secretary -->
                <div class="officer-2">
                    <a href="{{ asset('images/officers2024/(Rep4)JOHN OLIVER P ADAJAR.png') }}" data-lightbox="gallery">
                        <img src="{{ asset('images/officers2024/(Rep4)JOHN OLIVER P ADAJAR.png') }}" class="img-fluid gallery-image"
                            alt="Davao Oriental Representativ">
                    </a>
                    <div class="officer-name">EnP JOHN OLIVER P. ADAJAR</div>
                    <div class="officer-title">Davao Oriental Representativ</div>
                </div>
            </div>
            <!-- Repeat the above pattern for other officers -->
        </div>

    </div>
</section>

<section class="slider4 mbr-embla cid-u2OeWQ1TOO" id="gallery-13-u2OeWQ1TOO">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="embla position-relative" data-skip-snaps="true" data-align="center"
                    data-contain-scroll="trimSnaps" data-loop="true" data-auto-play="true" data-auto-play-interval="2"
                    data-draggable="true">
                    <div class="embla__viewport">
                        <div class="embla__container">
                            <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                                <div class="slide-content">
                                    <div class="item-img">
                                        <div class="item-wrapper">
                                            <a href="{{ asset('images/officers2024/IMG_3906.jpg') }}" data-lightbox="gallery">
                                                <img src="{{ asset('images/officers2024/IMG_3906.jpg') }}"
                                                    class="img-fluid gallery-image" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                                <div class="slide-content">
                                    <div class="item-img">
                                        <div class="item-wrapper">
                                            <a href="{{ asset('images/officers2024/IMG_4186.jpg') }}" data-lightbox="gallery">
                                                <img src="{{ asset('images/officers2024/IMG_4186.jpg') }}"
                                                    class="img-fluid gallery-image" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                                <div class="slide-content">
                                    <div class="item-img">
                                        <div class="item-wrapper">
                                            <a href="{{ asset('images/officers2024/IMG_4223.jpg') }}" data-lightbox="gallery">
                                                <img src="{{ asset('images/officers2024/IMG_4223.jpg') }}"
                                                    class="img-fluid gallery-image" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                                <div class="slide-content">
                                    <div class="item-img">
                                        <div class="item-wrapper">
                                            <a href="{{ asset('images/officers2024/IMG_4227CC.jpg') }}" data-lightbox="gallery">
                                                <img src="{{ asset('images/officers2024/IMG_4227CC.jpg') }}"
                                                    class="img-fluid gallery-image" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                                <div class="slide-content">
                                    <div class="item-img">
                                        <div class="item-wrapper">
                                            <a href="{{ asset('images/officers2024/IMG_4235.jpg') }}" data-lightbox="gallery">
                                                <img src="{{ asset('images/officers2024/IMG_4235.jpg') }}"
                                                    class="img-fluid gallery-image" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                                <div class="slide-content">
                                    <div class="item-img">
                                        <div class="item-wrapper">
                                            <a href="{{ asset('images/officers2024/IMG_4243.jpg') }}" data-lightbox="gallery">
                                                <img src="{{ asset('images/officers2024/IMG_4243.jpg') }}" class="img-fluid gallery-image" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="embla__button embla__button--prev">
                        <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
                        <span class="sr-only visually-hidden visually-hidden">Previous</span>
                    </button>
                    <button class="embla__button embla__button--next">
                        <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
                        <span class="sr-only visually-hidden visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <div class="container">
    <h1 class="text-center fw-bold mb-4 mt-3">Officers</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-2"></div>
        <div class="col-md-3">
            <!-- President -->
            <div class="officer">
                <img src="{{ asset('images/president.jpg') }}" alt="President" class="img-fluid">
                <div class="officer-title">President</div>
            </div>
        </div>
        <div class="col-md-3">
            <!-- Vice President -->
            <div class="officer">
                <img src="{{ asset('images/vice_president.jpg') }}" alt="Vice President" class="img-fluid">
                <div class="officer-title">Vice President</div>
            </div>
        </div>
        <div class="col-md-2"></div>
        <!-- Add other officers here -->
        <!-- Repeat the above pattern for other officers -->
    </div>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <!-- President -->
            <div class="officer-2">
                <img src="{{ asset('images/president.jpg') }}" alt="President" class="img-fluid">
                <div class="officer-title">President</div>
            </div>
        </div>
        <div class="col-md-3">
            <!-- Vice President -->
            <div class="officer-2">
                <img src="{{ asset('images/vice_president.jpg') }}" alt="Vice President" class="img-fluid">
                <div class="officer-title">Vice President</div>
            </div>
        </div>
        <!-- Add other officers here -->
        <!-- Below is just a sample layout -->
        <div class="col-md-3">
            <!-- Secretary -->
            <div class="officer-2">
                <img src="{{ asset('images/secretary.jpg') }}" alt="Secretary" class="img-fluid">
                <div class="officer-title">Secretary</div>
            </div>
        </div>
        <!-- Repeat the above pattern for other officers -->
    </div>
</div> --}}

{{-- <section class="contacts02 map1 cid-u2OeWQ4xCF" id="contacts-2-u2OeWQ4xCF">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 content-head">
                <div class="mbr-section-head mb-5">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                        <strong>Contact Us</strong>
                    </h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="map-wrapper col-md-12">
                <div class="google-map"><iframe frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCt1265A4qvZy9HKUeA8J15AOC4SrCyZe4&q=Davao+Region,+Philippines"
                        allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- src="https://www.google.com/maps/embed/v1/place?key&#x3D;AIzaSyCt1265A4qvZy9HKUeA8J15AOC4SrCyZe4&amp;q&#x3D;Philippines" --}}



<script src="{{ asset('gallery-external/parallax/jarallax.js') }}"></script>
{{-- <script src="{{ asset('gallery-external/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
{{-- <script src="{{ asset('gallery-external/dropdown/js/navbar-dropdown.js') }}"></script> --}}
<script src="{{ asset('gallery-external/embla/embla.min.js') }}"></script>
<script src="{{ asset('gallery-external/embla/script.js') }}"></script>
{{-- <script src="{{ asset('gallery-external/smoothscroll/smooth-scroll.js') }}"></script> --}}
<script src="{{ asset('gallery-external/ytplayer/index.js') }}"></script>
<script src="{{ asset('gallery-external/theme/js/script.js') }}"></script>
{{-- <script src="{{ asset('gallery-external/formoid/formoid.min.js') }}"></script> --}}

<script>
    (function () {
      var animationInput = document.createElement('input');
      animationInput.setAttribute('name', 'animation');
      animationInput.setAttribute('type', 'hidden');
      document.body.append(animationInput);
    })();

</script>