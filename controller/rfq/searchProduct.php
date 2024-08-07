<?php
	$errors = array();

	// Check if name has been entered
	if (!isset($_POST['product_search'])) {
		$errors['product_search'] = 'Please enter your name';
	}

    $errorOutput = '';

    if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}

    $product_search = $_POST['product_search'];
    require_once 'controller/conn/config.php';
    session_start();

    $sql = "SELECT product_entity.entity_id, product_entity.product_name, product_entity.unit_id,
    product_entity_decimal.value, product_inventory.quantity_on_hand, product_inventory.merchant_availability, 
    product_entity.sku, product_entity.is_website
    FROM product_entity
    INNER JOIN product_entity_decimal
    ON product_entity.entity_id=product_entity_decimal.entity_id
    INNER JOIN product_inventory
    ON product_entity.entity_id=product_inventory.product_entity_id
    WHERE product_entity.product_name
    LIKE '%$product_search%'
    AND product_entity.is_active = 1
    AND product_entity_decimal.is_active = 1
    AND product_entity_decimal.attribute_id = 77
    OR product_entity.sku LIKE '%$product_search%'
    AND product_entity.is_active = 1
    AND product_entity_decimal.is_active = 1
    AND product_entity_decimal.attribute_id = 77
    ORDER BY product_name ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();


    
    $options = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Using htmlspecialchars to prevent XSS
        $options .= "<option>" . htmlspecialchars($row['product_name']) . "</option>";
    }

    echo $options;
?>