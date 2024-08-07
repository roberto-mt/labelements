<?php

include $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['update_rfqList'])){
   $rfqList_id = $_POST['rfqList_id'];
   $rfqList_id = filter_var($rfqList_id, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);

   $update_qty = $conn->prepare("UPDATE `rfq_item_list` SET qty = ? WHERE id = ?");
   $update_qty->execute([$qty, $rfqList_id]);

   $success_msg[] = 'RFQ list quantity updated!';
}

if(isset($_POST['delete_item'])){
   $rfqList_id = $_POST['rfqList_id'];
   $rfqList_id = filter_var($rfqList_id, FILTER_SANITIZE_STRING);
   
   $verify_delete_item = $conn->prepare("SELECT * FROM `rfq_item_list` WHERE id = ?");
   $verify_delete_item->execute([$rfqList_id]);

   if($verify_delete_item->rowCount() > 0){
      $delete_rfqList_id = $conn->prepare("DELETE FROM `rfq_item_list` WHERE id = ?");
      $delete_rfqList_id->execute([$rfqList_id]);
      $success_msg[] = 'RFQ item deleted!';
   }else{
      $warning_msg[] = 'RFQ item already deleted!';
   } 
}

if(isset($_POST['empty_rfqList'])){
   $verify_empty_rfqList = $conn->prepare("SELECT * FROM `rfq_item_list` WHERE user_id = ?");
   $verify_empty_rfqList->execute([$user_id]);

   if($verify_empty_rfqList->rowCount() > 0){
      $delete_rfqList_id = $conn->prepare("DELETE FROM `rfq_item_list` WHERE user_id = ?");
      $delete_rfqList_id->execute([$user_id]);
      $success_msg[] = 'RFQ List emptied!';
   }else{
      $warning_msg[] = 'RFQ List already emptied!';
   } 
}
?>

<!------------ HEADER ------------>
<?php include_once 'header/header.php'; ?>
<!------------ TITLE ------------>
<title>RFQ List</title>

<!-- edit pencil button - to be replaced -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

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
<section class="products">
<div class="row product-content-grid">
   <h1 class="heading">RFQ List</h1>
   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_rfqList = $conn->prepare("SELECT * FROM `rfq_item_list` WHERE user_id = ?");
      $select_rfqList->execute([$user_id]);
      if($select_rfqList->rowCount() > 0){
         while($fetch_rfqList = $select_rfqList->fetch(PDO::FETCH_ASSOC)){

         $select_products = $conn->prepare("SELECT * FROM `product_entity` WHERE entity_id = ?");
         $select_products->execute([$fetch_rfqList['product_id']]);
         if($select_products->rowCount() > 0){
            $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
      
   ?>
   <form action="" method="POST" class="box">
      <input type="hidden" name="rfqList_id" value="<?= $fetch_rfqList['id']; ?>">
 
      <h3 class="name"><?= $fetch_product['product_name']; ?></h3>
      <p class="">UNIT: <?= $fetch_product['unit_id']; ?></p>
      <div class="flex">
         <p class="price">₱ <?= number_format($fetch_rfqList['price'],2); ?></p>
         <input type="number" name="qty" required min="1" value="<?= $fetch_rfqList['qty']; ?>" max="99" maxlength="2" class="qty">
         <button type="submit" name="update_rfqList" class="fas fa-edit">
         </button>
      </div>
      <p class="sub-total">Sub Total : <span>₱ <?= number_format($sub_total = ($fetch_rfqList['qty'] * $fetch_rfqList['price']),2); ?></span></p>
      <input type="submit" value="Remove" name="delete_item" class="delete-btn" onclick="return confirm('Remove this item?');">
   </form>
   <?php
      $grand_total += $sub_total;
      }else{
         echo '<p class="empty">Product was not found!</p>';
      }
      }
   }else{
      echo '<p class="empty">Your RFQ list is empty!</p>';
   }
   ?>

   </div>

   <?php if($grand_total != 0){ ?>

      <div class="cart-total">
         <p>Grand Total : <span>₱ <?= number_format($grand_total,2); ?></span></p>
         <a href="rfq_form_page.php" class="btn" id="addToRFQ">Proceed to Quotation Request</a>
         <form action="" method="POST">
          <input type="submit" value="Clear All" name="empty_rfqList" class="delete-btn" onclick="return confirm('Empty your RFQ List?');">
         </form>
         <br>         
      </div>

   <?php } ?>
   </div>
</section>
<!------------ FOOTER ------------>
<?php include_once 'footer/footer.php' ?>
<!------------ FOOTER ------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>
</body>
</html>