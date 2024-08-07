<!------------ HEADER ------------>
<?php
include_once 'header/header.php';
?>
<!------------ TITLE ------------>
  <title>Lab Elements - Contact Us</title>
</head>     

  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>

      <!------------ NAVIGATION BAR ------------>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <?php
          include_once 'navigation/navbar.php';
          ?>          
        </nav>

      <div class="main">
        <section class="module-contact">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <h4 class="font-alt">Contact Us</h4><br/>
                
                <form id="contactForm" role="form" method="post" action="controller/contact/postContactUs.php">
                  
                <!------------ contact form ------------>
                <?php include_once 'sections/contactForm.php' ?>
                <!------------ contact form ------------>                

                </form>
                </br>
                <div class="ajax-response" id="contactFormResponse"></div>
              </div>
              </br></br></br>
              <div class="col-sm-6">
                <h5 class="font-alt">Our Office:</h5>
                <p>L10-1 One Global Place 25th Street Corner 5th Avenue<br>
                Bonifacio Global City, Taguig 1630
                </p>
                <hr/>
                <h5 class="font-alt">Business Hours</h5>
                <ul class="list-unstyled">
                  <li>Monday - Friday: 8am to 5pm</li>
                </ul>
              </div>
            </div>
          </div>
        </section>

        <!-- <section id="map-section">
          <div id="map"></div>
        </section> -->
        
        <!------------ FOOTER ------------>
        <?php include_once 'footer/footer.php' ?>
        <!------------ FOOTER ------------>
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
    <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK2Axt8xiFYMBMDwwG1XzBQvEbYpzCvFU"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>