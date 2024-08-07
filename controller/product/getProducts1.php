<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';

  $selectedSecondaryOptionId = $_GET['id'];
  $select_products = $conn->prepare("SELECT product_entity.entity_id, product_entity.product_name, product_entity.unit_id, 
  product_entity_decimal.value
  FROM product_entity
  INNER JOIN product_entity_decimal
  ON product_entity.entity_id=product_entity_decimal.entity_id
  INNER JOIN product_category_entityMainSub
  ON product_category_entityMainSub.product_entity_id=product_entity.entity_id
  WHERE product_category_entityMainSub.category_sub_id = :secondaryOptionId 
  AND product_entity.is_active = 1
  AND product_entity_decimal.is_active = 1
  AND product_entity_decimal.attribute_id = 77
  ORDER BY product_name ASC");

  $select_products->bindParam(':secondaryOptionId', $selectedSecondaryOptionId);
  $select_products->execute();

  if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
?>
  <form action="" method="POST" class="box">

    <div class="product-card">
      
      <div class="details-grid">
        <div>  
          <h5 class="name"><?= $fetch_product['product_name'] ?></h5>
          <label>ID: </label><input type="" name="product_id" value=" <?= $fetch_product['entity_id']; ?>" readonly> 
        </div>

        <div class="flex">
            <div><label class="price">₱ </label><input class="price" name="price" value=" <?= number_format($fetch_product['value'],2); ?>" readonly></div>
            <div><span class="">UNIT: <?= $fetch_product['unit_id']; ?></span></div>
            <div><input type="number" name="qty" required min="1" value="1" max="999999" maxlength="" class="qty"></div>
        </div>
      </div>

      <!-- <div class="description-grid">
        <div>
        
        </div>
      </div> -->
      
      <div class="cta-grid">
        <div class="flex-button">
          <input type="submit" name="add_to_rfqItemList" value="RFQ" class="btn" id="addToRFQ">
          <!-- <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="delete-btn">Order Now</a> -->
        </div>
      </div>

    </div>

  </form>
<?php
  }
}else{
  echo '<p class="empty">No products found!</p>';
}
?>