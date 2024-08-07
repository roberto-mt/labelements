<?php
include $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/TCPDF-main/tcpdf.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $unique_id = create_unique_id();
   setcookie('user_id', $unique_id, time() + 60*60*24*30);
}

if(isset($_POST['submit_rfq'])){
    $business_name = filter_var($_POST['business_name'], FILTER_SANITIZE_STRING);
    $business_address = filter_var($_POST['business_address'], FILTER_SANITIZE_STRING);
    $contact_first_name = filter_var($_POST['contact_first_name'], FILTER_SANITIZE_STRING);
    $contact_last_name = filter_var($_POST['contact_last_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $mobile_no = filter_var($_POST['mobile_no'], FILTER_SANITIZE_STRING);

   $verify_rfqList = $conn->prepare("SELECT * FROM `rfq_item_list` WHERE user_id = ?" );
   $verify_rfqList->execute([$user_id]);
   
   if ($verify_rfqList->rowCount() > 0){
      $insert_rfq1 = $conn->prepare("INSERT INTO `rfq_submitted`(id, user_id, business_name, business_address, contact_first_name, contact_last_name, email, mobile_no) 
         VALUES(?,?,?,?,?,?,?,?);
      ");
      $rfq_submit_id = create_unique_id();
      $insert_rfq1->execute([$rfq_submit_id, $user_id, $business_name, $business_address, $contact_first_name, $contact_last_name, $email, $mobile_no]);

               while($f_rfqList = $verify_rfqList->fetch(PDO::FETCH_ASSOC)){
                  $insert_rfq2 = $conn->prepare("INSERT INTO rfq_submitted_products (rfq_submit_id, product_id, price, qty) 
                                 VALUES (:rfq_submit_id, :product_id, :price, :qty)");
                     $insert_rfq2->bindParam(':rfq_submit_id', $rfq_submit_id);
                     $insert_rfq2->bindParam(':product_id', $f_rfqList['product_id']);
                     $insert_rfq2->bindParam(':price', $f_rfqList['price']);
                     $insert_rfq2->bindParam(':qty', $f_rfqList['qty']);
                  $insert_rfq2->execute();
               }
   } else {
      $warning_msg[] = 'Your RFQ List is empty!';
   }

   if($insert_rfq2){
      $delete_rfqList_id = $conn->prepare("DELETE FROM `rfq_item_list` WHERE user_id = ?");
      $delete_rfqList_id->execute([$user_id]);
      header('location:rfq_submitted_page.php');
   }

$conn->close;
}
?>


<!------------ HEADER ------------>
<?php include_once 'header/header.php'; ?>
<!------------ TITLE ------------>
<title>Submit RFQ</title>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"> -->
<link href="assets/css/style2.css" rel="stylesheet">
</head>
<body>
<!------------ NAVIGATION BAR ------------>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <?php
          include_once 'navigation/navbar.php';
          ?>          
        </nav>
<!------------ NAVIGATION BAR - End ------------>
<br>
<br>
<div class="row product-content-grid">
<section class="checkout">
   <h1 class="heading">Request For Quotation Form</h1>

   <div class="row">

      <form action="" method="POST">
         <!-- <div class="flex"> -->
         <div>   
            <div class="box">
               <h6 class="font-alt">Business Details</h6>
               <section class="rfqForm_business">
                  <div class="form-group">
                     <label class="form_label" for="business_name">Business Name / Company Name *</label>
                     <input class="form-control" type="text" id="business_name" name="business_name" placeholder="" required="required" data-validation-required-message="Please enter your registered business name."/>
                     <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                     <label class="form_label" for="business_address">Business Address / Shipping Address *</label>
                     <input class="form-control" type="text" id="business_address" name="business_address" placeholder="" required="required" data-validation-required-message="Please enter your business address."/>
                     <p class="help-block text-danger"></p>
                  </div>
               </section>       
            </div>

            <div class="box">
               <h6 class="font-alt">Contact Details</h6>
                <section class="rfqForm_business">
                  <div class="inline-form">
                    <label class="form_label" for="contact_first_name">First Name *</label>
                    <input class="form-input" type="text" id="contact_first_name" name="contact_first_name" placeholder="" required="required" data-validation-required-message="Please enter your contact person first name."/>
                    <p class="help-block text-danger"></p>
                 </div>

                 <div class="inline-form">
                    <label class="form_label" for="contact_last_name">Last Name *</label>
                    <input class="form-input" type="text" id="contact_last_name" name="contact_last_name" placeholder="" required="required" data-validation-required-message="Please enter your contact person first name."/>   
                    <p class="help-block text-danger"></p>
                  </div>

                  <div class="inline-form">
                    <label class="form_label" for="email">Email *</label>
                    <input class="form-input" type="email" id="email" name="email" placeholder="" required="required" data-validation-required-message="Please enter your email address."/>
                    <p class="help-block text-danger"></p>
                  </div>

                  <div class="inline-form">
                    <label class="form_label" for="mobile_no">Mobile No.</label>
                    <input class="form-input" type="mobile_no" id="mobile_no" name="mobile_no" placeholder="" required="required" data-validation-required-message="Please enter your mobile_no address."/>
                    <p class="help-block text-danger"></p>
                  </div>
                </section>
            </div>

         </div>
         <input type="submit" value="SUBMIT" name="submit_rfq" class="btn" id="addToRFQ">
         <button class="btn small btn-round btn-d" type="reset" name="reset" id="reset-button">Reset</button>
      </form>

      <div class="summary">
         <h3 class="title">Product Items</h3>
         <?php
            $grand_total = 0;
            if(isset($_GET['entity_id'])){
               $select_get = $conn->prepare("SELECT * FROM `product_entity` WHERE entity_id = ?");
               $select_get->execute([$_GET['entity_id']]);
               while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
         ?>
         <div class="flex">
            <!-- <img src="uploaded_files class="image" alt=""> -->
            <div>
               <h4 class="name"><?= $fetch_get['product_name']; ?></h4>
               <p class="price">₱ <?= $fetch_get['price']; ?> x 1</p>
            </div>
         </div>
         <?php
               }
            }else{
               $select_rfqList = $conn->prepare("SELECT * FROM `rfq_item_list` WHERE user_id = ?");
               $select_rfqList->execute([$user_id]);
               if($select_rfqList->rowCount() > 0){
                  while($fetch_rfqList = $select_rfqList->fetch(PDO::FETCH_ASSOC)){
                     $select_products = $conn->prepare("SELECT * FROM `product_entity` WHERE entity_id = ?");
                     $select_products->execute([$fetch_rfqList['product_id']]);
                     $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                     $sub_total = ($fetch_rfqList['qty'] * $fetch_rfqList['price']);

                     $grand_total += $sub_total;
            
         ?>
         <div class="flex">
            <!-- <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt=""> -->
            <div>
               <h4 class="name"><?= $fetch_product['product_name']; ?></h4>
               <span><?= $fetch_product['unit_id']; ?></span>
               <p class="price">₱ <?= number_format($fetch_rfqList['price'],2); ?> x <?= $fetch_rfqList['qty']; ?></p>
            </div>
         </div>
         <?php
                  }
               }else{
                  echo '<p class="empty">Your RFQ List is empty</p>';
               }
            }
         ?>
         <div class="grand-total"><span>Grand Total:</span><p>₱ <?= number_format($grand_total,2); ?></p></div>
      </div>

   </div>

</section>
</div>
<!------------ FOOTER ------------>
<?php include_once 'footer/footer.php' ?>
<!------------ FOOTER ------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>
</body>
</html>