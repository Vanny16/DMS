<footer id="footer" class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 footer-widget footer-about">
                    <!-- <h3 class="widget-title">About Us</h3> -->
                    <img loading="lazy" width="200px" class="footer-logo" src="{{ asset('images/footer-logo.png') }}" alt="UM Official Logo"><br/>
                    PIEP Davao City 8000, Davao del Sur, Philippines<br/>
                    (+63) 082 321-0536<br/>
                    admin@piepdvo.com
                    <div class="footer-social">
                        <ul>
                            <li>
                                <a title="GRIND Facebook account" href="https://www.facebook.com/groups/1299136246827021" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a title="GRIND Twitter Account" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a title="GRIND Youtube Account" href="#">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a title="GRIND Instagram Account" href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                    <h3 class="widget-title">Links</h3>
                    <ul class="list-arrow">
                        <li><a href="{{ action('MainController@home') }}#features-33-u2OeWQ0rWX2">About Us</a></li>
                        {{-- <li><ahref="#">OrganizationalStructure</a></li> --}}
                        <li><a href="https://www.facebook.com/groups/1299136246827021" target="_blank">PIEP Davao Chapter Profile</a></li>
                        <li><a href="{{ action('NewsController@home') }}">News</a></li>
                        {{-- <li><ahref="#">Announcements</a></li> --}}
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                    <h3 class="widget-title">External Links</h3>
                    <ul class="list-arrow">
                        {{-- <li><a href="https://region11.dost.gov.ph/" target="_BLANK" rel="noopener noreferrer">DOST 11 Website</a></li> --}}
                        {{-- <li><a href="#" data-toggle="modal" data-target="#notAvailablemodal">External Link 2</a></li> --}}
                        {{-- <li><a href="#" data-toggle="modal" data-target="#notAvailablemodal">External Link 3</a></li> --}}
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="copyright-info">
                        <span>Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, PIEP Davao Chapter all rights reserved. Designed and developed by <a href="https://www.infinitwebsolutions.com" style="color:orange;">Infinit Solutions.</a>
                        </span>
                    </div>
                </div>
            </div>

            <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                <button class="btn btn-primary" title="Back to Top">
                    <i class="fa fa-angle-double-up"></i>
                </button>
            </div>
        </div>
    </div>
</footer>
