<?php
include $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}
?>
<!------------ HEADER ------------>
<?php include_once 'header/header.php'; ?>
<!------------ TITLE ------------>
<title>My RFQ</title>
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
<section class="orders">
   <h1 class="heading">My RFQ</h1>

   <div class="box-container">

   <?php
      $select_rfq = $conn->prepare("SELECT * FROM `rfq_submitted` WHERE user_id = ? ORDER BY created_at DESC");
      $select_rfq->execute([$user_id]);
      if($select_rfq->rowCount() > 0){
         while($fetch_rfq = $select_rfq->fetch(PDO::FETCH_ASSOC)){
            $select_product = $conn->prepare("SELECT * FROM `product_entity` WHERE entity_id = ?");
            $select_product->execute([$fetch_rfq['product_id']]);
            if($select_product->rowCount() > 0){
               while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" <?php if($fetch_rfq['rfq_status'] == 'canceled'){echo 'style="border:.2rem solid red";';}; ?>>
      <a href="rfq_view_page.php?get_id=<?= $fetch_rfq['id']; ?>">
         <p class="date"><i class="fa fa-calendar"></i><span><?= $fetch_rfq['created_at']; ?></span></p>
         <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
         <h3 class="name"><?= $fetch_product['product_name']; ?></h3>
         <p class="price"><?= $fetch_rfq['price']; ?> x <?= $fetch_rfq['qty']; ?></p>
         <p class="status" style="color:<?php if($fetch_rfq['rfq_status'] == 'delivered'){echo 'green';}elseif($fetch_rfq['rfq_status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $fetch_rfq['rfq_status']; ?></p>
      </a>
   </div>
   <?php
            }
         }
      }
   }else{
      echo '<p class="empty">No RFQ Found!</p>';
   }
   ?>

   </div>

</section>
</div>













<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>