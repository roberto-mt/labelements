<!------------ HEADER ------------>
<?php
include_once 'header/header.php';
?>
<!------------ TITLE ------------>
  <title>Lab Elements - About</title>
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
        <section class="module bg-dark-60 about-page-header" data-background="assets/images/warehouse2.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">About Us</h2>
                <!-- <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div> -->
              </div>
            </div>
          </div>
        </section>

        <section class="module-about">
          <div class="container">
            <div class="row">

              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="about-column">
                    <h5 class="font-alt">Your Premier Destination for Lab Supplies</h5>
                    <p style="text-align: justify;">We are committed to powering your scientific pursuits with top-quality laboratory supplies and equipment. Whether you are a researcher, a student, or a professional in the field, we understand the importance of reliable, high-grade materials in your work and studies.</p>
                    <br>
                </div>
              </div>

              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="about-column">
                    <h5 class="font-alt">Customer Satisfaction Guaranteed</h5>
                    <p style="text-align: justify;">We prioritize your satisfaction above all else. If you're not completely satisfied with your purchase, our customer support team is dedicated to resolving any issues promptly.</p>
                    <br>
                </div>
              </div>
                          
              <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="about-column">
                    <h5 class="font-alt">Our Product Categories</h5>
                    <ul>
                        <li>Laboratory Glassware</li>
                        <li>Chemicals & Reagents</li>
                        <li>Lab Equipment & Instruments</li>
                        <li>Consumables & Accessories</li>
                        <li>Safety & Protection Gear</li>
                    </ul>
                    <br>
                </div>
              </div>

            </div>
          </div>
        </section>

        <hr class="divider-w">

        <section class="module" id="services">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Why Choose Lab Elements?</h2>
                <div class="module-subtitle font-serif"></div>
              </div>
            </div>
            <div class="row multi-columns-row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-lightbulb"></span></div>
                  <h3 class="features-title font-alt">Quality Assurance</h3>
                  <p>We prioritize quality and reliability, sourcing products from trusted manufacturers and brands known for their excellence in the scientific community. Rest assured, your experiments are in good hands with our supplies.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-bike"></span></div>
                  <h3 class="features-title font-alt">Extensive Product Range</h3>
                  <p>Explore our comprehensive catalog featuring a diverse array of laboratory supplies, from glassware and chemicals to cutting-edge equipment and instruments. Find everything you need under one roof!</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-tools"></span></div>
                  <h3 class="features-title font-alt">Expert Guidance</h3>
                  <p>Need assistance in selecting the right products for your specific research needs? Our knowledgeable team is here to offer expert advice and recommendations, ensuring you make informed decisions.</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="features-item">
                  <div class="features-icon"><span class="icon-gears"></span></div>
                  <h3 class="features-title font-alt">Convenience & Efficiency</h3>
                  <p>Shopping with us is seamless and hassle-free. Enjoy a user-friendly interface, secure transactions, and prompt delivery, so you can focus on what truly matters.</p>
                </div>
              </div>
            </div>
          </div>
        </section>

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