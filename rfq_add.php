<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          require_once $_SERVER['DOCUMENT_ROOT'] . '/labelements.shop/build2v/model/conn2.php';

          if(isset($_COOKIE['user_id'])){
            $user_id = $_COOKIE['user_id'];
          } else {
            setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
          }

          

            $id = create_unique_id();
            $product_id = $_POST['product_id'];
            // $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
            $price = $_POST['price'];
            
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

                $insert_rfq_item_list = $conn->prepare("INSERT INTO `rfq_item_list`(id, user_id, product_id, price) VALUES(?,?,?,?)");
                $insert_rfq_item_list->execute([$id, $user_id, $product_id, $price]);
                $success_msg[] = 'Added to RFQ List!';
                }
              }
        ?>