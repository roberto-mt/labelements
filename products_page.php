<!------------ HEADER ------------>
<?php
include_once 'header/header.php';
?>
<!------------ TITLE ------------>
  <title>Lab Elements - Products</title>
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
      <!------------ NAVIGATION BAR - End ------------>
      
      <div class="main">

        <div class="container" id="page-title">
            <div class="row">
              <div class="col-sm-6">
                <h4 class="font-alt">Products</h4>
              </div>
            </div>
        </div>

        <section class="module-small" id="product-sorting">
          <div class="container">
              <div class="col-sm-3 mb-sm-20">
                <select class="form-control" id="mainCategory" >
                <option value="">Select Category...</option>
                  <?php
                    include_once 'controller/product/getProductMainCategory.php';    
                  ?>
                </select>
              </div>

              <div class="col-sm-4 mb-sm-20">
                <select class="form-control" id="subCategory">
                  <option value="">Select...</option>   
                </select>
              </div>

          </div>
        </section>
        <hr class="divider-w">

        <!-- Product List start -->
        <section class="module" id="product-list">
          <div class="container">
            <div class="row multi-columns-row">
              <div class="col-sm-4">
                <div class="menu">
                  <table id="productTable" class="">
                      <thead class="menu-title font-alt" id="productTableHead" hidden>
                        <tr>
                          <th>ID</th>
                          <th>Product Name</th>
                          <th>Unit</th>
                          <th>Price</th>
                          <th class="action_column">Action</th>
                        </tr>
                      </thead>
                      <tbody id="productTableBody">
                        <!-- Product details will be populated here -->
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Product List end -->

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


    <script>
    const mainCategory = document.getElementById('mainCategory');
    const subCategory = document.getElementById('subCategory');
    const productTableBody = document.getElementById('productTableBody');
    const productTableHead = document.getElementById('productTableHead');

    // Event listener for primary dropdown change
    mainCategory.addEventListener('change', function() {
      const selectedPrimaryOption = this.value;
      
      // Clear secondary dropdown options
      subCategory.innerHTML = '<option value="">Select...</option>';

      if (selectedPrimaryOption !== '') {
        fetch(`controller/product/getProductSubCategory.php?id=${selectedPrimaryOption}`)
          .then(response => response.text())
          .then(data => {
            subCategory.innerHTML += data;
          })
          .catch(error => {
            console.error('Error fetching sub category:', error);
          });
      }
    });

    // Event listener for secondary dropdown change
    subCategory.addEventListener('change', function() {
      const selectedSecondaryOption = this.value;

      // Clear product table
      productTableBody.innerHTML = '';

      if (selectedSecondaryOption !== '') {
        // Fetch products based on the selected secondary option using PHP script
        fetch(`controller/product/getProducts.php?id=${selectedSecondaryOption}`)
          .then(response => response.text())
          .then(data => {
            productTableHead.hidden = false;
            productTableBody.innerHTML = data;
          })
          .catch(error => {
            console.error('Error fetching products:', error);
          });
      }
    });
  </script>


  </body>
</html>