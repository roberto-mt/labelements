<!------------ HEADER ------------>
<?php
include_once 'header/header.php';
?>
<!------------ TITLE ------------>
  <title>Lab Elements</title>
</head>   
  
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>

      <!------------ NAVIGATION BAR ------------>
      <nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
        <?php
        include_once 'navigation/navbar.php';
        ?>  
      </nav>

      <section class="home-section home-fade home-full-height" id="home">
        <div class="hero-slider">
          <ul class="slides">

          <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;assets/images/shop/LabDark.jpg&quot;);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-1">Empowering Discovery</div>
                  <div class="font-alt mb-40 titan-title-size-4">One Test Tube at a Time</div>
                  <a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                </div>
              </div>
            </li>

            <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;assets/images/shop/MedicalDark.jpg&quot;);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-1">Reliable Care</div>
                  <div class="font-alt mb-30 titan-title-size-4">Delivered with Precision</div>
                  <div class="font-alt mb-40 titan-title-size-1">Safety Secured, Confidence Ensured</div><a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                </div>
              </div>
            </li>

          </ul>
        </div>
      </section>
      
      <div class="main">
        <!------------ SECTION - NEWS ------------>
        <?php //include_once 'sections/news.php'; ?>
        
        <div class="module-small bg-dark">
          <div class="container">
            <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="widget">
                  <h5 class="widget-title font-alt">About Lab Elements</h5>
                  <p style="text-align: justify;">Welcome to Lab Elements, your trusted partner in procuring top-quality medical and laboratory supplies. Our commitment to advancing scientific research, healthcare, and innovation drives every aspect of our business.</p>
                  <p>Mobile: (+63) 966 988 4900</br>
                  Email: <a href="#">labelements.info@gmail.com</a></p>
                </div>
              </div>

              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="widget">
                  <h5 class="widget-title font-alt">Product Categories</h5>
                  <ul>
                    <li><a href="#">Laboratory Glassware</a></li>
                    <li><a href="#">Lab Equipment & Instruments</a></li>
                    <li><a href="#">Consumables</a></li>
                    <li><a href="#">Chemicals & Reagents</a></li>
                    <li><a href="#">Safety & Protection Gear</a></li>
                  </ul>
                </div>
              </div>

              <!-- <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="widget">
                  <h5 class="widget-title font-alt">Send us your inquiry</h5>

                  <form id="contactForm" role="form" method="post" action="controller/contact/contact_us.php"> -->

                  <!------------ contact form ------------>
                  <?php //include_once 'sections/contactForm.php' ?>
                  <!------------ contact form ------------>  

                <!-- </form>
                </br>
                <div class="ajax-response" id="contactFormResponse"></div>
                </div>
              </div> -->

              <!-- <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Recent Comments</h5>
                  <ul class="icon-list">
                    <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                    <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                    <li>Andy on <a href="#">Eco bag Mockup</a></li>
                    <li>Jack on <a href="#">Bottle Mockup</a></li>
                    <li>Mark on <a href="#">Our trip to the Alps</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Popular Posts</h5>
                  <ul class="widget-posts">
                    <li class="clearfix">
                      <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-1.jpg" alt="Post Thumbnail"/></a></div>
                      <div class="widget-posts-body">
                        <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                        <div class="widget-posts-meta">23 january</div>
                      </div>
                    </li>
                    <li class="clearfix">
                      <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-2.jpg" alt="Post Thumbnail"/></a></div>
                      <div class="widget-posts-body">
                        <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a></div>
                        <div class="widget-posts-meta">15 February</div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div> -->

            </div>
          </div>
        </div>

        <hr class="divider-d">

        <!------------ FOOTER ------------>
        <?php include_once 'footer/footer.php'
        ?>

      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!--  
    JavaScripts
    =============================================
    -->
    <script src="assets/lib/jquery/dist/jquery.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/lib/wow/dist/wow.js"></script>
    <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="assets/lib/smoothscroll.js"></script>
    <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>