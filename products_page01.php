<!------------ HEADER ------------>
<?php
include_once 'header/header.php';
?>
<!------------ TITLE ------------>
  <title>Lab Elements - Products</title>

  <style>
    .container2 {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .column {
        flex: 1;
        padding: 10px;
        margin: 10px
    }
    .column:nth-child(odd) {
        /* background-color: #f0f0f0; */
    }
    .column:nth-child(even) {
        background-color: #e0e0e0;
    }
</style>

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
            <!-- <div class="row multi-columns-row"> --> 
              <div class="container2">
                
                <div class="column">
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
                          <!-- Product Start -->
                            

                            
                          <!-- Product End -->
                        </tbody>

                      </table>
                </div>


                <!-- RFQ List Start -->
                <div class="column">
                  <h5 class="font-alt" style="text-align:center">Request for Quote</h5>
                    <ul id="rfqList">
                      <li><span id="textLine"></span></li>
                    </ul>  
                </div>
                <!-- RFQ List End -->
              </div>
            <!-- </div> -->
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
    <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="assets/lib/smoothscroll.js"></script>
    <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
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

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.rfq-button').forEach(button => {
            button.addEventListener('click', function() {
                const entityId = this.dataset.entityId;
                const productName = this.dataset.productName;
                const unitId = this.dataset.unitId;
                const value = this.dataset.value;
                console.log("button is clicked");
                let textLine = document.getElementById("textLine");
                textLine.innerHTML = "Button is clicked!!!";

                // AJAX call to send data to PHP script
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'insert_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle response if needed
                        console.log(xhr.responseText);
                    }
                };
                xhr.send('entityId=' + entityId + '&productName=' + productName + '&unitId=' + unitId + '&value=' + value);
            });
        });
    });
</script>


</body>
</html>