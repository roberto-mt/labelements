<?php
include $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:rfq_submitted_page.php');
}

if(isset($_POST['cancel'])){

   $update_orders = $conn->prepare("UPDATE `rfq_submitted` SET rfq_status = ? WHERE id = ?");
   $update_orders->execute(['canceled', $get_id]);
   header('location:rfq_submitted_page.php');

}
?>
<!------------ HEADER ------------>
<?php include_once 'header/header.php'; ?>
<!------------ TITLE ------------>
<title>View RFQ</title>
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
<section class="order-details">

   <h1 class="heading">RFQ Details</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_orders = $conn->prepare("SELECT * FROM `rfq_submitted` WHERE id = ? LIMIT 1");
      $select_orders->execute([$get_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
            $select_product = $conn->prepare("SELECT * FROM `product_entity` WHERE entity_id = ? LIMIT 1");
            $select_product->execute([$fetch_order['product_id']]);
            if($select_product->rowCount() > 0){
               while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                  $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                  $grand_total += $sub_total;
   ?>
   <div class="box">
      <div class="col">
         <p class="title"><i class="fas fa-calendar"></i><?= $fetch_order['created_at']; ?></p>
         <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
         <p class="price">₱ <?= number_format($fetch_order['price'],2); ?> x <?= $fetch_order['qty']; ?></p>
         <h3 class="name"><?= $fetch_product['product_name']; ?></h3>
         <p class="grand-total">Grand Total: <span>₱ <?= number_format($grand_total,2); ?></span></p>
      </div>
      <div class="col">
         <p class="title">billing address</p>
         <p class="user">
         <i class="fas fa-user"></i><?= $fetch_order['business_name']; ?><br>
         <i class="fas fa-phone"></i><?= $fetch_order['mobile_no']; ?><br>
         <i class="fas fa-envelope"></i><?= $fetch_order['email']; ?><br>
         <i class="fas fa-map-marker-alt"></i><?= $fetch_order['business_address']; ?>
        </p>
        <label>Status: </label>
         <p class="status" style="color:<?php if($fetch_order['rfq_status'] == 'delivered'){echo 'green';}elseif($fetch_order['rfq_status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $fetch_order['rfq_status']; ?></p>
         
         <?php if($fetch_order['rfq_status'] == 'canceled'){ ?>
            <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">order again</a>
         <?php }else{ ?>
         <form action="" method="POST">
            <input type="submit" value="cancel order" name="cancel" class="delete-btn" onclick="return confirm('cancel this order?');">
         </form>
         <?php } ?>
         
      </div>
   </div>
   <?php
            }
         }else{
            echo '<p class="empty">product not found!</p>';
         }
      }
   }else{
      echo '<p class="empty">No RFQ Found!</p>';
   }
   ?>

   </div>

</section>














<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>