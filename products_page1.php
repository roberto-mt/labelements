<!------------ HEADER ------------>
<?php
include_once 'header/header.php';
?>
<!------------ TITLE ------------>
  <title>Lab Elements - Products</title>
  <link href="assets/css/style2.css" rel="stylesheet">
</head>     

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
  
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>

    <div class="page-grid-container">

      <div class="row nav-grid">
        <!------------ NAVIGATION BAR - Start ------------>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
          <?php
            include_once 'navigation/navbar.php';
          ?>          
        </nav>
        <!------------ NAVIGATION BAR - End ------------>
      </div>

      <div class="row filter-grid">
        
            <div class="container" id="page-title">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="font-alt">Products</h4>
                  </div>
                </div>
            </div>

          <section class="module-small" id="product-sorting">
            <div class="container">
                <div class="col-md-3 mb-sm-20">
                  <select class="form-control" id="mainCategory" >
                  <option value="">Select Category...</option>
                    <?php
                      include_once 'controller/product/getProductMainCategory.php';    
                    ?>
                  </select>
                </div>

                <div class="col-md-3 mb-sm-20">
                  <select class="form-control" id="subCategory">
                    <option value="">Select...</option>   
                  </select>
                </div>

            </div>
          </section>
          <hr class="divider-w">
      </div>
      
      <div class="row product-content-grid">
          <section class="products">
            <div class="box-container">
              <div id="productTableBody">  
              <!-- Product details will be populated here -->
              </div>       
            </div>
          </section>
          <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
      

          <?php
              require_once $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';

              if(isset($_COOKIE['user_id'])){
                $user_id = $_COOKIE['user_id'];
              } else {
                setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
              }

              if(isset($_POST['add_to_rfqItemList'])){

                $id = create_unique_id();
                $product_id = $_POST['product_id'];
                $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $qty = filter_var($qty, FILTER_SANITIZE_STRING);
                
                $verify_rfq_item_list = $conn->prepare("SELECT * FROM `rfq_item_list` WHERE user_id = ? AND product_id = ?");   
                $verify_rfq_item_list->execute([$user_id, $product_id]);

                $max_rfq_item_list_items = $conn->prepare("SELECT * FROM `rfq_item_list` WHERE user_id = ?");
                $max_rfq_item_list_items->execute([$user_id]);

                if($verify_rfq_item_list->rowCount() > 0){
                    $warning_msg[] = 'Added to RFQ List!';
                }elseif($max_rfq_item_list_items->rowCount() == 101){
                    $warning_msg[] = 'RFQ list is full!';
                }else{

                    // $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                    // $select_price->execute([$product_id]);
                    // $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

                    $insert_rfq_item_list = $conn->prepare("INSERT INTO `rfq_item_list`(id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)");
                    $insert_rfq_item_list->execute([$id, $user_id, $product_id, $price, $qty]);
                    $success_msg[] = 'Added to RFQ List!';
                    }
                  }
          ?>

        </div>

        <div class="row footer-grid">
          <!------------ FOOTER ------------>
          <?php include_once 'footer/footer.php' ?>
          <!------------ FOOTER ------------>
        </div>  
      
        <!-- <div class="main">
        </div> -->
    </div>
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
    const addToRFQ = document.getElementById('addToRFQ');

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
        fetch(`controller/product/getProducts1.php?id=${selectedSecondaryOption}`)
          .then(response => response.text())
          .then(data => {
            // productTableHead.hidden = false;
            productTableBody.innerHTML = data;
          })
          .catch(error => {
            console.error('Error fetching products:', error);
          });
      }
    });

    function submitForm(event) {
    event.preventDefault(); // Prevent default form submission behavior
    const formData = new FormData(event.target); // Get form data
    fetch(window.location.pathname, { method: "POST", body: formData }) // Send form data to server
      .then(response => response.text()) // Handle server response
      .then(data => { console.log("Response from server:", data); })
      .catch(error => { console.error("Error:", error); });
  }

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include 'controller/alert.php'; ?>

</body>
</html>